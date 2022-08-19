<?php
session_start();
include "connect_db.php";
if(isset($_POST['email'])&& isset($_POST['password']))
{
    function validate($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    $semail=validate($_POST['email']);
    $password=validate($_POST['password']);
    
    if(empty($semail)){
        echo "<script type=\"text/javascript\">
        alert(\"User Email is Require\");
        window.location='shoplogin.php';
        </script>";
        exit();
    }
    else if(empty($password))
    {
        echo "<script type=\"text/javascript\">
                alert(\"Password is Require\");
                window.location='shoplogin.php';
                </script>";
        exit();
    }
    else{
        $sql="SELECT * FROM shopuser_register WHERE email='$semail' AND pass='$password'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
            if($row['email']===$semail && $row['pass']===$password){
                $_SESSION['semail']=$row['email'];
                $_SESSION['password']=$row['pass'];
                $_SESSION['oname']=$row['name'];
                echo "<script type=\"text/javascript\">
                alert(\"Login Sucessfully!\");
                window.location='shopuser_page.php';
                </script>";
                exit();
            }
        }
        else{
            echo "<script type=\"text/javascript\">
            alert(\"Invalid email or password!\");
            window.location='shoplogin.php';
            </script>";
            exit();
        }
    }
}
mysqli_close($con);

?>

<html>

<head>
    <link rel="stylesheet" href="shoplogin.css">
</head>

<body>
    <div class="container">

        <div class="header">
            <ul><b>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="userregister.php">Home</a></li>
                </b> </ul>
            <img src="img3.jpg">
        </div>

        <p class="tri1"></p>
        <div class="tri2"></div>
        <div class="tri4"></div>
        <div class="form">
            <img src="../project/img2.jpg">
            <form action="shoplogin.php" method="POST">
                <div class="reg">
                    <p>Login</p>
                    <br><br><br>
                    <label>Email</label>
                    <input type="text" name="email">
                    <br><br><br>
                    <label>Password</label>
                    <input type="password" name="password">
                    <br><br><br>
                    <div class="tri3"></div>
                    <button type="submit" name="submit" value="submit">Login</button>
                    <br><br><br>
                    <a href="userlogin.php">Login as User</a>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
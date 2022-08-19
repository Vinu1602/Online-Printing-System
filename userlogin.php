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

    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    
    if(empty($email)){
        echo "<script type=\"text/javascript\">
                alert(\"User Email is Require\");
                window.location='home.html';
                </script>";
        exit();
    }
    else if(empty($password))
    {
        echo "<script type=\"text/javascript\">
        alert(\"Password is Require\");
        window.location='home.html';
        </script>";
        exit();
    }
    else{
        $sql="SELECT * FROM user_register WHERE email='$email' AND password='$password'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
            if($row['email']===$email && $row['password']===$password){
                $_SESSION['email']=$row['email'];
                $_SESSION['password']=$row['password'];
                $_SESSION['name']=$row['name'];
                echo "<script type=\"text/javascript\">
                alert(\"Login Sucessfully!\");
                window.location='userpage.php';
                </script>";
            //   header("Location:userpage.php");
                exit();
            }
        }
        else{
            echo "<script type=\"text/javascript\">
            alert(\"Invalid email or password!\");
            window.location='home.html';
            </script>";
            exit();
        }
    }
}
mysqli_close($con);

?>

<html>

<head>
    <link rel="stylesheet" href="userlogin.css">
</head>

<body>
    <div class="container">

        <div class="header">
            <ul><b>
                    <li><a href="userregister.php">Register</a></li>
                    <li><a href="userregister.php">Home</a></li>
                </b></ul>
            <img src="img3.jpg">
        </div>

        <p class="tri1"></p>
        <div class="tri2"></div>
        <div class="tri4"></div>
        <div class="form">
            <img src="../project/img6.jpg">
            <form action="userlogin.php" method="post">

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
                    <a href="shoplogin.php">Login as Shop Owner</a>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
<?php
session_start();
include "connect_db.php";
if(isset($_POST['name'])&& isset($_POST['email'])&& isset($_POST['pass'])&& isset($_POST['submit']))
{
    

    $name=$_POST['name'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['pass']=$_POST['pass'];
    $submit=$_POST['submit'];
   
$sql="CREATE TABLE IF NOT EXISTS user_register (urid int(11) AUTO_INCREMENT primary key ,name varchar(20),email varchar(100), password varchar(100))";
if(!mysqli_query($con,$sql))
{
    echo "Error creating table:".mysqli_error($con); 
}


$query="INSERT INTO user_register (name,email,password)VALUES('$name','$_SESSION[email]','$_SESSION[pass]')";
if (mysqli_query($con, $query)) {
    
    echo "<script type=\"text/javascript\">
    alert(\"Your information submited sucessfully..\");
    window.location='home.html';
    </script>";
    //echo ' <script> alert ("Your information Submitted Successfully!!") </script>';
   // header("Location:home.html");

  } 
  else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);	
  }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="userregister.css">
    </head>
    <body>
        <div class="container">
            
        <div class="header">
            <ul><b>
                <li><a href="userlogin.php">Login</a></li>
                <li><a href="userregister.php">Home</a></li>
             <b></ul>
            <img src="img3.jpg">
        </div>

        <p class="tri1"></p>
        <div class="tri2"></div>
        <div class="tri4"></div>
        <div class="form">
            <img src="../project/img2.jpg">
            <form action="userregister.php" method="POST">
                <div class="reg">
                <p>Register</p>
                <br><br><br>
                <label>Enter your name</label>
                <input type="text" name="name" required>
                <br><br><br>
                <label>Email</label> 
                <input type="text" name="email" required>
                <br><br><br>
                <label>Password</label> 
                <input type="password" name="pass" required>
                <br><br><br><div class="tri3"></div>
               <button type="submit" name="submit" value="submit">Submit</button>
               <br><br>
               <a href="register.php">Register as Shop Owner</a>
               </div>
            </form>
        
    </div>
    </div>
    </body>
</html>

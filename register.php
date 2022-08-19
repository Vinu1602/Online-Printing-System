<?php
session_start();
include "connect_db.php";
if(isset($_POST['name'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['sname'])&& isset($_POST['address'])
&& isset($_FILES['image'])&& isset($_POST['singleside'])&& isset($_POST['bothside'])&& isset($_POST['submit']))
{
    $_SESSION['oname']=$_POST['name'];
    $_SESSION['semail']=$_POST['email'];
    $_SESSION['password']=$_POST['password'];
    $_SESSION['sname']=$_POST['sname'];
    $_SESSION['saddress']=$_POST['address'];
    $simage=$_FILES['image']['name'];
    // echo $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$_FILES['image']['name']);
    $submit=$_POST['submit'];
    $singlecost=$_POST['singleside'];
    $bothcost=$_POST['bothside'];

    $sql="CREATE TABLE IF NOT EXISTS shopuser_register (rid int(11) AUTO_INCREMENT primary key ,name varchar(20),email varchar(40), pass varchar(100),shopname varchar(30) NOT NULL,
            shopaddress varchar(50),cost_of_singleside int,cost_of_bothside int,shopimage varchar(100));";

    if(!mysqli_query($con,$sql))
    {
        echo "Error creating table:".mysqli_error($con); 
    }
    
    $query="INSERT INTO shopuser_register (name,email,pass,shopname,shopaddress,cost_of_singleside,cost_of_bothside,shopimage)VALUES('$_SESSION[oname]','$_SESSION[semail]','$_SESSION[password]','$_SESSION[sname]','$_SESSION[saddress]','$singlecost','$bothcost','$simage')";
    if (mysqli_query($con, $query)) {
        echo "<script type='text/javascript'>alert('Registered Successfully')</script>";
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);	
    }
}

?>

<html>
    <head>
        <link rel="stylesheet" href="register.css">
    </head>
    <body>
        <div class="container">
            
        <div class="header">
            <ul><b>
                <li><a href="shoplogin.php">Login</a></li>
                <li><a href="home.html">Home</a></li>
            <b></ul>
            <img src="img3.jpg">
        </div>

        <p class="tri1"></p>
        <div class="tri2"></div>
        <div class="tri4"></div>      
        <div class="form">
            <img src="../project/img1.jpg">
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <div class="reg">
                <p>Register</p>
                <br><br>
                <label>Enetr your name</label>
                <input type="text" name="name" required>
                <br><br>
                <label>Email</label> 
                <input type="text" name="email" required>
                <br><br>
                <label>Password</label> 
                <input type="password" name="password" required>
                <br><br>
                <label>Shop Name</label> 
                <input type="text" name="sname" required>
                <br><br>
                <label>Shop Address</label> 
                <input type="text" name="address" required>
                <br><br>
                <label>Cost per page</label>
                <span style="color:#fff; font-size:17px;">Single side </span>
                <input type="text" class="cpp" name="singleside">
                <span style="color:#fff; font-size:17px;padding-left:2%;"> Both side </span>
                <input type="text" class="cpp" name="bothside">
                <br><br>
                <label>Upload Shop Image </label> 
                <input type="file" name="image" class="uimg" onchange="readURL(this);" accept="Image/*" required>  
                <br><br><div class="tri3"></div>
                <button type="submit" name="submit" value="submit">Submit</button>
                <br><br> 
                <a href="userregister.php">Register as User</a>
                </div>
            </form>
        
    </div>
    </div>
    </body>
</html>
<?php
$dbanme="project";
$servername="localhost";
$username="root";
$password="1234";

$con= mysqli_connect($servername,$username,$password,$dbanme);
if(!$con)
{
    die("Connection Error.".mysqli_connect_error($con));
}
?>
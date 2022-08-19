<?php
	session_start();
    include("connect_db.php"); // connect to the database
	include("function.php");
	$myfriend=$_GET['accept'];    
	$me= $_SESSION["logged"];
    $mfriends=mysqli_query($con, "INSERT INTO myfriends(myid,myfriends) VALUES('$me','$myfriend') ")or die(mysqli_error($con));
    $query = mysqli_query("delete from friendship WHERE receiver = '" . $_SESSION["logged"] . "' AND sender = '" . $_GET['accept'] . "' OR receiver = '" . $_GET['accept'] . "' AND sender = '" . $_SESSION["logged"] . "' ");
    {
		echo "<script type=\"text/javascript\">
				alert(\"friend added\");
				window.location='home.php';
				</script>";	
    }
	
	
?>
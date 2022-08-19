<?php
include  "connect_db.php";
session_start();
?>

<html>

<head>
    <link rel="stylesheet" href="edit_profile.css">
</head>

<body>
    <div class="container">
        <p class="tri1"></p>
        <p class="tri"></p>
        <div class="card">

            <h3>Edit Profile</h3>
            <hr>
            <br><br>
            <form action="edit_profile.php" method="post" class="form">
                <p class="tri2"></p>
                <label>Enetr your name</label>
                <input type="text" name="ename">
                <br><br>
                <label>Shop Name</label>
                <input type="text" name="esname">
                <br><br>
                <label>Shop Address</label>
                <input type="text" name="eaddress">
                <br><br>
                <label>Cost per page</label>
                <span style="color:#000; font-size:17px;padding-left:2%;">Single side </span>
                <input type="text" class="cpp" name="esingleside">
                <span style="color:#000; font-size:17px;padding-left:2%;"> Both side </span>
                <input type="text" class="cpp" name="ebothside">
                <br><br>
                <label>Upload Shop Image </label>
                <input type="file" name="eimage" class="uimg" onchange="readURL(this);" accept="Image/*">
                <br><br>
                <button type="submit" name="save">Save</button>
                <button type="submit" name="cancel">Cancel</button>
            </form>
        </div>
        <div class="corner"></div>
    </div>
</body>

</html>

<?php
    if(isset($_POST['save']))
    {
        if($_POST['ename']!=null)
        {
            $sql="UPDATE shopuser_register SET name='$_POST[ename]' WHERE email='$_SESSION[semail]'";
            $res=mysqli_query($con,$sql) or die(mysqli_erroe($con));
            echo "<script type=\"text/javascript\">
            alert(\"Your information updated sucessfully.\");
            window.location='shopuser_page.php';
            </script>";
        }
        else if($_POST['esname']!=null)
        {
            $sql1="UPDATE shopuser_register SET shopname='$_POST[esname]' WHERE email='$_SESSION[semail]'";
            $res1=mysqli_query($con,$sql1) or die(mysqli_erroe($con));
            echo "<script type=\"text/javascript\">
            alert(\"Your information updated sucessfully.\");
            window.location='shopuser_page.php';
            </script>";
        }
        else if($_POST['eaddress']!=null)
        {
            $sql2="UPDATE shopuser_register SET shopaddress='$_POST[eaddress]' WHERE email='$_SESSION[semail]'";
            $res2=mysqli_query($con,$sql2) or die(mysqli_erroe($con));
            echo "<script type=\"text/javascript\">
            alert(\"Your information updated sucessfully.\");
            window.location='shopuser_page.php';
            </script>";
        }
        else if($_POST['esingleside']!=null)
        {
            $sql3="UPDATE shopuser_register SET cost_of_singleside='$_POST[esingleside]' WHERE email='$_SESSION[semail]'";
            $res3=mysqli_query($con,$sql3) or die(mysqli_erroe($con));
            echo "<script type=\"text/javascript\">
            alert(\"Your information updated sucessfully.\");
            window.location='shopuser_page.php';
            </script>";
        }
        else if($_POST['ebothside']!=null)
        {
            $sql4="UPDATE shopuser_register SET cost_of_bothside='$_POST[ebothside]' WHERE email='$_SESSION[semail]'";
            $res4=mysqli_query($con,$sql4) or die(mysqli_erroe($con));
            echo "<script type=\"text/javascript\">
            alert(\"Your information updated sucessfully.\");
            window.location='shopuser_page.php';
            </script>";
        }
        else if($_POST['eimage']!=null)
        {
        $sql5="UPDATE shopuser_register SET shopimage='$_POST[eimage]' WHERE email='$_SESSION[semail]'";
        $res5=mysqli_query($con,$sql5) or die(mysqli_erroe($con));
            echo "<script type=\"text/javascript\">
            alert(\"Your information updated sucessfully.\");
            window.location='shopuser_page.php';
            </script>";
        }
        else{
            echo "<script type=\"text/javascript\">
            alert(\"Nothing get edited.\");
            window.location='shopuser_page.php';
            </script>";
        }
        
    }
    else if(isset($_POST['cancel']))
    {
        echo "<script type=\"text/javascript\">
            window.location='shopuser_page.php';
            </script>";
    }
?>
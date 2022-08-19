<?php
session_start();
include "connect_db.php";
if(isset($_SESSION['oname'])&& isset($_SESSION['semail'])){


?>

<html>

<head>
    <link rel="stylesheet" href="shopuser_page.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <img src="img3.jpg">
        </div>
        <div class="welcome">
            <h2>Welcome <br>
                <?php echo  $_SESSION['oname']; ?>
            </h2>
            <br>
            <div class="option">
                <form method='post'>
                    <ul>
                        <li><button type="submit" name="profile" style=none>PROFILE</button></li>
                        <li><button type="submit" name="req" style=none>REQUESTS</button></li>
                        <li><button type="submit" name="pfile" style=none>FILES TO PRINT</button></li>

                    </ul>
                </form>
            </div>

        </div>
        <div class="space">
            <div class="row">
                <?php
                    if(isset($_POST['req']))
                    {  
                            include "shop_request.php";
                        
                    }

                    if(isset($_POST['profile']))
                    {
                        include "profile.php";
                    }

                    if(isset($_POST['pfile']))
                    {
                        include "fileToPrint.php";
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php
}
?>
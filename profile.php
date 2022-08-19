<?php
include "connect_db.php";

?>
<html>
    <head>
        <link rel="stylesheet" href="profile.css">    
    </head>
<body>
    <?php
        $q1="SELECT * from shopuser_register where email='$_SESSION[semail]'";
        $res2=mysqli_query($con,$q1);
        if(mysqli_num_rows($res2)>0)
        {
            while($row4=mysqli_fetch_assoc($res2))
            {
                $img=$row4['shopimage'];
                $name=$row4['name'];
                $shopname=$row4['shopname'];
                $add=$row4['shopaddress'];
                $email=$row4['email'];
                $cost_o=$row4['cost_of_singleside'];
                $cost_b=$row4['cost_of_bothside'];
                ?>
                <img src="<?php echo "uploads/".$img ; ?>" width="500" height="300" class="proimg">
                <h3 class="pro">
                <?php
                echo "<br><br>Name: ".$name."<br><br> Shop Name: ".$shopname."<br><br> Shop Address: ".$add."<br><br> Email: ".$email."<br><br> Cost of One Side Print: ".$cost_o."<br><br> Cost of Both Side Print: ".$cost_b;
            }
        }
    ?>
    </h3>
        <form action="profile.php" method="post">
            <button type="submit" name="edit" class="edit">Edit</button>
        </from>
    <?php
        if(isset($_POST['edit']))
        { 
            header("location:edit_profile.php");
        }
    ?>
    </body>
</html>
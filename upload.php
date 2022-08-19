<?php
session_start();
include "connect_db.php";
if(isset($_SESSION['email'])){
    
?>

<html>

<head>
    <link rel="stylesheet" href="upload.css">
</head>

<body>


    <div class="container">
        <div class='info'>
            <form action='upload.php' method='post'>
                <h4>Upload Print Details</h4>
                <br>
                <label>Total Pages</label>
                <input type='text' name='num'>
                <br>
                <label>Print Colour</label>
                <select name='print-type' required>
                    <option value='B&W'>Black & White</option>
                    <option value='Colour'>Colour</option>
                </select>
                <br>
                <label>Print Type</labn-el>
                <select name='page-type' required>
                    <option value='oneside'>Single Side</option>
                    <option value='bothside'>Both Side</option>
                </select>
                <br>
                <label>Paper Size</label>
                <select name='print-format' required>
                    <option value='A4'>A4</option>
                    <option value='A3'>A3</option>
                    <option value='A5'>A5</option>
                    <option value='letter'>Letter</option>
                    <option value='exicutive'>Exicutive</option>
                    <option value='statement'>Statement</option>
                    <option value='legal'>Legal</option>
                    <option value='tabloid'>Tabloid</option>
                </select>
                <br><br>
                <label>Number of copies</label>
                <input type="text" name="ncopy">
                <br>
                <label>Choose Shop </label>
                <select name="shop">
                    <option value=" ">--Choose Shop--</option>
                    <?php
                        $i=0;
                        $sql="SELECT shopname,shopaddress FROM shopuser_register";
                        $result=mysqli_query($con,$sql);
                        $collnum=mysqli_num_fields($result);
                        if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_array($result)){
                            $_SESSION['shopname']=$row["shopname"];
                            $_SESSION['shopaddress']=$row["shopaddress"];
                    ?>
                    <option required>
                        <?php echo $row["shopname"]." , ".$row["shopaddress"]; ?>
                    </option>
                    <?php
                        $i++;
                        }}
                        else{
                            echo"no result found.";
                        }
                    ?>
                </select>
                <button name='submit' type='submit'>Send</button>
                <button name='cancel' type='cancel' style="margin-left:10%; position:absolute;">Cancel</button>
                <?php 
                    if(isset($_POST['cancel']))
                    { 
                        echo "<script type=\"text/javascript\">
                        window.location='userpage.php';
                        </script>";
                        exit();
                    }
                ?>
            </form>

        </div>
    </div>
</body>

</html>

<?php

    if(isset($_POST['num'])&&isset($_POST['print-type'])&&isset($_POST['page-type'])&&isset($_POST['print-format'])&&isset($_POST['shop'])&&isset($_POST['ncopy'])&&isset($_POST['submit'])){

        $_SESSION['t_page']=$_POST['num'];
        $p_colour=$_POST['print-type'];
        $_SESSION['p_type']=$_POST['page-type'];
        $p_format=$_POST['print-format'];
        $_SESSION['n_copy']=$_POST['ncopy'];
        $_SESSION['shop']=$_POST['shop'];
        $submit=$_POST['submit'];

        if(empty($_SESSION['t_page'])||empty($_SESSION['n_copy'])||empty($_SESSION['shop'])){
            
            echo "<script type=\"text/javascript\">
                    alert(\"Please enter all information...\");
                    window.location='userpage.php';
                    </script>";
            exit();
        }

        $sql="CREATE TABLE IF NOT EXISTS send_request(req_no int AUTO_INCREMENT primary key ,total_pages int, print_colour varchar(15),page_type varchar(15),page_format varchar(15), no_of_copies int ,choose_shop varchar(100),sender_email varchar(100),send_to varchar(100),c_Date DATETIME DEFAULT CURRENT_TIMESTAMP,c_Time TIMESTAMP default CURRENT_TIMESTAMP,status int);";

        if(!mysqli_query($con,$sql))
        {
            echo "Error creating table:".mysqli_error($con)."<br><br>Now different error<br>"; 
        }

        if(isset($_SESSION['shop']))
        {  
            $s2="SELECT shopname,shopaddress from shopuser_register";
            $res=mysqli_query($con,$s2);
            if(mysqli_num_rows($res))
            { 
                while($r1=mysqli_fetch_array($res)){
                    $_SESSION['shop_name']=$r1["shopname"];
                    $_SESSION['shop_add']=$r1["shopaddress"];
                    $_SESSION['shop_detail']= $r1["shopname"]." , ".$r1["shopaddress"];
                    echo $_SESSION['shop_detail'];
                    if($_SESSION['shop']==$_SESSION['shop_detail'])
                    {
                        $s1="SELECT email from shopuser_register WHERE shopname='$_SESSION[shop_name]' AND shopaddress= '$_SESSION[shop_add]'";
                        $result1 = mysqli_query($con,$s1);
                        if(mysqli_num_rows($result1)) {
                            $row = mysqli_fetch_array($result1);
                            $send_to = $row["email"];
                            $query="INSERT INTO send_request(total_pages,print_colour,page_type,page_format,no_of_copies,choose_shop,sender_email,send_to,status) VALUES('$_SESSION[t_page]','$p_colour','$_SESSION[p_type]','$p_format','$_SESSION[n_copy]','$_SESSION[shop]','$_SESSION[email]','$row[email]','0');";

                            if (mysqli_query($con, $query)) {
                                echo "<script type=\"text/javascript\">
                                alert(\"Request sent\");
                                window.location='userpage.php';
                                </script>";
                            }  

                            else {
                                    echo "Error: " . $query . "<br>" . mysqli_error($con);	
                            }
                        }
                    }       
                }
            }
        }
    }
}
?>
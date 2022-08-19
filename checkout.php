<?php

session_start();
include "connect_DB.php";

$sql1="SELECT total_pages,no_of_copies,page_type,send_to from send_request where sender_email='$_SESSION[email]'";
$res1=mysqli_query($con,$sql1);
if(mysqli_num_rows($res1))
{ 
    while($r1=mysqli_fetch_array($res1)){
        $t_page= $r1['total_pages'];
        $n_copy= $r1['no_of_copies'];
        $p_side= $r1['page_type'];
        $_SESSION['send_to']= $r1['send_to'];
    }
}
$sql2="SELECT cost_of_singleside,cost_of_bothside ,shopname,shopaddress from shopuser_register where email='$_SESSION[send_to]' ";
$res2=mysqli_query($con,$sql2);
if(mysqli_num_rows($res2))
{ 
    while($r2=mysqli_fetch_array($res2)){
        $c_one= $r2['cost_of_singleside'];
        $c_both= $r2['cost_of_bothside'];
        $_SESSION['s_name']= $r2['shopname'];
        $_SESSION['s_add']= $r2['shopaddress'];
    }
}
if($p_side=='oneside')
{
    $p_side=$c_one;
}

else if($p_side=='bothside')
{
    $p_side=$c_both;
}

$_SESSION['Total']=$t_page*$n_copy*$p_side;


?>

<html>

<head>
    <link rel="stylesheet" href="checkout.css">
</head>

<body>
    <div class="container">
        <p class="tri1"></p>
        <p class="tri"></p>
        <div class="card">

            <h3>CHECK OUT DETAILS </h3>
            <hr>
            <br><br>
            <form action="checkout.php" method="post" class="form">
                <p class="tri2"></p>
                <label>Number of copies:
                    <?php echo $n_copy; ?>
                </label> <br>
                <label>Shop Name:
                    <?php echo $_SESSION['s_name'].",".$_SESSION['s_add'];?>
                </label><br>
                <label>Total Amount:
                    <?php echo $_SESSION['Total']; ?>
                </label><br>

                <button type="submit" name="pay"><a href="payment.php" class="pay">Proceed For Payment </a></button>
            </form>
        </div>
        <div class="corner"></div>
    </div>
</body>

</html>
<?php
    include "connect_db.php";
?>
<html>
    <head>
    <link rel="stylesheet" href="available_shop.css">
</head>
    <body>
        
<div class="row" >
<h3>AVAILABLE SHOPS </h3>
        <?php
            $sql="SELECT shopimage,shopname,shopaddress,cost_of_singleside,cost_of_bothside FROM shopuser_register";
            $result=mysqli_query($con,$sql);
            $i=0;
            if(mysqli_num_rows($result)>0){ ?>
                <table>
                <tr>
                <th>Shop Image</th>
                <th>Shop Name</th>
                <th>Shop Address</th>
                <th>Cost Of Single side</th>
                <th>Cost of Both Side</th>
                </tr>
                <?php
            while($row=mysqli_fetch_array($result))
            {
                ?>
               <tr>
               <td> <img src=" <?php echo "uploads/".$row["shopimage"]; ?>" width="100" height="100"> </td>
            
                
               <td><?php echo $row["shopname"]; ?></td>
               <td> <?php echo  $row["shopaddress"];?></td>
               <td> <?php echo  $row["cost_of_singleside"]."Rs.";?></td>  
               <td> <?php echo   $row["cost_of_bothside"]."Rs.";?></td>
                </tr>
              
              
                <?php
            }
            ?>
            </table>
            </div>
            <?php
        }
        ?>
                        
                 </div>
            </body>
                    </html>
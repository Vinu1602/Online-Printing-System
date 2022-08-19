<?php
include "connect_db.php";

?>
<html>
    <head>
        <link rel="stylesheet" href="fileToPrint.css">
    </head>
<body>
    <?php
    
        $sql="SELECT sno,send_from,fname FROM uploaded_files where send_to='$_SESSION[semail]'";   
        $result=mysqli_query($con,$sql);   
        if(mysqli_num_rows($result)>0){ 
    ?>
            <h1 style="margin-left:40%;color:#fff;margin-top:1%;">FILES TO PRINT</h1>
                <table>
                <tr>
                <th>Sender Email</th>
                <th>File</th>
                </tr>
            
    <?php
            while($row=mysqli_fetch_assoc($result))
            {
                $sno=$row["sno"]; 
                $file=$row['fname'];
                echo "
                    <tr>  
                    <td>".$row['send_from']."</td> ";
                    echo" <td><a href='download.php?sno=$sno' >".$file."</a></td>";
            }
        }
    ?>
        </tr>
        </table>   
    </body>
</html>
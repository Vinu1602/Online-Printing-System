<?php
    $data = "vinu@#$90(*";
    $data=trim($data);
    echo $data."<br>";
    $data=stripslashes($data);
    echo $data."<br>";
    $data=htmlspecialchars($data);
    echo $data."<br>";

    echo "<script type=\"text/javascript\">
        alert(\"Your information submited sucessfully..\");
        window.location='home.html';
        </script>";
?>
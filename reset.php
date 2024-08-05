<?php
    include_once "connect.php";
    $sql=mysqli_query($conn,"update phim set viewngay=0");
    if($sql)header("location:index.php");
?>
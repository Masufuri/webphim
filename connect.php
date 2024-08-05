<?php
    $server="localhost";
    $user="root";
    $pass="";
    $database="dacchi_webphim";
    $conn=mysqli_connect("localhost","root","","dacchi_webphim");
    mysqli_query($conn,'set names "utf8"');
    if(!$conn)echo "Không kết nối được".mysqli_connect_error();
?>
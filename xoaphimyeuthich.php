<?php
	session_start();
	include_once "check.php";
    include "control.php";
	global $conn;
    $getdata=new data;
    $del=mysqli_query($conn,"delete from favorites where user_id=".$_GET['user_id']."and movie_id=".$_GET['movie_id']);
    if($del)echo "<script>location.href='phimyeuthich.php'</script>";else echo "lỗi";
    
?>
<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

</body>
</html> -->
<?php
	session_start();
	include_once "check.php";
    if($kiem_tra_cookie=="sai"){echo "<script>location.href='index.php'</script>";die;}
    include "control.php";
    //$getdata=new data;
    global $conn;
    $del=mysqli_query($conn,"delete from actors where id=".$_GET['id']);
    //$getdata->del_theloai($_GET['id']);
    if($del)echo "<script>location.href='themtheloai.php'</script>";else echo "lỗi";
    
?>
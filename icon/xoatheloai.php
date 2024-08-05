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
    if(!isset($_SESSION['adphim']))echo "<script>location.href='index.php'</script>";
    include "control.php";
    $getdata=new data;
    $del=$getdata->del_theloai($_GET['id']);
    if($del)echo "<script>location.href='themtheloai.php'</script>";else echo "lỗi";
    
?>
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
	include_once "../check.php";
    if($kiem_tra_cookie=="sai"){echo "<script>location.href='../index.php'</script>";die;}
    include "../control.php";
    $getdata=new data;
    $inf=mysqli_fetch_assoc($getdata->infophim($_GET['id']));
    
    if(strstr($inf['picture'],"/default")==null)unlink("../".$inf['picture']);
    $xoaphim=$getdata->xoaphim($_GET['id']);
    if($xoaphim)echo "<script>alert('Đã xóa thành công');window.location.href='index.php';</script>";
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") 
                    rrmdir($dir."/".$object); 
                else unlink   ($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
    rrmdir("../phim/".$_GET['id']);
?>
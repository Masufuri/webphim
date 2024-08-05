<!DOCTYPE html>
<?php
    session_start();
    include_once "../check.php";
    if($kiem_tra_cookie=="sai"){echo "<script>location.href='../index.php'</script>";die;}
    include "../control.php";
    global $conn;
    $getdata=new data;
    //$getphim=$getdata->dsphimcu();
    $theloai=$getdata->gettheloai();
    
    if(isset($_GET['trang'])){
        $trang=$_GET['trang']*12-12;
    }
    else {$_GET['trang']=1;$trang=0;}
    
    
	
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
    <div class="sum">
        <div class="left">
            <div class="logo"><a href="index.php"><img src="../img/Untitled-1.png" height="50px" style="margin: 10px"></a></div>
            <div class="danhmuc">
                <ul class="nav">
                    <li class="nav-item"><a href="index.php"><p>DS Phim</p></a></li>
                    <li class="nav-item" style="background:#030a23"><a href="qltheloai.php"><p>QL Thể loại</p></a></li>
                    <li class="nav-item"><a href="qldaodien.php"><p>QL Đạo diễn</p></a></li>
                    <li class="nav-item"><a href="qldienvien.php"><p>QL Diễn viên</p></a></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="main-header">
                <p>Xin chào admin</p>
            </div>
            <div class="container">
                <div class="page-inner">
                    <?php try{
                        if(isset($_GET['id'])){
                            $laytheloai=mysqli_fetch_assoc(mysqli_query($conn,"select * from theloai where matheloai=".$_GET['id']));
                            echo "<form method='post'>
                                <input type='text' value='".$laytheloai['theloai']."' name=txttheloai>
                                <input type='submit' value='Sửa' name='sbsua'>
                            </form>";
                            if(isset($_POST['sbsua'])){
                                $suatheloai=mysqli_query($conn,"update theloai set theloai='".$_POST['txttheloai']."' where matheloai=".$_GET['id']);
                                if($suatheloai){echo "<script>alert('Sửa thành công');window.location.href='qltheloai.php'</script>";}
                            }
                        }
                        else {
                            echo "<form method='post'>
                                <input type='text' name=txttheloai1>
                                <input type='submit' value='Thêm' name='sbthem'>
                            </form>";
                            if(isset($_POST['sbthem'])){
                                $themtheloai=mysqli_query($conn,"insert into theloai(theloai) values('".$_POST['txttheloai1']."')");
                                if($themtheloai){echo "<script>alert('Thêm thành công');window.location.href='qltheloai.php'</script>";}
                            }
                        }
                    }
                    catch(mysqli_sql_exception $e){echo "<script>location.href='qltheloai.php'</script>";}?>
                    <!-- <input type="text" name="" placeholder="Tìm kiếm phim..." id="" onkeyup="showResult(this.value)"> -->
                    <!-- <div id="livesearch"></div> -->
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Tên thể loại</th>
                            <th>Tùy chọn</th>
                        </tr>
                        <?php
                            foreach($theloai as $i){
                                /* echo "<tr>
                                    <td>".$i['matheloai']."</td>
                                    <td>".$i['theloai']."</td>
                                    <td><a href='xoatheloai.php?id=".$i['matheloai']."' onclick='return confirm('are you sure?')'>Xóa</a></td>
                                </tr>"; */
                                ?>
                                <tr>
                                    <td><?php echo $i['matheloai'];?></td>
                                    <td><?php echo $i['theloai'];?></td>
                                    <td><a href="xoatheloai.php?id=<?php echo $i['matheloai'];?>" onclick="return(confirm('are you sure?'))">Xóa</a>&nbsp;<a href="qltheloai.php?id=<?php echo $i['matheloai']?>">Sửa</a></td>
                                    
                                </tr>
                                <?php
                            };
                        ?>
                    </table>
                    <?php
                        $sophim=mysqli_num_rows($getdata->dsphim(-1));//nhỏ hơn 0 để lấy tất ds phim
                        //$sophim1=mysqli_num_rows($sophim);
                        $sotrang=ceil($sophim/12);
                    ?>
                    <div class="cls" style="clear: both;"></div>
                    <ul class="phantrang">
                        
                        <?php
                        if(!isset($_GET['id'])){
                            echo "Trang: ";
                            for($i=1;$i<=$sotrang;$i++){
                            echo "<li><a"?> <?php if(isset($_GET['trang']))if($_GET['trang']==$i)echo "style='background-color:#878787;font-weight:bold;padding: 4px 7px;' ";echo "href='index.php?trang=$i'>$i</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/livesearch.js"></script>
</html>
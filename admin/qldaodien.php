<!DOCTYPE html>
<?php
    session_start();
    include_once "../check.php";
    if($kiem_tra_cookie=="sai"){echo "<script>location.href='../index.php'</script>";die;}
    include "../control.php";
    global $conn;
    $getdata=new data;
    //$getphim=$getdata->dsphimcu();
    //$daodien=$getdata->getdaodienall();
    
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
                    <li class="nav-item"><a href="qltheloai.php"><p>QL Thể loại</p></a></li>
                    <li class="nav-item" style="background:#030a23"><a href="qldaodien.php"><p>QL Đạo diễn</p></a></li>
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
                        $daodien=mysqli_query($conn,"select * from directors limit $trang,12");
                        if(isset($_GET['id'])){
                            $laydaodien=mysqli_fetch_assoc(mysqli_query($conn,"select * from directors where id=".$_GET['id']));
                            echo "<form method='post'>
                                Tên: <input type='text' value='".$laydaodien['name']."' name='tendaodien'><br>
                                Mô tả: <textarea name='mota'>".$laydaodien['mota']."</textarea><br>
                                <input type='submit' value='Sửa' name='sbsua'>
                            </form>";
                            if(isset($_POST['sbsua'])){
                                $suatheloai=mysqli_query($conn,"update directors set name='".$_POST['tendaodien']."',mota='".$_POST['mota']."' where id=".$_GET['id']);
                                if($suatheloai){echo "<script>alert('Sửa thành công');window.location.href='qldaodien.php'</script>";}
                            }
                        }
                        else {
                            echo "<form method='post'>
                                Tên: <input type='text' name='tendaodien1'><br>
                                Mô tả: <textarea name='mota1'></textarea><br>
                                <input type='submit' value='Thêm' name='sbthem'>
                            </form>";
                            if(isset($_POST['sbthem'])){
                                $themtheloai=mysqli_query($conn,"insert into directors(name,mota) values('".$_POST['tendaodien1']."','".$_POST['mota1']."')");
                                if($themtheloai){echo "<script>alert('Thêm thành công');window.location.href='qldaodien.php'</script>";}
                            }
                        }
                    }
                    catch(mysqli_sql_exception $e){echo "<script>location.href='qldaodien.php'</script>";}?>
                    <!-- <input type="text" name="" placeholder="Tìm kiếm phim..." id="" onkeyup="showResult(this.value)"> -->
                    <!-- <div id="livesearch"></div> -->
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Đạo diễn</th>
                            <th>Mô tả</th>
                            <th>Tùy chọn</th>
                        </tr>
                        <?php
                            foreach($daodien as $i){
                                /* echo "<tr>
                                    <td>".$i['matheloai']."</td>
                                    <td>".$i['theloai']."</td>
                                    <td><a href='xoatheloai.php?id=".$i['matheloai']."' onclick='return confirm('are you sure?')'>Xóa</a></td>
                                </tr>"; */
                                ?>
                                <tr>
                                    <td><?php echo $i['id'];?></td>
                                    <td><?php echo $i['name'];?></td>
                                    <td><?php echo $i['mota']?></td>
                                    <td><a href="xoadaodien.php?id=<?php echo $i['id'];?>" onclick="return(confirm('are you sure?'))">Xóa</a>&nbsp;<a href="qldaodien.php?id=<?php echo $i['id']?>">Sửa</a></td>
                                    
                                </tr>
                                <?php
                            };
                        ?>
                    </table>
                    <?php
                        $soluong=mysqli_num_rows(mysqli_query($conn,"select * from directors"));//nhỏ hơn 0 để lấy tất ds phim
                        //$sophim1=mysqli_num_rows($sophim);
                        $sotrang=ceil($soluong/12);
                    ?>
                    <div class="cls" style="clear: both;"></div>
                    <ul class="phantrang">
                        
                        <?php
                        if(!isset($_GET['id'])){
                            echo "Trang: ";
                            for($i=1;$i<=$sotrang;$i++){
                            echo "<li><a"?> <?php if(isset($_GET['trang']))if($_GET['trang']==$i)echo "style='background-color:#878787;font-weight:bold;padding: 4px 7px;' ";echo "href='qldaodien.php?trang=$i'>$i</a></li>";
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
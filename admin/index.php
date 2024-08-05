<!DOCTYPE html>
<?php
    session_start();
    include_once "../check.php";
    if($kiem_tra_cookie=="sai"){echo "<script>location.href='../index.php'</script>";die;}
    include "../control.php";
    global $conn;
    $getdata=new data;
    $getphim=$getdata->dsphimcu();
    if(isset($_GET['trang'])){
        $trang=$_GET['trang']*12-12;
    }
    else {$_GET['trang']=1;$trang=0;}
    try{
        if(isset($_GET['id']))$phim=$getdata->infophim($_GET['id']);
        else $phim=mysqli_query($conn,"select * from phim limit $trang,12");
    }
    catch(mysqli_sql_exception $e){echo "<script>location.href='.'</script>";}
    
	
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
                    <li class="nav-item" style="background:#030a23"><a href="index.php"><p>DS Phim</p></a></li>
                    <li class="nav-item"><a href="qltheloai.php"><p>QL Thể loại</p></a></li>
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
                    <input type="text" name="" placeholder="Tìm kiếm phim..." id="" onkeyup="showResult(this.value)"><a href="themphim.php">Thêm phim</a>
                    <div id="livesearch"></div>
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Tên phim</th>
                            <th>Tùy chọn</th>
                        </tr>
                        <?php
                            foreach($phim as $i){
                                /* echo "<tr>
                                    <td>".$i['matheloai']."</td>
                                    <td>".$i['theloai']."</td>
                                    <td><a href='xoatheloai.php?id=".$i['matheloai']."' onclick='return confirm('are you sure?')'>Xóa</a></td>
                                </tr>"; */
                                ?>
                                <tr>
                                    <td><?php echo $i['maphim'];?></td>
                                    <td><a style="color:black;text-decoration:none" href="<?php echo "../infophim.php?id=".$i['maphim'];?>"><?php echo $i['name'];?></a></td>
                                    <td><a href="xoaphim.php?id=<?php echo $i['maphim'];?>" onclick="return(confirm('are you sure?'))">Xóa</a>&nbsp;<a href="suaphim.php?id=<?php echo $i['maphim'];?>">Sửa</a></td>
                                    
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
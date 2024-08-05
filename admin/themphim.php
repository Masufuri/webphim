<!DOCTYPE html>
<?php
    session_start();
    include_once "../check.php";
    if($kiem_tra_cookie=="sai"){echo "<script>location.href='../index.php'</script>";die;}
    include "../control.php";
    global $conn;
    $getdata=new data;
    $getphim=$getdata->dsphimcu();
    $gettheloai=$getdata->gettheloai();
    $getdaodien=$getdata->getdaodienall();
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
                    <form method="post"  enctype="multipart/form-data" class="form_margin_top_10px">
                        <table>
                            <tr>
                                <td>Tên phim: </td>
                                <td><input type="text" name="name"></td>
                            </tr>
                            <!-- <tr>
                                <td>File phim: </td>
                                <td><input type="text" name="phim"><div><input type="checkbox" id="filesub"><label for="filesub">File sub của m3u8</label></div></td>
                            </tr> -->
                            <tr>
                                <td>File phim: </td>
                                <!-- <td><input type="file" accept="video/*" name="phim"><div><input type="checkbox" id="filesub"><label for="filesub">File sub của m3u8</label></div></td> -->
                                <td><input type="file" accept="video/*" name="phim"></td>
                            </tr>
                            <tr id="trfilesub">
                                <td>File sub:</td>
                                <td><input type="file" accept=".vtt" name="inpfilesub" class="file"></td>
                            </tr>
                            <tr>
                                <td>Ảnh: </td>
                                <td><input type="file" accept="image/*" name="picture" class="file"></td>
                            </tr>
                            <tr>
                                <td>Thể loại: </td>
                                <td>
                                    <?php foreach($gettheloai as $se){echo "<div style='display:inline-block'><input type='checkbox' id='".$se['matheloai']."' name='theloai[]' value='".$se['theloai']."'><label for='".$se['matheloai']."'>".$se['theloai']."</label>&emsp;</div>";};?>
                                </td>
                            </tr>
                            <tr>
                                <td>Loại phim: </td>
                                <td>
                                    <input type="radio" id="phimbo" name="loaiphim" value="Phim Bộ">
                                    <label for="phimbo">Phim Bộ</label>
                                    <input type="radio" id="phimle" name="loaiphim" value="Phim Lẻ" checked>
                                    <label for="phimle">Phim Lẻ</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 130px">Năm sản xuất: </td>
                                <td><input type="number" name="namsx" id="innamsx" required></td>
                            </tr>
                            <tr>
                                <!-- <td>Đạo diễn: </td>
                                <td><input type="text" name="daodien"></td> -->
                                <td><label for="cbdaodien">Đạo diễn:</label></td>
                                <td><select name="cbdaodien" id="cbdaodien">
                                    <?php foreach($getdaodien as $dd){
                                    echo "<option value='".$dd['id']."'>".$dd['name']."</option>";
                                    }?>
                                </select></td>
                            </tr>
                            <tr>
                                <td>Thời lượng: </td>
                                <td><input type="text" name="thoiluong"></td>
                            </tr>
                            <tr>
                                <td>Nội dung: </td>
                                <td><textarea name="noidung"></textarea></td>
                            </tr>
                        </table>
                        <input type="submit" value="Thêm" name="sb">
                    </form>
                    <?php
                        //echo $tinhtoansophim;
                        if(isset($_POST['sb'])){
                            //$thumucphim=substr($_POST['phim'],0,strlen($_POST['phim'])-4);
                            $tl="";$filephim="";
                            $a="";$b="";
                            $a=$_FILES['picture']['tmp_name'];
                            $b=$_FILES['picture']['name'];
                            
                            $phimmoinhat=$getdata->phimmoinhat();
                            $row = mysqli_fetch_assoc($phimmoinhat);
                            $idphim=$row['maphim']+1;
                            $inpfilesub=$_FILES['inpfilesub']['tmp_name'];
                            //file sub:
                            if(!empty($inpfilesub)){
                                if (!file_exists("../phim/".($idphim)))mkdir("../phim/".($idphim), 0777, true);
                                $movefilesub=move_uploaded_file($inpfilesub,"../phim/".($idphim)."/".($idphim).".vtt");
                            }
                            if(isset($_FILES['phim']['tmp_name'])){
                                mkdir("../phim/".($idphim), 0777, true);
                                $duoiphim=substr($_FILES['phim']['name'],-5);
                                $duoiphim=strstr($duoiphim,".");
                                $linkphim="../phim/".$idphim."/".$idphim.$duoiphim;
                                move_uploaded_file($_FILES['phim']['tmp_name'],$linkphim);
                                $linkphim="phim/".$idphim."/".$idphim.$duoiphim;
                            }
                            //end file sub
                            if(!empty($a)){
                                
                                $formatimage=substr($b,-5);
                                $formatimage1=strstr($formatimage,".");
                                $anhphim='../img/'.($idphim)."".$formatimage1;
                                $c=move_uploaded_file($a,$anhphim);
                                $anhphim='img/'.($idphim)."".$formatimage1;
                            }elseif(strstr($_POST['phim'],"<")!=null){
                                $get_id_phim_youtube1=strstr($_POST['phim'],"embed");
                                $get_id_phim_youtube2=substr(strstr($get_id_phim_youtube1,"\"",true),6);
                                $anhphim="https://i.ytimg.com/vi/".$get_id_phim_youtube2."/hq720.jpg";
                            }
                            else $anhphim="img/default/REM.png";
                            /* $e=$_FILES['phim']['tmp_name'];
                            $d=$_FILES['phim']['name']; */
                            if(isset($_POST['theloai']))foreach($_POST['theloai'] as $i){$tl.=$i." ";};
                            
                            //$filephim=$_POST['phim'];
                //			if($c)echo "xong";
                            $themphim=$getdata->themphim($idphim,$_POST['name'],$anhphim,$tl,$_POST['namsx'],$linkphim,$_POST['noidung'],$_POST['cbdaodien'],$_POST['loaiphim'],$_POST['thoiluong']);
                            if($themphim){echo "<script>alert('Thêm thành công')</script><script>window.location.href=''</script>";/* header("refresh:0;url="); */}
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/livesearch.js"></script>
</html>
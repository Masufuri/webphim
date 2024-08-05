<?php
    include('control.php');
    $getdata=new data;
    include 'header.php';
    error_reporting(E_ERROR | E_PARSE);
?>
            
    <div class="new" style="padding-top: 10px;">
    <?php
		$layallphim=$getdata->phimbophimle('Phim Bộ',1);
		if(isset($_POST['sb'])){
			$chon=$_POST['thoigian'];
			echo "<script>window.location.href='phimbo.php?&sort=".($_POST['thoigian']=='cu' ? 'cu' : 'moi')."'</script>";
		}
		if($_GET['sort']=="cu")$layallphim=$getdata->phimbophimle('Phim Bộ',1);
		else $layallphim=$getdata->phimbophimle('Phim Bộ',0);
        /* $chontentheloai=$getdata->chontheloai($_GET['matl']);
        foreach($chontentheloai as $ctl); */
        echo "<h1>Phim Bộ</h1>
		<form method='post' enctype='multipart/form-data' style='display:inline-block;'>
		<select name='thoigian'>
			<option value='moi' ".($_GET['sort'] == 'moi' ? 'selected' : '').">Mới nhất</option>
			<option value='cu' ".($_GET['sort'] == 'cu' ? 'selected' : '').">Cũ nhất</option>
		</select>
		<input type='submit' name='sb' value='Tìm'>
		</form>
        <div class='cacpicnew'>";
        /* $row=$layallphim->fetch_array(MYSQLI_NUM);
        echo $row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6];
        $row=$layallphim->fetch_array(MYSQLI_NUM);
        echo $row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]; */
        // foreach($layallphim as $se){
           
            //echo end($se);
            /* $loc=$getdata->chon_theloai($chontentheloai,$se['theloai']);
            if($loc>0)echo $se['picture']; */
            /* echo "<div class='divpicnew'><a href='infophim.php?id=".$se['maphim']."'><img class='picnew' src='".$se['picture']."'><br>".$se['name']."</a></div>";
        } */
        foreach($layallphim as $se){
            /*if(strlen($se['name'])>15)$chamchamcham=substr_replace($se['name'],"...",15);else*/ $chamchamcham=$se['name'];
        echo "<div class='divpicnew'><a href='infophim.php?id=".$se['maphim']."'><img class='picnew' src='".$se['picture']."'><br><span class='title-phim-hot'>".$chamchamcham."</span></a></div>";}
        /* $loc=$getdata->chon_theloai2($chontentheloai);
        foreach($loc as $se){
            echo $se['picture'];
        } */
    ?>
    </div>
    </div>
    <?php include('footer.php');?>
    </div>
    
</body>
</html>
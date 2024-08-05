<?php
    include('control.php');
    $getdata=new data;
    include('header.php');
    $loi="<script>alert('Có gì đó không ổn, bạn sẽ được đưa về trang chủ');window.location.href='index.php'</script>";
    if(!isset($_GET['matl']))echo $loi;
    $chontentheloai=$getdata->chontheloai($_GET['matl']);
    if(!is_numeric($_GET['matl']) or mysqli_num_rows($chontentheloai)==0)echo $loi;
    if(isset($_GET['trang'])){
		$trang=$_GET['trang']*12-12;
	}
	else {$_GET['trang']=1;$trang=0;}
?>

        <div class="new">
            
    <?php
        
        foreach($chontentheloai as $ctl);
		if(isset($_GET['sort'])){
            if($_GET['sort']=='moi')$sort='moi';
            else $sort='cu';
        }else $sort='moi';
        $layallphim=$getdata->loctheloai($ctl['theloai'],$trang,$sort);
		if(isset($_POST['sb'])){
			$sort=$_POST['thoigian'];
			echo "<script>window.location.href='loc.php?matl=".$_GET['matl']."&sort=".($sort=='cu' ? 'cu' : 'moi')."'</script>";
		}
        
        echo "<h1>Thể loại: ".$ctl['theloai']."</h1>
		<form method='post' enctype='multipart/form-data' style='display:inline-block;'>
		<select name='thoigian'>
			<option value='moi' ".($sort == 'moi' ? 'selected' : '').">Mới nhất</option>
			<option value='cu' ".($sort == 'cu' ? 'selected' : '').">Cũ nhất</option>
		</select>
		<input type='submit' name='sb' value='Tìm'>
		</form>
        <div class='cacpicnew'>";
        
        foreach($layallphim as $se){
			/*if(strlen($se['name'])>15)$chamchamcham=substr_replace($se['name'],"...",15);else*/ $chamchamcham=$se['name'];
            /* $loc=$getdata->chon_theloai($chontentheloai,$se['theloai']);
            if($loc>0)echo $se['picture']; */
            echo "<div class='divpicnew'><a href='infophim.php?id=".$se['maphim']."'><img class='picnew' src='".$se['picture']."'><br><span class='title-phim-hot'>".$chamchamcham."</span></a></div>";
        }
        /* $loc=$getdata->chon_theloai2($chontentheloai);
        foreach($loc as $se){
            echo $se['picture'];
        } */
        $sophim=mysqli_num_rows($getdata->loctheloai($ctl['theloai'],-1,$sort));
        //$sophim1=mysqli_num_rows($sophim);
        $sotrang=ceil($sophim/12);
    ?>
    
    </div>
    <ul class="phantrang">
        Trang:
        <?php for($i=1;$i<=$sotrang;$i++){
            echo "<li><a"?> <?php if(isset($_GET['trang']))if($_GET['trang']==$i)echo "style='background-color:red;' ";echo "href='loc.php?matl={$_GET['matl']}&trang=$i&sort=$sort'>$i</a></li>";
        }?>
    </ul>
    </div>
    <?php include('footer.php');?>
    </div>
    
</body>
</html>
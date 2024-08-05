<?php
    include('control.php');
    $getdata=new data;
    include('header.php');
    if(isset($_GET['trang'])){
        $sttphim=$_GET['trang']*12-12;
    }else {$_GET['trang']=1;$sttphim=0;}
?>

        <div class="new">
            
    <?php
        if(isset($_GET['sort'])){
            if($_GET['sort']=='moi')$sort='moi';
            else $sort='cu';
        }else $sort='moi';
		$layallphim=$getdata->locnamsx($_GET['namsx'],$sttphim,$sort);
		if(isset($_POST['sb'])){
			$sort=$_POST['thoigian'];
			echo "<script>window.location.href='locnamsx.php?namsx=".$_GET['namsx']."&sort=".($sort=='cu' ? 'cu' : 'moi')."'</script>";
		}
        echo "<h1>Năm sản xuất: ".$_GET['namsx']."</h1>
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
        $sophim=mysqli_num_rows($getdata->locnamsx($_GET['namsx'],-1,$sort));
        $sotrang=ceil($sophim/12);
    ?>
    <ul class="phantrang">
        Trang:
        <?php
            for($i=1;$i<=$sotrang;$i++){
                echo "<li>
                    <a href='locnamsx.php?namsx={$_GET['namsx']}&sort=$sort&trang=$i' ".($_GET['trang']==$i ? "style='background-color:red;'" : "").">$i</a>
                </li>";
            }
        ?>
    </ul>
    </div>
    </div>
    <?php include('footer.php');?>
    </div>
    
</body>
</html>
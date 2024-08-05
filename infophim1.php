<?php
    include('control.php');
    $getdata=new data;
    $infophim=$getdata->infophim($_GET['id']);
	foreach($infophim as $e);
	global $conn;
	$sql="update phim set view=view+1,viewngay=viewngay+1 where maphim=".$_GET['id'];
	$run=mysqli_query($conn,$sql);
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta charset="utf8">
    <title>jkj</title>
    <link rel="stylesheet" type="text/css" href="css/css.css">
	<!-- <script src="sub.js"></script> -->
	<link href="css/media.css" rel="stylesheet">
	<link href="css/video-js.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/css.css">
    
    <link rel="stylesheet" href="css/videojs-mobile-ui.css">
	<link rel="stylesheet" href="css/forest.css">
	<!-- <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet"> -->
	
	<style type="text/css">
		
	
	</style>
	
</head>
<body>
	<div class="dangnhap">
		<div></div>
		<form>
			<div>
				<span style="display: block;font-size: 16px;">Nhập mật khẩu vào đêy...</span>
				<input type="password" id="checkpass" placeholder="Nhập pass vào đây" name="checkpass">
				<input type="submit" value="Nhập">
			</div>
		</form>
	</div>
	<div class="sum">
		<div class="top">
			<a href="index.php"><img src="img/Untitled-1.png" height="50px" style="margin: 10px"></a>
			<form class="ftimkiem" method="POST" enctype="multipart/form-data" style="height: fit-content;">
			<input type="text" name="timkiem">
			<button type="submit" name="btimkiem">Tìm kiếm</button>
			</form>
			<?php
				include_once "check.php";
				if(isset($_POST['btimkiem'])){
					header("location:timkiem.php?tukhoa=".$_POST['timkiem']);
				}
				if($kiem_tra_cookie=="dung"){?>
					<a class="btn-themphim" href="dangxuat.php">Đăng xuất</a>
					<a class="btn-themphim" href="themphim.php">Thêm phim</a>
					<a class="btn-themtheloai" href="themtheloai.php">Thêm thể loại</a>
					<a class="btn-suaphim" href="suaphim.php?id=<?php echo $e['maphim'];?>">Sửa phim</a>
				<?php }
				else echo '<a class="btn-dangnhap hien_form">Đăng nhập</a>';
			?>
			<a class="btn-themtheloai" href="locnangcao.php">Lọc nâng cao</a>
			<a class="btn-themtheloai" href="http://chatapp.masufuri.xyz/">Chatapp</a>
			
			
			<div onmouseleave="nhaclk(x,'cacmenu')" onclick="clk(x,'cacmenu')" class="menu">
				<a class="img-menu"><img class="cls-menu" src="icon/menu.png"></a>
				<div class="cacmenu hovertheloai" id="cacmenu">
					<?php 
						if($kiem_tra_cookie=="dung"){?>
								<a class="menunho" href="dangxuat.php">Đăng xuất</a>
								<a class="menunho" href="themphim.php">Thêm phim</a>
								<a class="menunho" href="themtheloai.php">Thêm thể loại</a>
								<a href="suaphim.php?id=<?php echo $e['maphim'];?>" class="menunho">Sửa phim</a>
						<?php }
						else echo '<a class="menunho hien_form">Đăng nhập</a>';
					?>
					<a href="locnangcao.php" class="menunho">Lọc nâng cao</a>
					<a href="http://chatapp.masufuri.xyz/" class="menunho">Chatapp</a>
					
				</div>
			</div>
		</div>
		<div class="danhmuc">
			<div class="bdm"><a href="index.php">Trang chủ</a></div>
			<div id="idtheloai" onmouseleave="nhaclk(x,'hovertheloai')" onclick="clk(x,'hovertheloai')" class="bdm">
				<a href="#">Thể loại</a>
				<div class="hovertheloai" id="hovertheloai" style="z-index: 15;">
					<?php
						$gettheloai=$getdata->gettheloai();
						foreach($gettheloai as $se){echo "<a class='menunho' href='loc.php?matl=".$se['matheloai']."&sort=moi'>".$se['theloai']."</a>";};
					?>
					<!-- <a class="menunho" href="">Viễn tưởng</a>
					<a class="menunho" href="">Siêu nhiên</a>
					<a class="menunho" href="">Đời thường</a>
					<a class="menunho" href="">Đời thường</a>
					<a class="menunho" href="">Đời thường</a>
					<a class="menunho" href="">Đời thường</a>
					<a class="menunho" href="">Đời thường</a>
					<a class="menunho" href="">Đời thường</a>
					<a class="menunho" href="">Đời thường</a> -->
				</div>
			</div>
			<div class="bdm"><a href="#">Phim Bộ</a></div>
			<div class="bdm"><a href="#">Chiếu rạp</a></div>
			<div onmouseleave="nhaclk(x,'hovertheloai-nam')" onclick="clk(x,'hovertheloai-nam')" class="bdm">
				<a href="#">Năm</a>
				<div class="hovertheloai" id="hovertheloai-nam">
					<?php
						$namsxphim=$getdata->getnamsx();
						foreach($namsxphim as $nsx){
							echo "<a class='menunho' href='locnamsx.php?namsx=".$nsx['namsx']."&sort=moi'>".$nsx['namsx']."</a>";
						}
					?>
				</div>
			</div>
		</div>
		<?php
			
				// echo "<img src='".$se['picture']."'><br>Tên: ".$se['name']."";
			$sub=substr($e['phim'],0,strlen($e['phim'])-4);
			//echo $sub;
		?>
		<div class="form_margin_top_10px">
			<div class="clsvideo">
			    <?php
					if(strstr($e['phim'],"<")!=null)echo $e['phim'];
					elseif(strstr($e['phim'],"http")!=null and strstr($e['phim'],"<")==null){
					    //mkdir('phim/'.$_GET['id'], 0777, true);
						echo "<video controls preload='none' playsinline controls='true' id='my-video' class='video-js vjs-theme-forest vjs-big-play-centered vjs-fill' data-setup='{}'>
						<source src=".$e['phim']." type='".(strstr($e['phim'],".m3u8")!=null ? 'application/x-mpegURL' : 'video/mp4')."'>";
						if (file_exists("phim/".$_GET['id']."/".$_GET['id'].".vtt"))echo "<track src='phim/".$_GET['id']."/".$_GET['id'].".vtt' kind='subtitles' srclang='vi' label='Tiếng Việt' default/>";
					echo "</video>";
					}
					else {
						echo "<video controls preload='none' playsinline controls='true' id='my-video' class='video-js vjs-theme-forest vjs-big-play-centered vjs-fill' data-setup='{}'>
						<source src=".$e['phim']." type='video/mp4'>
						<track src='".$sub.".vtt' kind='subtitles' srclang='vi' label='Tiếng Việt' default/>
					    </video>";
					}
				?>
			</div>
			<script type="text/javascript">
				
			</script>
			<br>
			<div class="ttphim">
			<div class="imginfophim">
				<img class="picnew" src="<?php echo $e['picture'];?>">
				
			</div>
			
			
			
			<table class="infophim">
				<tr>
				<td>Tên phim: <a><?php echo $e['name'];?></a></td>
				</tr>
				<tr><td>
				Thể loại: <?php
					$t="";
					$gettl=$getdata->gettheloai();
					foreach($gettl as $gtl){if(strstr($e['theloai'],$gtl['theloai'])!=null){$t.= "<a class='theloaitronginfo' href='loc.php?matl=".$gtl['matheloai']."&sort=moi'>".$gtl['theloai']."</a>, ";/* if(next($gettl)==true)echo ", "; */}}
					$l=rtrim($t,", ");
					echo $l;
				?></td></tr>
				<!-- Thể loại: <?php //echo $e['theloai'];?><br> -->
				<tr><td>
				Năm: <?php echo $e['namsx'];?>
				</td></tr>
				<tr><td>
				Nước sản xuất: <?php $countries=mysqli_fetch_assoc(mysqli_query($conn,"SELECT ten FROM countries where countries.countries_id=".$e['countries_id']));
				echo $countries["ten"];?>
				</td></tr>
				<tr>
					<td>Nội dung: <?php echo $e['noidung'];?></td>
				</tr>
				<tr><td><a style="color: blue;" href="<?php echo $e['phim'];?>">Tải phim</a></td></tr>
			</table>
			</div>
		</div>
		<?php include('footer.php');?>
	</div>
	
	<script>
		/* var jmediaquery = window.matchMedia( "(max-width: 600px)" )
		if (jmediaquery.matches) {
			// window width is at least 480px
			function clk(el){
							var tag=document.getElementById(el);
							tag.style.display=tag.style.display==='block'?'none':'block';
			}
			function nhaclk(el){
				var tag=document.getElementById(el);
				tag.style.display='none';
			}
		}
		else {
			
			// window width is less than 480px
		} */

		var x = window.matchMedia("(max-width: 700px)");
		myFunction(x); // Call listener function at run time
		x.addListener(myFunction);
		
		
		function clk(x,el) {
			if (x.matches) { // If media query matches
				
				
					var tag=document.getElementById(el);
					tag.style.display=tag.style.display==='block'?'none':'block';
					
				}else{document.getElementById(el).style="";}}
		function nhaclk(x,el){
			if (x.matches) {
				var tag=document.getElementById(el);
				tag.style.display='none';
			}else{document.getElementById(el).style="";}}
		function myFunction(x){
			if(x.matches){
				document.getElementById('hovertheloai').style="";
				document.getElementById('hovertheloai-nam').style="";
			}else{
				document.getElementById('hovertheloai').style="";
				document.getElementById('hovertheloai-nam').style="";
			}
		}
				
				
		
		
		/* 
		 */
				
		
	</script>
	<script src="js/video.min.js"></script>
	<script src="js/videojs.hotkeys.min.js"></script>
	<script src="js/videojs-mobile-ui.min.js"></script>
	<script src="js/videojs.zoomrotate.js"></script>
	<script src="js/zoom.js"></script>
	<script src="js/video-player.js"></script>
	<script src="js/dangnhap.js"></script>
</body>
</html>
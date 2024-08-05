<?php
	if(isset($_POST['btimkiem'])){
		header("location:timkiem.php?tukhoa=".$_POST['timkiem']);
	}
	session_start();
	
?>
<!doctype html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta charset="utf-8">
	<title>hello</title>
	<link href="css/media.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="stylesheet" type="text/css" href="chatapp/css.css">
	
</head>
<body>
	<style>
		#livesearch{
			border: 1px solid rgb(165, 172, 178);
			position: absolute;
			margin-top: 40px;
			background: white;
			z-index: 2;
			width: 60%;
			border-radius: 10px;
		}
	</style>
	<div class="dangnhap">
		<div class="wrapper">
			<section class="signup">
				<header>Chat App || Đăng ký</header>
				<div class="error">Lỗi rồi</div>
				<form action="#" enctype="multipart/form-data">
					<div class="input fields">
						<label for="">Tên</label>
						<input type="text" name="name" id="" placeholder="Nhập tên">
					</div>
					<div class="input fields">
						<label for="">Email</label>
						<input type="email" name="email" id="" placeholder="Nhập email">
					</div>
					<div class="input fields">
						<label for="">Mật khẩu</label>
						<input type="password" name="pass" id="" placeholder="Nhập mật khẩu">
					</div>
					<div class="image fields">
						<label for="">Chọn ảnh</label>
						<input type="file" name="img" id="" accept="image/*">
					</div>
					<div class="submit fields">
						<input type="submit" name="sb" value="Đăng ký">
					</div>
				</form>
				<div class="advice">
					Đã có tài khoản?
					<a href="index.php">Đăng nhập ngay.</a>
				</div>
			</section>
		</div>
	</div>
    <div class="sum">
		<div class="top">
			<a href="index.php"><img src="img/Untitled-1.png" height="50px" style="margin: 10px"></a>
			<form class="ftimkiem" method="POST" enctype="multipart/form-data" style="height: fit-content;">
			<input type="text" name="timkiem" onkeyup="showResult(this.value)">
			<div id="livesearch"></div>
			<button type="submit" name="btimkiem">Tìm kiếm</button>
			</form>
			<?php 
				include_once "check.php";
				if($kiem_tra_cookie=="dung"){?>
						<a class="btn-themphim" href="dangxuat.php">Đăng xuất</a>
						<a class="btn-themphim" href="themphim.php">Thêm phim</a>
						<a class="btn-themtheloai" href="themtheloai.php">Thêm thể loại</a>
						<?php if(isset($checkinfophim)&&$checkinfophim==1)echo "<a class='btn-suaphim' href='suaphim.php?id=".$e['maphim']."'>Sửa phim</a>";?>
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
								<?php if(isset($checkinfophim)&&$checkinfophim==1)echo "<a href='suaphim.php?id=".$e['maphim']."' class='menunho'>Sửa phim</a>";?>
						<?php }
						else echo '<a class="menunho hien_form">Đăng nhập</a>';
					?>
					<a href="locnangcao.php" class="menunho">Lọc nâng cao</a>
					<a href="http://chatapp.masufuri.xyz/" class="menunho">Chatapp</a>
					<!-- <a href="suaphim.php?id=<?php echo $e['maphim'];?>" class="menunho">Sửa phim</a> -->
				</div>
			</div>
		</div>
		<div class="danhmuc">
			<div class="bdm"><a href="index.php">Trang chủ</a></div>
			<div id="idtheloai" onmouseleave="nhaclk(x,'hovertheloai')" onclick="clk(x,'hovertheloai')" class="bdm">
				<a href="#">Thể loại</a>
				<div class="hovertheloai" id="hovertheloai">
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
					<!-- <a class="menunho" href="">2019</a>
					<a class="menunho" href="">2002</a>
					<a class="menunho" href="">2002</a>
					<a class="menunho" href="">2002</a>
					<a class="menunho" href="">2002</a> -->

				</div>
			</div>
		</div>
		<script src="js/dangnhap.js"></script>
		<script src="js/livesearch.js"></script>
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
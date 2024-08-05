<?php
    include('control.php');
    $getdata=new data;
    $infophim=$getdata->infophim($_GET['id']);
	foreach($infophim as $e);
	global $conn;
	$sql="update phim set view=view+1,viewngay=viewngay+1 where maphim=".$_GET['id'];
	$run=mysqli_query($conn,$sql);
	
    $checkinfophim=1;
	$sql1=mysqli_query($conn,"select name from directors where id=".$e["directors_id"]);
	$daodien=mysqli_fetch_assoc($sql1);
    include "header.php";

			
				// echo "<img src='".$se['picture']."'><br>Tên: ".$se['name']."";
			$sub=substr($e['phim'],0,strlen($e['phim'])-4);
			//echo $sub;
		?>
        <link href="css/video-js.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/videojs-mobile-ui.css">
	    <link rel="stylesheet" href="css/forest.css">
        
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
					<td>Lượt xem: <?php echo $e['view'];?></td>
				</tr>
				<?php
				
				?>
				<tr>
					<td>Đạo diễn: <?php echo $daodien['name'];?></td>
				</tr>
				<tr>
					<td>Thời lượng: <?php echo $e['thoiluong'];?></td>
				</tr>
				<tr>
					<td>Loại phim: <?php echo $e['loaiphim'];?></td>
				</tr>
				<tr>
					<td>Nội dung: <?php echo $e['noidung'];?></td>
				</tr>
				<tr><td><a style="color: blue;" href="<?php echo $e['phim'];?>">Tải phim</a></td></tr>
			</table>
			<form method="post" action="">
				<input type="submit" value="Thêm phim yêu thích" name="themyt">
			</form>
			
			<?php if(isset($_POST['themyt'])){
				if(isset($_SESSION['user']) and isset($_COOKIE['user'])){
					global $conn;
					$checkphimyt=mysqli_query($conn,"select * from favorites where user_id=".$_SESSION['user']." and movie_id=".$_GET['id']);
					$numphimyt=mysqli_num_rows($checkphimyt);
					if($numphimyt==0){
						$phimyt=$getdata->themphimyeuthich($_SESSION['user'],$_GET['id']);
						echo "<script>alert('Thêm phim thành công')</script><meta http-equiv='refresh' content='0'>";
					}
					else echo "<script>alert('Bạn đã thêm phim này rồi')</script><meta http-equiv='refresh' content='0'>";
				}
				else echo "<script>alert('Bạn phải đăng nhập trước')</script><meta http-equiv='refresh' content='0'>";
				//if($phimyt)echo "<script>alert('thêm thành công')</script>";
			}
			?>
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


        //-----------------------
		// var x = window.matchMedia("(max-width: 700px)");
		// myFunction(x); // Call listener function at run time
		// x.addListener(myFunction);
		
		
		// function clk(x,el) {
		// 	if (x.matches) { // If media query matches
				
				
		// 			var tag=document.getElementById(el);
		// 			tag.style.display=tag.style.display==='block'?'none':'block';
					
		// 		}else{document.getElementById(el).style="";}}
		// function nhaclk(x,el){
		// 	if (x.matches) {
		// 		var tag=document.getElementById(el);
		// 		tag.style.display='none';
		// 	}else{document.getElementById(el).style="";}}
		// function myFunction(x){
		// 	if(x.matches){
		// 		document.getElementById('hovertheloai').style="";
		// 		document.getElementById('hovertheloai-nam').style="";
		// 	}else{
		// 		document.getElementById('hovertheloai').style="";
		// 		document.getElementById('hovertheloai-nam').style="";
		// 	}
		// }
				
				
		
		
		/* 
		 */
				
		
	</script>
	<script src="js/video.min.js"></script>
	<script src="js/videojs.hotkeys.min.js"></script>
	<script src="js/videojs-mobile-ui.min.js"></script>
	<script src="js/videojs.zoomrotate.js"></script>
	<script src="js/zoom.js"></script>
	<script src="js/video-player.js"></script>
	
</body>
</html>
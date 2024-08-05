<?php
	include('control.php');
	$getdata=new data;
	if(isset($_GET['trang'])){
		$trang=$_GET['trang']*12-12;
	}
	else {$_GET['trang']=1;$trang=0;}
	$phim=$getdata->dsphim($trang);
	$top10phim=$getdata->topluotxem(10);
	$top5phim=mysqli_query($conn,"select * from phim order by viewngay desc limit 5");
	//$top5phim=$getdata->topluotxem(5);
	include('header.php');
?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
		<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

		<div class="swiper mySwiper">
			<div class="swiper-wrapper">
				<?php
					foreach($top5phim as $l){
						if(strlen($l['name'])>15)$chamchamcham=substr_replace($l['name'],"...",15);else $chamchamcham=$l['name'];
					echo "<div class='swiper-slide'><a href='infophim.php?id=".$l['maphim']."'><img class='pichot' src='".$l['picture']."'><br><span class='title-phim-hot'>".$l['name']."</span></a></div>";}
				?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>

		<div class="hot" style="display: none;">
			<h1>Phim Hot</h1>
			<div class="cacpichot">
				<?php
					//echo end($phim['maphim']);
					foreach($top10phim as $i){
						/*if(strlen($i['name'])>15)$chamchamcham=substr_replace($i['name'],"...",15);else*/ $chamchamcham=$i['name'];
					echo "<div class='divpichot'><a href='infophim.php?id=".$i['maphim']."'><img class='pichot' src='".$i['picture']."'><br><span class='title-phim-hot'>".$chamchamcham."</span></a></div>";}
				?>
			</div>
		</div>

				
		<style>
			.swiper-pagination{bottom: 0 !important;}
			.cacpichot>.swiper{
				padding-bottom: 20px !important;
				height: 220px;
    			min-height: auto;
			}
			.divpichot,.divpichot>a{height: inherit;margin: 0;width: inherit;text-align: center;}
			.swiper-button-disabled{
				display: none;
			}
			.divpichot span{
				font-size: 0.7em;
			}
		</style>
		<div class="hot">
			<h1>Phim Hot</h1>
			<div class="cacpichot">
				<div class='swiper mySwiperhot'>
					<div class='swiper-wrapper'>
				<?php
					//echo end($phim['maphim']);
					foreach($top10phim as $i){
						/*if(strlen($i['name'])>15)$chamchamcham=substr_replace($i['name'],"...",15);else*/ $chamchamcham=$i['name'];
					echo "
					  			<div class='swiper-slide'>
					  <div class='divpichot'><a href='infophim.php?id=".$i['maphim']."'><img class='pichot' src='".$i['picture']."'><br><span class='title-phim-hot'>".$chamchamcham."</span></a></div></div>
					  		";}
				?>
					</div>
					<div class='swiper-button-next'></div>
					<div class='swiper-button-prev'></div>
					<div class='swiper-pagination'></div>
				</div>
			</div>
		</div>


		<div class="clr"></div>
		<style>
			
		</style>
		
		

		<!-- Swiper JS -->
		

		<!-- Initialize Swiper -->
		
		<script>
		var swiper = new Swiper(".mySwiper", {
			loop:true,
			navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
			},
		});
		</script>

		<script>
			var swiper = new Swiper(".mySwiperhot", {
				slidesPerView: 2,
				spaceBetween: 5,
				slidesPerGroup: 2,
				breakpoints:{
					550:{
						slidesPerView: 3,
						slidesPerGroup: 3,
					},
					700:{
						slidesPerView: 4,
						slidesPerGroup: 4,
					},
					800:{
						slidesPerView: 5,
						slidesPerGroup: 5,
					},
					1000:{
						slidesPerView: 6,
						slidesPerGroup: 6,
					},
					1200:{
						slidesPerView: 7,
						slidesPerGroup: 7,
					},
					1500:{
						slidesPerView: 8,
						slidesPerGroup: 8,
					},
				},
				loop: false,
				loopFillGroupWithBlank: false,
				pagination: {
				el: ".swiper-pagination",
				clickable: true,
				},
				navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
				},
			});
		</script>


		<div class="new">
			<h1>Phim Mới Cập Nhật</h1>
			<div class="cacpicnew">
				<?php
					foreach($phim as $se){
						/*if(strlen($se['name'])>15)$chamchamcham=substr_replace($se['name'],"...",15);else*/ $chamchamcham=$se['name'];
						echo "<div class='divpicnew'><a href='infophim.php?id=".$se['maphim']."'><img class='picnew' src='".$se['picture']."'><br><span class='title-phim'>".$chamchamcham."</span></a></div>";
					}
				?>
			</div>
		</div>
		<?php
            $sophim=mysqli_num_rows($getdata->dsphim(-1));//nhỏ hơn 0 để lấy tất ds phim
            //$sophim1=mysqli_num_rows($sophim);
            $sotrang=ceil($sophim/12);
        ?>
        <div class="cls" style="clear: both;"></div>
        <ul class="phantrang">
            Trang:
            <?php for($i=1;$i<=$sotrang;$i++){
                echo "<li><a"?> <?php if(isset($_GET['trang']))if($_GET['trang']==$i)echo "style='background-color:red;' ";echo "href='index.php?trang=$i'>$i</a></li>";
            }?>
        </ul>
        <?php include('footer.php');?>
	</div>
	
<!--	<script src="c.js"></script>-->
</body>

</html>
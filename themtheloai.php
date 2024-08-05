<?php
	include('control.php');
	$getdata=new data;
	include('header.php');
	include_once "check.php";
	if($kiem_tra_cookie=="sai"){echo "<script>location.href='index.php'</script>";die;}
?>

		<form method="post" enctype="multipart/form-data" class="form_margin_top_10px">
			<input type="text" name="theloai" placeholder="Nhập tên thể loại cần thêm..." style="width: 200px;"><br>
			<input type="submit" name="sb" value="Thêm">
			<table border="1">
				<tr>
					<th>ID</th>
					<th>Thể loại</th>
					<th>Tùy chọn</th>
				</tr>
				<?php
					foreach($gettheloai as $i){
						/* echo "<tr>
							<td>".$i['matheloai']."</td>
							<td>".$i['theloai']."</td>
							<td><a href='xoatheloai.php?id=".$i['matheloai']."' onclick='return confirm('are you sure?')'>Xóa</a></td>
						</tr>"; */
						?>
						<tr>
							<td><?php echo $i['matheloai'];?></td>
							<td><?php echo $i['theloai'];?></td>
							<td><a href="xoatheloai.php?id=<?php echo $i['matheloai'];?>" onclick="return(confirm('are you sure?'))">Xóa</a>	<a href="#">Sửa</a></td>
							
						</tr>
						<?php
					};
				?>
			</table>
		</form>
		<?php include('footer.php');?>
		</div>
		
		<?php
			if(isset($_POST['sb'])){
				$intl=$getdata->ins_theloai($_POST['theloai']);
				if($intl){/* echo "<script>alert('Thêm thành công')</script>"; */echo "<script>window.location.href = window.location.href;</script>";};
			}
		?>
	
	<script>
	</script>
</body>
</html>
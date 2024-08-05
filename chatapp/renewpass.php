<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<?php
	include "php/connect.php";
	if(!isset($_GET['vf'])){echo "Có gì đó không đúng, bạn vui lòng thực hiện lại yêu cầu.";exit();}
	$email=mysqli_query($conn,"select * from users where fpass like '%{$_GET['vf']}%'");
	if(mysqli_num_rows($email)<=0){echo "Có gì đó không đúng, bạn vui lòng thực hiện lại yêu cầu.";exit();}
	$row=mysqli_fetch_assoc($email);
	
	$a=explode("(",$row['fpass']);
	if(!isset($a[1])){echo "Có gì đó không đúng, bạn vui lòng thực hiện lại yêu cầu.";exit();}
	if(time()>$a[1]+300){echo "Có gì đó không đúng, bạn vui lòng thực hiện lại yêu cầu.";$sql_update=mysqli_query($conn,"update users set fpass='' where email='{$row['email']}'");exit();}
	?>
	<h1>Bạn đang đổi mật khẩu cho tài khoản <?php echo $row['email'];?></h1>
	<form action="#" enctype="multipart/form-data">
		<div class="error"></div>
	    	<input type="text" name="email" id="" placeholder="Nhập email của bạn"><br>
	    	<input class="fpass" type="submit" value="Kiểm tra">
	</form>
	    <script src="javascript/fpass.js"></script>
</body>
</html>
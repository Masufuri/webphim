<?php
	include_once "connect.php";
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	if(!empty($email)){
		$sql=mysqli_query($conn,"select * from users where email='{$email}'");
		if(mysqli_num_rows($sql)>0){
			$hash=hash("ripemd160",$email.time());
			$fpass=$hash."(".time();
			$sql_update=mysqli_query($conn,"update users set fpass='{$fpass}' where email='{$email}'");
			$title="Xác thực đổi mật khẩu Web phim ";
			$nd="nhan vao <a href='http://chatapp.masufuri.xyz/renewpass.php?vf={$hash}'>day</a> de dat lai mat khau";
			require "guimail.php";
		} else echo "Email không tồn tại";
	} else echo "Bạn phải nhập email đã";
?>
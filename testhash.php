<form method="post">
		<input type="text" name="hash">
		<input type="submit" name="sb">
	</form>
<?php
	if(isset($_POST['sb'])){
		$hash=hash("ripemd160",$_POST['hash']);
	    	$hash=hash("ripemd160",$hash."adjks");
	    	echo $hash;
    	}
?>
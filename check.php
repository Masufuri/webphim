<?php
    //$check=["341247c13dd6f53c79a0d71c3ab95a39fcb01c73"];
    $check=["c69b7141661d48c9f409cb6beb74abefd3148b4a"];
    if(isset($_COOKIE['adphim']) and isset($_SESSION['adphim']) and in_array($_COOKIE['adphim'],$check))$kiem_tra_cookie="dung";else $kiem_tra_cookie="sai";
?>
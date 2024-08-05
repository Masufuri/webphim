<?php
    session_start();
    include "control.php";
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);
    $getdata=new data;
    $checkacc=$getdata->dangnhap($email,$pass);
    $num=mysqli_num_rows($checkacc);
    $hash=hash("ripemd160",$email);
    $hash=hash("ripemd160",$hash."adjks");
    //$hash2=hash("ripemd160",$hash.rand(time(),10000000));
    //include_once "check.php";
    // if(in_array($hash,$check)){
    //     $_SESSION['adphim']=$hash;
    //     setcookie("adphim",$hash,time()+3600);
    //     echo $checkacc;
    // }
    if($num==1){
        $data=mysqli_fetch_assoc($checkacc);
        if($data["user_role"]==1){
            $_SESSION['adphim']=$data['id'];
            setcookie("adphim",$hash,time()+3600);
        }else{
            $_SESSION['user']=$data['id'];
            setcookie("user",$hash,time()+3600);
        }
        echo "success";
    }
    else echo "Tài khoản hoặc mật khẩu không đúng";
?>
<?php
    session_start();
    include_once "connect.php";
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);
    if(!empty($_POST['email'])&&!empty($_POST['pass'])){
        $sql=mysqli_query($conn,"select * from users where email='{$email}' and pass='{$pass}'");
        if(mysqli_num_rows($sql)>0){
            
            $row=mysqli_fetch_assoc($sql);
            $_SESSION['unique_id']=$row['unique_id'];
            $sql2=mysqli_query($conn,"update users set status = 'online' where unique_id={$_SESSION['unique_id']}");
            echo "success";
        }else echo "Tài khoản hoặc mật khẩu chưa chính xác";
    }else echo "Không được bỏ trống trường nào";
?>
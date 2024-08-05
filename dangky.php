<?php
    session_start();
    include "control.php";
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);

    if(!empty($name)&&!empty($email)&&!empty($pass)){
        $sql=mysqli_query($conn,"SELECT * from users_phim where username='{$name}'");
        if(mysqli_num_rows($sql)>0){
            echo $email." đã tồn tại.";
        }else {
            $sql2=mysqli_query($conn,"INSERT INTO users_phim(user_role,username,email,password) values(0,'{$name}','{$email}','{$pass}')");
            if($sql2)echo "success";
            else echo "Lỗi";
        }
    }else echo "Lỗi";
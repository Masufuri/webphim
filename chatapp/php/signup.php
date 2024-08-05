<?php
    session_start();
    include_once "connect.php";
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);

    if(!empty($name)&&!empty($email)&&!empty($pass)){
        $sql=mysqli_query($conn,"SELECT * from users where email='{$email}'");
        if(mysqli_num_rows($sql)>0){
            echo $email." đã tồn tại.";
        }else {
            if(!empty($_FILES['img']['tmp_name'])){
                $img_name=$_FILES['img']['name'];
                $tmp_name=$_FILES['img']['tmp_name'];
                $time=time();
                $new_img_name=$time.$img_name;
                if(move_uploaded_file($tmp_name,"../img/".$new_img_name)){
                    $status="Đang hoạt động";
                    $random_id=rand(time(),10000000);

                    $sql2=mysqli_query($conn,"INSERT INTO users(unique_id,name,email,pass,img,status) values({$random_id},'{$name}','{$email}','{$pass}','{$new_img_name}','{$status}')");
                    if($sql2){
                        $sql3=mysqli_query($conn,"select * from users where email='{$email}'");
                        if(mysqli_num_rows($sql3)>0){
                            $row=mysqli_fetch_assoc($sql3);
                            $_SESSION['unique_id']=$row['unique_id'];
                            echo "success";
                        }
                    }else{
                        echo "Có gì đó sai sai.";
                    }
                }else echo "Lỗi";
            }else{
                echo "Hãy chọn 1 ảnh đại diện";
            }
        }
    }else {
        echo "Không được bỏ trống trường nào.";
    }
?>
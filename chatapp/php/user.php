<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "connect.php";
        $sql=mysqli_query($conn,"select * from users where not unique_id={$_SESSION['unique_id']}");
        $thongtin="";
        foreach($sql as $se){
            $sql2=mysqli_query($conn,"select * from messages where (outgoing_msg_id={$se['unique_id']} and incoming_msg_id={$_SESSION['unique_id']}) OR (outgoing_msg_id={$_SESSION['unique_id']} and incoming_msg_id={$se['unique_id']}) order by msg_id desc limit 1");
            $new_chat=mysqli_fetch_assoc($sql2);
            if(mysqli_num_rows($sql2)>0){
                $result=$new_chat['msg'];
            }else $result="Không có tin nhắn nào";

            // kiểm tra tin nhắn dài hơn 28 ký tự thì sẽ thêm ...
            (strlen($result)>28)?$msg=substr($result,0,28)."...":$msg=$result;
            $_SESSION['unique_id']==$new_chat['outgoing_msg_id']?$you="Bạn: ":$you="";

            $se['status']=="offline"?$status="offline":$status="";

            $thongtin.='<a href="chat.php?user_id='.$se['unique_id'].'">
            <div class="profile">
                <img src="img/'.$se['img'].'" alt="">
                <div class="details">
                    <span>'.$se['name'].'</span>
                    <p>'.$you.$msg.'</p>
                </div>
            </div>
            <div class="status-dots '.$status.'"><i class="fas fa-circle"></i></div>
        </a>';
        }
        echo $thongtin;
    }
?>
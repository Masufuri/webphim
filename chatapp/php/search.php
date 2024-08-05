<?php
    session_start();
    include_once "connect.php";
    $searchTerm=mysqli_real_escape_string($conn,$_POST['searchTerm']);
    $sql=mysqli_query($conn,"select * from users where name like '%{$searchTerm}%' and not unique_id={$_SESSION['unique_id']}");
    $thongtin="";
    foreach($sql as $se){
        
        $thongtin.='<a href="">
        <div class="profile">
            <img src="img/'.$se['img'].'" alt="">
            <div class="details">
                <span>'.$se['name'].'</span>
                <p>Đây là tin nhắn thử nghiệm</p>
            </div>
        </div>
        <div class="status-dots"><i class="fas fa-circle"></i></div>
    </a>';
    }
    echo $thongtin;
?>
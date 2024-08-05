<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "connect.php";
        $sql2=mysqli_query($conn,"select * from messages order by msg_id desc limit 1");
        $num=mysqli_fetch_assoc($sql2);
        sleep(1);
        $sql3=mysqli_query($conn,"update messages set refresh =1 where msg_id={$num['msg_id']}");
    }
?>
<?php
    include_once "connect.php";
    $sql=mysqli_query($conn,"select * from messages order by msg_id desc limit 1");
    $num=mysqli_fetch_assoc($sql);
    if(empty($num['refresh'])){
        echo "refresh";
        /* sleep(0.5);
        $sql3=mysqli_query($conn,"update messages set refresh =1 where msg_id={$num['msg_id']}"); */
    }
?>
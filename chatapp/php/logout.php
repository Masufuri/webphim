<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "connect.php";
        $sql=mysqli_query($conn,"update users set status = 'offline' where unique_id={$_SESSION['unique_id']}");
        if($sql){
            session_unset();
            session_destroy();
            header("location:../");
        }else header("location:../");
    }else header("location:../");
?>
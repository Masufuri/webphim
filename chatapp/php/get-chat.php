<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "connect.php";
        $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
        $incoming_id=mysqli_real_escape_string($conn,$_POST['incoming_id']);
            $sql=mysqli_query($conn,"select * from messages join users on outgoing_msg_id=unique_id where (outgoing_msg_id={$outgoing_id} and incoming_msg_id={$incoming_id}) OR (outgoing_msg_id={$incoming_id} and incoming_msg_id={$outgoing_id}) order by msg_id asc");
            $output="";
            if(mysqli_num_rows($sql)>0){
            foreach($sql as $row){
                if($outgoing_id===$row['outgoing_msg_id']){
                    $output.='<div class="chat outgoing">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                            </div>';
                }else {
                    $output.='<div class="chat incoming">
                                <img src="img/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                            </div>';
                }
            }
            echo $output;
            /* $sql2=mysqli_query($conn,"select * from messages order by msg_id desc limit 1");
            $num=mysqli_fetch_assoc($sql2); */
            
        }
    }else header("../index.php")
?>
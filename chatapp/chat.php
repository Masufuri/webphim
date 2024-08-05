<?php
    session_start();
    if(!isset($_SESSION['unique_id']))header("location:index.php");
    include_once "php/connect.php";
    $user_id=mysqli_real_escape_string($conn,$_GET['user_id']);
    $sql=mysqli_query($conn,"select * from users where unique_id={$user_id}");
    if(mysqli_num_rows($sql)>0)$row=mysqli_fetch_assoc($sql);else echo "Lỗi";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="img/<?php echo $row['img']?>" alt="">
                <div class="details">
                    <span><?php echo $row['name']?></span>
                    <p><?php echo $row['status']?></p>
                </div>
            </header>
            <div class="chat-box">
                
                
            </div>
            <form action="#" class="typing-area">
                <div class="type">
                    <input type="text" value="<?php echo $_SESSION['unique_id']?>" name="outgoing_id" id="" hidden>
                    <input type="text" value="<?php echo $user_id?>" name="incoming_id" id="" hidden>
                    <input type="text" class="input-field" name="message" id="" placeholder="Nhập tin nhắn ở đây...">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </div>
            </form>
        </section>
    </div>
    <script src="javascript/chat.js"></script>
</body>
</html>
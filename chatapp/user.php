<?php
    session_start();
    if(!isset($_SESSION['unique_id']))header("location:index.php");
    include_once "php/connect.php";
    $sql=mysqli_query($conn,"select * from users where unique_id={$_SESSION['unique_id']}");
    $row=mysqli_fetch_assoc($sql);
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
        <section class="user">
            <header>
                <div class="profile">
                    <img src="img/<?php echo $row['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['name']?></span>
                        <p><?php echo $row['status']?></p>
                    </div>
                </div>
                <a href="php/logout.php" class="logout">Thoát</a>
            </header>
            <div class="search">
                <span class="text">Chọn một người để chat</span>
                <input type="text" placeholder="Tìm kiếm...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="user-list">
                <!-- <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a>
                <a href="">
                    <div class="profile">
                        <img src="img/a.png" alt="">
                        <div class="details">
                            <span>Đắc Chiến</span>
                            <p>Đây là tin nhắn thử nghiệm</p>
                        </div>
                    </div>
                    <div class="status-dots"><i class="fas fa-circle"></i></div>
                </a> -->
            </div>
        </section>
    </div>
    <script src="javascript/user.js"></script>
</body>
</html>
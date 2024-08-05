<?php
    session_start();
    if(isset($_SESSION['unique_id']))header("location:user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="wrapper">
        <section class="signup">
            <header>Chat App || Đăng ký</header>
            <div class="error">Lỗi rồi</div>
            <form action="#" enctype="multipart/form-data">
                <div class="input fields">
                    <label for="">Tên</label>
                    <input type="text" name="name" id="" placeholder="Nhập tên">
                </div>
                <div class="input fields">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" placeholder="Nhập email">
                </div>
                <div class="input fields">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="pass" id="" placeholder="Nhập mật khẩu">
                </div>
                <div class="image fields">
                    <label for="">Chọn ảnh</label>
                    <input type="file" name="img" id="" accept="image/*">
                </div>
                <div class="submit fields">
                    <input type="submit" name="sb" value="Đăng ký">
                </div>
            </form>
            <div class="advice">
                Đã có tài khoản?
                <a href="index.php">Đăng nhập ngay.</a>
            </div>
        </section>
    </div>

    <script src="javascript/signup.js"></script>
</body>
</html>
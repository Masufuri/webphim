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
        <section class="signin">
            <header>Chat App || Đăng nhập</header>
            <div class="error">Lỗi rồi</div>
            <form action="#">
                <div class="input fields">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" placeholder="Email">
                </div>
                <div class="input fields">
                    <label for="">Password</label>
                    <input type="password" name="pass" id="" placeholder="Password">
                </div>
                <div><a style="text-align:right;display: block;" href="fpass.php">Quên mật khẩu</a></div>
                <div class="submit fields">
                    <input type="submit" name="sb" value="Đăng nhập">
                </div>
            </form>
            <div class="advice">
                Chưa có tài khoản?
                <a href="signup.php">Đăng ký ngay.</a>
            </div>
        </section>
        
    </div>
    <script src="javascript/login.js"></script>
</body>
</html>
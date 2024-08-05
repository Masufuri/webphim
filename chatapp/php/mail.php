<?php
include ("PHPMailer/src/Exception.php");
include ("PHPMailer/src/OAuth.php");
include ("PHPMailer/src/POP3.php");
include ("PHPMailer/src/PHPMailer.php");
include ("PHPMailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml"
//xmlns="http://www.w3.org/1999/xhtml"
?>
<!DOCTYPE HTML>
<html>
<head>
    <!meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
    <title>abc</title>
</head>
<body>
<?php
    $mail=new PHPMailer(true);
    try{
        $mail->SMTPDebug=2;//cho bang 0 de khong hien chi tiet, 2 de hien
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='luffyvsaceinonepiece@gmail.com';
        $mail->Password='qibwttzzylrwffnc';
        $mail->SMTPSecure='tls';
        $mail->Port=587;
        $mail->CharSet='UTF-8';
        $mail->setFrom('luffyvsaceinonepiece@gmail.com');
        $mail->addAddress('remwasaiko@gmail.com');
        $mail->isHTML(true);
        $mail->Subject='Em chào cô, em là Chien lop 2 co oi :D';
        $mail->Body='Co ngu ngon';
        $mail->send();
        echo 'Email da gui';
    }catch (Exception $e){
        echo 'Tin nhan ko gui dc', $mail->ErrorInfo;
    }
?>
</body>
</html>
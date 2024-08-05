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

<?php
    $mail=new PHPMailer(true);
    try{
        $mail->SMTPDebug=0;//cho bang 0 de khong hien chi tiet, 2 de hien
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='luffyvsaceinonepiece@gmail.com';
        $mail->Password='qibwttzzylrwffnc';
        $mail->SMTPSecure='tls';
        $mail->Port=587;
        $mail->CharSet='UTF-8';
        $mail->setFrom('luffyvsaceinonepiece@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject=$title;
        $mail->Body=$nd;
        $mail->send();
        echo 'Email da gui';
    }catch (Exception $e){
        echo 'Tin nhan ko gui dc', $mail->ErrorInfo;
    }
?>
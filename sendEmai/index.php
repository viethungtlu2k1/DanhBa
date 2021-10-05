<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP(); // gửi mail SMTP
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'viethungtlu2k1@gmail.com'; // SMTP username
    $mail->Password = 'itgenusfjomtvalq'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 587; // TCP port to connect to
    $mail->CharSet = 'UTF-8';
    //Recipients
    $mail->setFrom('viethungtlu2k1@gmail.com', 'Danh bạ Đại học Thủy Lợi');

    $mail->addReplyTo('viethungtlu2k1@gmail.com', 'Đại học Thủy Lợi'); // nhận phải hồi từ người nhận
    //$email = 'viethung3052001@gmail.com';
    $mail->addAddress($email); // Add a recipient // dia chi ng nhan

    // Attachments
    // $mail->addAttachment('pdf/XTT/'.$data[11].'.pdf', $data[11].'_1.pdf'); // Add attachments
    //$mail->addAttachment('pdf/Giay_bao_mat_sau.pdf'); // Optional name

    // Content
    $mail->isHTML(true);   // Set email format to HTML
    $tieude = 'Kích hoạt tài khoản Danh Bạ';
    $mail->Subject = $tieude;
    $str = rand();
    $code = md5($str);
    // Mail body content 
    $bodyContent = '<p>Thân gửi <b>NVHung</b></h1>';
    $bodyContent .= '<p>Bạn vui lòng nhấp vào đường linh dưới đây để kích hoạt tài khoản</p>';
    $bodyContent .= '<p></p>';


    $mail->Body = $bodyContent;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if ($mail->send()) {
        echo 'Thư đã được gửi đi';
    } else {
        echo 'Lỗi. Thư chưa gửi được';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

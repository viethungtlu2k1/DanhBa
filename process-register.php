

<?php
ob_start(); // loi cua header()
include("./config/constants.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['submit'])) {
    // xu li up file



    $first_name = $_POST['firstName'];
    $last_name  = $_POST['lastName'];
    $email      = $_POST['email'];
    $pass1      = $_POST['pass1'];
    $pass2      = $_POST['pass2'];
    if (isset($_FILES['avatar'])) {
        $image_name = $_FILES['avatar']['name'];
        $source_path = $_FILES['avatar']['tmp_name'];
        $save_path = "images/avatar_user/" . $image_name;
        // kiểm tra xem có file nào đã được chọn hay chưa
        if ($image_name != "") {
            // đổi tên file ảnh 
            // $ext = end(explode('.', $image_name));
            // echo $image_name = "userImage_" . $userid . '.' . $ext;
            // kiểm tra  có phải là file ảnh hay không
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if ($check !== false) {
                // nếu là file ảnh thì ...
                $upload = move_uploaded_file($source_path, $save_path);
                if ($upload == false) {
                    $value = 'failed image';
                    header("Location:register.php?reply=$value");
                }
                //echo print_r($check);
            } else {
                // nếu không phải file ảnh thì hiện ra thông báo khi submit
                $value = 'failed image';
                header("Location:register.php?reply=$value");
            }
        }
    }
    $sql_1 = "SELECT * FROM users WHERE email='$email'";
    $result_1 = mysqli_query($conn, $sql_1);
    if (mysqli_num_rows($result_1) > 0) {
        $value = 'failed email';
        header("Location:register.php?reply=$value");
    } elseif ($pass1 != $pass2) {
        $value = 'failed pass';
        header("Location:register.php?reply=$value");
    } else {
        // đăng kí thành công 
        if ($image_name == "") { // nếu k chọn ảnh thì để là ảnh mặc định
            echo $image_name = 'avatar_default.png';
        }
        $str = rand();
        $code = md5($str);
        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
        $sql_2 = "INSERT INTO users(first_name, last_name, email, password,code,avatar) 
        VALUES ('$first_name','$last_name','$email','$pass_hash','$code','$image_name')";
        $result_2 = mysqli_query($conn, $sql_2);

        if ($result_2 > 0) {
            // send mail

            require './sendEmai/Exception.php';
            require './sendEmai/PHPMailer.php';
            require './sendEmai/SMTP.php';

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

                $link = "http://localhost/danhba/activeUser.php?email=" . $email . "&code=" . $code;
                // Mail body content 
                $bodyContent = '<p>Thân gửi <b>NVHung</b></h1>';
                $bodyContent .= '<p>Bạn vui lòng nhấp vào đường linh dưới đây để kích hoạt tài khoản</p>';
                $bodyContent .= '<a href=' . $link . '>Kích hoạt</a>';

                $mail->Body = $bodyContent;
                // // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if ($mail->send()) {
                    //echo 'Thư đã được gửi đi';
                    $_SESSION['noti'] = '<p class = "text-success">Đăng kí thành công. Kiểm tra Email để kích hoạt tài khoản</p>';
                    header("location:" . $siteurl . "login.php");
                } else {
                    // thư không được gửi đi
                    $_SESSION['noti'] = '<p class = "text-danger">Lỗi khi kích hoạt tài khoản! Vui lòng thử lại</p>';
                    header("location:" . $siteurl . "login.php");
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}

?>
<?php
include('./config/constants.php');
require 'Excel/vendor/autoload.php';
include("./bridge/check_user.php");


if (isset($_POST['inport_file_btn'])) {
    $allweb_ext = ['xls', 'csv', 'xlsx'];

    $fileName = $_FILES['import_file']['name'];

    $checking = explode(".", $fileName);
    $file_ext = end($checking);

    if (in_array($file_ext, $allweb_ext)) {
        $targetPath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $i = 0;
        foreach ($data as $row) {
            $i++;
            if ($i == 1) {
                continue;
            }
            $tennv = $row['0'];
            $chucvu = $row['1'];
            $mayban = $row['2'];
            $email = $row['3'];
            $sodidong = $row['4'];
            $tendv = $row['5'];
            // lấy ra mã đơn vị theo tên đơn vị phù hợp
            $sql1 = "SELECT * FROM db_donvi WHERE tendv = '$tendv'";
            $res1 = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_assoc($res1);
            $madv = $row['madv'];
            // thêm 1 dòng dữ liệu mới
            // dữ liệu thêm vào cần phải chuẩn 
            $sql2 = "INSERT INTO `db_nhanvien`(`tennv`, `chucvu`, `mayban`, `email`, `sodidong`, `madv`) 
            VALUES ('$tennv','$chucvu','$mayban','$email','$sodidong','$madv')";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2) {
                $_SESSION['noti'] = "Đã thêm thành công";
                header("location: index.php");
            } else {
                $_SESSION['noti'] = "Lỗi! Thêm không thành công";
                header("location: index.php");
            }
        }
    } else {
        $_SESSION['noti'] = "Vui Lòng chọn đúng file EXcel";
        header("location: index.php");
    }
}

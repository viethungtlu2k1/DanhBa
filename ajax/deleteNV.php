<?php
include('../config/constants.php');
include("../bridge/check_user.php");
include('../bridge/checklogin.php');
$manv = $_GET['manv'];

$sql = "DELETE FROM `db_nhanvien` WHERE manv = $manv";

$res = mysqli_query($conn, $sql);

if ($res) {
    echo 1;
    //$_SESSION['noti'] = "Đã xóa";
    //header("location:" . $siteurl . 'index.php');
} else {
    echo 0;
    //$_SESSION['noti'] = "Lỗi khi xóa";
    //header("location:" . $siteurl . 'index.php');
}

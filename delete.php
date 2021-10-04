<?php
include("./config/constants.php");

$manv = $_GET['manv'];

$sql = "DELETE FROM `db_nhanvien` WHERE manv = $manv";

$res = mysqli_query($conn, $sql);

if ($res) {
    $_SESSION['noti'] = "Đã xóa";
    header("location:" . $siteurl . 'index.php');
} else {
    $_SESSION['noti'] = "Lỗi khi xóa";
    header("location:" . $siteurl . 'index.php');
}

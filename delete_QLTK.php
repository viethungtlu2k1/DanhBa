<?php
include("./config/constants.php");

$userid = $_GET['userid'];

$sql = "DELETE FROM `users` WHERE userid = $userid";

$res = mysqli_query($conn, $sql);

if ($res) {
    $_SESSION['noti'] = "Đã xóa";
    header("location:" . $siteurl . 'QLTK.php');
} else {
    $_SESSION['noti'] = "Lỗi khi xóa";
    header("location:" . $siteurl . 'QLTK.php');
}

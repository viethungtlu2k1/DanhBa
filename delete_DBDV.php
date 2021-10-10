<?php
include("./config/constants.php");
include("./bridge/check_user.php");

$madv = $_GET['madv'];

$sql = "DELETE FROM `db_donvi` WHERE madv = $madv";

$res = mysqli_query($conn, $sql);

if ($res) {
    $_SESSION['noti'] = "Đã xóa";
    header("location:" . $siteurl . "DBDonVi.php");
} else {
    $_SESSION['noti'] = "Lỗi khi xóa";
    header("location:" . $siteurl . "DBDonVi.php");
}

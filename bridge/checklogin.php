<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['noti'] = "Xin vui lòng đăng nhập";
    header("location:" . $siteurl . "login.php");
}

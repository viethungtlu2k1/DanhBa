<?php
if (!isset($_SESSION['check_user'])) {
    $_SESSION['noti'] = "Xin vui lòng đăng nhập";
    header("location:" . $siteurl . "index.php");
}

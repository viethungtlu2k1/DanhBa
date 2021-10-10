<?php
if (!isset($_SESSION)) {
    session_start();
}

$siteurl = "http://localhost/danhba/";
$link = "localhost/foododer";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_danhba";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Không thể kết nối,kiểm tra lại các tham số kết nối");
}
// lấy ra cấp độ tài khoản đăng nhập
// 1 - cho phép thêm sửa xóa và xem thông tin tài khoản khác
// 0 - không cho phép thêm sửa xóa và không xem được thông tin tài khoản khác
function user_level($id)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_danhba";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //$id = $_SESSION['user_id'];
    $sql = "SELECT user_level FROM users WHERE userid = $id";
    $res = mysqli_query($conn, $sql);
    $row_x = mysqli_fetch_assoc($res);
    return $row_x['user_level'];
}

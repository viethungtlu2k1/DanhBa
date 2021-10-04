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

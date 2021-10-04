<?php
include('./config/constants.php');
ob_start(); // loi cua header() nen phai dung
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Danh Ba</title>
</head>

<body>

    <div class="simple-login-container">
        <?php
        if (isset($_SESSION['noti'])) {
            echo $_SESSION['noti'];
            unset($_SESSION['noti']);
        }
        ?>
        <form action="" method="POST">
            <h2>Login Form</h2>
            <div class="row mb-3">
                <div class="col-md-12 form-group">
                    <input type="text" name="tendangnhap" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 form-group">
                    <input type="password" name="matkhau" placeholder="Enter your Password" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 form-group">
                    <input type="submit" name="submit" class="btn btn-block btn-login" placeholder="Enter your Password">
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST["submit"])) {
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = md5($_POST['matkhau']);

    $sql = "SELECT * FROM `db_nguoidung` WHERE `tendangnhap` = '$tendangnhap'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if ($row['matkhau'] == $matkhau) {
            $_SESSION['noti'] = "Đã đăng nhập";
            $_SESSION['user'] = $row['email'];
            header("location:" . $siteurl . 'index.php');
        } else {
            $_SESSION['noti'] = "Tài khoản mật khẩu chưa chính xác";
            header("location:" . $siteurl . 'login.php');
        }
    }
}
?>
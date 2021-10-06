<?php
include('./config/constants.php');
ob_start(); // loi cua header() nen phai dung
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/regis.css">
    <title>Đăng Nhập</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <?php
                        if (isset($_SESSION['noti'])) {
                            echo $_SESSION['noti'];
                            unset($_SESSION['noti']);
                        }
                        ?>
                        <form method="POST" action="">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="pass" class="form-control" id="floatingInput" placeholder="Password">
                                <label for="floatingInput">Mật khẩu</label>
                            </div>
                            <!-- <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                <label class="form-check-label" for="rememberPasswordCheck">
                                    Remember password
                                </label>
                            </div> -->
                            <div class="d-grid mb-3">
                                <input class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="submit" value="Đăng Nhập">
                            </div>
                            <div class="row mb-4 px-3">
                                <small class="font-weight-bold">Bạn chưa có tài khoản? <a href="register.php" class="text-danger ">Đăng kí</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    //$matkhau = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM `users` WHERE `email` = '$email' and `status` = 1 ";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($pass, $row['password'])) {
            // đăng nhập thành công 
            $_SESSION['noti'] = "<p class = 'text-success'>Đã đăng nhập </p>";
            $_SESSION['user'] = $row["first_name"] . " " . $row['last_name'];
            $_SESSION['user_id'] = $row['userid'];
            header("location:" . $siteurl . 'index.php');
        } else {
            $_SESSION['noti'] = '<p class="text-danger">Tài khoản mật khẩu chưa chính xác</p>';
            header("location:" . $siteurl . 'login.php');
        }
    }
}
?>
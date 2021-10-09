<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/regis.css">
    <title>Đăng Kí </title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <?php
                        if (isset($_GET['reply'])) {
                            if ($_GET['reply'] == "failed email") {
                                echo '<p class="text-danger">* Email đã tồn tại</p>';
                            } elseif ($_GET['reply'] == "failed pass") {
                                echo '<p class="text-danger">* Các mật khẩu đã nhập không khớp. Hãy thử lại.</p>';
                            } else {
                                echo '<p class="text-danger">* Lỗi khi chọn ảnh đại diện.</p>';
                            }
                        }

                        ?>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" name="firstName" class="form-control" id="floatingInput" placeholder="Viet">
                                <label for="floatingInput">Họ</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="lastName" class="form-control" id="floatingInput" placeholder="Hung">
                                <label for="floatingInput">Tên</label>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Ảnh đại diện</label>
                                <input class="form-control" type="file" name="avatar" value="Chọn ảnh">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email</label>
                                <a href=""></a>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="pass1" class="form-control" id="floatingInput" placeholder="Password">
                                <label for="floatingInput">Mật khẩu</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="pass2" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Nhập lại mật khẩu</label>
                            </div>
                            <!-- <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                <label class="form-check-label" for="rememberPasswordCheck">
                                    Remember password
                                </label>
                            </div> -->
                            <div class="d-grid mb-4">
                                <input class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="submit" value="Đăng kí">
                            </div>
                        </form>
                        <div class="row mb-4 px-3">
                            <small class="font-weight-bold">Đã có tài khoản? <a href="login.php" class="text-danger ">Đăng Nhập</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include("process-register.php")
?>
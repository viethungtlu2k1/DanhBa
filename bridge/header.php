<?php
include('./config/constants.php');
include('./bridge/checklogin.php');
ob_start(); // loi cua header()


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
    <title>Danh Ba</title>
</head>

<body>

    <div class="danhba">
        <div class="header">
            <div class="container">
                <header class="row justify-content-start">
                    <a href="index.php" class="col-6">
                        <img src="./images/logo.png" class="img-fluid">
                    </a>
                    <div class="header-right col-6 text-end header-meta">
                        <div class="login">
                            <a href="logout.php">Đăng xuất</a>
                            <img src="./images/vi.jpg" alt="">
                            <img src="./images//en.jpg" alt="">
                        </div>
                        <div class="admin">
                            <span><?= $_SESSION['user'] ?></span>
                        </div>
                        <!-- <form class="header-search">
              <i class="fas fa-search"></i>
              <input type="text" placeholder="Tìm kiếm" class="input">
              <input type="submit" value="Tìm" class="submit"> 
            </form> -->
                    </div>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-1">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" id="qliDanhBaNV" aria-current="page" href="index.php">Quản Lý Danh bạ nhân viên</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="qliDanhBaDV" href="DBDonVi.php">Quản Lý danh bạ đơn vị</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <?php
                                        $id = $_SESSION['user_id'];
                                        if (user_level($id) == 1) { // nếu là cấp 1 
                                        ?>
                                            <a class="nav-link" id="qliTaiKhoan" href="QLTK.php" role="button">
                                                Quản lý Tài khoản
                                            </a>
                                        <?php
                                        }

                                        ?>
                                    </li>
                                </ul>
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
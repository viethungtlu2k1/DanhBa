<?php
include("./bridge/header.php");

$userid = $_GET['userid'];

$sql = "SELECT * FROM users WHERE userid = $userid";

$res = mysqli_query($conn, $sql);
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $userid = $row['userid'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $registration_date = $row['registration_date'];
    $old_avatar = $row['avatar'];
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 ">
                        <label class="form-label">Họ</label>
                        <input type="text" name="first_name" class="form-control" value="<?= $first_name ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên</label>
                        <input type="text" name="last_name" class="form-control" value="<?= $last_name ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày đăng kí</label>
                        <input type="text" name="registration_date" class="form-control" value="<?= $registration_date ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label me-3">Ảnh đại diện: </label>
                        <img class="img_user" src="./images/avatar_user/<?= $old_avatar ?>" alt="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thay đổi ảnh đại diện: </label>
                        <input type="file" name="new_avatar" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="add" value="Sửa">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $registration_date = $_POST['registration_date'];
    if ($_FILES['new_avatar']['name'] == "") {
        // không thay đổi ảnh đại diện
        //echo $new_avatar = $old_avatar;
    } else {
        // có thay đổi ảnh đại diện
        $image_name = $_FILES['new_avatar']['name'];
        $source_path = $_FILES['new_avatar']['tmp_name'];
        $save_path = "images/avatar_user/" . $image_name;
        // kiểm tra xem có file nào đã được chọn hay chưa
        // đổi tên file ảnh 
        // $ext = end(explode('.', $image_name));
        // echo $image_name = "userImage_" . $userid . '.' . $ext;
        // kiểm tra  có phải là file ảnh hay không
        $check = getimagesize($_FILES["new_avatar"]["tmp_name"]);
        if ($check !== false) {
            // nếu là file ảnh thì ...
            $upload = move_uploaded_file($source_path, $save_path);
            if ($upload == false) {
                $_SESSION['img_change'] = '<p class="text-danger">* Lỗi khi thay đổi thông tin người dùng</p>';
                header("Location: QLTK.php");
            }
        } else {
            // nếu không phải file ảnh thì hiện ra thông báo khi submit
            $_SESSION['img_change'] = '<p class=text-dangerr">* Lỗi khi thay đổi thông tin người dùng</p>';
            header("Location: QLTK.php");
        }
    }

    $sql = "UPDATE `users` 
    SET `first_name`='$first_name',
    `last_name`='$last_name',
    `registration_date`='$registration_date',
    `email`='$email',
    `avatar`='$image_name' 
    WHERE `userid` = $userid";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['noti'] = "Đã sửa thành công";
        header("location:" . $siteurl . 'QLTK.php');
    } else {
        $_SESSION['noti'] = "Lỗi! Sửa không thành công";
        header("location:" . $siteurl . 'QLTK.php');
    }
}
include("./bridge/footer.php");
?>
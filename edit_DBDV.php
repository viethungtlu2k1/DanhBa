<?php
include("./bridge/header.php");
include("./bridge/check_user.php");
$madv = $_GET['madv'];

$sql = "SELECT * FROM db_donvi WHERE madv = $madv";

$res = mysqli_query($conn, $sql);
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $madv = $row['madv'];
    $tendv = $row['tendv'];
    $diachi = $row['diachi'];
    $email = $row['email'];
    $website = $row['website'];
    $dienthoai = $row['dienthoai'];
    $old_madv_cha = $row['madv_cha'];
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST">
                    <div class="mb-3 ">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" name="tendv" class="form-control" value="<?= $tendv ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chức vụ</label>
                        <input type="text" name="diachi" class="form-control" value="<?= $diachi ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số máy bàn</label>
                        <input type="text" name="website" class="form-control" value="<?= $website ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số di động</label>
                        <input type="text" name="dienthoai" class="form-control" value="<?= $dienthoai ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên đơn vị</label>
                        <select class="form-select" name="madv_cha">
                            <option value="NULL">Không thuộc đơn vị nào</option>
                            <?php
                            $sql = "SELECT * FROM db_donvi";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $madv_slected = $row['madv'];
                                    $tendv = $row['tendv'];
                            ?>
                                    <option class="form-control" value="<?= $madv_slected; ?>" <?php if ($madv_slected == $old_madv_cha) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                        <?= $tendv ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="add" value="Sửa">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $tendv = $_POST['tendv'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $dienthoai = $_POST['dienthoai'];
    $madv_cha = $_POST['madv_cha'];
    $sql = "UPDATE `db_donvi` 
    SET `tendv`='$tendv',
    `diachi`='$diachi',
    `email`='$email',
    `website`='$website',
    `dienthoai`='$dienthoai',
    `madv_cha`=$madv_cha 
    WHERE `madv` = $madv";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['noti'] = "Đã sửa thành công";
        header("location:" . $siteurl . "DBDonVi.php");
    } else {
        $_SESSION['noti'] = "Lỗi! Sửa không thành công";
        header("location:" . $siteurl . "DBDonVi.php");
    }
}
include("./bridge/footer.php");
?>
<?php
include("./bridge/header.php");

$manv = $_GET['manv'];

$sql = "SELECT * FROM db_nhanvien WHERE manv = $manv";

$res = mysqli_query($conn, $sql);
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $manv = $row['manv'];
    $tennv = $row['tennv'];
    $chucvu = $row['chucvu'];
    $email = $row['email'];
    $mayban = $row['mayban'];
    $sodidong = $row['sodidong'];
    $old_madv = $row['madv'];
}
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST">
                    <div class="mb-3 ">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" name="tennv" class="form-control" value="<?= $tennv ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chức vụ</label>
                        <input type="text" name="chucvu" class="form-control" value="<?= $chucvu ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số máy bàn</label>
                        <input type="text" name="mayban" class="form-control" value="<?= $mayban ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số di động</label>
                        <input type="text" name="sodidong" class="form-control" value="<?= $sodidong ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên đơn vị</label>
                        <select class="form-select" name="madv">
                            <?php
                            $sql = "SELECT * FROM db_donvi";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $madv = $row['madv'];
                                    $tendv = $row['tendv'];
                            ?>
                                    <option class="form-control" value="<?= $madv; ?>" <?php if ($madv == $old_madv) {
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
    $tenvn = $_POST['tennv'];
    $chucvu = $_POST['chucvu'];
    $email = $_POST['email'];
    $mayban = $_POST['mayban'];
    $sodidong = $_POST['sodidong'];
    $madv = $_POST['madv'];
    $sql = "UPDATE `db_nhanvien` 
    SET `tennv`='$tenvn',
    `chucvu`='$chucvu',
    `mayban`='$mayban',
    `email`='$email',
    `sodidong`='$sodidong',
    `madv`='$madv' 
    WHERE `manv` = $manv";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['noti'] = "Đã sửa thành công";
        header("location:" . $siteurl . 'index.php');
    } else {
        $_SESSION['noti'] = "Lỗi! Sửa không thành công";
        header("location:" . $siteurl . 'index.php');
    }
}
include("./bridge/footer.php");
?>
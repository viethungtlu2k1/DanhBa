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
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Chức vụ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số máy bàn</th>
                                <th scope="col">Số di động</th>
                                <th scope="col">Tên đơn vị</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="tennv" value="<?= $tennv ?>"></td>
                                <td><input type="text" name="chucvu" value="<?= $chucvu ?>"></td>
                                <td><input type="email" name="email" value="<?= $email ?>"></td>
                                <td><input type="text" name="mayban" value="<?= $mayban ?>"></td>
                                <td><input type="text" name="sodidong" value="<?= $sodidong ?>"></td>
                                <td><select name="madv">
                                        <?php
                                        $sql = "SELECT * FROM db_donvi";
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);

                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $madv = $row['madv'];
                                                $tendv = $row['tendv'];
                                        ?>
                                                <option value="<?= $madv; ?>" <?php if ($madv == $old_madv) {
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
                                    </select></td>
                            </tr>
                        </tbody>
                    </table>
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
        header("location: index.php");
    } else {
        $_SESSION['noti'] = "Lỗi! Sửa không thành công";
        header("location: index.php");
    }
}
include("./bridge/footer.php");
?>
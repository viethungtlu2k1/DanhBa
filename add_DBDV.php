<?php
include("./bridge/header.php");
include("./bridge/check_user.php");
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tên Đơn vị</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Website</th>
                                <th scope="col">Số di động</th>
                                <th scope="col">Thuộc Đơn vị</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-control" type="text" name="tendv"></td>
                                <td><input class="form-control" type="text" name="diachi"></td>
                                <td><input class="form-control" type="email" name="email"></td>
                                <td><input class="form-control" type="text" name="website"></td>
                                <td><input class="form-control" type="text" name="dienthoai"></td>
                                <td><select name="madv" class="form-select">
                                        <option value="NULL">Không thuộc đơn vị nào</option>
                                        <?php
                                        $sql = "SELECT * FROM db_donvi";
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);

                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $madv = $row['madv'];
                                                $tendv = $row['tendv'];
                                        ?>
                                                <option value="<?= $madv ?>"><?= $tendv ?></option>
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
                    <input type="submit" name="submit" class="add" value="Thêm">
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
    $madv = $_POST['madv'];
    echo $sql = "INSERT INTO `db_donvi`(`madv`, `tendv`, `diachi`, `email`, `website`, `dienthoai`, `madv_cha`) 
    VALUES (NULL,'$tendv','$diachi','$email','$website','$dienthoai',$madv)";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['noti'] = "Đã thêm thành công";
        header("location:" . $siteurl . "DBDonVi.php");
    } else {
        $_SESSION['noti'] = "Lỗi! Thêm không thành công";
        header("location:" . $siteurl . "DBDonVi.php");
    }
}
include("./bridge/footer.php");
?>
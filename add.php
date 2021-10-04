<?php
include("./bridge/header.php")
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
                                <td><input class="form-control" type="text" name="tennv"></td>
                                <td><input class="form-control" type="text" name="chucvu"></td>
                                <td><input class="form-control" type="email" name="email"></td>
                                <td><input class="form-control" type="text" name="mayban"></td>
                                <td><input class="form-control" type="text" name="sodidong"></td>
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
    $tenvn = $_POST['tennv'];
    $chucvu = $_POST['chucvu'];
    $email = $_POST['email'];
    $mayban = $_POST['mayban'];
    $sodidong = $_POST['sodidong'];
    $madv = $_POST['madv'];
    $sql = "INSERT INTO `db_nhanvien`(`manv`, `tennv`, `chucvu`, `mayban`, `email`, `sodidong`, `madv`) 
    VALUES (NULL,'$tenvn','$chucvu','$mayban','$email','$sodidong','$madv')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['noti'] = "Đã thêm thành công";
        header("location: index.php");
    } else {
        $_SESSION['noti'] = "Lỗi! Thêm không thành công";
        header("location: index.php");
    }
}
include("./bridge/footer.php");
?>
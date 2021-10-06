<?php
include("./bridge/header.php")
?>
<div class="main">
    <div class="container">
        <h3 class="text-center">Danh bạ Đơn vị</h3>

        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
                ?>
                <br>
                <a href="add_DBDV.php" class="add">Thêm</a>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Đơn vị</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">Số di động</th>
                            <th scope="col">Thuộc Đơn vị</th>
                            <th scope="col">Sửa</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM db_donvi";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td scope="row"><?php echo $i; ?> </td>
                                    <td><?php echo $row['tendv']; ?> </td>
                                    <td><?php echo $row['diachi']; ?> </td>
                                    <td><?php echo $row['email']; ?> </td>
                                    <td><?php echo $row['website']; ?> </td>
                                    <td><?php echo $row['dienthoai']; ?> </td>
                                    <td><?php
                                        // lấy ra mã đơn vị cha
                                        $madv_cha = $row['madv_cha'];
                                        if ($madv_cha == NULL) {
                                            echo "NULL";
                                        } else { // truy cập db_donvi lấy ra tên đơn vị có mã đơn vị bằng mã đơn vị cha
                                            $sql = "SELECT * FROM db_donvi WHERE madv = $madv_cha";
                                            $res = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($res) > 0) {
                                                $check = mysqli_fetch_assoc($res);
                                                echo $check['tendv'];
                                            }
                                        }

                                        ?>
                                    </td>
                                    <td><a href="edit_DBDV.php?madv=<?php echo $row['madv']; ?>"><i class="fas fa-edit"></i></a></td>
                                    <td><a href="delete_DBDV.php?madv=<?php echo $row['madv']; ?>"><i class="fas fa-trash"></i></a></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include("./bridge/footer.php")
?>
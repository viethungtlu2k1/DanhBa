<?php
include("./bridge/header.php");
include("./bridge/check_user.php");
?>
<div class="main">
    <div class="container">
        <h3 class="text-center">Quản lý Tài khoản</h3>
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
                if (isset($_SESSION['img_change'])) {
                    echo $_SESSION['img_change'];
                    unset($_SESSION['img_change']);
                }

                ?>
                <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Họ</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ngày đăng kí</th>
                            <th scope="col">Sửa</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td scope="row"><?php echo $i; ?> </td>
                                    <td><?php echo $row['first_name']; ?> </td>
                                    <td><?php echo $row['last_name']; ?> </td>
                                    <td><?php echo $row['email']; ?> </td>
                                    <td><?php echo $row['registration_date']; ?> </td>
                                    <td><a href="edit_QLTK.php?userid=<?php echo $row['userid']; ?>"><i class="fas fa-edit"></i></a></td>
                                    <td><a href="delete_QLTK.php?userid=<?php echo $row['userid']; ?>"><i class="fas fa-trash"></i></a></td>
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
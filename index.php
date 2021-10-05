<?php
include("./bridge/header.php")
?>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php
        if (isset($_SESSION['noti'])) {
          echo $_SESSION['noti'];
          unset($_SESSION['noti']);
        }
        ?>
        <br>
        <a href="add_DBNV.php" class="add">Thêm</a>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Mã nhân viên</th>
              <th scope="col">Họ và tên</th>
              <th scope="col">Chức vụ</th>
              <th scope="col">Email</th>
              <th scope="col">Số di động</th>
              <th scope="col">Tên đơn vị</th>
              <th scope="col">Sửa</th>
              <th scope="col">Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT nv.manv, nv.tennv, nv.chucvu, nv.email, nv.sodidong, dv.tendv 
                    FROM db_nhanvien nv, db_donvi dv WHERE nv.madv = dv.madv ORDER BY nv.manv";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                  <td scope="row"><?php echo $i; ?> </td>
                  <td><?php echo $row['manv']; ?> </td>
                  <td><?php echo $row['tennv']; ?> </td>
                  <td><?php echo $row['chucvu']; ?> </td>
                  <td><?php echo $row['email']; ?> </td>
                  <td><?php echo $row['sodidong']; ?> </td>
                  <td><?php echo $row['tendv']; ?> </td>
                  <td><a href="edit_DBNV.php?manv=<?php echo $row['manv']; ?>"><i class="fas fa-edit"></i></a></td>
                  <td><a href="delete_DBNV.php?manv=<?php echo $row['manv']; ?>"><i class="fas fa-trash"></i></a></td>
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
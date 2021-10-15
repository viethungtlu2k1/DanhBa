<?php
include("./bridge/header.php")
?>
<div class="main">
  <div class="container">
    <h3 class="text-center">Danh bạ Nhân viên</h3>
    <div class="row">
      <div class="col-12">
        <?php
        if (isset($_SESSION['noti'])) {
          echo $_SESSION['noti'];
          unset($_SESSION['noti']);
        }
        ?>
        <br>
        <?php
        $id = $_SESSION['user_id'];
        if (user_level($id) == 1) { // nếu là cấp 1 
        ?>
          <a href="add_DBNV.php" class="add">Thêm</a>
        <?php
        }
        ?>
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
              <?php
              $id = $_SESSION['user_id'];
              if (user_level($id) == 1) { // nếu là cấp 1 
              ?>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
              <?php
              }
              ?>
            </tr>
          </thead>
          <tbody id="showNV">

          </tbody>
        </table>
        <form action="export_excel.php" method="POST">
          <div class="row">
            <div class="col-md-6">
              <button type="submit" name="submit" class="btn btn-primary">Tải File</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include("./bridge/footer.php")
?>
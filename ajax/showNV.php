<?php
include('../config/constants.php');
include('../bridge/checklogin.php');
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
            <?php
            $id = $_SESSION['user_id'];
            if (user_level($id) == 1) { // nếu là cấp 1 
            ?>
                <td><a href="edit_DBNV.php?manv=<?php echo $row['manv']; ?>"><i class="fas fa-edit"></i></a></td>
                <td><a href="#" id="deleteNV" data-manv="<?= $row['manv'] ?>"><i class="fas fa-trash"></i></a></td>
            <?php
            }
            ?>

        </tr>
<?php
        $i++;
    }
}
?>
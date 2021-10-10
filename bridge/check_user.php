<?php

$id = $_SESSION['user_id'];
if (user_level($id) == 0) {
    header("location:" . $siteurl . "index.php");
}

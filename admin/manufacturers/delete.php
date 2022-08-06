<?php
require '../check_super_admin_login.php';

if (empty($_GET['id'])) {
    header('location:index.php?error=Không xác định được mã của nhân viên');
    exit;
}

$id = $_GET['id'];

require '../connectDB.php';
$sql = "delete from manufacturers
where manufacturer_id = '$id'";

mysqli_query($connect_db, $sql);
$error = mysqli_error($connect_db);
mysqli_close($connect_db);

if (empty($error)) {
    header('location:index.php?success=Xoá thành công');
    exit;
} else {
    header('location:index.php?error=Lỗi truy vấn');
    exit;
}

<?php
require '../check_admin_login.php';

$id = $_GET['id'];

require '../connectDB.php';
$sql = "delete from products
where product_id = '$id'";

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

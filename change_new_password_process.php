<?php

if (empty($_POST['new_password'])) {
    header('location:change_new_password.php?error=Vui lòng điền mật khẩu mới');
    exit;
}

$token = $_POST['token'];
$new_password = $_POST['new_password'];

require 'admin/connectDB.php';
$sql = "select customer_id from forgot_password
where token = '$token'";
$result = mysqli_query($connect_db, $sql);
if (mysqli_num_rows($result) == 0) {
    header('location:index.php');
    exit;
}

$customer_id = mysqli_fetch_array($result)['customer_id'];

$sql = "update customers
set password = '$new_password' where customer_id = '$customer_id'";
mysqli_query($connect_db, $sql);

$sql = "delete from forgot_password
where token = '$token'";
mysqli_query($connect_db, $sql);

mysqli_close($connect_db);
header('location:index.php?success=Đổi mật khẩu thành công');

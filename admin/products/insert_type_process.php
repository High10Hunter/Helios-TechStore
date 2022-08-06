<?php
require '../check_admin_login.php';

if (empty($_POST['type_name'])) {
    header('location:insert_type_form.php?error=Vui lòng điền đầy đủ thông tin');
    exit;
}

$type_name = $_POST['type_name'];
require '../connectDB.php';

$sql = "insert into types (type_name)
values ('$type_name')";

mysqli_query($connect_db, $sql);

$error = mysqli_error($connect_db);
mysqli_close($connect_db);
if (empty($error)) {
    header('location:index.php?success=Thêm thể loại thành công!');
    exit;
} else {
    header('location:insert_type_form.php?error=Không thể thêm thể loại');
    exit;
}

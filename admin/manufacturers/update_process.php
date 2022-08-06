<?php
require '../check_super_admin_login.php';

if (empty($_POST['id'])) {
    header('location:index.php?error=Không xác định được mã nhà sản xuất');
    exit;
}
$id = $_POST['id'];

if (empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone_number'])) {
    header("location:update_form.php?id=$id&error=Vui lòng điền đầy đủ thông tin!");
    exit;
}

$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$new_image = $_FILES['new_image'];

if ($new_image['size'] > 1) {
    $folder = 'manufacturers_images/';
    $file_extension = explode('.', $new_image['name'])[1];
    $file_name = time() . '.' . $file_extension;
    $path = $folder . $file_name;
    move_uploaded_file($new_image['tmp_name'], $path);
} else {
    $file_name = $_POST['old_image'];
}


require '../connectDB.php';
$sql = "update manufacturers
set
manufacturer_name = '$name',
address = '$address',
phone_number = '$phone_number',
image = '$file_name'
where manufacturer_id = '$id'";
mysqli_query($connect_db, $sql);

$error = mysqli_error($connect_db);
mysqli_close($connect_db);

if (empty($error)) {
    header('location:index.php?success=Cập nhật thành công nhà sản xuất!');
    exit;
} else {
    header("location:update_form.php?id=$id&error=Lỗi truy vấn");
    exit;
}

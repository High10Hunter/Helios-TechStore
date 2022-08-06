<?php
require '../check_admin_login.php';

if (empty($_POST['id'])) {
    header('location:index.php?error=Không xác định được sản phẩm');
    exit;
}
$id = $_POST['id'];

if (empty($_POST['product_name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['manufacturer_id'])) {
    header('location: insert_form.php?error=Vui lòng điền đầy đủ thông tin');
    exit;
}

$name = $_POST['product_name'];
$new_image = $_FILES['new_image'];
if ($new_image['size'] > 0) {
    $folder = 'products_images/';
    $file_extension = explode('.', $new_image['name'])[1];
    $file_name = time() . '.' . $file_extension;
    $path = $folder . $file_name;
    move_uploaded_file($new_image['tmp_name'], $path);
} else {
    $file_name = $_POST['old_image'];
}

$description = $_POST['description'];
$price = $_POST['price'];
$manufacturer_id = $_POST['manufacturer_id'];
$type_id = $_POST['type_id'];


require '../connectDB.php';
$sql = "update products
set
product_name = '$name',
image = '$file_name',
price = '$price',
description = '$description',
manufacturer_id = '$manufacturer_id',
type_id = '$type_id'
where product_id = '$id'";

mysqli_query($connect_db, $sql);

$error = mysqli_error($connect_db);
mysqli_close($connect_db);
if (empty($error)) {
    header('location:index.php?success=Cập nhật sản phẩm thành công!');
    exit;
} else {
    header("location:update_form.php?id=$id&error=Lỗi truy vấn");
    exit;
}

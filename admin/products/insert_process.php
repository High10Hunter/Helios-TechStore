<?php
require '../check_admin_login.php';

if (empty($_POST['product_name']) || empty($_FILES['image']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['manufacturer_id'])) {
    header('location: insert_form.php?error=Vui lòng điền đầy đủ thông tin');
    exit;
}

$name = $_POST['product_name'];
$image = $_FILES['image'];
$description = $_POST['description'];
$price = $_POST['price'];
$manufacturer_id = $_POST['manufacturer_id'];
$type_id = $_POST['type_id'];

//save image
$folder = 'products_images/';
$file_extension = explode('.', $image['name'])[1];
$file_name = time() . '.' . $file_extension;
$path = $folder . $file_name;
move_uploaded_file($image['tmp_name'], $path);

require '../connectDB.php';
$sql = "insert into products(product_name, image, price, description, manufacturer_id, type_id)
values ('$name', '$file_name', '$price', '$description', '$manufacturer_id', '$type_id')";

mysqli_query($connect_db, $sql);

$error = mysqli_error($connect_db);
mysqli_close($connect_db);
if (empty($error)) {
    header('location:index.php?success=Thêm sản phẩm thành công!');
    exit;
} else {
    header('location:index.php?error=Lỗi truy vấn');
    exit;
}

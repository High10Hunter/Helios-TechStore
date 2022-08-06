<?php
require '../check_super_admin_login.php';

if (empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone_number']) || empty($_FILES['image'])) {
    header('location:insert_form.php?error=Vui lòng điền đầy đủ thông tin!');
    exit;
}

$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$image = $_FILES['image'];

$folder = 'manufacturers_images/';
$file_extension = explode('.', $image['name'])[1];
$file_name = time() . '.' . $file_extension;
$path = $folder . $file_name;

move_uploaded_file($image['tmp_name'], $path);

require '../connectDB.php';
$sql = "insert into manufacturers (manufacturer_name, address, phone_number, image)
values ('$name', '$address', '$phone_number', '$file_name')";
mysqli_query($connect_db, $sql);

$error = mysqli_error($connect_db);
mysqli_close($connect_db);
if (empty($error)) {
    header('location:index.php?success=Thêm thành công nhà sản xuất!');
    exit;
} else {
    header('location:index.php?error=Lỗi truy vấn');
    exit;
}

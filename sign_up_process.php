<?php

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['birthday']) || empty($_POST['password']) || empty($_POST['address']) || empty($_POST['phone_number'])) {
    header('location:sign_up.php?error=Vui lòng điền đầy đủ thông tin!');
    exit;
}

$customer_name = $_POST['name'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];

require 'admin/connectDB.php';
$sql = "select count(*) from customers
where email = '$email'";
$result = mysqli_query($connect_db, $sql);
$number_rows = mysqli_fetch_array($result)['count(*)'];

if ($number_rows == 1) {
    header('location:sign_up.php?error=Email đã tồn tại ! Vui lòng chọn email khác');
    exit;
}

$sql = "insert into customers(customer_name, birthday, email, password, address, phone_number)
values ('$customer_name', '$birthday', '$email', '$password', '$address', '$phone_number')";
mysqli_query($connect_db, $sql);

//save session
$sql = "select customer_id from customers
where email = '$email'";
$result = mysqli_query($connect_db, $sql);
$id = mysqli_fetch_array($result)['customer_id'];

session_start();
$_SESSION['customer_id'] = $id;
$_SESSION['customer_name'] = $customer_name;

mysqli_close($connect_db);

header('location:user.php');
exit;

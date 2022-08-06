<?php

if (empty($_POST['email']) || empty($_POST['email'])) {
    header('location:sign_in.php?error=Vui lòng điền đầy đủ thông tin!');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];
if ($_POST['remember']) {
    $remember = true;
} else {
    $remember = false;
}

require 'admin/connectDB.php';
$sql = "select * from customers
where email = '$email' and password = '$password'";
$result = mysqli_query($connect_db, $sql);
$num_rows = mysqli_num_rows($result);


if ($num_rows == 1) {
    session_start();
    $each = mysqli_fetch_array($result);
    $_SESSION['customer_id'] = $each['customer_id'];
    $_SESSION['customer_name'] = $each['customer_name'];

    if ($remember) {
        while (1) {
            $token = uniqid('user_', true);
            $sql = "select * from customers
            where token = '$token'";
            $result = mysqli_query($connect_db, $sql);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {
                break;
            }
        }
        $id = $each['customer_id'];
        $sql = "update customers
        set token = '$token'
        where customer_id = '$id'";
        mysqli_query($connect_db, $sql);
        setcookie("remember_signin", $token, time() + 60 * 60 * 24 * 30);
    }

    mysqli_close($connect_db);
    header('location:user.php');
    exit;
}

header('location:sign_in.php?error=Tên email hoặc mật khẩu sai!');
exit;

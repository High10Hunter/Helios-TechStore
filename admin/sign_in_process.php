<?php

if (empty($_POST['email']) || empty($_POST['email'])) {
    header('location:index.php?error=Vui lòng điền đầy đủ thông tin!');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];
if ($_POST['remember']) {
    $remember = true;
} else
    $remember = false;

require 'connectDB.php';

$sql = "select * from admin
where email = '$email' and password = '$password'";
$result = mysqli_query($connect_db, $sql);
if (mysqli_num_rows($result) == 1) {
    $each = mysqli_fetch_array($result);
    session_start();

    $_SESSION['id'] = $each['admin_id'];
    $_SESSION['name'] = $each['name'];
    $_SESSION['level'] = $each['level'];

    if ($remember) {
        while (1) {
            $token = uniqid('user_', true);
            $sql = "select * from admin
            where token = '$token'";
            $result = mysqli_query($connect_db, $sql);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {
                break;
            }
        }
        $id = $each['admin_id'];
        $sql = "update admin
        set token = '$token'
        where admin_id = '$id'";
        mysqli_query($connect_db, $sql);
        setcookie("remember_signin", $token, time() + 60 * 60 * 24 * 30);
    }

    mysqli_close($connect_db);
    header('location:root/index.php');
    exit;
}

header('location:index.php?error=Tên email hoặc mật khẩu sai');

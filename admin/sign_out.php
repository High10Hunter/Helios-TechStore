<?php

session_start();
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['level']);

setcookie("remember_signin", null, -1);

if (isset($_GET['current_level'])) {
    $level = $_GET['current_level'];
    if ($level == 0) {
        header('location:index.php?error=Bạn không có quyền truy cập');
        exit;
    } else {
        header('location:index.php');
        exit;
    }
}
header('location:index.php');
exit;

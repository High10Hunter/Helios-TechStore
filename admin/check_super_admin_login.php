<?php

session_start();
if (empty($_SESSION['level'])) {
    header('location:../index.php?current_level=0&error=Bạn không có quyền truy cập');
    exit;
}

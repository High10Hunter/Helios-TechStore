<?php
try {
    session_start();
    $id = $_GET['id'];

    require 'admin/connectDB.php';
    $sql = "select * from products
    where product_id = '$id'";
    $result = mysqli_query($connect_db, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 1) {

        $type = $_GET['type'];

        if ($type === 'decrease') {
            if ($_SESSION['cart'][$id]['quantity'] > 1) {
                $_SESSION['cart'][$id]['quantity']--;
            } else {
                unset($_SESSION['cart'][$id]);
            }
        } else if ($type === 'increase') {
            if ($_SESSION['cart'][$id]['quantity'] < 3) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['cart'][$id]['quantity'] = 3;
                throw new Exception("Bạn không được đặt quá 3 sản phẩm!");
                // header('location:view_cart.php?error=Bạn không được đặt quá 3 sản phẩm');
                // exit;
            }
        }
        // header('location:view_cart.php');
        // exit;
    }
    echo 1;
} catch (\Throwable $th) {
    echo $th->getMessage();
}

// header('location:view_cart.php');

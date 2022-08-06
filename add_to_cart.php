<?php
try {
    session_start();
    // unset($_SESSION['cart']);

    if (empty($_GET['id'])) {
        throw new Exception("Không tìm thấy sản phẩm");
    }
    $id = $_GET['id'];

    if (empty($_SESSION['cart'][$id])) {
        require 'admin/connectDB.php';
        $sql = "select * from products
    where product_id = '$id'";
        $result = mysqli_query($connect_db, $sql);
        $each = mysqli_fetch_array($result);

        $_SESSION['cart'][$id]['product_name'] = $each['product_name'];
        $_SESSION['cart'][$id]['image'] = $each['image'];
        $_SESSION['cart'][$id]['price'] = $each['price'];
        $_SESSION['cart'][$id]['quantity'] = 1;
    } else {
        if ($_SESSION['cart'][$id]['quantity'] < 3) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            throw new Exception("Bạn không được đặt quá 3 sản phẩm");
            $_SESSION['cart'][$id]['quantity'] = 3;
        }
    }
    echo 1;
} catch (Throwable $th) {
    echo $th->getMessage();
}

<?php

session_start();
$recipient_name = $_POST['recipient_name'];
$recipient_phone_number = $_POST['recipient_phone_number'];
$recipient_address = $_POST['recipient_address'];

require 'admin/connectDB.php';
$total_price = 0;
$cart = $_SESSION['cart'];
foreach ($cart as $each) {
    $total_price += ($each['quantity'] * $each['price']);
}
$customer_id = $_SESSION['customer_id'];
$status = 0; //recently added

$sql = "insert into orders (customer_id, recipient_name, recipient_phone_number, recipient_address, status, total_price) 
values ('$customer_id', '$recipient_name', '$recipient_phone_number', '$recipient_address', '$status', '$total_price')";
mysqli_query($connect_db, $sql);

$sql = "select max(order_id) from orders
where customer_id = '$customer_id'";
$result = mysqli_query($connect_db, $sql);
$order_id = mysqli_fetch_array($result)['max(order_id)'];

$sql = "insert into orders_products (order_id, product_id, quantity) values";
foreach ($cart as $product_id => $each) {
    $insert_part = '(';
    $quantity = $each['quantity'];
    $insert_part = $insert_part  . $order_id . ',' . $product_id . ',' . $quantity . ')';
    $sql = $sql . $insert_part . ',';
}
$sql =  rtrim($sql, ",");
$sql = $sql . ";";
mysqli_query($connect_db, $sql);

mysqli_close($connect_db);
unset($_SESSION['cart']);

header('location:user.php?success=Đặt hàng thành công!');
exit;

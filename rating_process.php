<?php

$rating = $_POST['rating'];
$comment = $_POST['comment'];
$customer_id = $_POST['customer_id'];
$product_id = $_POST['product_id'];

require 'admin/connectDB.php';
$sql = "insert into rating_comment(customer_id, product_id, rating, comment)
values('$customer_id', '$product_id', '$rating', '$comment')";
mysqli_query($connect_db, $sql);

mysqli_close($connect_db);
$error = mysqli_error($connect_db);
mysqli_close($connect_db);
if (empty($error)) {
    header("location:user_product_details.php?id=$product_id&success=Đã thêm đánh giá sản phẩm");
    exit;
} else {
    header("location:user_product_details.php?id=$product_id&error=Không thêm được đánh giá");
    exit;
}

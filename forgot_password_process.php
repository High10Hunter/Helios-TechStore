<?php

function current_url()
{
    $url = "http://" . $_SERVER['HTTP_HOST'];
    return $url;
}

if (empty($_POST['email'])) {
    header('location:forgot_password.php?error=Vui lòng điền email khôi phục');
    exit;
}

$email = $_POST['email'];
require 'admin/connectDB.php';
$sql = "select customer_id, customer_name 
from customers
where email = '$email'";
$result = mysqli_query($connect_db, $sql);

if (mysqli_num_rows($result) === 1) {
    $each = mysqli_fetch_array($result);
    $id = $each['customer_id'];
    $name = $each['customer_name'];
    $sql = "delete from forgot_password
    where customer_id = '$id'";
    mysqli_query($connect_db, $sql);
    $token = uniqid();

    $sql = "insert into forgot_password(customer_id, token)
    values('$id', '$token')";
    mysqli_query($connect_db, $sql);
    $link = current_url() . '/project/shopping_website/change_new_password.php?token=' . $token;
    require 'mail.php';
    $title = "Thay đổi mật khẩu";
    $content = "Nhấp vào link này để đổi mật khẩu <a href='$link'>Hiệu lực trong 24h</a>";
    send_mail($email, $name, $title, $content);
}
mysqli_close($connect_db);
header('location:index.php?success=Đã gửi email');

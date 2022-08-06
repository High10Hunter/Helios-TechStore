<?php
require '../check_admin_login.php';

$status = $_GET['status'];
$order_id = $_GET['order_id'];
require '../connectDB.php';

$sql = "update orders 
set status = '$status'
where order_id = '$order_id'";
mysqli_query($connect_db, $sql);


header('location:index.php');
exit;

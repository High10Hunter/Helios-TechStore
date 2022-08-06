<!-- remember sign in -->
<?php
session_start();
if (isset($_COOKIE['remember_signin'])) {
    $token = $_COOKIE['remember_signin'];
    require 'admin/connectDB.php';
    $sql = "select * from customers
    where token = '$token'
    limit 1";
    $result = mysqli_query($connect_db, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 1) {
        $each = mysqli_fetch_array($result);
        $_SESSION['customer_id'] = $each['customer_id'];
        $_SESSION['customer_name'] = $each['customer_name'];
    }
}

if (isset($_SESSION['customer_id'])) {
    header('location:user.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css_customers/menu.css">
    <link rel="stylesheet" href="css_customers/products_view.css">
    <link rel="stylesheet" href="css_customers/footer.css">
    <link rel="stylesheet" href="css_customers/notification.css">
    <link rel="stylesheet" href="css_customers/pagination.css">
    <link rel="stylesheet" href="css_customers/search_bar.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
    body {
        background-image: url(https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2F736x%2Fc9%2F97%2Ffb%2Fc997fbe0495afdc0004077a42c97f814.jpg&f=1&nofb=1);
    }
</style>

<body>
    <div id="general">
        <?php include 'notifications.php' ?>
        <?php include 'menu.php' ?>
        <?php include 'products_view.php' ?>
        <?php include 'footer.php' ?>
    </div>
</body>

</html>
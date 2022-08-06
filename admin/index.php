<?php
if (isset($_COOKIE['remember_signin'])) {
    $token = $_COOKIE['remember_signin'];
    require 'connectDB.php';
    $sql = "select * from admin
    where token = '$token'";
    $result = mysqli_query($connect_db, $sql);
    if (mysqli_num_rows($result) == 1) {
        $each = mysqli_fetch_array($result);

        $_SESSION['id'] = $each['admin_id'];
        $_SESSION['name'] = $each['name'];
        $_SESSION['level'] = $each['level'];
    }
}

if (isset($_GET['current_level'])) {
    $level = $_GET['current_level'];
    if ($level == 0) {
        header('location:sign_out.php?current_level=$level');
        exit;
    }
}

if (isset($_SESSION['id'])) {
    header('location:root/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập admin</title>
    <link rel="stylesheet" href="css_files/sign_in.css">
    <link rel="stylesheet" href="css_files/notification.css">
    <style>
        body {
            background-image: none;
        }
    </style>
</head>

<body>
    <!-- notifications -->
    <?php
    if (isset($_GET['error'])) {
    ?>
        <div class="error-msg">
            <?php echo $_GET['error'] ?>
        </div>
    <?php
    }
    ?>

    <?php
    if (isset($_GET['success'])) {
    ?>
        <div class="success-msg">
            <?php echo $_GET['success'] ?>
        </div>
    <?php
    }
    ?>

    <div class="form-wrapper">
        <h1>Đăng nhập</h1>
        <form action="sign_in_process.php" method="POST">
            <div class="form-item">
                <label for="email"></label>
                <input type="email" name="email" placeholder="Email"></input>
            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password" placeholder="Mật khẩu"></input>
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Sign In" value="Đăng nhập"></input>
            </div>
            <br>
            <span style='font-family: "Open Sans", sans-serif; font-size: 1em;color: #666;'>
                Ghi nhớ đăng nhập
            </span>
            <input type="checkbox" name="remember">
        </form>
        <div class="form-footer">
            <p><a href="#">Quên mật khẩu ?</a></p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="css_customers/sign_in.css">
    <link rel="stylesheet" href="css_customers/notification.css">

</head>

<body>
    <?php include 'notifications.php' ?>
    <div class="form-wrapper">
        <h1>Nhập email khôi phục</h1>
        <form action="forgot_password_process.php" method="POST">
            <div class="form-item">
                <label for="email"></label>
                <input type="email" name="email" placeholder="Email"></input>
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Sign In" value="Gửi link"></input>
            </div>
            <br>
    </div>
</body>

</html>
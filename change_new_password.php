<?php
$token = $_GET['token'];
require 'admin/connectDB.php';
$sql = "select customer_id from forgot_password 
where token = '$token'";
$result = mysqli_query($connect_db, $sql);
if (mysqli_num_rows($result) === 0) {
    header('location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="css_customers/sign_in.css">
    <link rel="stylesheet" href="css_customers/notification.css">
</head>

<body>
    <?php include 'notifications.php' ?>
    <div class="form-wrapper">
        <h1>Thay đổi mật khẩu</h1>
        <form action="change_new_password_process.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="new_password" placeholder="Mật khẩu mới"></input>
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Sign In" value="Đổi mật khẩu"></input>
            </div>
            <br>
        </form>
    </div>
</body>

</html>
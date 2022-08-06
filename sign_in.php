<!-- remember sign in  -->
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
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css_customers/sign_in.css">
    <link rel="stylesheet" href="css_customers/notification.css">
    <style>
        .display_error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <h1>Đăng nhập</h1>
        <form action="sign_in_process.php" method="POST">
            <div class="form-item">
                <label for="email"></label>
                <input id="email-input" type="email" name="email" placeholder="Email"></input>
                <span id="email-error" class="display_error"></span>
            </div>
            <div class="form-item">
                <label for="password"></label>
                <input id="password-input" type="password" name="password" placeholder="Mật khẩu"></input>
                <span id="password-error" class="display_error"></span>
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Sign In" value="Đăng nhập" onclick="return validate_form()"></input>
            </div>
            <br>
            <span style='font-family: "Open Sans", sans-serif; font-size: 1em;color: #666;'>
                Ghi nhớ đăng nhập
            </span>
            <input type="checkbox" name="remember">
        </form>
        <div class="form-footer">
            <p><a href="sign_up.php">Đăng ký</a></p>
            <p><a href="forgot_password.php">Quên mật khẩu ?</a></p>
            <br>
            <p><a style="color: purple" href="index.php">Trang chủ</a>
            </p>
        </div>
    </div>

    <script type="text/javascript">
        function validate_form() {
            let check = true;
            let email = document.getElementById('email-input').value;
            if (email.length == 0) {
                document.getElementById('email-error').innerHTML = "Vui lòng nhập email";
                check = false;
            } else {
                document.getElementById('email-error').innerHTML = "";
            }

            let password = document.getElementById('password-input').value;
            if (password.length == 0) {
                document.getElementById('password-error').innerHTML = "Mật khẩu không được để trống";
                check = false;
            } else {
                document.getElementById('password-error').innerHTML = "";
            }


            if (check == false)
                return false;
            return true;
        }

        function wrong_password_or_email() {
            document.getElementById('password-error').innerHTML = "Tên email hoặc mật khẩu sai!";
        }
    </script>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "Tên email hoặc mật khẩu sai!") {
            echo '<script>wrong_password_or_email();</script>';
        }
    }
    ?>
</body>

</html>
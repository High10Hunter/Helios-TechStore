<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css_customers/sign_up.css">
    <link rel="stylesheet" href="css_customers/notification.css">
    <style>
        .display_error {
            color: orange;
        }
    </style>
</head>

<body>
    <?php
    // include 'notifications.php';
    ?>
    <form action="sign_up_process.php" method="post">
        <h1> Đăng ký </h1>
        <fieldset>

            <label for="name">Tên:</label>
            <span id="name-error" class="display_error"></span>
            <input id="name-input" type="text" name="name">

            <label for="email">Email:</label>
            <span id="email-error" class="display_error"></span>
            <input id="email-input" type="email" name="email">

            <label for="password">Password:</label>
            <span id="password-error" class="display_error"></span>
            <input id="password-input" type="password" name="password">

            <label for="birthday">Ngày sinh</label>
            <span id="date-error" class="display_error"></span>
            <input id="date-input" type="date" name="birthday">

            <label for="birthday">Địa chỉ:</label>
            <span id="address-error" class="display_error"></span>
            <textarea id="address-input" name="address"></textarea>

            <label for="phone_number">Số điện thoại:</label>
            <span id="phone-number-error" class="display_error"></span>
            <input id="phone-number-input" type="text" name="phone_number">

        </fieldset>

        <button type="submit" onclick="return validate_form()">Đăng ký</button>
        <p style="text-align:center">
            <a href="index.php" style="color:white; text-decoration:none;
            font-size:large">Trang chủ</a>
        </p>
    </form>

    <script type="text/javascript">
        function validate_form() {
            let check = true;
            let name = document.getElementById('name-input').value;
            if (name.length === 0) {
                document.getElementById('name-error').innerHTML = "Tên không được để trống";
                check = false;
            } else {
                let regex_name = /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹ]*)*$/;
                if (!regex_name.test(name)) {
                    document.getElementById('name-error').innerHTML = "Tên không hợp lệ";
                    check = false;
                } else {
                    document.getElementById('name-error').innerHTML = "";
                }
            }

            let email = document.getElementById('email-input').value;
            if (email.length == 0) {
                document.getElementById('email-error').innerHTML = "Email không được để trống";
                check = false;
            } else {
                document.getElementById('email-error').innerHTML = "";
            }

            let password = document.getElementById('password-input').value;
            if (password.length == 0) {
                document.getElementById('password-error').innerHTML = "Mật khẩu không được để trông";
                check = false;
            } else {
                document.getElementById('password-error').innerHTML = "";
            }

            let birthday = document.getElementById('date-input').value;
            if (birthday.length == 0) {
                document.getElementById('date-error').innerHTML = "Ngày sinh không được để trống";
                check = false;
            } else {
                document.getElementById('date-error').innerHTML = "";
            }

            let address = document.getElementById('address-input').value;
            if (address.length == 0) {
                document.getElementById('address-error').innerHTML = "Địa chỉ không được để trống";
                check = false;
            } else {
                document.getElementById('address-error').innerHTML = "";
            }

            let phone_number = document.getElementById('phone-number-input').value;
            if (phone_number.length == 0) {
                document.getElementById('phone-number-error').innerHTML = "Vui lòng nhập số điện thoại";
                check = false;
            } else {
                document.getElementById('phone-number-error').innerHTML = "";
            }

            if (check == false)
                return false;
            return true;
        }
    </script>
</body>

</html>
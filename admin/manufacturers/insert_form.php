<?php
require '../check_super_admin_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_files/index_interface.css">
    <link rel="stylesheet" href="../css_files/notification.css">
    <link rel="stylesheet" href="../css_files/insert_form_interface.css">
    <link rel="stylesheet" href="sidebar.css">
    <title>Thêm nhà sản xuất</title>
</head>

<body>
    <?php include "../menu.php" ?>
    <div id='center' class="main center">
        <div class="container">
            <form id="contact" action="insert_process.php" method="post" enctype="multipart/form-data">
                <h3>THÊM NHÀ SẢN XUẤT</h3>
                <br>

                <fieldset>
                    <input placeholder="Tên nhà sản xuất" type="text" name="name" tabindex="1" autofocus>
                </fieldset>
                <textarea placeholder="Địa chỉ" name="address"></textarea>
                <fieldset>
                    <input placeholder="Số điện thoại" type="text" name="phone_number" tabindex="3">
                </fieldset>
                <fieldset>
                    <div style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Ảnh</div>
                    <input type="file" style="color: white;" name="image" tabindex="3">
                </fieldset>
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit">THÊM</button>
                </fieldset>
            </form>


        </div>
    </div>
</body>

</html>
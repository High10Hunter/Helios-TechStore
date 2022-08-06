<?php
require '../check_admin_login.php';
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
    <title>Thêm sản phẩm</title>

</head>

<body>
    <?php
    include '../menu.php';
    require '../connectDB.php';
    $sql_manufacturers = "select * from manufacturers";
    $result = mysqli_query($connect_db, $sql_manufacturers);

    $sql_types = "select * from types";
    $result_types = mysqli_query($connect_db, $sql_types);
    ?>

    <div id='center' class="main center">
        <div class="container">
            <form id="contact" action="insert_type_process.php" method="post" enctype="multipart/form-data">
                <h3>THÊM THỂ LOẠI</h3>
                <br>
                <fieldset>
                    <input placeholder="Tên thể loại" type="text" name="type_name" tabindex="1" autofocus>
                </fieldset>
                <fieldset>
                    <button name="submit" type="submit" id="contact-submit">THÊM</button>
                </fieldset>
        </div>
    </div>


</body>

</html>
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
            <form id="contact" action="insert_process.php" method="post" enctype="multipart/form-data">
                <h3>THÊM SẢN PHẨM</h3>
                <br>

                <fieldset>
                    <input placeholder="Tên sản phẩm" type="text" name="product_name" tabindex="1" autofocus>
                </fieldset>
                <fieldset>
                    <div style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Ảnh</div>
                    <input placeholder="Ảnh" type="file" style="color: white;" name="image" tabindex="3">
                </fieldset>
                <textarea placeholder="Mô tả" name="description"></textarea>
                <fieldset>
                    <input placeholder="Giá" type="number" name="price" tabindex="4" style="width:100%; height:55px; font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">
                </fieldset>
                <fieldset>
                    <span style=" color: white;font: 800 25px/20px 'Open Sans' , Helvetica, Arial, sans-serif;">Nhà sản xuất </span>
                    <select name="manufacturer_id" style="	width: 30%;
        font-size: 22px;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">
                        <?php foreach ($result as $each) { ?>
                            <option value=" <?php echo $each['manufacturer_id'] ?>">
                                <?php echo $each['manufacturer_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </fieldset>

                <fieldset>
                    <span style=" color: white;font: 800 25px/20px 'Open Sans' , Helvetica, Arial, sans-serif;">Thể loại </span>
                    <select name="type_id" style="	width: 30%;
        font-size: 22px;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">
                        <?php foreach ($result_types as $each) { ?>
                            <option value=" <?php echo $each['type_id'] ?>">
                                <?php echo $each['type_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </fieldset>

                <fieldset>
                    <button name="submit" type="submit" id="contact-submit">THÊM</button>
                </fieldset>
            </form>


        </div>
    </div>


</body>

</html>
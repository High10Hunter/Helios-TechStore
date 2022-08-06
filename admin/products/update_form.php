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
    <title>Cập nhật sản phẩm</title>

</head>

<body>
    <?php
    include '../menu.php';
    require '../connectDB.php';
    if (empty($_GET['id'])) {
        header('location:index.php?error=Không xác định được mã nhà sản xuất cần sửa');
    }
    $id = $_GET['id'];
    $sql = "select * from products
    where product_id = '$id'";
    $result = mysqli_query($connect_db, $sql);

    $sql = "select * from manufacturers";
    $manufacturers = mysqli_query($connect_db, $sql);

    $sql_types = "select * from types";
    $result_types = mysqli_query($connect_db, $sql_types);

    $num_rows = mysqli_num_rows($result);
    if ($num_rows === 1) {
        $each = mysqli_fetch_array($result);
    ?>
        <div id='center' class="main center">
            <div class="container">
                <form id="contact" action="update_process.php" method="post" enctype="multipart/form-data">
                    <h3>CẬP NHẬT SẢN PHẨM</h3>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $each['product_id'] ?>">
                    <fieldset>
                        <input type="text" name="product_name" value="<?php echo $each['product_name'] ?>" tabindex="1" autofocus>
                    </fieldset>
                    <fieldset>
                        <div style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Ảnh cũ</div>
                        <br>
                        <img height="300px" width="50%" src="products_images/<?php echo $each['image'] ?>">
                    </fieldset>
                    <input type="hidden" name="old_image" value="<?php echo $each['image'] ?>">
                    <fieldset>
                        <div style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Đổi ảnh mới</div>
                        <input placeholder="Ảnh" type="file" style="color: white;" name="new_image" tabindex="3">
                    </fieldset>
                    <span style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Mô tả sản phẩm</span>
                    <textarea name="description"><?php echo $each['description'] ?></textarea>
                    <fieldset>
                        <input value="<?php echo $each['price'] ?>" type="number" name="price" tabindex="4" style="width:100%; height:55px; font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">
                    </fieldset>
                    <fieldset>
                        <span style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Nhà sản xuất </span>
                        <select name="manufacturer_id" style="width: 30%;
        font-size: 22px;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">
                            <?php foreach ($manufacturers as $manufacturer) { ?>
                                <option <?php if ($each['manufacturer_id'] == $manufacturer['manufacturer_id']) { ?> selected <?php } ?> value=" <?php echo $manufacturer['manufacturer_id'] ?>">
                                    <?php echo $manufacturer['manufacturer_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </fieldset>

                    <fieldset>
                        <span style=" color: white;font: 800 25px/20px 'Open Sans' , Helvetica, Arial, sans-serif;">Thể loại </span>
                        <select name="type_id" style="	width: 30%;
        font-size: 22px;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">
                            <?php foreach ($result_types as $type) { ?>
                                <option <?php if ($each['type_id'] == $type['type_id']) { ?> selected <?php } ?> value=" <?php echo $type['type_id'] ?>">
                                    <?php echo $type['type_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </fieldset>

                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit">CẬP NHẬT</button>
                    </fieldset>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <h1>Không tồn tại mã sản phẩm này</h1>
    <?php } ?>

</body>

</html>
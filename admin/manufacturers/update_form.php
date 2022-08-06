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
    <title>Cập nhật nhà sản xuất</title>
</head>

<body>
    <?php
    if (empty($_GET['id'])) {
        header('location:index.php?error=Không xác định được mã nhà sản xuất cần sửa');
    }
    $id = $_GET['id'];
    include "../menu.php";
    require "../connectDB.php";

    $sql = "select * from manufacturers
        where manufacturer_id = '$id'";
    $result = mysqli_query($connect_db, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows === 1) {
        $each = mysqli_fetch_array($result);
    ?>
        <div id='center' class="main center">
            <div class="container">
                <form id="contact" action="update_process.php" method="post" enctype="multipart/form-data">
                    <h3>CẬP NHẬT NHÀ SẢN XUẤT</h3>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $each['manufacturer_id'] ?>">
                    <fieldset>
                        <span style="color: white; font-size:25px">Tên nhà sản xuất</span>
                        <input type="text" name="name" value="<?php echo $each['manufacturer_name'] ?>">
                    </fieldset>
                    <span style="color: white; font-size:25px;">Địa chỉ</span>
                    <textarea placeholder="Địa chỉ" name="address"><?php echo $each['address'] ?></textarea>
                    <fieldset>
                        <span style="color: white; font-size:25px;">Số điện thoạt</span>
                        <input type="text" name="phone_number" value="<?php echo $each['phone_number'] ?>">
                    </fieldset>
                    <fieldset>
                        <div style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Ảnh cũ</div>
                        <br>
                        <img height="300px" width="50%" src="manufacturers_images/<?php echo $each['image'] ?>">
                    </fieldset>
                    <input type="hidden" name="old_image" value="<?php echo $each['image'] ?>">
                    <fieldset>
                        <div style="color: white;font: 800 25px/20px 'Open Sans', Helvetica, Arial, sans-serif;">Đổi ảnh mới</div>
                        <input placeholder="Ảnh" type="file" style="color: white;" name="new_image" tabindex="3">
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit">CẬP NHẬT</button>
                    </fieldset>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <h1>Không tồn tại mã nhà sản xuất này</h1>
    <?php } ?>
</body>

</html>
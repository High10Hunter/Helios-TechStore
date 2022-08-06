<?php require '../check_admin_login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../css_files/orders.css">
</head>

<body>
    <?php
    require '../connectDB.php';
    $order_id = $_GET['order_id'];
    $sql = "select * from 
    orders_products 
    join products
    on orders_products.product_id = products.product_id
    where order_id = '$order_id'";
    $result = mysqli_query($connect_db, $sql);
    $total = 0;
    ?>
    <div class="table-title">
        <h3>Đơn hàng mã <?php echo $order_id ?></h3>
    </div>
    <table class="table-fill">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <?php foreach ($result as $each) { ?>
            <tbody class="table-hover">
                <tr>
                    <td><img src="../products/products_images/<?php echo $each['image'] ?>" style="width: 150px;"></td>
                    <td><?php echo $each['product_name'] ?></td>
                    <td><?php echo $each['price'] ?></td>
                    <td><?php echo $each['quantity'] ?></td>
                    <td>
                        <?php
                        $subtotal = $each['quantity'] * $each['price'];
                        echo $subtotal;
                        $total += $subtotal;
                        ?>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <br>
    <div class="big" style="font-size: 2em;
	font-weight: bold; color:aliceblue;">
        <p style="text-align:center">Tổng tiền: <?php echo $total ?> VNĐ</p>
    </div>
    <br>
    <button style="background: red;">
        <a href="index.php" style="color:aliceblue; text-decoration:none;
        font-size:large">
            << Quay lại </a>
    </button>

</body>

</html>
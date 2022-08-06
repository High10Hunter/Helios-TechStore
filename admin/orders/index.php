<?php require '../check_admin_login.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../css_files/orders.css">
    <link rel="stylesheet" href="sidebar.css">
</head>

<body>
    <?php
    include '../menu.php';

    require '../connectDB.php';
    $sql = "select 
    orders.*,
    customers.customer_name,
    customers.phone_number,
    customers.address
    from orders
    join customers
    on customers.customer_id = orders.customer_id;";
    $result = mysqli_query($connect_db, $sql);
    ?>
    <div id='center' class="main center">
        <div class="table-title">
            <h3 style="color:black;">Đơn hàng</h3>
        </div>
        <table class="table-fill">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Thời gian đặt</th>
                    <th>Thông tin người nhận</th>
                    <th>Thông tin người đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Xem</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <?php foreach ($result as $each) { ?>
                <tbody class="table-hover">
                    <tr>
                        <td><?php echo $each['order_id'] ?></td>
                        <td><?php echo $each['created_at'] ?></td>
                        <td>
                            <?php echo $each['recipient_name'] ?><br>
                            <?php echo $each['recipient_phone_number'] ?><br>
                            <?php echo $each['recipient_address'] ?><br>
                        </td>
                        <td>
                            <?php echo $each['customer_name'] ?><br>
                            <?php echo $each['phone_number'] ?><br>
                            <?php echo $each['address'] ?><br>
                        </td>
                        <td>
                            <?php
                            switch ($each['status']) {
                                case '0':
                                    echo "Mới đặt";
                                    break;
                                case '1':
                                    echo "Đã duyệt";
                                    break;
                                case '2':
                                    echo "Đã huỷ";
                                    break;
                            }
                            ?>
                        </td>
                        <td><?php echo $each['total_price'] ?></td>
                        <td>
                            <a href="order_detail.php?order_id=<?php echo $each['order_id'] ?>">
                                <button class="view" style="background:cadetblue; color:cornsilk; border:none">Xem đơn</button>
                            </a>
                        </td>
                        <td>
                            <?php if ($each['status'] == 0) { ?>
                                <a href="update_order.php?order_id=<?php echo $each['order_id'] ?>&status=1">
                                    <button style="background:cornflowerblue; color:cornsilk; border:none">Duyệt đơn</button>
                                </a>
                            <?php } ?>
                            <br>
                            <?php if ($each['status'] == 0) { ?>
                                <a href="update_order.php?order_id=<?php echo $each['order_id'] ?>&status=2">
                                    <button style="background:crimson; color:cornsilk; border:none">Huỷ đơn</button>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>

</body>

</html>
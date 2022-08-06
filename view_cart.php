<?php
session_start();
if (empty($_SESSION['cart'])) {
    header('location:error_page.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="css_customers/cart.css">
    <link rel="stylesheet" href="css_customers/notification.css">
    <link rel="stylesheet" href="css_customers/recipient_info.css">
    <style>
        a {
            color: white;
            text-decoration: none;
        }

        a:active {
            color: rgb(157, 214, 157);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    $cart = $_SESSION['cart'];
    $total = 0;
    ?>
    <?php include 'notifications.php' ?>
    <p style="text-align: center; font-size:65px">
        Giỏ hàng
    </p>
    <div id="container">
        <table>
            <tr style="text-align:center;">
                <td></td>
                <td>Tên sản phẩm</td>
                <td>Giá</td>
                <td>Số lượng</td>
                <td>Thành tiền</td>
                <td> </td>
            </tr>
            <?php foreach ($cart as $id => $each) { ?>
                <tr class="p">
                    <td class="image"><img src="admin/products/products_images/<?php echo $each['image'] ?>" /></td>
                    <td class="name"><?php echo $each['product_name'] ?></td>
                    <td>
                        <span class="span-price">
                            <?php echo $each['price'] ?>
                        </span>
                    </td>
                    <td>
                        <button class="update-quantity-btn" style="display:contents; color:white" data-id="<?php echo $id ?>" data-type="decrease">
                            -
                        </button>
                        <!-- <a href="update_quantity_in_cart.php?id=<?php echo $id ?>&type=decrease">
                            -
                        </a> -->
                        <span class="span-quantity">
                            <?php echo $each['quantity'] ?>
                        </span>
                        <button class="update-quantity-btn" style="display:contents; color:white" data-id="<?php echo $id ?>" data-type="increase">
                            +
                        </button>
                        <!-- <a href="update_quantity_in_cart.php?id=<?php echo $id ?>&type=increase">
                            +
                        </a> -->
                    </td>
                    <td>
                        <span class="span-priceSubTotal">
                            <?php
                            $subtotal = $each['price'] * $each['quantity'];
                            $total += $subtotal;
                            echo $subtotal;
                            ?>
                        </span>
                    </td>
                    <td class="remove">
                        <div>
                            <!-- <a href="delete_from_cart.php?id=<?php echo $id ?>">
                                &times
                            </a> -->
                            <button style="display:contents; color:white" data-id="<?php echo $id ?>" class="delete-btn">
                                &times
                            </button>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td style="border-top:1px solid white" colspan="6"><br />
                </td>
            </tr>
        </table>
        <span class="big">Tổng tiền:
            <span id="realTotal">
                <?php echo $total ?> VNĐ
            </span>
        </span>

        <?php
        $id = $_SESSION['customer_id'];
        require 'admin/connectDB.php';
        $sql = "select * from customers 
        where customer_id = '$id'";
        $result = mysqli_query($connect_db, $sql);
        $each = mysqli_fetch_array($result);
        ?>

        <div class="container">
            <form id="contact" action="checkout_process.php" method="post">
                <h3>Thông tin người nhận</h3>
                <h4></h4>
                <fieldset>
                    <input placeholder="Tên người nhận" type="text" tabindex="1" name="recipient_name" value="<?php echo $each['customer_name'] ?>" required>
                </fieldset>
                <fieldset>
                    <input placeholder="Số điện thoại người nhận" type="text" name="recipient_phone_number" value="<?php echo $each['phone_number'] ?>" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <textarea placeholder="Địa chỉ người nhận" name="recipient_address" tabindex="5" required><?php echo $each['address'] ?></textarea>
                </fieldset>
                <button type="submit" style="background-color: #34373e;height:fit-content; width:fit-content">
                    <div id="checkout">
                        Đặt hàng
                        <span> &rarr;</span>
                    </div>
                </button>
            </form>
        </div>

        <br>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="notify.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.update-quantity-btn').click(function() {
                let btn = $(this);
                let id = btn.data('id');
                let type = btn.data('type');
                $.ajax({
                    type: "GET",
                    url: "update_quantity_in_cart.php",
                    data: {
                        id,
                        type
                    },
                    success: function(response) {
                        if (response == 1) {
                            let parent_tr = btn.parents('tr');
                            let price = parent_tr.find('.span-price').text();
                            price = parseFloat(price);
                            let quantity = parent_tr.find('.span-quantity').text();
                            quantity = parseInt(quantity);

                            if (type === "increase")
                                ++quantity;
                            else {
                                --quantity;
                            }
                            if (quantity === 0) {
                                parent_tr.remove();
                            } else {
                                parent_tr.find('.span-quantity').text(quantity);
                                let subTotal = price * quantity;
                                parent_tr.find('.span-priceSubTotal').text(subTotal);
                            }
                            getTotal();
                        } else {
                            $.notify(response, "error");
                        }
                    }
                });
            })

            $('.delete-btn').click(function() {
                let btn = $(this);
                let id = btn.data('id');
                $.ajax({
                    type: "GET",
                    url: "delete_from_cart.php",
                    data: {
                        id
                    },
                    success: function(response) {
                        btn.parents('tr').remove();
                        getTotal();
                    }
                });
            })
        });

        function getTotal() {
            let total = 0;
            $('.span-priceSubTotal').each(function() {
                total += parseFloat($(this).text());
            });
            $('#realTotal').text(total);
        }
    </script>

    <a href="user.php">
        << Quay lại trang chủ </a>
</body>

</html>
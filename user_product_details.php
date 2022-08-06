<?php
session_start();
if (empty($_SESSION['customer_id'])) {
    header('location:index.php?error=Vui lòng đăng nhập hoặc đăng ký!!');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css_customers/menu.css">
    <link rel="stylesheet" href="css_customers/products_view.css">
    <link rel="stylesheet" href="css_customers/footer.css">
    <link rel="stylesheet" href="css_customers/details.css">
    <link rel="stylesheet" href="css_customers/notification.css">
    <link rel="stylesheet" href="css_customers/comment_thread.css">
    <link rel="stylesheet" href="css_customers/rating.css">
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" id="bootstrap-css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>

<body>
    <div id="general">
        <?php include 'user_menu.php' ?>
        <?php include 'details.php' ?>
        <?php include 'footer.php' ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="notify.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart-btn').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "add_to_cart.php",
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response == 1) {
                            $.notify("Đã thêm sản phẩm vào giỏ hàng", "success");
                        } else {
                            $.notify(response, "error");
                        }
                    }
                });
            })
        });
    </script>
</body>

</html>
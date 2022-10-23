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
    <link rel="stylesheet" href="css_customers/pagination.css">
    <link rel="stylesheet" href="css_customers/search_bar.css">
    <link rel="stylesheet" href="css_customers/notification.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
    body {
        background-image: url(https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2F736x%2Fc9%2F97%2Ffb%2Fc997fbe0495afdc0004077a42c97f814.jpg&f=1&nofb=1);
    }
</style>

<body>
    <div id="general">
        <?php include 'user_menu.php' ?>
        <?php include 'user_products_view.php' ?>
        <?php include 'footer.php' ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="notify.js"></script>
    <script type="text/javascript">
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };

        $(document).ready(function() {
            let success = getUrlParameter('success');
            if (success) {
                $.notify(success, "success");
            }

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
                    },
                });
            })
        });
    </script>
</body>

</html>
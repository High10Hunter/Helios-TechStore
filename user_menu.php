<div class="menu">
    <ul class="horizontal-menu">
        <span class="heading"> Helios TechShop </span>
        <li> <a href="user.php" style="font-size: 15px;">Trang chủ</a></li>
        <li><span style="font-size: 20px; color:white; font-family: sans-serif;">
                Xin chào, <?php echo $_SESSION['customer_name'] ?> !
            </span></li>
        <li> <a href="view_cart.php" style="color:azure; font-size:15px;font-family: sans-serif;">
                <i>
                    Xem giỏ hàng
                </i>
            </a></li>
        <li> <a href="sign_out.php" class="login"> Đăng xuất </a> </li>

    </ul>
</div>
<?php
if (isset($_GET['error'])) {
?>
    <div class="error-msg" style="text-align:center">
        <?php echo $_GET['error'] ?>
    </div>
<?php
}
?>

<?php
if (isset($_GET['success'])) {
?>
    <div class="success-msg" style="text-align:center">
        <?php echo $_GET['success'] ?>
    </div>
<?php
}
?>

<div class="header"></div>
<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
<label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
</label>
<div id="sidebarMenu">
    <ul class="sidebarMenuInner">
        <a href="../root/index.php" style="text-decoration:none">
            <li>
                Helios Techshop
                <span>Công ty công nghệ tin học</span>
            </li>
        </a>
        <li>
            <a href="../manufacturers">
                Quản lý nhà sản xuất
            </a>
        </li>
        <li>
            <a href="../products">
                Quản lý sản phẩm
            </a>
        </li>
        <li>
            <a href="../orders">
                Quản lý đơn hàng
            </a>
        </li>
        <li>
            <a href="../sign_out.php">
                Đăng xuất
            </a>
        </li>
    </ul>
</div>
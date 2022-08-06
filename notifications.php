<?php
if (isset($_GET['error'])) {
?>
    <div class="error-msg">
        <?php echo $_GET['error'] ?>
    </div>
<?php
}
?>

<?php
if (isset($_GET['success'])) {
?>
    <div class="success-msg">
        <?php echo $_GET['success'] ?>
    </div>
<?php
}
?>
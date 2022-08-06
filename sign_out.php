<?php

session_start();
unset($_SESSION['customer_id']);
unset($_SESSION['customer_name']);

setcookie("remember_signin", null, -1);

header('location:index.php');
exit;

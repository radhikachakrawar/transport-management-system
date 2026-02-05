<?php
session_start();

unset($_SESSION['admin_loggedin']);
unset($_SESSION['admin_id']);
unset($_SESSION['admin_username']);

session_destroy();

header("Location: admins/login.php");
exit();

<?php
session_start();

unset($_SESSION['admin_id']);
unset($_SESSION['admin_email']);
unset($_SESSION['admin_username']);

// Redirect the user to the login page
header("location: login.php");
exit();
?>

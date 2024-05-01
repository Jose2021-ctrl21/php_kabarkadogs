<?php
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['email']);
unset($_SESSION['username']);

// Redirect the user to the login page
header("location: login.php");
exit();
?>

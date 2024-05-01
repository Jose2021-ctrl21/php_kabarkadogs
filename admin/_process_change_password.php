<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $adminId = $_SESSION['admin_id']; 

    $checkPasswordQuery = "SELECT admin_password FROM admin WHERE id = $adminId";
    $result = $conn->query($checkPasswordQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $currentPassword = $row['admin_password'];

        if ($oldPassword == $currentPassword) {

            if ($newPassword != $confirmPassword) {
                $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>New password and confirm password do not match.</div>";
                header("Location: settings.php");
            } else {

                $updatePasswordQuery = "UPDATE admin SET admin_password = '$newPassword' WHERE id = $adminId";
                if ($conn->query($updatePasswordQuery)) {
                    $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Password changed successfully.</div>";
                    header("Location: settings.php");
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Password change failed. Please try again later.</div>";
                    header("Location: settings.php");
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Old password is incorrect.</div>";
            header("Location: settings.php");
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>User not found.</div>";
        header("Location: settings.php");
    }

$conn->close();
}
?>
<?php
session_start();
require('../php/connect.php');

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $deleteSql = "DELETE FROM recommendation WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        $_SESSION['message'] = "Recommendation deleted successfully!".$id;
    } else {
        $_SESSION['message'] = "Error deleting Profile: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
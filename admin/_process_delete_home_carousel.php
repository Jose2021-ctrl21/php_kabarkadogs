<?php
session_start();
require('../php/connect.php');

if (isset($_POST['carouselId'])) {
    $carouselId = $_POST['carouselId'];
    $deleteSql = "DELETE FROM home_carousel WHERE id = $carouselId";
    $deleteResult = mysqli_query($conn, $deleteSql);
    if ($deleteResult) {
        $_SESSION['message'] = "Image deleted successfully!".$carouselId;
    } else {
        $_SESSION['message'] = "Error deleting Image: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
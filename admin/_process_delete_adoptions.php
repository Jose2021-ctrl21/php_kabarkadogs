<?php
session_start();
require('../php/connect.php');

if (isset($_POST['adoptionId'])) {
    $adoptionId = $_POST['adoptionId'];

    // Perform the SQL query to delete the booking based on $adoptionId
    $deleteSql = "DELETE FROM adoptions WHERE id = '$adoptionId'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        // Booking deleted successfully
        echo "Booking deleted successfully!";
    } else {
        // Error deleting booking
        echo "Error deleting booking: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
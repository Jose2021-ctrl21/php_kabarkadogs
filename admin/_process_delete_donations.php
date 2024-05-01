<?php
session_start();
require('../php/connect.php');

if (isset($_POST['donationId'])) {
    $donationId = $_POST['donationId'];

    // Perform the SQL query to delete the booking based on $donationId
    $deleteSql = "DELETE FROM donations WHERE id = '$donationId'";
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
<?php
session_start();
require('../php/connect.php');

if (isset($_POST['bookingId'])) {
    $bookingId = $_POST['bookingId'];

    // Perform the SQL query to delete the booking based on $bookingId
    $deleteSql = "DELETE FROM bookings WHERE id = '$bookingId'";
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
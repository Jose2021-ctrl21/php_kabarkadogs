<?php
session_start();
require('../php/connect.php');

if (isset($_POST['animalId'])) {
    $animalId = $_POST['animalId'];

    // Perform the SQL query to delete the booking based on $animalId
    $deleteSql = "DELETE FROM deceased WHERE id = '$animalId'";
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
<?php
session_start();
require('../php/connect.php');

if (isset($_POST['adoptionStoryId'])) {
    $adoptionStoryId = $_POST['adoptionStoryId'];

    // Perform the SQL query to delete the booking based on $adoptionStoryId
    $deleteSql = "DELETE FROM adoption_stories_settings WHERE id = $adoptionStoryId";
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
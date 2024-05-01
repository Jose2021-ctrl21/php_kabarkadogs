<?php
session_start();
require('../php/connect.php');

if (isset($_POST['animalId'])) {
    $animalId = $_POST['animalId'];
    $archive_yes = "yes";
    // Perform the SQL query to update the booking based on $animalId
    $updatesqsl = "UPDATE animals SET archive = '$archive_yes' WHERE id='$animalId'";
    $updateResult = mysqli_query($conn, $updatesqsl);

    if ($updateResult) {
        // Booking updated successfully
        echo "Information is now on archive";
    } else {
        // Error deleting booking
        echo "Error archiving booking: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
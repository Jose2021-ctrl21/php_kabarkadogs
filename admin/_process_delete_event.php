<?php
session_start();
require('../php/connect.php');

if (isset($_POST['eventId'])) {
    $eventId = $_POST['eventId'];
    $deleteSql = "DELETE FROM events WHERE id = $eventId";
    $deleteResult = mysqli_query($conn, $deleteSql);
    if ($deleteResult) {
        $_SESSION['message'] = "Event deleted successfully!".$eventId;
    } else {
        $_SESSION['message'] = "Error deleting Event: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
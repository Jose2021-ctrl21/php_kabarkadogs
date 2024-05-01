<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['bookingId'];
    $selectedStatusId = $_POST['selectedStatusId'];

    // Validate the input
    if (!is_numeric($bookingId) || !is_numeric($selectedStatusId)) {
        $response['status'] = "error";
        $response['message'] = "Invalid input.";
    } else {
        // Update the status in the database
        $updateSql = "UPDATE bookings SET status_id = $selectedStatusId WHERE id = $bookingId";
        
        if (mysqli_query($conn, $updateSql)) {
            // Include email sending logic
            include "email_for_booking.php";
        } else {
            // Error updating status
            $response['status'] = "error";
            $response['message'] = "Error updating status: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid request";
}

// Send response as JSON
echo json_encode($response);
?>

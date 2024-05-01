<?php
require('../php/connect.php');

$date = date("Y-m-d");
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adoptionId = $_POST['adoptionId'];
    $selectedStatusId = $_POST['selectedStatusId'];
    $userId = $_POST['userId'];

    // Validate the input
    if (!is_numeric($adoptionId) || !is_numeric($selectedStatusId)) {
        $response['status'] = "error";
        $response['message'] = "Invalid input.";
    } else {
        // Update the status in the database
        $updateSql = "UPDATE adoptions SET status_id = $selectedStatusId WHERE id = $adoptionId";
        
        $sql2 = "INSERT INTO notifications (
            user_id, title, description, is_read, created_at
        ) VALUES (
            '$userId', 'Adoption Status', 'your adoption status changed to " . 
            ($selectedStatusId == 1 ? 'Pending' : ($selectedStatusId == 2 ? 'Approved' : ($selectedStatusId == 4 ? "Failed" : ''))) . 
            "', 0, '$date'
        )";
        
        if (mysqli_query($conn, $updateSql) && mysqli_query($conn, $sql2)) {
            //Include email file
            include "email_for_adoption.php";
        } else {
            $response['status'] = "error";
            $response['message'] = "Error updating status: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid request.";
}

// Send response as JSON
echo json_encode($response);
?>

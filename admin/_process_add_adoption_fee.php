<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required POST parameters are set
    if (isset($_POST['listItem'], $_POST['id'])) {
        $listInput = $_POST['listItem'];
        $adoptionFeeId = $_POST['id'];

        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO lists (description, adoption_fee_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $listInput, $adoptionFeeId);

        if ($stmt->execute()) {
            // Successful insertion
             $_SESSION['message'] = "Data inserted successfully: $listInput, $adoptionFeeId";
        } else {
            // Error in SQL query execution
            $result = "Error: " . $stmt->error;
            $_SESSION['message'] = $result;
        }
        $stmt->close();
    } else {
        // Required parameters not set
        $result = "Error: Required parameters are not set.";
    }

    $conn->close();
} else {
    // header('Location: setting_our_pet');
}
?>

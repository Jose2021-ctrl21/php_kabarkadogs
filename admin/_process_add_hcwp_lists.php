<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required POST parameters are set
    if (isset($_POST['listItem'], $_POST['id'])) {
        $listInput = $_POST['listItem'];
        $hcwpId = $_POST['id'];

        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO lists (description, how_can_we_help_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $listInput, $hcwpId);

        if ($stmt->execute()) {
            // Successful insertion
             $_SESSION['message'] = "Data inserted successfully: $listInput, $hcwpId";
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

<?php
require('../php/connect.php');

// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);

$result = ''; // Initialize result variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editId = $_POST["edit-id"];
    $editRepublic = $_POST["edit-republic"];
    $editTitle = $_POST["edit-title"];
    $editSubtitle = $_POST["edit-subtitle"];

    $sql = "UPDATE policy SET republic_act = ?, title = ?, subtitle = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $editRepublic, $editTitle, $editSubtitle, $editId); // Corrected the data types
    
    if ($stmt->execute()) {
        var_dump($stmt);
        // Redirect to the edit page with the event ID
        header("Location: setting_policies.php");
        exit(); // It's good practice to exit after a header redirect
    } else {
        $result = "Error: " . $stmt->error;
    }
    $stmt->close();
}
echo $result; // Output the result after the innermost if block
?>

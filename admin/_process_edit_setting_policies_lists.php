<?php
session_start();
require('../php/connect.php');
// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);

$result = ''; // Initialize result variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editList = $_POST["edit-list"];
    $editListId = $_POST["edit-list-id"];

    $sql = "UPDATE lists SET description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $editList, $editListId); // Corrected the data types
    
    if ($stmt->execute()) {
        var_dump($stmt);
        // Redirect to the edit page with the event ID
        header("Location: setting_policies_lists.php?id=". $_SESSION['id']);
        exit(); // It's good practice to exit after a header redirect
    } else {
        $result = "Error: " . $stmt->error;
    }
    $stmt->close();
}
echo $result; // Output the result after the innermost if block
?>

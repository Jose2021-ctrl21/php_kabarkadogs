<?php
require('../php/connect.php');

// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);

$result = ''; // Initialize result variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editSmallTitle = $_POST['small-title'];
    $editTitle = $_POST['title'];
    $editDescription = $_POST['description'];
    $editMapName = $_POST['map-name'];
    $editMapLink = $_POST['map-link'];
    $recommendationId = $_POST['recommendation_id'];

    $sql = "UPDATE recommendation SET small_title = ?, title = ?, description = ?, map_name = ?, map_link = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $editSmallTitle, $editTitle, $editDescription, $editMapName, $editMapLink, $recommendationId); // Corrected the data types
    
    if ($stmt->execute()) {
        var_dump($stmt);
        // Redirect to the edit page with the event ID
        header("Location: setting_recommendation.php");
        exit(); // It's good practice to exit after a header redirect
    } else {
        $result = "Error: " . $stmt->error;
    }
    $stmt->close();
}

echo $result; // Output the result after the innermost if block
?>

<?php
require('../php/connect.php');

// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);

$result = ''; // Initialize result variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $infoId = $_POST["infoId"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $date = $_POST["date-established"];

    $sql = "UPDATE profile_setting SET name = ?, position = ?, date_established = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $position, $date, $infoId); // Corrected the data types
    
    if ($stmt->execute()) {
        var_dump($stmt);
        // Redirect to the edit page with the event ID
        header("Location: setting_profile.php");
        exit(); // It's good practice to exit after a header redirect
    } else {
        $result = "Error: " . $stmt->error;
    }
    $stmt->close();
}

echo $result; // Output the result after the innermost if block
?>

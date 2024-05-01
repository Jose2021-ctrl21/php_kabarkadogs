<?php
session_start();
require('../php/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Get the carousel image ID from the AJAX request
    $id = $_POST["id"];
    
    // Construct SQL query to select data from home_carousel table based on the received ID
    $sql = "SELECT * FROM profile_setting WHERE id = $id";
    
    // Execute the SQL query
    $query = mysqli_query($conn, $sql);
    
    // Check if the query was successful
    if ($query) {
        // Fetch the result row as an associative array
        $profileData = mysqli_fetch_assoc($query);
        
        // Now you have the data related to the carousel image, you can process it as needed
        // For example, you might want to send this data back to the JavaScript code
        
        // Convert the data to JSON format for sending back to JavaScript
        $jsonData = json_encode($profileData);
        
        // Send the JSON response back to JavaScript
        echo $jsonData;
    } else {
        // If there was an error with the query, you can send an error message back
        echo "Error retrieving profile data for ID: " . $id;
    }
}
?>

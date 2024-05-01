<?php
session_start();
require('../php/connect.php');
// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);

$result = ''; // Initialize result variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['submit'])){
        $editQuestion = $_POST["edit-question"];
        $editAnswer = $_POST["edit-answer"];
        $qaId = $_POST["qa-id"];

        $sql = "UPDATE qa_lists SET question = ?, answer = ?  WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $editQuestion, $editAnswer, $qaId); // Corrected the data types
        
        if ($stmt->execute()) {
            var_dump($stmt);
            $_SESSION['message'] = "Updated successfully";
            // Redirect to the edit page with the event ID
            header("Location: setting_faqs.php");
            exit(); // It's good practice to exit after a header redirect
        } else {
            $result = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $result = "Error: 'submit' parameter not set.";
    }
}

echo $result; // Output the result after the innermost if block
$_SESSION['message'] = $result;
?>

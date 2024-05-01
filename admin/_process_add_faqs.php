<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qaId = $_POST['qa-id'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO qa_lists (question, answer, qa_id) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the placeholders
    $stmt->bind_param("sss", $question, $answer, $qaId);

    // Execute the statement
    if ($stmt->execute()) {
        $result = "Added successfully";
        $_SESSION['message'] = $result;
        header('Location: setting_faqs.php');
        exit(); // Make sure to exit after redirection
    } else {
        // Error handling if the execution fails
        $result = "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
    $conn->close();
} else {
    // Redirect if the request method is not POST
    $result = "Error: " . $stmt->error;
    $_SESSION['message'] = $result;
    header('Location: setting_faqs.php');
    exit(); // Make sure to exit after redirection
}

?>

<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file upload separately
    $fileTmpPath = $_FILES['accountImg']['tmp_name'];
    $fileName = $_FILES['accountImg']['name'];
    $fileSize = $_FILES['accountImg']['size'];
    $fileType = $_FILES['accountImg']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Create a unique filename to prevent overwriting existing files
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    
    // Define the upload directory
    $uploadDir = '../uploads/';

    // Construct the full path of the uploaded file on the server
    $destPath = $uploadDir . $newFileName;

    // Move the uploaded file to the desired location
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // File upload successful, continue with the database update
        $accountImg = $newFileName;
        $accountName = $_POST['account-name'];
        $instructions = $_POST['instructions'];
        $configId = $_POST['configId'];

        // Prepare and bind parameters to prevent SQL injection
        $sql = "UPDATE donation_setting SET
                account_img = ?,
                account_name = ?,
                instructions = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $accountImg, $accountName, $instructions, $configId);

        if ($stmt->execute()) {
            // Redirect to the edit page upon successful update
            header('Location: donations-edit-config.php');
            exit(); // Exit to prevent further execution
        } else {
            $result = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // File upload failed, handle the error
        $result = "Error uploading file.";
    }
} else {
    // If the request method is not POST, redirect to the edit page
    header('Location: donations-edit-config.php');
    exit(); // Exit to prevent further execution
}
?>

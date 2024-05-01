<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accountImg = basename($_FILES["accountImg"]["name"]);
    $accountName = $_POST['account-name'];
    $instructions = $_POST['instructions'];

    if (isset($_FILES["accountImg"]) && $_FILES["accountImg"]["error"] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["accountImg"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["accountImg"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (optional)
            if ($_FILES["accountImg"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["accountImg"]["tmp_name"], $target_file)) {
                        // Prepare the SQL statement
                        $sql = "INSERT INTO donation_setting (account_img, account_name, instructions) 
                                VALUES (?, ?, ?)";
                    
                        // Prepare the statement
                        $stmt = $conn->prepare($sql);

                        // Bind parameters
                        $stmt->bind_param("sss", $accountImg, $accountName, $instructions);

                        // Execute the statement
                        if ($stmt->execute()) {
                            // Insertion successful
                            $result = "Added account successfully!";
                            header('Location: donation-config.php?success=' . urlencode($result));
                            exit(); // Exit to prevent further execution
                        } else {
                            // Error occurred
                            $result = "Error: " . $stmt->error;
                        }

                        // Close the statement
                        $stmt->close();
                    } else {
                        $result = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $result = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                }
            }
        } else {
            $result = "The uploaded file is not an image.";
        }
    } else {
        $result = "No file was uploaded.";
    }

    $conn->close();
} else {
    header('Location: donation-config-add.php');
    exit(); // Exit to prevent further execution
}
?>

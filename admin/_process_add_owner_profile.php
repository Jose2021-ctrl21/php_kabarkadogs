<?php
session_start();
require('../php/connect.php');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = $_POST['name'];
    $position = $_POST['position'];
    $dateStablished = $_POST['date-established'];

    if (isset($_FILES["owner-image"]) && $_FILES["owner-image"]["error"] == 0) {
        $target_dir = "../uploads/";
        $img = basename($_FILES["owner-image"]["name"]);
        $target_file = $target_dir . $img;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["owner-image"]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES["owner-image"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["owner-image"]["tmp_name"], $target_file)) {
                        // Prepare the SQL statement with placeholders
                        $sql = "INSERT INTO profile_setting (img, name, position, date_established) 
                                VALUES (?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssss", $img, $name, $position, $dateStablished);
                        
                        if ($stmt->execute()) {
                            $result = "You have added successfully";
                        } else {
                            $result = "Error: " . $stmt->error;
                            var_dump($result);
                        }
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

    // Close the connection
    $conn->close();
} else {
    $_SESSION['message'] =  $result;
    header('Location: setting_profile.php');
}
$_SESSION['message'] =  $result;
header('Location: setting_profile.php');
?>

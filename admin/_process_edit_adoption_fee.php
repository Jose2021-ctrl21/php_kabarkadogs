<?php
session_start();
require('../php/connect.php');

// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = ''; // Initialize result variable
    $eventImage = "";
    $id = $_POST['id']; 
    $title = $_POST['title'];
    $titleDescription = $_POST['title-description'];
    $subtitle = $_POST['subtitle'];
    // Check if a new image is uploaded
    if (!empty($_FILES["eventImage"]["name"])) {
        $eventImage = basename($_FILES["eventImage"]["name"]);
        // Move the uploaded file to the desired location
        $target_dir = "../uploads/";
        $target_file = $target_dir . $eventImage;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if the file is an actual image
        $check = getimagesize($_FILES["eventImage"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (optional)
            if ($_FILES["eventImage"]["size"] > 5000000) { // Adjust the maximum file size as needed
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["eventImage"]["tmp_name"], $target_file)) {
                        // Image uploaded successfully, update the database with the new image information
                        $sql = "UPDATE adoption_fee SET
                                img = ?,
                                title = ?,
                                title_description = ?,
                                subtitle = ?
                                WHERE id = ?";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssi", $eventImage, $title, $titleDescription, $subtitle, $id);
                        
                        if ($stmt->execute()) {
                            // Redirect to the edit page with the event ID
                            $_SESSION['message'] = "Update successful";
                            header("Location: setting_adoption_fee.php");
                            exit(); // It's good practice to exit after a header redirect
                        } else {
                            $result = "Error: " . $stmt->error;
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
        // No new image uploaded, use the existing image filename
        $eventImage = $_POST['existing-image'];
        
        // Update the database with the existing image filename and other details
        $sql = "UPDATE adoption_fee SET
        img = ?,
        title = ?,
        title_description = ?,
        subtitle = ?
        WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $eventImage, $title, $titleDescription, $subtitle, $id);
        
        if ($stmt->execute()) {
            // Redirect to the edit page with the event ID
            $_SESSION['message'] = "Update successful";
            ;
            header("Location: setting_adoption_fee.php");
            exit(); // It's good practice to exit after a header redirect
        } else {
            $result = "Error: " . $stmt->error;
            $_SESSION['message'] = $result;
        }
        $stmt->close();
    }
    echo $result;
    $_SESSION['message'] = $result;
}
?>

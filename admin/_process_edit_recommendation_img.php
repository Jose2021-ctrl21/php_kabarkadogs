<?php
require('../php/connect.php');

// Use error_reporting(E_ALL); for better error reporting during development
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = ''; // Initialize result variable
    $img = "";
    $image_id = $_POST['image_id'];
    // Check if a new image is uploaded
    // var_dump(isset($_FILES["img"]));
    if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
        $img = basename($_FILES["img"]["name"]);
        // Move the uploaded file to the desired location
        $target_dir = "../uploads/";
        $target_file = $target_dir . $img;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (optional)
            if ($_FILES["img"]["size"] > 5000000) { // Adjust the maximum file size as needed
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        // Image uploaded successfully, update the database with the new image information
                        $sql = "UPDATE recommendation SET img = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("si", $img, $image_id); // Corrected the data types
                        
                        if ($stmt->execute()) {
                            // Redirect to the edit page with the event ID
                            header("Location: setting_recommendation.php");
                            exit();
                             // It's good practice to exit after a header redirect
                             echo $result;
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
    } 
    echo $result; // Output the result after the innermost if block
}
?>

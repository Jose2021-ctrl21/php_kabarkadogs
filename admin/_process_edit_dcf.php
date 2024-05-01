<?php
session_start();
require('../php/connect.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both update-dcf and eventImage are present
    if (isset($_POST["update"])) {
        $id = 1;
        $img = "";
        // Get other form data
        $donate = $_POST['donate'];
        $costs = $_POST['costs'];
        $funding = $_POST['funding'];

        // Check if file has been uploaded and if it's not empty
        if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] !== UPLOAD_ERR_NO_FILE && $_FILES['eventImage']['size'] > 0) {
            // File is uploaded and not empty
            $img = basename($_FILES['eventImage']['name']);
            // Set the target directory for uploading the file
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["eventImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the uploaded file is an actual image
        $check = getimagesize($_FILES["eventImage"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (optional)
            if ($_FILES["eventImage"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["eventImage"]["tmp_name"], $target_file)) {
                        // Prepare and execute the SQL update statement
                        $sql = "UPDATE dcf SET img = ?, donate = ?, costs = ? ,funding = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssi", $img, $donate, $costs, $funding, $id);
                        if ($stmt->execute()) {
                            $result = "You have successfully updated dcf.";
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
            // File is empty or not selected
            // Use the existing image name
            $existingImage = $_POST['existing-image'];
            $sql = "UPDATE dcf SET img = ?, donate = ?, costs = ? ,funding = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $existingImage, $donate, $costs, $funding, $id);
            if ($stmt->execute()) {
                $result = "You have successfully updated dcf.";
            } else {
                $result = "Error: " . $stmt->error;
            }
            $stmt->close();
        }

    } else {
        $result = "Both update-dcf and eventImage are required.";
    }
    // header("Location: animals-home-dcf.php");
} else {
    $result = "Invalid request.";
}
$_SESSION['message'] = $result; // Output the result
header("Location: about-us-dcf.php");

?>

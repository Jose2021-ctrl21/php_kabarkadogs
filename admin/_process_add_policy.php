<?php
error_reporting(0);
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $addImg = $_POST['add-img'];
    $addRepublic = $_POST['add-republic'];
    $addTitle = $_POST['add-title'];
    $addSubtitle = $_POST['add-subtitle'];
    $currentDate = date('Y-m-d'); 

    if (isset($_FILES["add-img"]) && $_FILES["add-img"]["error"] == 0) {
        $target_dir = "../uploads/";
        $img = basename($_FILES["add-img"]["name"]);
        $target_file = $target_dir . $img;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["add-img"]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES["add-img"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["add-img"]["tmp_name"], $target_file)) {
                        // Prepare the SQL statement with placeholders
                        $sql = "INSERT INTO policy (img, republic_act, title, subtitle, date) 
                          VALUES (?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssss", $img, $addRepublic, $addTitle, $addSubtitle, $currentDate);
                        
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
    header('Location: setting_policies.php');

} else {
    header('Location: setting_policies.php');
}

?>

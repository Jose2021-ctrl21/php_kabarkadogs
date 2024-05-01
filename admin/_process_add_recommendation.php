<?php
error_reporting(0);
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $addImg = $_POST['img'];
    $img = $_POST['img'];
    $smallTitle = $_POST['small-title'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $mapName = $_POST['map-name'];
    $mapLink = $_POST['map-link'];

    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
        $target_dir = "../uploads/";
        $img = basename($_FILES["img"]["name"]);
        $target_file = $target_dir . $img;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES["img"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        // Prepare the SQL statement with placeholders
                        $sql = "INSERT INTO recommendation (img, small_title, title, description, map_name, map_link) 
                          VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssss", $img, $smallTitle, $title, $description, $mapName, $mapLink);
                        
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
    header('Location: setting_recommendation.php');

} else {
    header('Location: setting_recommendation.php');
}

?>

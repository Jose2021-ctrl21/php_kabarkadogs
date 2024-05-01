<?php
session_start();
require('../php/connect.php');

if(isset($_POST['add'])){
    $img = basename($_FILES['img']['name']);
    $addHeading = $_POST['add-heading'];
    $addCaption = $_POST['add-caption'];
    
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (optional)
            if ($_FILES["img"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $sql = "INSERT INTO home_carousel (img, heading, caption) 
                        VALUES ('$img','$addHeading','$addCaption')";
                    
                        if ($conn->query($sql) === TRUE) {
                            // Insertion successful
                            $result = "Added image successfully!";
                        } else {
                            // Error occurred
                            $result = "Error: " . $conn->error;
                        }
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

    $_SESSION['message'] =$result;
    $conn->close();

    header('Location: animals-home-carousel.php');


}else{
    header('Location: animals-home-carousel.php');

}
?>2
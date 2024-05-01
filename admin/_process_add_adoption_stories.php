<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if a file was uploaded
    if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $city = $_POST['city'];
        $brgy = $_POST['barangay'];


        $picture = basename($_FILES['picture']['name']);
        $animalName = $_POST['animal-name'];
        $adoptionDate = $_POST['adoption-date'];
        $adoptionLocation = $city.", ".$brgy;
        $storyLink = $_POST['story-link'];
        

        echo $picture;

        $target_dir = "../uploads/";
        $target_file = $target_dir . $picture;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        
        // Check if the file is an image
        if ($check !== false) {
            
            // Check file size
            if ($_FILES["picture"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                
                // Check if file type is allowed
                if (in_array($imageFileType, $allowedTypes)) {
                    
                    // Move uploaded file to the target directory
                    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                        
                        // Insert data into database
                        $stmt = $conn->prepare("INSERT INTO adoption_stories_settings (img, name, adoption_date, adoption_location, story_link) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $picture,  $animalName, $adoptionDate, $adoptionLocation, $storyLink);

                        if ($stmt->execute()) {
                            $result = "Story added successfully!";
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
        $result = "No file was uploaded or an error occurred during upload.";
    }
    $_SESSION['message'] = $result;
    $conn->close();
    header('Location: adoption_stories_settings.php');

} else {
    header('Location: adoption_stories_settings.php');
}
?>

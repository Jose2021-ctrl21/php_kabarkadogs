<?php
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_img = basename($_FILES['edit-picture']['name']); 
    $animal_id = $_POST['animal_id']; 
    $name = $_POST['name'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $sex = $_POST['sex'];
    $weight = $_POST['weight'];
    $color = $_POST['color'];
    $mammal = $_POST['mammal'];
    $rescuedLocation = $_POST['edit-rescuedLocation'];
    $rescuedDate = $_POST['edit-rescuedDate'];
    $storyLink = $_POST['edit-story-link'];
    // echo "$animal_img";
    if (!empty($_FILES["edit-picture"]["name"])) {
        $animal_img = basename($_FILES["edit-picture"]["name"]);
        $target_dir = "../uploads/";
        $target_file = $target_dir . $animal_img;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["edit-picture"]["tmp_name"]);
        if ($check !== false) {
            if ($_FILES["edit-picture"]["size"] > 5000000) {
                $result = "Sorry, your file is too large.";
            } else {
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["edit-picture"]["tmp_name"], $target_file)) {
                        $sql = "UPDATE animals SET
                                    name = '$name',
                                    age = '$age',
                                    picture = '$animal_img',
                                    breed = '$breed',
                                    sex = '$sex',
                                    weight = '$weight',
                                    color = '$color',
                                    mammal = '$mammal',
                                    rescued_location = '$rescuedLocation',
                                    rescued_date = '$rescuedDate',
                                    story_link = '$storyLink'
                                    WHERE id = '$animal_id'";
                    
                        if ($conn->query($sql) === TRUE) {
                            echo "$animal_img";
                            // header('Location: animals-edit.php');
                        } else {
                            $result = "Error: " . $conn->error;
                        }
                    }
                    
                } else {
                    $result = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                }
            }

        } else {
            $result = "The uploaded file is not an image.";
        }
    } 
   else {
        // No new image uploaded, use the existing image filename
        $exisisting = $_POST['existing-image'];
        
        // Update the database with the existing image filename and other details
        $sql = "UPDATE animals SET
                    name = '$name',
                    age = '$age',
                    picture = '$exisisting',
                    breed = '$breed',
                    sex = '$sex',
                    weight = '$weight',
                    color = '$color',
                    mammal = '$mammal',
                    rescued_location = '$rescuedLocation',
                    rescued_date = '$rescuedDate',
                    story_link = '$storyLink'
                    WHERE id = '$animal_id'";
    
        if ($conn->query($sql) === TRUE) {
            echo "$animal_img";
            header('Location: animals-edit.php');
        } else {
            $result = "Error: " . $conn->error;
        }
    }
} else {
    header('Location: animals-edit.php');
}
?>
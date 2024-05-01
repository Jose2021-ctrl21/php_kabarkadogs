<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = $_POST['city'];
    $brgy = $_POST['barangay'];

    $picture = basename($_FILES["picture"]["name"]);
    $name = $_POST['name'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $sex = $_POST['sex'];
    $weight = $_POST['weight'];
    $color = $_POST['color'];
    $mammal = $_POST['mammal'];
    $archive_no = "no";
    $rescuedLocation = $city.", ".$brgy;
    $rescuedDate = $_POST['rescuedDate'];
    $storyLink = $_POST['story-link'];

    if (strtotime($rescuedDate) > strtotime(date('Y-m-d'))) {
        $result = "Invalid input in rescue date";
    }else{
            if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["picture"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if the file is an actual image
                $check = getimagesize($_FILES["picture"]["tmp_name"]);
                if ($check !== false) {
                    // Check file size (optional)
                    if ($_FILES["picture"]["size"] > 5000000) {
                        $result = "Sorry, your file is too large.";
                    } else {
                        // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                        $allowedTypes = array("jpg", "jpeg", "png", "gif");
                        if (in_array($imageFileType, $allowedTypes)) {
                            // Move the uploaded file to the desired location
                            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                                $sql = "INSERT INTO animals (picture, name, age, breed, sex, weight, color, mammal,archive,rescued_location,rescued_date,story_link) 
                                VALUES ('$picture', '$name', '$age', '$breed', '$sex', '$weight', '$color', '$mammal','$archive_no','$rescuedLocation','$rescuedDate','$storyLink')";
                            
                                if ($conn->query($sql) === TRUE) {
                                    // Insertion successful
                                    $result = "Added animal successfully!";
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
    } //end checing date rescued is not greater to the current date

    $conn->close();
} else {
    header('Location: animals.php');
}

?>

<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased events</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php" class="active"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>

<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Add Animals</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $result ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('./layout/footer.php')?>
<?php
session_start();
require('./php/connect.php');

$date = date("Y-m-d");
$user_id = 0;

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $_SESSION['message'] = "You have to login first";
    header('Location: index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $animal = $_POST['pet'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $zip_code = $_POST['zip_code'];
    $outdoors_kept = $_POST['outdoors_kept'];
    $petscompanion = $_POST['petscompanion'];
    $petcompanion_other = $_POST['petcompanion_other'];
    $medicines_and_vaccinations = $_POST['medicines_and_vaccinations'];
    $personal_references = $_POST['personal_references'];
    $additional_information = $_POST['additional_information'];
    $status_id = 1; 
    $created_date = date("Y-m-d");
    $agree_terms_and_conditions = isset($_POST['agree_terms_and_conditions']) ? $_POST['agree_terms_and_conditions'] : 'No';
    $image = basename($_FILES["image"]["name"]);

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (optional)
            if ($_FILES["image"]["size"] > 500000) {
                $result = "Sorry, your file is too large.";
            } else {
                // Allow only certain image file types (e.g., jpg, jpeg, png, gif)
                $allowedTypes = array("jpg", "jpeg", "png", "gif");
                if (in_array($imageFileType, $allowedTypes)) {
                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $sql = "INSERT INTO adoptions (
                            first_name, middle_name, last_name, age, email, phone, address, city, barangay, zip_code,
                            outdoors_kept, petscompanion, petcompanion_other, medicines_and_vaccinations, personal_references,
                            additional_information, agree_terms_and_conditions, status_id, created_date, image, animal_id, user_id
                        ) VALUES (
                            '$first_name', '$middle_name', '$last_name', '$age', '$email', '$phone', '$address', '$city',
                            '$barangay', '$zip_code', '$outdoors_kept', '$petscompanion', '$petcompanion_other',
                            '$medicines_and_vaccinations', '$personal_references', '$additional_information', 
                            '$agree_terms_and_conditions', '$status_id', '$created_date', '$image', '$animal', '$user_id'
                        )";
                    
                        $sql2 = "INSERT INTO notifications (
                            user_id, title, description, is_read, created_at
                        ) VALUES (
                            '$user_id', 'Pet Adoption', 'you successfully adapt a pet', 0, '$date'
                        )";

                        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
                            // Insertion successful
                            $result = "Adoption application submitted successfully!";
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
    $conn->close();
} else {
    // Redirect back to the form if the request is not a POST request
    header('Location:index.php');
}
?>

<?php require('./layout/header.php') ?>
<div class="container">
    <div class="p-5 text-center rounded-3 mt-5">
        <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3"><?php echo $result?></h1>
        <div class="pt-5">
            <a href="index.php" class="text-decoration-none">>> Back to Adoption Form</a>
        </div>
        <hr class="featurette-divider" />
    </div>
</div>
<?php require('./layout/footer.php')?>
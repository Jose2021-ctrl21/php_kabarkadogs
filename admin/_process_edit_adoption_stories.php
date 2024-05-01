<?php
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['story-id'];
    $name = $_POST['name'];
    $adoptionDate = $_POST['adoption-date'];
    $adoptionLocation = $_POST['adoption-location'];
    $storyLink = $_POST['story-link'];


    echo "$id, $name, $adoptionDate, $adoptionLocation, $storyLink";
    $sql = "UPDATE adoption_stories_settings SET
            name = '$name',
            adoption_date = '$adoptionDate',
            adoption_location = '$adoptionLocation',
            story_link = '$storyLink'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: adoption_stories_settings.php');
    } else {
        $result = "Error: " . $conn->error;
    }
} else {
    header('Location: adoption_stories_settings.php');
}
?>
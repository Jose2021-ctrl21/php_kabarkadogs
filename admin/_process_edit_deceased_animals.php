<?php
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deceased_id = $_POST['deceased_id']; 

    $date_of_death = $_POST['date_of_death'];
    $cause_of_death = $_POST['cause_of_death'];

    // var_dump($deceased_id);
    // var_dump($date_of_death);
    // var_dump($cause_of_death);

    $sql = "UPDATE deceased SET
    date_of_death = '$date_of_death',
    cause_of_death = '$cause_of_death'
    WHERE id = '$deceased_id'";

    // var_dump($conn->query($sql));
    if ($conn->query($sql) === TRUE) {
        header('Location: deceased-animals.php');
    } else {
        $result = "Error: " . $conn->error;
    }
} else {
    header('Location: deceased-animals-edit.php');
}
?>
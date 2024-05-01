<?php

require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_name = $_POST['donor_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $date_of_donation = $_POST['date_of_donation'];
    $amount = intval($_POST['amount']);

    $sql = "INSERT INTO donations (donor_name, contact_number, address, date_of_donation, amount) 
            VALUES ('$donor_name', '$contact_number', '$address', '$date_of_donation', '$amount')";

    if ($conn->query($sql) === TRUE) {
        header('Location: donations.php');

    } else {
        $result = "Error: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: donations-add.php');
}

?>

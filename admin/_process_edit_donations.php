<?php
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donation_id = $_POST['donation_id']; 
    $donor_name = $_POST['donor_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $date_of_donation = $_POST['date_of_donation'];
    $amount = $_POST['amount'];

    $sql = "UPDATE donations SET
            donor_name = '$donor_name',
            contact_number = '$contact_number',
            address = '$address',
            date_of_donation = '$date_of_donation',
            amount = '$amount'
            WHERE id = '$donation_id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: donations.php');
    } else {
        $result = "Error: " . $conn->error;
    }
} else {
    header('Location: donations-edit.php');
}
?>
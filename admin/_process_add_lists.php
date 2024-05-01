<?php
session_start();
require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $policyId = $_POST['policy-id'];
    $addList = $_POST['add-list'];

    $sql = "INSERT INTO lists (description, policy_id) 
            VALUES ('$addList', '$policyId')";

    if ($conn->query($sql) === TRUE) {
        header('Location: setting_policies_lists.php?id=' . $_SESSION['id']);


    } else {
        $result = "Error: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: setting_policies_lists.php?id=' . $_SESSION['id']);
}

?>

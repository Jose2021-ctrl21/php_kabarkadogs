<?php
session_start();
require('../php/connect.php');

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $deleteSql = "DELETE FROM policy WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteSql);

    $deleteSql_list = "DELETE FROM lists WHERE policy_id = $id";
    $deleteResult_list = mysqli_query($conn, $deleteSql_list);


    if ($deleteResult_list && $deleteResult) {
        $_SESSION['message'] = "Policy and associated lists deleted successfully!".$id;
    } else {
        $_SESSION['message'] = "Error deleting Policy: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
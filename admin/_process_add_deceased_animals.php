<?php

// require('../php/connect.php');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $animal_id = intval($_POST['animals']);
//     $date_of_death = $_POST['date_of_death'];
//     $cause_of_death = $_POST['cause_of_death'];
//     $sql = "INSERT INTO deceased (animal_id, date_of_death, cause_of_death) 
//             VALUES ('$animal_id', '$date_of_death', '$cause_of_death')";

//     if ($conn->query($sql) === TRUE) {
//         header('Location: deceased-animals.php');

//     } else {
//         $result = "Error: " . $conn->error;
//     }

//     $conn->close();
// } else {
//     header('Location: deceased-animals-add.php');
// }

?>
<!-- PREPAPRED STATEMENT -->
<?php

require('../php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $animal_id = intval($_POST['animals']);
    $date_of_death = $_POST['date_of_death'];
    $cause_of_death = $_POST['cause_of_death'];

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO deceased (animal_id, date_of_death, cause_of_death) 
            VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("iss", $animal_id, $date_of_death, $cause_of_death);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: deceased-animals.php');
        exit();
    } else {
        $result = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Close the connection
    $conn->close();
} else {
    header('Location: deceased-animals-add.php');
    exit();
}

?>

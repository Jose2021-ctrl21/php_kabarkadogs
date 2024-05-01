<?php   
session_start();
require('./php/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $date_of_appointment = $_POST['date_of_appointment'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    $status_id = 1; 

    $sql = "INSERT INTO bookings (name, email, phone_number, date_of_appointment, time, message, status_id) 
            VALUES ('$name', '$email', '$phone_number', '$date_of_appointment', '$time', '$message', $status_id)";

    if ($conn->query($sql) === TRUE) {
        // echo "Booking inserted successfully!";
        $result = "Booking inserted successfully!";

    } else {
        // echo "Error: " . $conn->error;
        $result = "Error: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: book-appointment.php');
}

?>

<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3"><?php echo $result?></h1>
            <div class="pt-5">
                <a href="book-appointment.php" class="text-decoration-none">>> Back to Book Appointment</a>
            </div>
            <hr class="featurette-divider" />
        </div>
    </div>

<?php require('./layout/footer.php')?>

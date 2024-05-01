<?php
session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}
if (!isset($_GET['id'])) {
    header('Location: booking-list.php');
    exit(); 
}

$id = $_GET['id'];
$id = intval($id);

if ($id <= 0) {
    header('Location: booking-list.php');
    exit();
}

$sql = "SELECT bookings.id, bookings.name, bookings.email, bookings.phone_number, bookings.date_of_appointment, bookings.time, bookings.message, statuses.name AS status_name, statuses.id AS status_id 
FROM bookings 
INNER JOIN statuses ON bookings.status_id = statuses.id
WHERE bookings.id = $id;";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
        $date_of_appointment = $row['date_of_appointment'];
        $time = $row['time'];
        $message = $row['message'];
        $status_name = $row['status_name'];
        $status_id = $row['status_id'];
    }
}else{
    header('Location: booking-list.php');
    exit();
}

$_sql = "SELECT * FROM statuses";
$_result = mysqli_query($conn, $_sql);
$_data = [];

if ($_result) {
    if (mysqli_num_rows($_result) > 0) {
        while ($row = mysqli_fetch_assoc($_result)) {
            $_data[] = $row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

$conn->close();
?>

<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php" class="active"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View Booking</h1></div>
                <!-- <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="product-add-new.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create New</a></div> -->
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #f1eada;">
                    <h4 class="alert-heading color-kabarkadogs">Name: <?php echo $name ?></h4>
                    <p class="color-kabarkadogs">Email: <a href="mailto:<?php echo $email ?>" class="color-kabarkadogs"><?php echo $email ?></a></p>
                    <p class="color-kabarkadogs">Phone Number: <?php echo $phone_number ?></p>
                    <p class="color-kabarkadogs">Date of appointment: <?php echo $date_of_appointment ?></p>
                    <p class="color-kabarkadogs">Time: <?php echo $time ?></p>
                    <hr>
                    <p class="mb-0 color-kabarkadogs mb-3">Message: <?php echo $message ?></p>
                    <p class="mb-0 color-kabarkadogs d-flex align-items-center mb-3">
                        <span>Status: </span>
                        <input type="hidden" class="booking-id" value="<?php echo $id; ?>">
                        <select class="form-select ms-2" style="width: 200px">
                            <?php foreach ($_data as $roww): ?>
                                <option value="<?php echo $roww['id']?>" <?php echo $status_id === $roww['id'] ? 'selected' : ''?>><?php echo $roww['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <hr>
                    <div class="d-flex">
                        <div class="action-button">
                            <button class="border-0 color-red delete-booking" data-booking-id="<?php echo $id; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this booking?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var selectElements = document.querySelectorAll("select.form-select");
    var selectElements = document.querySelectorAll("select.form-select");
    var deleteButtons = document.querySelectorAll(".delete-booking");
    var confirmDeleteButton = document.getElementById("confirmDelete");
    var bookingIdToDelete = null;

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            bookingIdToDelete = this.getAttribute("data-booking-id");
        });
    });

    confirmDeleteButton.addEventListener("click", function () {
        if (bookingIdToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_booking.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting booking: " + xhr.responseText);
                }
            };

            xhr.send("bookingId=" + encodeURIComponent(bookingIdToDelete));
        }
        document.getElementById('close_modal').click();
    });

    selectElements.forEach(function (selectElement) {
        selectElement.addEventListener("change", function () {
            var selectedStatusId = this.value;
            var bookingId = this.closest(".alert").querySelector(".booking-id").value;
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "_process_update_booking_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log("Status updated successfully.");
                } else {
                    console.error("Error updating status: " + xhr.responseText);
                }
            };

            xhr.send("bookingId=" + encodeURIComponent(bookingId) + "&selectedStatusId=" + encodeURIComponent(selectedStatusId));
        });
    });
});
</script>
<?php require('./layout/footer.php')?>


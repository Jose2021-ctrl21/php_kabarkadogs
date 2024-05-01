<?php 

session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

$searchName = '';

if(isset($_GET['name'])){
    $searchName = $_GET['name'];
}

// var_dump($searchName);

$sql = "SELECT bookings.id, bookings.name, bookings.email, bookings.phone_number, bookings.date_of_appointment, bookings.time, bookings.message, statuses.name AS status_name, statuses.id AS status_id FROM bookings INNER JOIN statuses ON bookings.status_id = statuses.id WHERE bookings.name LIKE '%$searchName%';";
$result = mysqli_query($conn, $sql);
$data = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
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

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Unset the session message after displaying
}

mysqli_close($conn);

?>
<?php require('./layout/header.php')?>
<?php require('nav_menu.php')?>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Booking List</h1></div>
                <!-- <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="product-add-new.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create New</a></div> -->
            </div>
            <!-- <div class="col-lg-12 mb-20">
                <div class="box">
                    <form method="get">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" placeholder="Search by name" name="name" value="<?php echo $searchName?>"/>
                                </div>
                            </div>
                            <div class="col-lg-2"><button class="btn btn-kabarkadogs w-100" type="submit">Search</button></div>
                        </div>
                    </form>
                </div>
            </div> -->
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Date of appointment</th>
                                        <th>Time</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['phone_number']; ?></td>
                                                <td><?php echo date('F d, Y', strtotime($row['date_of_appointment'])); ?></td>
                                                <td><?php echo $row['time']; ?></td>
                                                <td><?php echo $row['message']; ?></td>
                                                <td>
                                                    <input type="hidden" class="booking-id" value="<?php echo $row['id']; ?>">
                                                    <select class="form-select">
                                                        <?php foreach ($_data as $roww): ?>
                                                            <option value="<?php echo $roww['id']?>" <?php echo $row['status_id'] === $roww['id'] ? 'selected' : ''?>><?php echo $roww['name']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="booking-list-view.php?id=<?php echo $row['id']?>" title="View" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                        </div>
                                                        <!-- <div class="action-button"><button class="border-0 color-red" title="Delete" name="delete" value="<?php echo $row['id']; ?>" type="submit"><i class="fa-solid fa-trash"></i></div> -->
                                                        <div class="action-button">
                                                            <button class="border-0 color-red delete-booking" data-booking-id="<?php echo $row['id']; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('booking-lists-modal.php')?>


<script>
document.addEventListener("DOMContentLoaded", function () {
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
            var bookingId = this.closest("tr").querySelector(".booking-id").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_update_booking_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        alert(response.message);
                    } else {
                        alert("Failed to update status: " + response.message);
                    }
            };
            xhr.send("bookingId=" + encodeURIComponent(bookingId) + "&selectedStatusId=" + encodeURIComponent(selectedStatusId));
        });
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>



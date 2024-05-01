<?php 

session_start();
require('../php/connect.php');
error_reporting();
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

$sql = "SELECT * from events";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $img = $row['img'];
        $description = $row['description'];
        $title = $row['title'];
        $date = $row['date'];
    }
}
?>

<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased events</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php" class="active"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Edit events</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="_process_add_events.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="eventImage" class="col-sm-12 col-lg-2 col-form-label">Current Image:</label>
                                    <input type="file" class="form-control" id="eventImage" name="eventImage"/>
                                </div>
                                <script>
                                    function triggerFileInput() {
                                        document.getElementById('eventImage').click();
                                    }
                                </script>
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-12 col-lg-2 col-form-label">Title: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-12 col-lg-2 col-form-label">Description: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="description" name="description"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="date" class="col-sm-12 col-lg-2 col-form-label">Date: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="date" name="date"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-kabarkadogs">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('./layout/footer.php')?>

<?php 
session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}
?>
<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php" class="active"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Add Donor</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="_process_add_donations.php">
                                <div class="mb-3 row">
                                    <label for="donor_name" class="col-sm-12 col-lg-2 col-form-label">Donor Name: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="donor_name" name="donor_name"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="contact_number" class="col-sm-12 col-lg-2 col-form-label">Contact Number: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="number" class="form-control" id="contact_number" name="contact_number"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="address" class="col-sm-12 col-lg-2 col-form-label">Address: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="date_of_donation" class="col-sm-12 col-lg-2 col-form-label">Date of Donation: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="date_of_donation" name="date_of_donation"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="amount" class="col-sm-12 col-lg-2 col-form-label">Amount: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="number" class="form-control" id="amount" name="amount"/>
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


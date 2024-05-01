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
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php" class="active"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Add story</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="_process_add_adoption_stories.php" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="animal-name" class="col-sm-12 col-lg-2 col-form-label">Pet name: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="animal-name" name="animal-name"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="picture" class="col-sm-12 col-lg-2 col-form-label">Picture: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="file" class="form-control" id="picture" name="picture" accept="image/*"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="adoption-date" class="col-sm-12 col-lg-2 col-form-label">Adoption date: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="adoption-date" name="adoption-date"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="adoption-location" class="col-sm-12 col-lg-2 col-form-label">Adoption location: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="adoption-location" name="adoption-location"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="story-link" class="col-sm-12 col-lg-2 col-form-label">Story link: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="story-link" name="story-link"/>
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


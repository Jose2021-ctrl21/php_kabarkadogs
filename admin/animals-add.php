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
        <li><a href="animals.php" class="active"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
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
                <div><h2 class="title">Add Animals</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="_process_add_animals.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="picture" class="col-sm-12 col-lg-2 col-form-label">Picture: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="file" class="form-control" id="picture" name="picture" accept="image/*"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="animal_name" class="col-sm-12 col-lg-2 col-form-label">Animal Name: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="animal_name" name="name"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="age" class="col-sm-12 col-lg-2 col-form-label">Age: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="age" name="age"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="breed" class="col-sm-12 col-lg-2 col-form-label">Breed: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="breed" name="breed"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="sex" class="col-sm-12 col-lg-2 col-form-label">Sex: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <select name="sex" id="sex" class="form-select form-control" name="sex">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="weight" class="col-sm-12 col-lg-2 col-form-label">Weight: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="weight" name="weight"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="color" class="col-sm-12 col-lg-2 col-form-label">Color: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="color" name="color"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="mammal" class="col-sm-12 col-lg-2 col-form-label">Type of pet: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <select id="mammal" class="form-select form-control" name="mammal">
                                            <option value="dog">Dog</option>
                                            <option value="cat">Cat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">City:</label>
                                        <select id="inputCity" class="form-select" name="city">
                                            <option value="select" selected>-Select City-</option>
                                            <option value="Cavite City">Cavite City</option>
                                            <option value="Kawit, Cavite">Kawit, Cavite</option>
                                            <option value="Noveleta, Cavite">Noveleta, Cavite</option>
                                            <option value="Rosario, Cavite">Rosario, Cavite</option>
                                            <option value="Bacoor City">Bacoor City</option>
                                            <option value="Imus City">Imus City</option>
                                            <option value="Dasmarinas City">Dasmarinas City</option>
                                            <option value="Carmona, Cavite">Carmona, Cavite</option>
                                            <option value="General Mariano Alvarez, Cavite">General Mariano Alvarez, Cavite</option>
                                            <option value="General Trias City">General Trias City</option>
                                            <option value="Silang, Cavite">Silang, Cavite</option>
                                            <option value="Amadeo, Cavite">Amadeo, Cavite</option>
                                            <option value="Indang, Cavite">Indang, Cavite</option>
                                            <option value="Tanza, Cavite">Tanza, Cavite</option>
                                            <option value="Tagaytay, Cavite">Tagaytay, Cavite</option>
                                            <option value="Alfonso, Cavite">Alfonso, Cavite</option>
                                            <option value="General Emilio Aguinaldo, Cavite">General Emilio Aguinaldo, Cavite</option>
                                            <option value="Magallanes, Cavite">Magallanes, Cavite</option>
                                            <option value="Maragondon, Cavite">Maragondon, Cavite</option>
                                            <option value="Mendez, Cavite">Mendez, Cavite</option>
                                            <option value="Naic, Cavite">Naic, Cavite</option>
                                            <option value="Ternate, Cavite">Ternate, Cavite</option>  
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="barangay" class="form-label">Barangay:</label>
                                        <select id="barangay" class="form-select" name="barangay">
                                            <!-- <option selected>-Select Barangay-</option>   -->
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-3">
                                    <label for="rescuedDate" class="col-sm-12 col-lg-2 col-form-label">Rescued Date: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="rescuedDate" name="rescuedDate"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="story-link" class="col-sm-12 col-lg-2 col-form-label">Read story here: <span class="">*</span></label>
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
<script src="../places.js"></script>
<?php require('./layout/footer.php')?>

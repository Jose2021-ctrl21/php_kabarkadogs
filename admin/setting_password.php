<?php 
error_reporting(E_ALL);
session_start(); // Start the session at the very beginning

require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

// Debugging line to check if session message is set
if (isset($_SESSION['message'])) {
    // var_dump($_SESSION['message']);
}

$sql = "SELECT * FROM profile_setting";
$result = mysqli_query($conn, $sql);
$rows = []; // Initialize an empty array
if($result){
    while($row = mysqli_fetch_assoc($result)){ // Fetch each row and add to the array
        $rows[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Unset the session message after displaying
}

?>


<?php require('./layout/header.php')?>
<?php require('nav_menu_setting.php')?>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>

                        <div class="col-lg-2 shadow"></div>
                        <div class="col-lg-8 shadow">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <div><h2 class="title">Password setting</h1></div>
                        </div>
                            <form method="post" action="_process_change_password.php">
                              
                                <div class="mb-6 row">
                                    <label for="old_password" class="col-sm-4 col-lg-4 col-form-label">Old Password: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-4">
                                        <input type="password" class="form-control" id="old_password" name="old_password"/>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="new_password" class="col-sm-4 col-lg-4 col-form-label">New Password: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-4">
                                        <input type="password" class="form-control" id="new_password" name="new_password"/>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="confirm_password" class="col-sm-4 col-lg-4 col-form-label">Confirm Password: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-4">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"/>
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
 <!-- MODAL -->
 <?php require('setting-modal-owner-profile.php')?>
                        <!-- END modal -->
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

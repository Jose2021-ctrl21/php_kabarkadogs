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

$sql = "SELECT * FROM dcf";
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
            <!-- <div class="col-lg-12">
                <div class="box"> -->
                    <div class="row">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }           
                    ?>
                       <div class="col-lg-12 shadow pb-5"> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center><h2 class="title">Donate, Cost, Funding</h2></center>
                                        <!-- Content for Donate section -->
                                    </div>                               
                                </div>
                            </div>  
                            <div class="form-group">
                                <form method="POST" action="_process_edit_dcf.php" enctype="multipart/form-data">
                                    <?php foreach($rows as $row):?>
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4">
                                            <div class="mb-3 shadow">
                                                <label for="eventImage" class="col-sm-12 col-lg-2 col-form-label">Current Image:</label>
                                                <input type="file" class="form-control" id="eventImage" name="eventImage" style="display: none;" accept="image/*"/>
                                                    <?php if (!empty($row['img'])): ?>
                                                        <a href="javascript:void(0);" onclick="triggerFileInput()">
                                                            <img src="../uploads/<?php echo $row['img']; ?>" alt="Current Image" style="max-width: 100%; height: auto;">
                                                        </a>
                                                        <input type="hidden" name="existing-image" value="<?php echo $row['img']; ?>">
                                                    <?php else: ?>
                                                        <p>No image available</p>
                                                    <?php endif; ?>
                                            </div>
                                            <script>
                                                function triggerFileInput() {
                                                    document.getElementById('eventImage').click();
                                                }
                                            </script>
                                        </div>     
                                        <div class="col-lg-4"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h2 class="title">Donate</h2>
                                            <textarea name="donate" id="donate" cols="30" rows="6" class="form-control"><?php echo $row['donate']?></textarea>
                                        </div>                
                                        <div class="col-md-4">
                                            <h2 class="title">Costs</h2>
                                            <textarea name="costs" id="costs" cols="30" rows="6" class="form-control"><?php echo $row['costs']?></textarea>
                                        </div>                
                                        <div class="col-md-4">
                                            <h2 class="title">Funding</h2>
                                            <textarea name="funding" id="funding" cols="30" rows="6" class="form-control"><?php echo $row['funding']?></textarea>
                                        </div>                
                                    </div>
                                    <?php endforeach ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-kabarkadogs mt-5" name="update" style="float: right;">Save</button>
                                        </div>                               
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- </div>
            </div> -->
        </div>
    </div>
</div>
 <!-- MODAL -->
 <?php require('setting-modal-owner-profile.php')?>
                        <!-- END modal -->
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

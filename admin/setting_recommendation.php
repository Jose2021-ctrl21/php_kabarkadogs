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

$sql = "SELECT * FROM recommendation";
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
                        <div class="col-lg-12 shadow"> 
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div><h2 class="title">Recommendation setting</h1></div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-kabarkadogs" style="float: right;"  data-bs-toggle="modal" data-bs-target="#addOwnerProfile" value="Add">Add recommendation</button>
                                </div>
                            </div>                
                            <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>Image</th>
                                        <th>Small title</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Map location</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rows as $row): ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <img src="../uploads/<?php echo !empty($row["img"]) ? $row["img"] : 'default-image.jpg'; ?>" alt="Profile" class="brand-image img-square elevation-2" width="40px" height="40px" style="opacity: .8;border: 1px solid gray">
                                                        &nbsp;<i class="fa fa-edit edit-recommendation-image" data-id="<?php echo $row["id"]?>" style="color: #15b4ed;position: absolute;" title="Edit Image" data-bs-toggle="modal" data-bs-target="#editRecommendationImage" data-bs-image="<?= htmlentities($row['id']); ?>"></i>
                                                    </center>
                                                </td>
                                                <td><?php echo !empty($row["small_title"]) ? $row["small_title"] : 'small'; ?></td>
                                                <td><?php echo !empty($row["title"]) ? $row["title"] : 'title'; ?></td>
                                                <td><?php echo !empty($row["description"]) ? $row["description"] : 'description'; ?></td>
                                                <td><?php echo !empty($row["map_name"]) ? $row["map_name"] : 'Date'; ?></td>
                                                <td>
                                                    <center>
                                                    <i class="fa fa-edit edit-recommendation" 
                                                        data-id="<?php echo $row["id"]?>"
                                                        style="color: #39c91c" 
                                                        title="Edit here..." 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editInfo">
                                                        </i>
                                                    <i class="fa fa-trash delete-recommendation" 
                                                        data-id="<?php echo $row["id"]?>" 
                                                        style="color: red" 
                                                        title="Delete here..." 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteInfo">
                                                        </i>
                                                    </center>
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
</div>
 <!-- MODAL -->
 <?php require('setting_recommendation_modal.php')?>
 
 <!-- SCRIPT -->
 <?php require('setting_policies_modal.php')?>
 <script>
 document.addEventListener("DOMContentLoaded", function () {
    var editRecommendation = document.querySelectorAll(".edit-recommendation");
    var deleteRecommendation = document.querySelectorAll(".delete-recommendation");
    var editRecommendationImage = document.querySelectorAll(".edit-recommendation-image");
    var recommendationToDelete = null;
    var recommendationToEdit = null;
    var recommendationImageToEdit = null;

    //GET ID and PASS IT TO INPUT FIELD FOR IMAGE ID
    editRecommendationImage.forEach(function (updateImg) {
        updateImg.addEventListener("click", function () {
            recommendationImageToEdit = this.getAttribute("data-id");
            var imgId = document.getElementById("img-id");
            imgId.value = recommendationImageToEdit;
            console.log("Input field value: " + imgId.value + ", Data ID: " + recommendationImageToEdit);
        });
    });

    // EDIT RECOMMENDATION SCRIPT
    editRecommendation.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            recommendationToEdit = this.getAttribute("data-id");
            var editSmallTitle = document.getElementById('edit-small-title');
            var editTitle = document.getElementById('edit-title');
            var editDescription = document.getElementById('edit-description');
            var editMapName = document.getElementById('edit-map-name');
            var editMapLink = document.getElementById('edit-map-link');
            var recommendationId = document.getElementById('recommendation_id');

            // Make an AJAX request to a PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "setting_recommendation_row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Parse the JSON response from the PHP script
                    var response = JSON.parse(xhr.responseText);
                    
                    // Update the heading and caption with the received data
                    editSmallTitle.value = response.small_title;
                    editTitle.value = response.title;
                    editDescription.value = response.description;
                    editMapName.value = response.map_name;
                    editMapLink.value = response.map_link;
                    recommendationId.value = response.id;
                    console.log(xhr.responseText); // For debugging purposes
                }
            };
            // Send data to PHP script
            xhr.send("id=" + recommendationToEdit);
            // console.log(id.value+'-'+editRepublic.value+'-'+editTitle.value+'-'+editSubtitle.value);
        });
    });


    // DELETE
    deleteRecommendation.forEach(function (deleteEvent) {
        var confirmDelete = document.getElementById('confirmDelete');
        //Get id after clicking the icon delete
        deleteEvent.addEventListener("click", function () {
            recommendationToDelete = this.getAttribute('data-id');
            console.log(recommendationToDelete);
        });

        //Deelte when button delete in modal was clicked
        confirmDelete.addEventListener("click",function(){
        if (recommendationToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_recommendation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting policy: " + xhr.responseText);
                }
            };
            xhr.send("id=" + encodeURIComponent(recommendationToDelete));
        }
        });
            document.getElementById('close_modal').click();
        });
    });
</script>

 <?php require('../plugins/scripts.php')?>
<?php require('./layout/footer.php')?>

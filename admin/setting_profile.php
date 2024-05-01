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
                        <div class="col-lg-12 shadow"> 
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div><h2 class="title">Owner's profile setting</h1></div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-kabarkadogs" style="float: right;"  data-bs-toggle="modal" data-bs-target="#addOwnerProfile" value="Add">Add owner's profile</button>
                                </div>
                            </div>                
                            <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Date stablished</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rows as $row): ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <img src="../uploads/<?php echo !empty($row["img"]) ? $row["img"] : 'default-image.jpg'; ?>" alt="Profile" class="brand-image img-square elevation-2" width="40px" height="40px" style="opacity: .8;border: 1px solid gray">
                                                        &nbsp;<i class="fa fa-edit edit-image" data-id="<?php echo $row["id"]?>" style="color: #15b4ed;position: absolute;" title="Edit Image" data-bs-toggle="modal" data-bs-target="#editOwnerProfile" data-bs-image="<?= htmlentities($row['id']); ?>"></i>
                                                    </center>
                                                </td>
                                                <td><?php echo !empty($row["name"]) ? $row["name"] : 'John Doe'; ?></td>
                                                <td><?php echo !empty($row["position"]) ? $row["position"] : 'Position'; ?></td>
                                                <td><?php echo !empty($row["date_established"]) ? $row["date_established"] : 'Date'; ?></td>
                                                <td>
                                                    <center>
                                                    <i class="fa fa-edit btn-accountEdit" 
                                                        data-id="<?php echo $row["id"]?>" 
                                                        style="color: #39c91c" 
                                                        title="Edit here..." 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editInfo">
                                                        </i>
                                                    <i class="fa fa-trash btn-accountDelete" 
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
 <?php require('setting-modal-owner-profile.php')?>
 <script>
 document.addEventListener("DOMContentLoaded", function () {
    var btnAccountEdit = document.querySelectorAll(".btn-accountEdit");
    var btnAccountDelete = document.querySelectorAll(".btn-accountDelete");
    var profileImage = document.querySelectorAll(".edit-image");
    var accountEdit_id = null;
    var profileImageEdit_id = null;
    var deleteId = null;

    profileImage.forEach(function (updateImg) {
        updateImg.addEventListener("click", function () {
            profileImageEdit_id = this.getAttribute("data-bs-image");
            var imgId = document.getElementById("image_id");
            imgId.value = profileImageEdit_id;
            console.log("Input field value: " + imgId.value + ", Data ID: " + profileImageEdit_id);
        });
    });

    // PROFILE EDIT
    btnAccountEdit.forEach(function (editButton) {

        editButton.addEventListener("click", function () {

            accountEdit_id = this.getAttribute("data-id");
            var editName = document.getElementById('edit-name');
            var editPosition = document.getElementById('edit-position');
            var editDateEstablished = document.getElementById('edit-date-established');
            var infoId = document.getElementById('infoId');
            // Make an AJAX request to a PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "setting_profile_row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Parse the JSON response from the PHP script
                    var response = JSON.parse(xhr.responseText);
                    
                    // Update the heading and caption with the received data
                    editName.value = response.name;
                    editPosition.value = response.position;
                    editDateEstablished.value = response.date_established;
                    infoId.value = response.id;
                    console.log(xhr.responseText); // For debugging purposes
                }
            };
            // Send data to PHP script
            xhr.send("id=" + accountEdit_id);
            // console.log(id.value+'-'+editRepublic.value+'-'+editTitle.value+'-'+editSubtitle.value);
        });
    });


       // DELETE
       btnAccountDelete.forEach(function (deleteEvent) {
        var confirmDelete = document.getElementById('confirmDelete');
        //Get id after clicking the icon delete
        deleteEvent.addEventListener("click", function () {
            deleteId = this.getAttribute('data-id');
            console.log(deleteId);
        });

        //Deelte when button delete in modal was clicked
        confirmDelete.addEventListener("click",function(){
        if (deleteId !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_setting_profile.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting profile: " + xhr.responseText);
                }
            };
            xhr.send("id=" + encodeURIComponent(deleteId));
        }
        });
            document.getElementById('close_modal').click();
        });
    });
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

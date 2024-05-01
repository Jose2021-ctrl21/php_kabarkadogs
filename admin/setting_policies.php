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

//FOR ADDING INROMATON
$sql = "SELECT * FROM policy";
$result = mysqli_query($conn, $sql);
$rows = []; // Initialize an empty array
if($result){
    while($row = mysqli_fetch_assoc($result)){ // Fetch each row and add to the array
        $rows[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}

// if (isset($_SESSION['message'])) {
//     echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
//     unset($_SESSION['message']); 
// }


//FOR EDITING INFORMATION
//FOR ADDING INROMATON
$sql = "SELECT * FROM policy";
$result = mysqli_query($conn, $sql);
$rows = []; // Initialize an empty array
if($result){
    while($row = mysqli_fetch_assoc($result)){ // Fetch each row and add to the array
        $rows[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
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
                                <div><h2 class="title">Policies setting</h1></div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-kabarkadogs" style="float: right;"  data-bs-toggle="modal" data-bs-target="#addOwnerProfile" value="Add">Add policy</button>
                                </div>
                            </div>                
                            <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>Image</th>
                                        <th>Republic act</th>
                                        <th>Title</th>
                                        <th>Sub title</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rows as $row): ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <img src="../uploads/<?php echo !empty($row["img"]) ? $row["img"] : 'default-image.jpg'; ?>" alt="Profile" class="brand-image img-square elevation-2" width="40px" height="40px" style="opacity: .8;border: 1px solid gray">
                                                        &nbsp;<i class="fa fa-edit edit-image" data-id="<?= isset($row['id']) ? htmlentities($row['id']) : ''; ?>" style="color: #15b4ed;position: absolute;" title="Edit Image" data-bs-toggle="modal" data-bs-target="#editOwnerProfile" data-bs-image="<?= htmlentities($row['id']); ?>"></i>
                                                    </center>
                                                </td>
                                                <td><?php echo !empty($row["republic_act"]) ? $row["republic_act"] : 'John Doe'; ?></td>
                                                <td><?php echo !empty($row["title"]) ? $row["title"] : 'title'; ?></td>
                                                <td><?php echo !empty($row["subtitle"]) ? $row["subtitle"] : 'subtitle'; ?></td>
                                                <td>
                                                    <center>
                                                        <a href="#" class="btn btn-success text-decoration-none">
                                                            <i class="fa fa-edit policy-edit" 
                                                            data-id="<?= isset($row['id']) ? htmlentities($row['id']) : ''; ?>" 
                                                            style="color: black" 
                                                            title="Edit here..." 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editInfo">
                                                            </i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger text-decoration-none">
                                                            <i class="fa fa-trash policy-delete" 
                                                            data-id="<?= isset($row['id']) ? htmlentities($row['id']) : ''; ?>" 
                                                            style="color: black" 
                                                            title="delete here..." 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteInfo">
                                                            </i>
                                                        </a>
                                                        <a href="setting_policies_lists.php?id=<?php echo $row['id']?>" title="View lists" class="btn btn-primary"><i class="fa-solid fa-list"></i></a>   
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


 <!-- SCRIPT -->
 <?php require('setting_policies_modal.php')?>
 <script>
 document.addEventListener("DOMContentLoaded", function () {
    var policyEdit = document.querySelectorAll(".policy-edit");
    var policyDelete = document.querySelectorAll(".policy-delete");
    var policyImg = document.querySelectorAll(".edit-image");
    var policyToDelete_id = null;
    var policyImgEdit_id = null;
    var id = null;

    policyImg.forEach(function (updateImg) {
        updateImg.addEventListener("click", function () {
            policyImgEdit_id = this.getAttribute("data-id");
            var imgId = document.getElementById("img-id");
            imgId.value = policyImgEdit_id;
            console.log("Input field value: " + imgId.value + ", Data ID: " + policyImgEdit_id);
        });
    });

    // POLICY SCRIPT
    policyEdit.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            id = this.getAttribute("data-id");
            var editRepublic = document.getElementById('edit-republic');
            var editTitle = document.getElementById('edit-title');
            var editSubtitle = document.getElementById('edit-subtitle');
            var editId = document.getElementById('edit-id');

            // Make an AJAX request to a PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "setting_policies_row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Parse the JSON response from the PHP script
                    var response = JSON.parse(xhr.responseText);
                    
                    // Update the heading and caption with the received data
                    editRepublic.value = response.republic_act;
                    editTitle.value = response.title;
                    editSubtitle.value = response.subtitle;
                    editId.value = response.id;
                    console.log(xhr.responseText); // For debugging purposes
                }
            };
            // Send data to PHP script
            xhr.send("id=" + id);
            // console.log(id.value+'-'+editRepublic.value+'-'+editTitle.value+'-'+editSubtitle.value);
        });
    });


    // DELETE
    policyDelete.forEach(function (deleteEvent) {
        var confirmDelete = document.getElementById('confirmDelete');
        //Get id after clicking the icon delete
        deleteEvent.addEventListener("click", function () {
            policyToDelete_id = this.getAttribute('data-id');
            console.log(policyToDelete_id);
        });

        //Deelte when button delete in modal was clicked
        confirmDelete.addEventListener("click",function(){
        if (policyToDelete_id !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_setting_policy.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting policy: " + xhr.responseText);
                }
            };
            xhr.send("id=" + encodeURIComponent(policyToDelete_id));
        }
        });
            document.getElementById('close_modal').click();
        });
    });
</script>

<?php require('../plugins/scripts.php')?>
<?php require('./layout/footer.php')?>

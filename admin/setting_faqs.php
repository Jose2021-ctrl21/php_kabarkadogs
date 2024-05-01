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
//FOR ADOPTION FEE
$sql = "SELECT * FROM faqs LIMIT 1";
$result = mysqli_query($conn, $sql);
$rows = []; // Initialize an empty array
if($result){
    while($row = mysqli_fetch_assoc($result)){ // Fetch each row and add to the array
        $rows[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}


// FOR LISSTS
$sql_list = "SELECT *, 
qa_lists.qa_id AS qa_id,
qa_lists.id AS id 
FROM qa_lists 
INNER JOIN faqs 
ON faqs.id = qa_lists.qa_id";
$result_list = mysqli_query($conn, $sql_list);
$rows_list = []; // Initialize an empty array
if($result_list){
    while($row_list = mysqli_fetch_assoc($result_list)){ // Fetch each row and add to the array
        $rows_list[] = $row_list;
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
                                        <center><div><h2 class="title">Question and Answer</h1></div></center>
                                        <!-- Content for Donate section -->
                                    </div>                               
                                </div>
                            </div>  
                            <div class="form-group">
                                    <div class="row">

                                        <?php foreach($rows as $row):?>
                                        <div class="col-lg-3 shadow">
                                            <form method="POST" action="_process_edit_faqs.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4"></div>
                                                        <div class="col-sm-4">
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
                                                            <script>
                                                                function triggerFileInput() {
                                                                    document.getElementById('eventImage').click();
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class="col-sm-4"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row p-2">
                                                        <label for="title"><b>Title:</b></label>
                                                        <input type="hidden" id="id" name="id" placeholder="id" class=" form-control mb-3" value="<?php echo $row['id']?>">
                                                        <input type="text" id="title" name="title" placeholder="title" class=" form-control mb-3" value="<?php echo $row['title']?>">
                                                        <label for="title-description"><b>Title description:</b></label>
                                                        <textarea type="text" id="title-description" name="title-description"   class=" form-control mb-3" cols="25" rows="4">
                                                            <?php echo $row['title_description']?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-kabarkadogs mt-5" name="update" style="float: right;">Apply</button>
                                                    </div>                               
                                                </div>
                                            </form>
                                        </div>
                                        <?php endforeach ?>


                                        
                                        <div class="col-lg-9">
                                        <div class="col-lg-12 mb-3">
                                            <div class="float-right">
                                                <button type="button" class="btn btn-kabarkadogs" style="float: right;"  data-bs-toggle="modal" data-bs-target="#addOwnerProfile" value="Add">Add QA</button>
                                            </div>
                                        </div>
                                        <table id="example" class="table table-hover">
                                            <thead class="table-light">
                                                <th>id</th>
                                                <th>question</th>
                                                <th>answer</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody class="scroll-y">
                                                <?php foreach($rows_list as $row): ?>
                                                    <tr>
                                                        <td><?php echo !empty($row["id"]) ? $row["id"] : 'id'; ?></td>
                                                        <td><?php echo !empty($row["question"]) ? $row["question"] : 'question'; ?></td>
                                                        <td><?php echo !empty($row["answer"]) ? $row["answer"] : 'answer'; ?></td>
                                                        <td>
                                                            <center>
                                                            <i class="fa fa-edit faqsEdit" 
                                                                data-id="<?php echo $row["id"]?>" 
                                                                style="color: #39c91c" 
                                                                title="Edit here..." 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editInfo">
                                                                </i>
                                                            <i class="fa fa-trash faqsDelete" 
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
                                        <style>.scroll-y {
                                            max-height: 320px; /* Set the maximum height for the list container */
                                            overflow-y: auto; /* Add vertical scrollbar if content exceeds the maximum height */
                                        }
                                        </style>
                                    </div>
                                   
                            </div>
                            <!-- end fprm group -->
                        </div>
                    </div>
                <!-- </div>
            </div> -->
        </div>
    </div>
</div>
 <!-- MODAL -->
 <?php require('setting_faqs_modal.php')?>
 <script>
    //Pass id for adding
    document.addEventListener("DOMContentLoaded", function () {
    var qaId = document.getElementById('qa-id');
    var id = document.getElementById('id').value;
    qaId.value = id;
 });
 </script>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    var faqsEdit = document.querySelectorAll(".faqsEdit");
    var faqsDelete = document.querySelectorAll(".faqsDelete");
    var faqsTodelete = null;
    var id_data = null;

    // POLICY SCRIPT
    faqsEdit.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            id_data = this.getAttribute("data-id");
            var editQuestion = document.getElementById('edit-question');
            var editAnswer = document.getElementById('edit-answer');
            var qa = document.getElementById('qa');

            // Make an AJAX request to a PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "setting_faqs_row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Parse the JSON response from the PHP script
                    var response = JSON.parse(xhr.responseText);
                    
                    // Update the heading and caption with the received data
                    editQuestion.value = response.question;
                    editAnswer.value = response.answer;
                    qa.value = response.id;
                    console.log(xhr.responseText); // For debugging purposes
                }
            };
            // Send data to PHP script
            xhr.send("id=" + id_data);
            // console.log(id.value+'-'+editRepublic.value+'-'+editTitle.value+'-'+editSubtitle.value);
        });
    });


    // DELETE
    faqsDelete.forEach(function (deleteEvent) {
        var confirmDelete = document.getElementById('confirmDelete');
        //Get id after clicking the icon delete
        deleteEvent.addEventListener("click", function () {
            faqsTodelete = this.getAttribute('data-id');
            console.log(faqsTodelete);
        });

        //Deelte when button delete in modal was clicked
        confirmDelete.addEventListener("click",function(){
        if (faqsTodelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_faqs.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting policy: " + xhr.responseText);
                }
            };
            xhr.send("id=" + encodeURIComponent(faqsTodelete));
        }
        });
            document.getElementById('close_modal').click();
        });
    });
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>
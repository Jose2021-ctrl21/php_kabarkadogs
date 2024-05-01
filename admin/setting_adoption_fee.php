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
$sql = "SELECT * FROM adoption_fee";
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
lists.description AS description,
lists.id AS id 
FROM lists 
INNER JOIN adoption_fee 
ON adoption_fee.id = lists.adoption_fee_id";
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
                                        <center><h2 class="title">Adoption fee</h2></center>
                                        <!-- Content for Donate section -->
                                    </div>                               
                                </div>
                            </div>  
                            <div class="form-group">
                                    <div class="row">

                                        <?php foreach($rows as $row):?>
                                        <div class="col-lg-6">
                                            <form method="POST" action="_process_edit_adoption_fee.php" enctype="multipart/form-data">
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
                                                    <div class="row">
                                                        <label for="title"><b>Title:</b></label>
                                                        <input type="hidden" id="id" name="id" placeholder="id" class=" form-control mb-3" value="<?php echo $row['id']?>">
                                                        <input type="text" id="title" name="title" placeholder="title" class=" form-control mb-3" value="<?php echo $row['title']?>">
                                                        <label for="title-description"><b>Title description:</b></label>
                                                        <input type="text" id="title-description" name="title-description" placeholder="title-description" class=" form-control mb-3" value="<?php echo $row['title_description']?>">
                                                        <label for="donate"><b>Subtitle:</b></label>
                                                        <input type="text" id="subtitle" name="subtitle" placeholder="subtitle" class=" form-control mb-3" value="<?php echo $row['subtitle']?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-kabarkadogs mt-5" name="update" style="float: right;">Apply</button>
                                                    </div>                               
                                                </div>
                                            </form>
                                        </div>
                                        <?php endforeach ?>



                                        <div class="col-lg-6">
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <h2 class="lists">Lists</h2>
                                                        <div class="">
                                                           <!-- LIST INPUT -->
                                                            <div class="input-group mb-3">
                                                                <input type="text" id="listsInput" name="list-input" placeholder="Add lists" class="form-control">
                                                                <button type="submit" id="addButton" name="submit" class="btn btn-primary">Add</button>
                                                            </div>
                                                           
                                                            <ul id="listsContainer" class="list-group mt-3 scroll-y">
                                                                <!-- Placeholder list item, will be replaced by JavaScript -->
                                                                <?php foreach($rows_list as $row): ?>
                                                                    <!-- List item generated from PHP loop -->
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center list-remove" id="list-id" value="<?php echo $row['id']?>">
                                                                        <?php echo $row['description']; ?>
                                                                        <button type="button" class="btn btn-danger btn-sm" ondblclick="removeListItem(this)">X</button>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                                <!-- End of placeholder list item -->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
 <?php require('setting-modal-owner-profile.php')?>
                        <!-- END modal -->
                        <script>
    document.addEventListener('DOMContentLoaded', function() {
        //Pass id to adoption-fee-id
      
       // Get references to elements
        var listsInput = document.getElementById('listsInput');
        var addButton = document.getElementById('addButton');

        // Event listener for the "Add" button
        addButton.addEventListener('click', function() {
            // Get the value from the input field
            var listItemText = listsInput.value.trim();
            var add_id = document.getElementById('id').value;
            
            if (add_id !== null && listItemText.length > 0) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "_process_add_adoption_fee.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function () {
                    if (xhr.status === 200) {
                         // If the input field is not empty
                            if (listItemText !== '') {
                                // Create a new list item element
                                var listItem = document.createElement('li');
                                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                                // Add the text content
                                listItem.textContent = listItemText;
                                // Create a button for removing the list item
                                var removeButton = document.createElement('button');
                                removeButton.textContent = 'X';
                                removeButton.className = 'btn btn-danger btn-sm';
                                // Event listener for the remove button
                                removeButton.addEventListener('click', function() {
                                    // Remove the list item when the remove button is clicked
                                    listItem.parentNode.removeChild(listItem);
                                });
                                // Append the remove button to the list item
                                listItem.appendChild(removeButton);
                                // Append the new list item to the lists container
                                document.getElementById('listsContainer').appendChild(listItem);
                                // Clear the input field
                                listsInput.value = '';
                            }
                        // Reload the page after successful addition
                        // location.reload();
                    } else {
                        console.error("Error adding item: " + xhr.responseText);
                    }
                };

                // Concatenate parameters with &
                var params = "id=" + encodeURIComponent(add_id) + "&listItem=" + encodeURIComponent(listItemText);

                // Send the parameters in the POST request
                xhr.send(params);
            }    
        });
    });
// Function to remove a list item
// Function to remove a list item
function removeListItem(button) {
    // Get the parent list item of the remove button
    var listItem = button.parentElement;

    // Get the value from the value attribute of the list item
    var id = listItem.getAttribute('value');

    // Display the value (you can modify this to display it wherever you want)
    console.log("ID of the list item:", id);

    // Send an AJAX request to delete the item
    if (id !== null) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "_process_delete_adoption_fee.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Reload the page after successful deletion
                location.reload();
            } else {
                console.error("Error deleting item: " + xhr.responseText);
            }
        };
        // Send the id as a parameter in the POST request
        xhr.send("id=" + encodeURIComponent(id));
    }
}

</script>

<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

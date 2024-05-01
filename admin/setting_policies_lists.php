<?php 
error_reporting(E_ALL);
session_start();

require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit(); // Ensure that script execution stops after redirecting
}

// Sanitize input
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if ($id) {
    $_SESSION['id'] = $id;

    $sql = "SELECT * FROM lists WHERE policy_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }
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
                        <div class="col-lg-12 shadow"> 
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div><h2 class="title">Lists</h1></div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-kabarkadogs" style="float: right;"  data-bs-toggle="modal" data-bs-target="#addLists" value="Add">Add lists</button>
                                </div>
                            </div>                
                            <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>id</th>
                                            <th>Lists</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($rows)): ?>
                                            <?php foreach($rows as $row): ?>
                                                <tr>
                                                    <td><?php echo htmlentities($row["id"]); ?></td>
                                                    <td><?php echo htmlentities($row["description"]); ?></td>
                                                    <td>
                                                        <center>
                                                            <i class="fa fa-edit lists" 
                                                                data-id="<?= isset($row['id']) ? htmlentities($row['id']) : ''; ?>" 
                                                                style="color: #39c91c" 
                                                                title="Edit here..." 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editList">
                                                            </i>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3">No data available</td>
                                            </tr>
                                        <?php endif; ?>
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
 <?php require('setting_policies_modal.php')?>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    var editList = document.querySelectorAll('.lists');
    var id = null;

    editList.forEach(function (listEvent) {
        listEvent.addEventListener("click", function () {
            id = this.getAttribute("data-id");
            var editListId = document.getElementById('edit-list-id');
            var editListElement = document.getElementById('edit-list');

            // Make an AJAX request to a PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "setting_policies_lists_row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the JSON response from the PHP script
                        var response = JSON.parse(xhr.responseText);

                        // Update the heading and caption with the received data
                        editListElement.value = response.description;
                        editListId.value = response.id;
                        console.log(xhr.responseText); // For debugging purposes
                    } else {
                        console.error("AJAX request failed with status:", xhr.status);
                    }
                }
            };
            // Send data to PHP script
            xhr.send("id=" + id);
        });
    });
});

</script>

<?php require('./layout/footer.php')?>

<?php require('../plugins/scripts.php')?>

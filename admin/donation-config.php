<?php 

session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

$sql = "SELECT * FROM donation_setting";

$result = mysqli_query($conn, $sql);
$data = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

// var_dump($data);

mysqli_close($conn);

?>

<?php require('./layout/header.php')?>
<?php require('nav_menu_setting.php')?>

<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Manage Donations</h1></div>
                <div class="group-input mt-3">
                    <a href="setting_donate.php" class="btn btn-kabarkadogs"><i></i>How can we help?</a>
                    <a class="btn btn-kabarkadogs" href="donation-config-add.php">
                        <i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add account
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        
                                        <th>image</th>
                                        <th>Account name</th>
                                        <th>Add instruction</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><img class="img-fluid" src="../uploads/<?php echo $row['account_img']; ?>" style="height: 150px;"/></td>
                                                <td><?php echo $row['account_name']; ?></td>
                                                <td><?php echo $row['instructions']; ?></td>
                                                   
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="donations-edit-config.php?id=<?php echo $row['id']?>" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <button class="border-0 color-red delete-donation" data-donation-id="<?php echo $row['id']; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this donation?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteButtons = document.querySelectorAll(".delete-donation");
    var confirmDeleteButton = document.getElementById("confirmDelete");
    var donationIdToDelete = null;

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            donationIdToDelete = this.getAttribute("data-donation-id");
        });
    });

    confirmDeleteButton.addEventListener("click", function () {
        console.log(donationIdToDelete);
        if (donationIdToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_donations_config.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting donation: " + xhr.responseText);
                }
            };
            xhr.send("donationId=" + encodeURIComponent(donationIdToDelete));
        }
        document.getElementById('close_modal').click();
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

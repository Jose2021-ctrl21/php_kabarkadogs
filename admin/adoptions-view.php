<?php
session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

// if (!isset($_GET['id'])) {
//     header('Location: deceased-animals.php');
//     exit(); 
// }

$id = $_GET['id'];
$id = intval($id);
// if ($id <= 0) {
//     header('Location: adoptions.php');
//     exit();
// }

$sql = "SELECT adoptions.*, statuses.name AS status_name, statuses.id AS status_id, animals.name AS animal_name, animals.picture AS animal_picture
FROM adoptions 
LEFT JOIN statuses ON adoptions.status_id = statuses.id 
LEFT JOIN animals ON  adoptions.animal_id = animals.id
WHERE adoptions.id = $id;";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];
        $age = $row['age'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $city = $row['city'];
        $barangay = $row['barangay'];
        $zip_code = $row['zip_code'];
        $outdoors_kept = $row['outdoors_kept'];
        $petscompanion = $row['petscompanion'];
        $petcompanion_other = $row['petcompanion_other'];
        $medicines_and_vaccinations = $row['medicines_and_vaccinations'];
        $personal_references = $row['personal_references'];
        $additional_information = $row['additional_information'];
        $created_date = $row['created_date'];
        $status_id = $row['status_id'];
        $image = $row['image'];
        $animal_name = $row['animal_name'];
        $animal_picture = $row['animal_picture'];
        // var_dump($row);
    }
}else{
    header('Location: adoptions.php');
    exit();
} 

$_sql = "SELECT * FROM statuses";
$_result = mysqli_query($conn, $_sql);
$_data = [];

if ($_result) {
    if (mysqli_num_rows($_result) > 0) {
        while ($row = mysqli_fetch_assoc($_result)) {
            $_data[] = $row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

$conn->close();
?>
<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php" class="active"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View Adoptions</h1></div>
                <!-- <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="product-add-new.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create New</a></div> -->
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #f1eada;">
                    <p><img class="img-fluid" src="../uploads/<?php echo $image?>" style="height: 150px;"/></p>
                    <h4 class="alert-heading color-kabarkadogs">Name: <strong><?php echo $first_name . ' ' . $middle_name . ' ' . $last_name?></strong></h4>
                    <p><img class="img-fluid" src="../uploads/<?php echo $animal_picture?>" style="height: 150px;"/></p>
                    <h4 class="alert-heading color-kabarkadogs">Animal adopted name: <strong><?php echo $animal_name;?></strong></h4>
                    <p class="color-kabarkadogs">Email: <a href="mailto:<?php echo $email?>" class="color-kabarkadogs"><strong><?php echo $email?></strong></a></p>
                    <p class="color-kabarkadogs">Phone Number: <strong><?php echo $phone ?></strong></p>
                    <p class="color-kabarkadogs">Age: <strong><?php echo $age ?></strong></p>
                    <p class="color-kabarkadogs">Address: <strong><?php echo $address?></strong></p>
                    <p class="color-kabarkadogs">City: <strong><?php echo $city?></strong></p>
                    <p class="color-kabarkadogs">Barangay: <strong><?php echo $barangay?></strong></p>
                    <p class="color-kabarkadogs">Zip: <strong><?php echo $zip_code?></strong></p>
                    <p class="color-kabarkadogs">Created Date: <strong><?php echo $created_date?></strong></p>
                    <p class="mb-0 color-kabarkadogs d-flex align-items-center mb-3">
                        <span>Status: </span>
                        <input type="hidden" class="adoption-id" value="<?php echo $id; ?>">
                        <select class="form-select ms-2" style="width: 200px">
                            <?php foreach ($_data as $roww): ?>
                                <option value="<?php echo $roww['id']?>" <?php echo $status_id === $roww['id'] ? 'selected' : ''?>><?php echo $roww['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <hr>
                    <p class="mb-0 color-kabarkadogs">When this pet is outdoors, how will he/she be kept? <strong><?php echo $outdoors_kept?></strong></p>
                    <p class="mb-0 color-kabarkadogs">Why do you want this pet? <strong><?php echo $petscompanion?></strong></p>
                    <p class="mb-0 color-kabarkadogs">If other, please explain: <strong><?php echo $petcompanion_other?></strong></p>
                    <p class="mb-0 color-kabarkadogs">Are you willing to provide your monthly/yearly medicines and vaccinations at your own expense? <strong><?php echo $medicines_and_vaccinations ?></strong></p>
                    <p class="mb-0 color-kabarkadogs">Please provide any two personal references NOT related to you: <strong><?php echo $personal_references ?></strong></p>
                    <p class="mb-0 color-kabarkadogs">Please include any information you would like for us to consider when reviewing your foster application approval: <strong><?php echo $additional_information ?></strong></p>
                    <hr>
                    <div class="d-flex">
                        <div class="action-button">
                            <button class="border-0 color-red delete-adoption" data-adoption-id="<?php echo $id; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                <i class="fa-solid fa-trash"></i>
                            </button>
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
        Are you sure you want to delete this adoption?
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
    var selectElements = document.querySelectorAll("select.form-select");
    var deleteButtons = document.querySelectorAll(".delete-adoption");
    var confirmDeleteButton = document.getElementById("confirmDelete");
    var adoptionIdToDelete = null;

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            adoptionIdToDelete = this.getAttribute("data-adoption-id");
        });
    });

    confirmDeleteButton.addEventListener("click", function () {
        console.log(adoptionIdToDelete);
        if (adoptionIdToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_adoptions.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting adoption: " + xhr.responseText);
                }
            };

            xhr.send("adoptionId=" + encodeURIComponent(adoptionIdToDelete));
        }
        document.getElementById('close_modal').click();
    });

    selectElements.forEach(function (selectElement) {
        selectElement.addEventListener("change", function () {
            var selectedStatusId = this.value;
            var adoptionId = this.closest(".alert").querySelector(".adoption-id").value;
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "_process_update_adoptions_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log("Status updated successfully.");
                } else {
                    console.error("Error updating status: " + xhr.responseText);
                }
            };

            xhr.send("adoptionId=" + encodeURIComponent(adoptionId) + "&selectedStatusId=" + encodeURIComponent(selectedStatusId));
        });
    });
});
</script>
<?php require('./layout/footer.php')?>
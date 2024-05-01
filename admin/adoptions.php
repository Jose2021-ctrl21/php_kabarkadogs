<?php 

session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

$searchName = '';

if(isset($_GET['name'])){
    $searchName = $_GET['name'];
}

// $sql = "SELECT * FROM adoptions WHERE first_name LIKE '%$searchName%';";
$sql = $sql = "SELECT adoptions.*, statuses.name AS status_name, statuses.id AS status_id FROM adoptions INNER JOIN statuses ON adoptions.status_id = statuses.id WHERE adoptions.first_name LIKE '%$searchName%';";


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

mysqli_close($conn);

?>
<?php require('./layout/header.php')?>
<?php require('nav_menu.php')?>

<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Manage Adoptions</h1></div>
                <!-- <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="adoption_stories_settings.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Adoption stories settings</a></div> -->
            </div>
            <!-- <div class="col-lg-12 mb-20">
                <div class="box">
                    <form method="get">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" placeholder="Search by name" name="name" value="
                                    <?php 
                                    // echo $searchName
                                    ?>"/>
                                </div>
                            </div>
                            <div class="col-lg-2"><button class="btn btn-kabarkadogs w-100" type="submit">Search</button></div>
                        </div>
                    </form>
                </div>
            </div> -->
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['middle_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td>
                                                    <input type="hidden" class="adoption-id" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" class="user-id" value="<?php echo $row['user_id']; ?>">
                                                    <select class="form-select">
                                                        <?php foreach ($_data as $roww): ?>
                                                            <option value="<?php echo $roww['id']?>" <?php echo $row['status_id'] === $roww['id'] ? 'selected' : ''?>><?php echo $roww['name']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="adoptions-view.php?id=<?php echo $row['id']?>" title="View" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <button class="border-0 color-red delete-adoption" data-adoption-id="<?php echo $row['id']; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
            var adoptionId = this.closest("tr").querySelector(".adoption-id").value;
            var userId = this.closest("tr").querySelector(".user-id").value;
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "_process_update_adoptions_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        alert(response.message);
                    } else {
                        alert("Failed to update status: " + response.message);
                    }
            };

            xhr.send("adoptionId=" + encodeURIComponent(adoptionId) + "&selectedStatusId=" + encodeURIComponent(selectedStatusId) + "&userId=" + encodeURIComponent(userId));
        });
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

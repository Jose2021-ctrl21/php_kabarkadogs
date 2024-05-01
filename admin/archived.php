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

$sql = "SELECT animals.*
FROM animals
LEFT JOIN deceased ON animals.id = deceased.animal_id
WHERE deceased.animal_id IS NULL and archive = 'yes'
AND animals.name LIKE '%$searchName%';";

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
<?php require('nav_menu.php')?>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-12 mb-20">
                <div class="box">
                    <form method="get">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" placeholder="Search by name" name="name" value="<?php echo $searchName?>"/>
                                </div>
                            </div>
                            <div class="col-lg-2"><button class="btn btn-kabarkadogs w-100" type="submit">Search</button></div>
                        </div>
                    </form>
                </div>
            </div> -->
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Manage archives</h1></div>
                <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="events-add.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add event</a></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>Image</th>
                                        <th>Animal Name</th>
                                        <th>Age</th>
                                        <th>Breed</th>
                                        <th>Sex</th>
                                        <th>Weight</th>
                                        <th>Color</th>
                                        <th>Mammal</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr data-animal-id="<?php echo $row['id']; ?>">
                                                <td>
                                                    <img 
                                                        src="../uploads/<?php echo $row['picture']; ?>"
                                                        alt="no image"
                                                        style="max-width:40px; max-height:40px;opacity: .8;border: 1px solid gray"
                                                        class="brand-image img-square elevation-2" width="40px" height="40px"
                                                    >
                                                </td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['age']; ?></td>
                                                <td><?php echo $row['breed']; ?></td>
                                                <td><?php echo $row['sex']; ?></td>
                                                <td><?php echo $row['weight']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td><?php echo $row['mammal']; ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <!-- <div class="action-button">
                                                            <a href="#.php?id=<?php echo $row['id']?>" title="View" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <a href="#.php?id=<?php echo $row['id']?>" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                                        </div> -->
                                                        <div class="action-button">
                                                            <button class="alert alert-success border-0 archive-animal" data-animal-id="<?php echo $row['id']; ?>" title="restore" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                                                <i class="fa-solid fa-undo"></i>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Restore</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to restore this animal?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-success" id="confirmRestore">restore</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var archiveButtons = document.querySelectorAll(".archive-animal");
    var confirmRestoreButton = document.getElementById("confirmRestore");
    var animalIdToarchive = null;

    archiveButtons.forEach(function (archiveButton) {
        archiveButton.addEventListener("click", function () {
            animalIdToarchive = this.getAttribute("data-animal-id");
        });
    });

    confirmRestoreButton.addEventListener("click", function () {
        console.log(animalIdToarchive);
        if (animalIdToarchive !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_restore_animal.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting animal: " + xhr.responseText);
                }
            };

            xhr.send("animalId=" + encodeURIComponent(animalIdToarchive));
        }
        document.getElementById('close_modal').click();
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

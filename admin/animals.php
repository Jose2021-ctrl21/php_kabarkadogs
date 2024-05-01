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
WHERE deceased.animal_id IS NULL and archive = 'no' ORDER BY animals.id DESC";

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
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Manage Animals</h1></div>
                <!-- <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="animals-home-carousel.php"><i class="fa-solid fa-home"></i>&nbsp;&nbsp;&nbsp;Home carousel setting</a></div> -->
                <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="animals-add.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Animal</a></div>
            </div>
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
                                                        <div class="action-button">
                                                            <a href="animals-view.php?id=<?php echo $row['id']?>" title="View" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <a href="animals-edit.php?id=<?php echo $row['id']?>" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <button class="border-0 color-red delete-animal" data-animal-id="<?php echo $row['id']; ?>" title="Archive" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                                                <i class="fa-solid fa-archive"></i>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Archive</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to archive this animal?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmArchive">Archive</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="homeCarousel" aria-labelledby="homeCarouselLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="homeCarouselLabel">Archive</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       CAROUSEL
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmArchive">Archive</button>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteButtons = document.querySelectorAll(".delete-animal");
    var confirmArchiveButton = document.getElementById("confirmArchive");
    var animalIdToDelete = null;

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            animalIdToDelete = this.getAttribute("data-animal-id");
        });
    });

    confirmArchiveButton.addEventListener("click", function () {
        console.log(animalIdToDelete);
        if (animalIdToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_animal.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting animal: " + xhr.responseText);
                }
            };

            xhr.send("animalId=" + encodeURIComponent(animalIdToDelete));
        }
        document.getElementById('close_modal').click();
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

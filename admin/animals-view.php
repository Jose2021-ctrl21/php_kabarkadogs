<?php
session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

if (!isset($_GET['id'])) {
    header('Location: animals.php');
    exit(); 
}

$id = $_GET['id'];
$id = intval($id);

if ($id <= 0) {
    header('Location: animals.php');
    exit();
}

$sql = "SELECT * from animals WHERE id = $id";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rescuedLocation = $row['rescued_location'];
        $rescuedDate = $row['rescued_date'];
        $storyLink = $row['story_link'];
        $picture = $row['picture'];
        $name = $row['name'];
        $breed = $row['breed'];
        $sex = $row['sex'];
        $weight = $row['weight'];
        $color = $row['color'];
        $mammal = $row['mammal'];
        $age = $row['age'];
    }
}else{
    header('Location: animals.php');
    exit();
}

?>

<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php" class="active"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View Animal</h1></div>
                <!-- <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="product-add-new.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create New</a></div> -->
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #f1eada;">
                    <p><img class="img-fluid" src="../uploads/<?php echo $picture?>" style="height: 150px;"/></p>
                    <h4 class="alert-heading color-kabarkadogs">Name: <?php echo $name ?></h4>
                    <p class="color-kabarkadogs">Age: <?php echo $age ?></p>
                    <p class="color-kabarkadogs">Breed: <?php echo $breed ?></p>
                    <p class="color-kabarkadogs">Sex: <?php echo $sex ?></p>
                    <p class="color-kabarkadogs">Weight: <?php echo $weight ?></p>
                    <p class="color-kabarkadogs">Color: <?php echo $color ?></p>
                    <p class="color-kabarkadogs">Type of pet: <?php echo $mammal ?></p>
                    <p class="color-kabarkadogs">Rescued date: <?php echo $rescuedDate ?></p>
                    <p class="color-kabarkadogs">Rescued Location: <?php echo $rescuedLocation ?></p>
                    <p class="color-kabarkadogs">Story link: <a href="<?php echo $storyLink ?>"> <?php echo $storyLink ?></p></a>
                    <hr>
                    <div class="d-flex">
                        <div class="action-button">
                            <a href="animals-edit.php?id=<?php echo $id ?>" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                        </div>
                        <div class="action-button">
                            <button class="border-0 color-red delete-animal" data-animal-id="<?php echo $id; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
        Are you sure you want to delete this animal?
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
    var deleteButtons = document.querySelectorAll(".delete-animal");
    var confirmDeleteButton = document.getElementById("confirmDelete");
    var animalIdToDelete = null;

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            animalIdToDelete = this.getAttribute("data-animal-id");
        });
    });

    confirmDeleteButton.addEventListener("click", function () {
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


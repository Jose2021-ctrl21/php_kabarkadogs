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

$sql = "SELECT * FROM events WHERE archive='no'";

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


$conn->close();
?>
<?php require('./layout/header.php') ?>
<?php require('nav_menu.php')?>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Manage events</h1></div>
                <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="events-add.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add event</a></div>
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
                <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']); // Unset the session message after displaying
                    }
                ?>
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr data-event-id="<?php echo $row['id']; ?>">
                                                <td><img src="../uploads/<?php echo $row['img']; ?>" alt="no image" alt="no image"
                                                        style="max-width:40px; max-height:40px;opacity: .8;border: 1px solid gray"
                                                        class="brand-image img-square elevation-2" width="40px" height="40px"></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="events-edit.php?id=<?php echo $row['id']?>" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <button class="border-0 color-red archive-event" data-event-id="<?php echo $row['id']; ?>" title="Archive" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
        Are you sure you want to delete this event?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-warning" id="confirmArchive">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var archiveButtons = document.querySelectorAll(".archive-event");
    var confirmArchiveButton = document.getElementById("confirmArchive");
    var eventIdToarchive = null;

    archiveButtons.forEach(function (archiveButton) {
        archiveButton.addEventListener("click", function () {
            eventIdToarchive = this.getAttribute("data-event-id");
            console.log(eventIdToarchive);
        });
    });

    confirmArchiveButton.addEventListener("click", function () {
        console.log(eventIdToarchive);
        if (eventIdToarchive !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error archiving event: " + xhr.responseText);
                }
            };

            xhr.send("eventId=" + encodeURIComponent(eventIdToarchive));
        }
        document.getElementById('close_modal').click();
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

<?php 
session_start();
require('php/connect.php');

$sql = "SELECT * FROM adoption_stories_settings";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }else
    $message = "No dogs image available";
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>


<?php require('./layout/header.php')?>

<?php require('nav_menu_setting.php')?>

<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Manage Adoptions</h1></div>
                <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']); // Unset the session message after displaying
                    }
                    ?>
                <div class="d-flex align-items-center"><a class="btn btn-kabarkadogs" href="adoption-stories-add.php"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Create new adopted</a></div>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Adoption date</th>
                                        <th>Adoption location</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td>
                                                    <img 
                                                        src="../uploads/<?php echo $row['img']; ?>"
                                                        alt="no image"
                                                        style="max-width:40px; max-height:40px;"
                                                        class="brand-image img-square elevation-2" width="40px" height="40px" style="opacity: .8;border: 1px solid gray">
                                                        &nbsp;
                                                        <i class="fa fa-edit edit-image" 
                                                        style="color: #15b4ed;position: absolute;" 
                                                        title="Edit Image" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editStoryModal" 
                                                        data-bs-image="<?= htmlentities($row['id']); ?>"
                                                    >
                                                </td> 
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['adoption_date']; ?></td>
                                                <td><?php echo $row['adoption_location']; ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <a href="adoption-stories-edit.php?id=<?php echo $row['id']?>" title="Edit" class="btn btn-success"><i class="fa-solid fa-edit"></i></a>
                                                        </div>
                                                        <div class="action-button">
                                                            <button class="border-0 btn btn-danger delete-adoption" data-adoption-id="<?php echo $row['id']; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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

<!-- EDIT IMAGE STORY -->
<div class="modal fade" id="editStoryModal" tabindex="-1" aria-labelledby="editStoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Edit image
                </h2>
                <form method="post" action="_process_edit_adoption_stories_image.php" enctype="multipart/form-data">
                    <div class="mb-6 row">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Image <span class="required">*</span></label>
                        <!-- Use PHP to echo the value of $row['id'] -->
                        <input type="hidden" name="image_id" id="image_id">
                        <div class="col-lg-10 col-sm-12">
                            <input type="file" class="form-control" id="img" name="img" accept="image/*"/>
                        </div>
                        
                    </div>
                <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn btn-kabarkadogs" id="saveImage">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE STORY -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this story?
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
    var deleteButtons = document.querySelectorAll(".delete-adoption");
    var editImageButtons = document.querySelectorAll(".edit-image");
    var confirmDeleteButton = document.getElementById("confirmDelete");
    var saveImage = document.getElementById("saveImage");
    var adoptionStoryIdToDelete = null;
    var adoptionStoryIdImageToEdit = null;

    editImageButtons.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            adoptionStoryIdImageToEdit = this.getAttribute("data-bs-image");
            var imageId = document.getElementById("image_id");
            imageId.value = adoptionStoryIdImageToEdit;

            console.log(adoptionStoryIdImageToEdit+" "+imageId.value);
        });
    });


    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            adoptionStoryIdToDelete = this.getAttribute("data-adoption-id");
            console.log(adoptionStoryIdToDelete);
        });
    });

    
    // DELETE
    confirmDeleteButton.addEventListener("click", function () {
        console.log(adoptionStoryIdToDelete);
        if (adoptionStoryIdToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_adoption_story.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting adoption: " + xhr.responseText);
                }
            };

            xhr.send("adoptionStoryId=" + encodeURIComponent(adoptionStoryIdToDelete));
        }
        document.getElementById('close_modal').click();
    });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

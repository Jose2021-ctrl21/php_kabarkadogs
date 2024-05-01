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

$sql = "SELECT * FROM home_carousel";

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
            
            <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']); // Unset the session message after displaying
                }
            ?>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="col-lg-12 d-flex justify-content-between">
                            <div><h2 class="title">Carousel</h1></div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-kabarkadogs fa fa-edit edit-image"
                                        title="Edit Image" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#addImageCarousel" 
                                        data-bs-image="<?= htmlentities($row['id']); ?>"><i>Add</i>
                                    </button>
                                </div>
                        </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead class="table-light">
                                        <th>id</th>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Caption</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row): ?>
                                            <tr data-animal-id="<?php echo $row['id']; ?>">
                                                <td><?php echo $row['id']; ?></td>
                                                <td>
                                                    <img 
                                                        src="../uploads/<?php echo $row['img']; ?>"
                                                        alt="no image"
                                                        style="max-width:40px; max-height:40px;opacity: .8;border: 1px solid gray"
                                                        class="brand-image img-square elevation-2" width="40px" height="40px"
                                                    >
                                                </td> 
                                                <td><?php echo $row['heading']?></td>
                                                <td><?php echo $row['caption']?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button">
                                                            <button class="border-0 btn btn-success edit-home-carousel" data-carousel-id="<?php echo $row['id']; ?>" title="Edit home carousel image" data-bs-toggle="modal" data-bs-target="#editHomeCarousel" type="button">
                                                                <i class="fa-solid fa-edit"></i>
                                                            </button>
                                                        </div>
                                                        <div class="action-button">
                                                            <button class="border-0 btn btn-danger delete-carousel-img" data-carousel-id="<?php echo $row['id']; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
<?php include "animals-home-carousel-modal.php";?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteCarouselImg = document.querySelectorAll(".delete-carousel-img");
    var editCarouselImg = document.querySelectorAll(".edit-home-carousel");
    var confirmDeleteButton = document.getElementById("confirmDelete");
    var updateButton = document.getElementById("update");
    var carouselImgToDelete = null;
    var carouselImgToEdit = null;

    deleteCarouselImg.forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function () {
            carouselImgToDelete = this.getAttribute("data-carousel-id");
            console.log(carouselImgToDelete);
        });
    });

    // edit
    editCarouselImg.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            var carouselImgToEdit = this.getAttribute("data-carousel-id");
            var $heading = document.getElementById('edit-heading');
            var $caption = document.getElementById('edit-caption');
            var $img = document.getElementById('edit-img');
            var $id = document.getElementById('edit-img-id');

            // Make an AJAX request to a PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "animals-home-carousel-row.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Parse the JSON response from the PHP script
                    var response = JSON.parse(xhr.responseText);
                    
                    // Update the heading and caption with the received data
                    $heading.value = response.heading;
                    $caption.value = response.caption;
                    $img.value = response.img;
                    $id.value = response.id;
                    console.log(xhr.responseText); // For debugging purposes
                }
            };
            // Send data to PHP script
            xhr.send("carouselImgToEdit=" + carouselImgToEdit);
        });
    });
    // edit



    // DELETE
    confirmDeleteButton.addEventListener("click", function () {
        console.log(carouselImgToDelete);
        if (carouselImgToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "_process_delete_home_carousel.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error("Error deleting animal: " + xhr.responseText);
                }
            };

            xhr.send("carouselId=" + encodeURIComponent(carouselImgToDelete));
        }
        document.getElementById('close_modal').click();
    });


    // var fileInput = document.getElementById("imgxxx");
    // updateButton.addEventListener("click", function () {
    //     console.log(carouselImgToEdit + "oooo");
    //     if (carouselImgToEdit !== null) {
    //         if (fileInput.files.length > 0) {
    //             var file = fileInput.files[0];
    //             var formData = new FormData();
    //             formData.append("editCarouselId", carouselImgToEdit);
    //             formData.append("imgxxx", file);
    //             if (formData.has("editCarouselId") && formData.has("imgxxx")) {
    //                 var xhr = new XMLHttpRequest();
    //                 xhr.open("POST", "_process_edit_home_carousel.php", true);
    //                 xhr.onload = function () {
    //                     if (xhr.status === 200) {
    //                         alert("SUCCESSFUL");
    //                         location.reload();
    //                     } else {
    //                         console.error("Error updating image: " + xhr.responseText);
    //                     }
    //                 };
    //                 console.log(file.name+"___"+carouselImgToEdit);
    //                 xhr.send(formData);
    //             } else {
    //                 console.error("Both editCarouselId and imgxxx are required.");
    //             }
    //         } else {
    //             console.error("No file selected.");
    //         }
    //     }
    //     document.getElementById('close_modal').click();
    // });
});
</script>
<?php require('./layout/footer.php')?>
<?php require('../plugins/scripts.php')?>

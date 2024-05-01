<!-- ADD MODAL -->
<div class="modal fade" id="addOwnerProfile" tabindex="-1" aria-labelledby="addOwnerProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Add owner's profile
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_add_owner_profile.php" enctype="multipart/form-data">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="mb-6 row">
                        <label for="owner-image" class="col-sm-12 col-lg-6 col-form-label">Image: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="file" class="form-control" id="owner-image" name="owner-image" accept="image/*"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="name" class="col-sm-12 col-lg-6 col-form-label">Name: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="name" name="name"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="position" class="col-sm-12 col-lg-6 col-form-label">Position: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="position" name="position"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="date-established" class="col-sm-12 col-lg-6 col-form-label">Date stablished: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="date" class="form-control" id="date-established" name="date-established"/>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn btn-kabarkadogs">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT IMAGE MODAL -->
<div class="modal fade" id="editOwnerProfile" tabindex="-1" aria-labelledby="editOwnerProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Edit owner's profile
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_edit_owner_profile_image.php" enctype="multipart/form-data">
                    <div class="mb-6 row">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Image profile <span class="required">*</span></label>
                        <!-- Use PHP to echo the value of $row['id'] -->
                        <input type="hidden" name="image_id" id="image_id">
                        <div class="col-lg-10 col-sm-12">
                            <input type="file" class="form-control" id="img" name="img" accept="image/*"/>
                        </div>
                        
                    </div>
                <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn btn-kabarkadogs">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT INFO MODAL -->
<div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Kabarkadogs owner's profile
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_edit_owner_profile_info.php">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <input type="hidden" id="infoId" name="infoId">
                    <div class="mb-6 row">
                        <label for="name" class="col-sm-12 col-lg-6 col-form-label">Name: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-name" name="name"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="position" class="col-sm-12 col-lg-6 col-form-label">Position: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-position" name="position"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="date-established" class="col-sm-12 col-lg-6 col-form-label">Date stablished: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="date" class="form-control" id="edit-date-established" name="date-established"/>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn btn-kabarkadogs">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE PROFILE MODAL -->
<div class="modal fade" id="deleteInfo" tabindex="-1" aria-labelledby="deleteInfoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteInfoLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this row?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
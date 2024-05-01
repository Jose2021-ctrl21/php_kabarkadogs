<!-- ADD POLICY MODAL -->
<div class="modal fade" id="addOwnerProfile" tabindex="-1" aria-labelledby="addOwnerProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Add Policy
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_add_policy.php" enctype="multipart/form-data">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="mb-6 row">
                        <label for="add-img" class="col-sm-12 col-lg-6 col-form-label">Image: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="file" class="form-control" id="add-img" name="add-img" accept="image/*"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="add-republic" class="col-sm-12 col-lg-6 col-form-label">Republic act: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="add-republic" name="add-republic"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="add-title" class="col-sm-12 col-lg-6 col-form-label">Title: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="add-title" name="add-title"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="add-subtitle" class="col-sm-12 col-lg-6 col-form-label">Subtitle: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="add-subtitle" name="add-subtitle"/>
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

<!-- EDIT IMAGE POLICY -->
<div class="modal fade" id="editOwnerProfile" tabindex="-1" aria-labelledby="editOwnerProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Edit image policy
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_edit_setting_policies_img.php" enctype="multipart/form-data">
                    <div class="mb-6 row">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Image <span class="required">*</span></label>
                        <!-- Use PHP to echo the value of $row['id'] -->
                        <input type="hidden" id="img-id" name="image_id">
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

<!-- EDIT POLICY MODAL -->
<div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Edit Policy
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_edit_setting_policies.php" enctype="multipart/form-data">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="mb-6 row">
                        <input type="hidden" class="form-control" id="edit-id" name="edit-id"/>
                        <label for="edit-republic" class="col-sm-12 col-lg-6 col-form-label">Republic act: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-republic" name="edit-republic"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="edit-title" class="col-sm-12 col-lg-6 col-form-label">Title: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-title" name="edit-title"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="edit-subtitle" class="col-sm-12 col-lg-6 col-form-label">Subtitle: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea class="form-control" id="edit-subtitle" name="edit-subtitle"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn btn-kabarkadogs" id="confirmUpdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- DELETE POLICY MODAL -->
<!-- DELETE -->
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

<!-- ADD LISTS MODAL -->
<div class="modal fade" id="addLists" tabindex="-1" aria-labelledby="addListsLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                   Add list
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <?php

                // Check if the 'id' is present in the $_GET array and set it in a session variable
                if(isset($_GET['id'])) {
                    unset($_SESSION['id']);
                    $_SESSION['id'] = $_GET['id'];
                }
                ?>
                <form method="post" action="_process_add_lists.php" enctype="multipart/form-data">
                    <div class="mb-6 row">
                        <!-- Use PHP to echo the value of $row['id'] -->
                        <input type="hidden" name="policy-id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Content<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea class="form-control" id="add-list" name="add-list"></textarea>
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

<!-- EDIT LISTS MODAL -->
<div class="modal fade" id="editList" tabindex="-1" aria-labelledby="editListLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                   Edit list
                </h2>
                <form method="post" action="_process_edit_setting_policies_lists.php">
                    <div class="mb-6 row">
                        <!-- Use PHP to echo the value of $row['id'] -->
                        <input type="hidden" id="edit-list-id" name="edit-list-id">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Content<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea class="form-control" id="edit-list" name="edit-list"></textarea>
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
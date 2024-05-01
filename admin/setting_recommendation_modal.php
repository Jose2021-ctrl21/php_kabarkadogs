
<!-- EDIT IMAGE recommendation -->
<div class="modal fade" id="editRecommendationImage" tabindex="-1" aria-labelledby="editRecommendationImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Edit image recommendation
                </h2>
                <center>
                    <!-- <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p> -->
                </center>
                <form method="post" action="_process_edit_recommendation_img.php" enctype="multipart/form-data">
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

<!-- EDIT recommendation MODAL -->
<div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                        Edit recommendation
                    </h2>
                    <form method="post" action="_process_edit_recommendation.php" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="recommendation_id" name="recommendation_id"/>
                    <div class="mb-6 row">
                        <label for="small-title" class="col-sm-12 col-lg-6 col-form-label">Small title: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-small-title" name="small-title"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="title" class="col-sm-12 col-lg-6 col-form-label">Title: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-title" name="title"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="description" class="col-sm-12 col-lg-6 col-form-label">Description: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-description" name="description"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="map-name" class="col-sm-12 col-lg-6 col-form-label">Map name: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-map-name" name="map-name"/>
                        </div>
                    <div class="mb-6 row">
                        <label for="map-link" class="col-sm-12 col-lg-6 col-form-label">Map link: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-map-link" name="map-link"/>
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
</div>


<!-- DELETE recommendation MODAL -->
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


<!-- ADD MODAL -->
<div class="modal fade" id="addOwnerProfile" tabindex="-1" aria-labelledby="addOwnerProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Add recommendation
                </h2>
                <form method="post" action="_process_add_recommendation.php" enctype="multipart/form-data">
                    <div class="mb-6 row">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Image: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="file" class="form-control" id="img" name="img" accept="image/*"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="small-title" class="col-sm-12 col-lg-6 col-form-label">Small title: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="small-title" name="small-title"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="title" class="col-sm-12 col-lg-6 col-form-label">Title: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="title" name="title"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="description" class="col-sm-12 col-lg-6 col-form-label">Description: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="description" name="description"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="map-name" class="col-sm-12 col-lg-6 col-form-label">Map name: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="map-name" name="map-name"/>
                        </div>
                    <div class="mb-6 row">
                        <label for="map-link" class="col-sm-12 col-lg-6 col-form-label">Map link: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="map-link" name="map-link"/>
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

<!-- ADD -->
<div class="modal fade" id="addImageCarousel" tabindex="-1" aria-labelledby="addImageCarouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                   Add image carousel
                </h2>
                <form method="post" action="_process_add_home_carousel.php" enctype="multipart/form-data">
                    <div class="mb-6 row">
                        <label for="img" class="col-sm-12 col-lg-6 col-form-label">Image profile <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="file" class="form-control" id="img" name="img" accept="image/*"/>
                        </div>
                        
                    </div>
                    <div class="mb-6 row">
                        <label for="add-heading" class="col-sm-12 col-lg-6 col-form-label">Heading<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="add-heading" name="add-heading"/>
                        </div>
                        
                    </div>
                    <div class="mb-6 row">
                        <label for="add-caption" class="col-sm-12 col-lg-6 col-form-label">Caption<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="add-caption" name="add-caption"/>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn btn-kabarkadogs" name="add">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>


<!-- Edit -->
<div class="modal fade" id="editHomeCarousel" tabindex="-1" aria-labelledby="editHomeCarouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                   Add image carousel
                </h2>
                <form method="post" action="_process_edit_home_carousel.php" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="edit-img-id" name="edit-img-id"/>

                    <div class="mb-6 row">
                        <label for="imgxxx" class="col-sm-12 col-lg-6 col-form-label">Image profile <span class="required">*</span></label>
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-sm-12">
                                <input type="file" class="form-control" id="imgxxx" name="imgxxx" accept="image/*"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="edit-img" class="col-sm-12 col-lg-6 col-form-label">Image value<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="hidden" class="form-control" id="edit-img" name="edit-img"/>
                        </div>
                    </div>
                    <div class="mb-6 row">
                        <label for="edit-heading" class="col-sm-12 col-lg-6 col-form-label">Heading<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-heading" name="edit-heading"/>
                        </div>
                        
                    </div>
                    <div class="mb-6 row">
                        <label for="edit-caption" class="col-sm-12 col-lg-6 col-form-label">Caption<span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" id="edit-caption" name="edit-caption"/>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">Close</button>
                        <button type="submit" class="btn btn-success" name="update-carousel">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- DELETE -->
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
<!-- ADD MODAL -->
<div class="modal fade" id="addOwnerProfile" tabindex="-1" aria-labelledby="addOwnerProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-mm"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Add question and answer
                </h2>
                <form method="post" action="_process_add_faqs.php">
                    <input type="text" class="form-control" id="qa-id" name="qa-id"/>
                    <div class="mb-6 row">
                        <label for="question" class="col-sm-12 col-lg-6 col-form-label">Question: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea type="text" class="form-control" id="question" name="question" cols="30" rows="6"></textarea>
                        </div> 
                    </div>
                    <div class="mb-6 row">
                        <label for="answer" class="col-sm-12 col-lg-6 col-form-label">Answer: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea type="text" class="form-control" id="answer" name="answer" cols="30" rows="6"></textarea>
                        </div> 
                    </div>
                    <div class="mt-5 mb-4 row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <button class="btn btn-kabarkadogs">Save</button>
                        </div>
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
                    Add question and answer
                </h2>
                <form method="post" action="_process_edit_faqs_lists.php">
                    <input type="text" class="form-control" id="qa" name="qa-id"/>
                    <div class="mb-6 row">
                        <label for="edit-question" class="col-sm-12 col-lg-6 col-form-label">Question: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea type="text" class="form-control" id="edit-question" name="edit-question" cols="30" rows="6"></textarea>
                        </div> 
                    </div>
                    <div class="mb-6 row">
                        <label for="edit-answer" class="col-sm-12 col-lg-6 col-form-label">Answer: <span class="required">*</span></label>
                        <div class="col-lg-10 col-sm-12">
                            <textarea type="text" class="form-control" id="edit-answer" name="edit-answer" cols="30" rows="6"></textarea>
                        </div> 
                    </div>
                    <div class="mt-5 mb-4 row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <button type="submit" name="submit" class="btn btn-kabarkadogs">Save</button>
                        </div>
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
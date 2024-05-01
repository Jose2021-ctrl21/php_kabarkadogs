
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Enlarge modal width -->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2 class="fw-normal lh-1 color-kabarkadogs pt-3 fw-semibold text-center">
                    Foster Application Form
                </h2>
                <center>
                    <p class="lead color-kabarkadogs pt-4 text-center color-kabarkadogs-gold fw-medium" style="max-width: 600px">
                        KabarkaDogs Foster Application Form. Completing this application is the best way to ensure a positive experience for both you and the pets.
                    </p>
                </center>
                <form class="row g-3" method="post" action="_process_adoptions.php" enctype="multipart/form-data">
                        <input type="hidden" name="pet" id="to-adopt-pet-id">
                        <div class="col-md-3">
                            <label for="first_name" class="form-label">Your Picture:</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                        <div class="col-md-3">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="col-md-3">
                            <label for="middle_name" class="form-label">Middle Name:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="col-md-3">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="col-md-2">
                            <label for="age" class="form-label">Age:</label>
                            <input type="text" class="form-control" id="age" name="age">
                        </div>
                        <div class="col-md-5">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-5">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">House/Street/No.:</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">City:</label>
                            <select id="inputCity" class="form-select" name="city">
                                <option value="select" selected>-Select City-</option>
                                <option value="Cavite City">Cavite City</option>
                                <option value="Kawit, Cavite">Kawit, Cavite</option>
                                <option value="Noveleta, Cavite">Noveleta, Cavite</option>
                                <option value="Rosario, Cavite">Rosario, Cavite</option>
                                <option value="Bacoor City">Bacoor City</option>
                                <option value="Imus City">Imus City</option>
                                <option value="Dasmarinas City">Dasmarinas City</option>
                                <option value="Carmona, Cavite">Carmona, Cavite</option>
                                <option value="General Mariano Alvarez, Cavite">General Mariano Alvarez, Cavite</option>
                                <option value="General Trias City">General Trias City</option>
                                <option value="Silang, Cavite">Silang, Cavite</option>
                                <option value="Amadeo, Cavite">Amadeo, Cavite</option>
                                <option value="Indang, Cavite">Indang, Cavite</option>
                                <option value="Tanza, Cavite">Tanza, Cavite</option>
                                <option value="Tagaytay, Cavite">Tagaytay, Cavite</option>
                                <option value="Alfonso, Cavite">Alfonso, Cavite</option>
                                <option value="General Emilio Aguinaldo, Cavite">General Emilio Aguinaldo, Cavite</option>
                                <option value="Magallanes, Cavite">Magallanes, Cavite</option>
                                <option value="Maragondon, Cavite">Maragondon, Cavite</option>
                                <option value="Mendez, Cavite">Mendez, Cavite</option>
                                <option value="Naic, Cavite">Naic, Cavite</option>
                                <option value="Ternate, Cavite">Ternate, Cavite</option>  
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="barangay" class="form-label">Barangay:</label>
                            <select id="barangay" class="form-select" name="barangay">
                                <!-- <option selected>-Select Barangay-</option>   -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="zip_code" class="form-label">Zip:</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" readonly>
                        </div>
                        <div class="col-12">
                            <label for="kept" class="form-label">When this pet is outdoors, how will he/she be kept? (fence, chain, line, kennel etc.):</label>
                            <input type="text" class="form-control" id="kept" name="outdoors_kept">
                        </div>
                        <div class="col-12">
                            <label for="petcompanion" class="form-label">Why do you want this pet?:</label>
                            <select id="petcompanion" name="petscompanion" class="form-select">
                                <option value="Companion for child">Companion for child</option>
                                <option value="Companion for other pets">Companion for other pets</option>
                                <option value="Companion for self">Companion for self</option>
                                <option value="Security">Security</option>
                                <option value="House pet">House pet</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="petcompanion_other" class="form-label">If other, please explain:</label>
                            <input type="text" class="form-control" id="petcompanion_other" name="petcompanion_other">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Are you willing to provide your monthly/yearly medicines and vaccinations at your own expense?:</label>
                            <select id="willing_to_provide" class="form-select" name="medicines_and_vaccinations">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="two_personal" class="form-label">Please provide any two personal references NOT related to you:</label>
                            <input type="text" class="form-control" id="two_personal" name="personal_references">
                        </div>
                        <div class="col-12">
                            <label for="information" class="form-label">Please include any information would you like for us to consider when reviewing your foster application approval:</label>
                            <input type="text" class="form-control" id="information" name="additional_information">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck" name="agree_terms_and_conditions">
                                <label class="form-check-label" for="gridCheck">
                                    I agree with The KabarkaDogs terms and conditions.
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-kabarkadogs">Submit</button>
                        </div>
                        </form>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->
<script>
$(document).ready(function() {
    $('#exampleModal form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '_process_adoptions.php',
            data: formData,
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while processing your request. Please try again later.');
            }
        });
    });
});
</script>
<script src="places.js"></script>
<script>
    function checkLogin(event) {
        event.preventDefault();
        var animalId = event.target.getAttribute('data-animal-id');
        var toAdoptPetId = document.getElementById('to-adopt-pet-id');
        console.log(animalId);
        toAdoptPetId.value = animalId;
        console.log(toAdoptPetId);
    }
</script>
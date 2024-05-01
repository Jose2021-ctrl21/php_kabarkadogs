<?php 
session_start();
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Book Appointment</h1>
            <hr class="featurette-divider" />
        </div>
    </div>

    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-lg-6">
            <p class="lead color-kabarkadogs fw-bold">
              Contact Us
            </p>
            <p class="lead color-kabarkadogs">
              Please use the form to message us. Because of the number of messages we receive everyday, please give us a few days to respond. Our messages are checked by volunteers during their spare time.
            </p>
            <p class="lead color-kabarkadogs mt-3">
              Please use the form to message us. Because of the number of messages we receive everyday, please give us a few days to respond. Our messages are checked by volunteers during their spare time.
            </p>
            <p class="lead color-kabarkadogs mt-3">
              <i class="fa-solid fa-phone" style="font-size: 18px"></i>
              Phone: 0917 716 7271
            </p>
            <p class="lead color-kabarkadogs">
              <i class="fa-solid fa-envelope" style="font-size: 18px"></i>
              Email: thekabarkadogs@gmail.com
            </p>
          </div>
          <div class="col-lg-6 justify-content-center d-flex">
            <div class="modal-content rounded-4 shadow">
              <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2 color-kabarkadogs">Book Appointment</h1>
              </div>
              <div class="modal-body p-5 pt-0">
                <form method="POST" action="_process_booking.php">
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingone" placeholder="Your Name" name="name">
                        <label for="floatingone">Your Name</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" id="floatingtwo" placeholder="Your Email Address" name="email">
                        <label for="floatingtwo">Your Email Address</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingthree" placeholder="Phone Number" name="phone_number">
                        <label for="floatingthree">Phone Number</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-floating mb-3">
                        <input type="date" class="form-control rounded-3" id="floatingfour" placeholder="Date" name="date_of_appointment">
                        <label for="floatingfour">Date</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="mb-3">
                        <!-- <select class="form-select" aria-label="Time" name="time">
                          <option selected disabled>Time</option>
                          <option value="Breakfast">Breakfast</option>
                          <option value="Lunch">Lunch</option>
                          <option value="Dinner">Dinner</option>
                        </select> -->
                        <input type="time" name="time" class="form-control" placeholder="hour:minute AM/PM"/>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Message" name="message"></textarea>
                      </div>
                    </div>
                  </div>
                  <button class="w-100 mb-2 btn btn-lg rounded-3 btn-kabarkadogs" type="submit">Book now</button>
                </form>
              </div>
            </div>
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>

<?php require('./layout/footer.php')?>
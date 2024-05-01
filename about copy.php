<?php 
session_start();
require('php/connect.php');

// PROFILE FETCH
$sql = "SELECT * FROM profile_setting";
$result = mysqli_query($conn, $sql);
if($result){
    if(mysqli_num_rows($result)>0){
        $rows = mysqli_fetch_assoc($result);
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}

// DONATE, COSTS, FUNDING FETCH
$sql_dcf = "SELECT * FROM dcf";
$result_dcf = mysqli_query($conn, $sql_dcf);
$rows_dcf = []; // Initialize an empty array
if($result_dcf){
    while($row = mysqli_fetch_assoc($result_dcf)){ // Fetch each row and add to the array
        $rows_dcf[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}

?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">About Us</h1>
            <hr class="featurette-divider" />
        </div>
    </div>
    
    <!-- <div class="bg-kabarkadogs-2 marketing section-padding-top"> -->
    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
      <div class="row featurette">
        <div class="col-md-7 d-flex justify-content-center">
          <img src="assets/images/dogs.png" alt="gcash" class="img-fluid rounded" width="700">
        </div>
        <div class="col-md-5">
          <h3 class="color-kabarkadogs-gold">About Us</h3>
          <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs mb-4">
            The KabarkaDogs
          </h2>
          <div>
            <?php foreach($rows_dcf as $row):?>
            <ul class="nav nav-tabs" id="donationTabs" role="tablist">
              <li class="nav-item col-4 text-center" role="presentation">
                <a class="nav-link active" id="donate-tab" data-bs-toggle="tab" href="#donate" role="tab" aria-controls="donate" aria-selected="true">Donate</a>
              </li>
              <li class="nav-item col-4 text-center" role="presentation">
                <a class="nav-link" id="costs-tab" data-bs-toggle="tab" href="#costs" role="tab" aria-controls="costs" aria-selected="false">Costs</a>
              </li>
              <li class="nav-item col-4 text-center" role="presentation">
                <a class="nav-link" id="funding-tab" data-bs-toggle="tab" href="#funding" role="tab" aria-controls="funding" aria-selected="false">Funding</a>
              </li>
            </ul>
            <div class="tab-content" id="donationTabContent">
              <div class="tab-pane fade show active" id="donate" role="tabpanel" aria-labelledby="donate-tab">
                <div class="col-12">
                  <p class="color-kabarkadogs mt-4">
                    We promote responsible pet ownership and reimpose the Animal Welfare Laws. The Kabarkadogs is also run a CAWAG Inc. It currently houses over 39 cats and 47 dogs estimated rescued from cruelty or neglect. Here, these animals are rehabilitated in the hope of finding the new homes and a second chance at a good life.
                  </p>  
                </div>
              </div>
              <div class="tab-pane fade" id="costs" role="tabpanel" aria-labelledby="costs-tab">
                <div class="col-12">
                  <p class="color-kabarkadogs mt-4">
                    Eliminate animal discrimination and for them to be free from any human cruelty. To build a community where people value animals and treat them with respect and kindness.
                  </p>  
                </div>
              </div>
              <div class="tab-pane fade" id="funding" role="tabpanel" aria-labelledby="funding-tab">
                <div class="col-12">
                  <p class="color-kabarkadogs mt-4">
                    Rehabilitate and Rehome our Rescues. To advance the safety and well-being of animals.
                  </p>  
                </div>
              </div>
            </div>
            <?php endforeach ?>
          </div>
          
        </div>
        <hr class="featurette-divider" />
        <div class="row featurette">
          <div class="col-12 d-flex align-items-center flex-column pb-5">
            <h3 class="color-kabarkadogs-gold fw-normal">Meet Our Team</h3>
            <h2 class="featurette-heading fw-bolder lh-1 color-kabarkadogs">
              The KabarkaDogs Awesome Teams
            </h2>
          </div>
          <div class="profile-card shadow">
            <img src="uploads/<?php echo !empty($rows['img']) ? $rows['img'] : 'profile.png'; ?>" alt="owner">
            <h1><?php echo !empty($rows['name']) ? $rows['name'] : 'John Doe'; ?></h1>
            <p class="title"><?php echo !empty($rows['position']) ? $rows['position'] : 'Position'; ?></p>
            <p><?php echo !empty($rows['date_established']) ? $rows['date_established'] : 'Date established'; ?></p>
            <div class="footer">
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
            </div>
            <!-- <p><button>Contact</button></p> -->
        </div>
      </div>
      <!-- CAROUSEL -->
      <center>
            <h4 class="featurette-heading fw-bolder lh-1 color-kabarkadogs mt-5">
             MEMBERS
            </h4>
      </center>
          <div id="myCarousel" class="carousel carousel-dark slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active p-5">
                <div class="container">
                  <div class="row featurette">
                    <div class="col-12 d-flex justify-content-center">
                      <img
                        src="assets/images/team.jpg"
                        alt="gcash"
                        class="img-fluid rounded"
                        width="300"
                      />
                    </div>
                  </div>
                </div>
            </div>
            <div class="carousel-item p-5">
                <div class="container">
                  <div class="row featurette">
                    <div class="col-12 d-flex justify-content-center">
                      <img
                        src="assets/images/team2.jpg"
                        alt="gcash"
                        class="img-fluid rounded"
                        width="300"
                      />
                    </div>
                  </div>
                </div>
            </div>
            <div class="carousel-item p-5">
                <div class="container">
                  <div class="row featurette">
                    <div class="col-12 d-flex justify-content-center">
                      <img
                        src="assets/images/team3.jpg"
                        alt="gcash"
                        class="img-fluid rounded"
                        width="300"
                      />
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
      </div>
      </div>
      <!-- CAROUSEL -->
        </div>
        <hr class="featurette-divider" />
        </div>
      </div>
    </div>

<?php require('./layout/footer.php')?>
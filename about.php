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


// CAROUSEL MEMBERS FETCH
$sql_members = "SELECT * FROM profile_setting AS members";
$result_members = mysqli_query($conn, $sql_members);
if($result_members){
    if(mysqli_num_rows($result_members)>0){
        $rows_members = mysqli_fetch_assoc($result_members);
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
        <?php foreach($rows_dcf as $row):?>
        <div class="col-md-7 d-flex justify-content-center">
          <img src="uploads/<?php echo $row['img']?>" alt="gcash" class="img-fluid rounded" width="700">
        </div>
        <div class="col-md-5">
          <h3 class="color-kabarkadogs-gold">About Us</h3>
          <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs mb-4">
            The KabarkaDogs
          </h2>
          <div>
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
                  <p class="color-kabarkadogs mt-4" style="text-align: justify !important;">
                      <?php echo $row['donate']?>
                  </p>  
                </div>
              </div>
              <div class="tab-pane fade" id="costs" role="tabpanel" aria-labelledby="costs-tab">
                <div class="col-12">
                  <p class="color-kabarkadogs mt-4" style="text-align: justify !important;">
                      <?php echo $row['costs']?>
                  </p>  
                </div>
              </div>
              <div class="tab-pane fade" id="funding" role="tabpanel" aria-labelledby="funding-tab">
                <div class="col-12">
                  <p class="color-kabarkadogs mt-4" style="text-align: justify !important;">
                      <?php echo $row['funding']?>
                  </p>  
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>

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
                <a href="https://youtube.com/@thekabarkadogs4399?si=QC9mME506esUGCJN"><i class="fab fa-youtube"></i></a>
                <!-- <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a> -->
                <a href="https://www.facebook.com/TheKabarkaDogs?mibextid=ZbWKwL"><i class="fab fa-facebook"></i></a>
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
            <div class="carousel-inner">
                <?php 
                $first = true; // Flag to track the first item
                while($rows_members = mysqli_fetch_assoc($result_members)): 
                    $active_class = $first ? 'active' : ''; // Assign 'active' class only to the first item
                ?>
                    <div class="carousel-item <?php echo $active_class; ?> p-5">
                        <div class="container">
                            <div class="row featurette">
                                <div class="col-12 d-flex justify-content-center">
                                    <img src="uploads/<?php echo !empty($rows_members['img']) ? $rows_members['img'] : 'profile.png'; ?>" alt="gcash" class="img-fluid rounded" width="300">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $first = false; // Update the flag after the first item
                endwhile; 
                ?>
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
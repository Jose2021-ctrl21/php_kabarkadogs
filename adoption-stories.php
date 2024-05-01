<?php 
session_start();
require('php/connect.php');

$sql = "SELECT * FROM adoption_stories_settings";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }else
    $message = "No dogs image available";
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>


<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Adoption Stories</h1>
            <hr class="featurette-divider" />
        </div>
    </div>

      <!-- this partt -->
      <div id="myCarousel" class="carousel carousel-dark slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div> -->
        <?php if(mysqli_num_rows($result) > 0) {?>
        <div class="carousel-inner">
        <?php foreach ($data as $index => $row): ?>
            <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                <div class="container p-5">
                  <div class="row featurette">
                    <div class="col-md-5">
                      <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs pt-3 pb-5">
                      <?php echo $row['name']; ?>
                      </h2>
                      <p class="lead color-kabarkadogs">
                        <span class="fw-semibold">Adoption Date: </span> <?php echo $row['adoption_date']; ?>
                      </p>
                      <p class="lead color-kabarkadogs">
                        <span class="fw-semibold">Adoption Location: </span> <?php echo $row['adoption_location']; ?>
                      </p>
                      <p class="lead color-kabarkadogs">
                        <span class="fw-semibold">Read story here: </span> 
                        <a href="<?php echo $row['story_link']; ?>" target="_blank">Click Here</a>
                      </p>
                    </div>
                    <div class="col-md-7 d-flex justify-content-end">
                      <?php
                      $imgSrc = !empty($row['img']) ? "uploads/" . $row['img'] : "assets/images/blank_dog_img.jpg";
                      ?>
                      <img
                          src="<?php echo $imgSrc; ?>"
                          alt="dog"
                          class="img-fluid rounded"
                          width="700"
                      />
                  </div>
                    <hr class="featurette-divider" />
                  </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php } else {?>
          <center>
            <div class="col-md-4 shadow p-3 align-items-center">
                <img src="assets/images/blank_dog_img.jpg" class="w-100 h-100" alt="...">
            </div>
            </center>
        <?php }?>
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
      <!-- this part  -->

<?php require('./layout/footer.php')?>
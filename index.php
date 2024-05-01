<?php
session_start();
require('./php/connect.php');

$donationSql = "SELECT COUNT(*) as donationCount FROM donations";
$donationResult = mysqli_query($conn, $donationSql);

if ($donationResult) {
    $row = mysqli_fetch_assoc($donationResult);
    $donationCount = $row['donationCount'];
} else {
    echo "Error: " . mysqli_error($conn);
}



// CAT COUNT
$catsSql = "SELECT COUNT(*) as catsCount FROM animals
LEFT JOIN deceased ON animals.id = deceased.animal_id
WHERE deceased.animal_id IS NULL
AND mammal = 'cat' AND archive = 'no'";
$catsResult = mysqli_query($conn, $catsSql);

if ($catsResult) {
    $row = mysqli_fetch_assoc($catsResult);
    $catsCount = $row['catsCount'];
} else {
    echo "Error: " . mysqli_error($conn);
}
// END CAT COUNT



// DOG COUNT
$dogsSql = "SELECT COUNT(*) as dogsCount FROM animals
LEFT JOIN deceased ON animals.id = deceased.animal_id
WHERE deceased.animal_id IS NULL
AND mammal = 'dog' AND archive = 'no'";
$dogsResult = mysqli_query($conn, $dogsSql);

if ($dogsResult) {
    $row = mysqli_fetch_assoc($dogsResult);
    $dogsCount = $row['dogsCount'];
} else {
    echo "Error: " . mysqli_error($conn);
}
// END DOG COUNT




// DECEASED COUNT
$deceasedSql = "SELECT COUNT(*) as deceasedCount FROM deceased
LEFT JOIN animals ON deceased.animal_id = animals.id";
$deceasedResult = mysqli_query($conn, $deceasedSql);
if ($deceasedResult) {
    $row = mysqli_fetch_assoc($deceasedResult);
    $deceasedCount = $row['deceasedCount'];
} else {
    echo "Error: " . mysqli_error($conn);
}
$adoptedSql = "SELECT COUNT(*) as adoptedCount FROM adoptions WHERE status_id = 3";
$adoptedResult = mysqli_query($conn, $adoptedSql);
if ($adoptedResult) {
    $row = mysqli_fetch_assoc($adoptedResult);
    $adoptedCount = $row['adoptedCount'];
} else {
    echo "Error: " . mysqli_error($conn);
}
// END DECEASED COUNT




// FLIP IMAGE
$searchName = '';
if(isset($_GET['pets'])){
    $searchName = $_GET['pets'];
}

$sql = "SELECT animals.*, animals.id AS nimal_id
FROM animals
LEFT JOIN adoptions ON animals.id = adoptions.animal_id
LEFT JOIN deceased ON animals.id = deceased.animal_id
WHERE deceased.animal_id IS NULL AND animals.archive = 'no'
AND animals.mammal LIKE '%$searchName%'
AND (adoptions.id IS NULL OR adoptions.status_id = 1)
ORDER BY animals.id DESC";
$result = mysqli_query($conn, $sql);
$data = [];
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($nimal_row = mysqli_fetch_assoc($result)) {
            $data[] = $nimal_row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

// Number of items per page
$itemsPerPage = 4;
// Calculate total number of pages
$totalItems = count($data);
$totalPages = ceil($totalItems / $itemsPerPage);
// Get current page number from URL parameter, default to 1
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
// Calculate the starting index for the current page
$startIndex = ($page - 1) * $itemsPerPage;
// Slice the data array to display items for the current page
$currentPageData = array_slice($data, $startIndex, $itemsPerPage);
//FLIP IMAGE END


// DONATE
$sqlDonationSetting = "SELECT * FROM donation_setting";
$resultDonationSetting = mysqli_query($conn, $sqlDonationSetting);
$dataDonationSetting = [];
if ($resultDonationSetting) {
    if (mysqli_num_rows($resultDonationSetting) > 0) {
        while ($row = mysqli_fetch_assoc($resultDonationSetting)) {
            $dataDonationSetting[] = $row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}
// END DONATE




// HOME CAROUSEL
$sqlCarousel = "SELECT * FROM home_carousel";
$resultCarousel = mysqli_query($conn, $sqlCarousel);
$dataCarousel = [];
if ($resultCarousel) {
    if (mysqli_num_rows($resultCarousel) > 0) {
        while ($row = mysqli_fetch_assoc($resultCarousel)) {
            $dataCarousel[] = $row;
        }
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}
// HOME CAROUSEL


if (isset($_SESSION['message'])) {
  echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
  unset($_SESSION['message']); // Unset the session message after displaying
}


mysqli_close($conn);

?>
<?php require('./layout/header.php') ?>
<!-- start carousel -->
    <div
      id="myCarousel"
      class="carousel slide mb-6"
      data-bs-ride="carousel"
      data-bs-theme="light"
    >
      <div class="carousel-inner carousel-dark-mode" style="z-index:0">
      <?php foreach($dataCarousel as $index => $cRow):?>

        <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
          <img
            src="uploads/<?php echo $cRow['img']?>"
            class="d-block w-100"
            alt="ey"
            style="object-fit: contain; height: 42rem"
          />
          <div class="container">
            <div class="carousel-caption">
              <h1><?php echo $cRow['heading']?></h1>
              <p><?php echo $cRow['caption']?></p>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#myCarousel"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#myCarousel"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- end carousel -->

       <!-- START ALL PETS FLIP-->
    <div class="container">
      <div class="text-center rounded-3">
      <hr class="featurette-divider" />
        <h5
          class="color-kabarkadogs fw-bold hero-title position-relative display-3 mb-5"
        >
          Our Pets
        </h5>
      </div>
    </div>

    <div class="bg-kabarkadogs marketing"> 
      <div class="container">
        <form method="get">
          <div class="row mb-4">
            <div class="col-4">
              <button class="btn btn-kabarkadogs w-100" value="" name="pets">All Pets</button>
            </div>
            <div class="col-4">
              <button class="btn btn-kabarkadogs w-100" value="dog" name="pets">Dogs</button>
            </div>
            <div class="col-4">
              <button class="btn btn-kabarkadogs w-100" value="cat" name="pets">Cats</button>
            </div>
          </div>
        </form>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php foreach ($currentPageData as $nimal_row): ?>
            <div class="col-md-3 ">
                <div class="flip-card shadow">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="uploads/<?php echo $nimal_row['picture']; ?>" class="card-img-top" alt="..." height="350">
                        </div>
                      <div class="flip-card-back" style="background-image: url('./assets/images/13999067.jpg'); background-size: cover; position: relative;">
                          <div class="back"></div>
                          <div class="card-body color-kabarkadogs" style="position: relative; z-index: 1;">
                              <h5 class="card-title"><span class="fw-semibold">Name:</span> <?php echo $nimal_row['name']; ?></h5>
                              <p class="card-text"><span class="fw-semibold">Breed:</span> <?php echo $nimal_row['breed']; ?><br/>
                              <span class="fw-semibold">Sex:</span> <?php echo $nimal_row['sex']; ?><br/>
                              <span class="fw-semibold">Weight:</span> <?php echo $nimal_row['weight']; ?><br/>
                              <span class="fw-semibold">Color:</span> <?php echo $nimal_row['color']; ?><br/>
                              <span class="fw-semibold">Mammal:</span> <?php echo $nimal_row['mammal']; ?><br/>
                              <span class="fw-semibold">Age:</span> <?php echo $nimal_row['age']; ?><br/>
                              </p>
                              <p class="color-kabarkadogs">
                                  <span class="fw-semibold">Rescue Location: </span> <?php echo $nimal_row['rescued_location']; ?><br>
                                  <span class="fw-semibold">Rescue Date: </span> <?php echo $nimal_row['rescued_date']; ?><br>
                                  <span class="fw-semibold">Read story here: </span> 
                                  <a href="<?php echo $nimal_row['story_link']; ?>" target="_blank">Click Here</a>
                              </p>
                          </div>
                            <div class="action-button" style="position: relative; z-index: 1;">
                                <button class="border-0 color-red btn btn-kabarkadogs w-100" data-animal-id="<?php echo $nimal_row['nimal_id']; ?>" title="adopt" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" onclick="checkLogin(event)">
                                    <i class="fa-solid fa-dog"> </i> Adopt me <i class="fa-solid fa-cat"></i>
                                </button>
                            </div>
                      </div>
                        <!-- MODAL -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



<script>
    function flipCard(card) {
      card.classList.toggle('flipped');
    }
</script>
<!-- Pagination links -->
<br>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo ($page - 1) . '&pets=' . $searchName; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i . '&pets=' . $searchName; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo ($page + 1) . '&pets=' . $searchName; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
    <hr class="featurette-divider" />
</nav>
  </div>
</div>
     <!-- END ALL PETS FLIP-->


    <!-- Donate now gcash, bpi -->
    <div class="bg-kabarkadogs marketing">
  <div class="container">
    <div class="row featurette">
      <div class="col-md-5">
          <h3 class="color-kabarkadogs-gold">Donate Now</h3>
          <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">Save a life by donating today</h2>
          <p class="lead color-kabarkadogs pt-5">
              To donate via 
              <select id="donation-select">
                  <?php foreach ($dataDonationSetting as $index => $row): ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['account_name']?></option>
                  <?php endforeach; ?>
              </select>
          </p>
          <div class="container custom-container">
            <!-- Wrap the paragraph inside a column and apply text-justify class -->
            <div class="text-justify" style="text-align: justify !important;">
              <p id="instruction"><?php echo $dataDonationSetting[0]['instructions']; ?></p>
            </div>
          </div>
      </div>
      <div class="col-md-4 d-flex justify-content-center justify-content-md-end position-relative">
          <img id="donation-img" src="uploads/<?php echo $dataDonationSetting[0]['account_img']?>" alt="gcash" class="img-fluid rounded" width="300"/>
      </div>
    </div>
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Get references to select element and image and instruction elements
            const select = document.getElementById('donation-select');
            const img = document.getElementById('donation-img');
            const instruction = document.getElementById('instruction');

            // Add event listener to select element
            select.addEventListener('change', function () {
                // Get the selected option value
                const selectedOptionValue = select.value;
                
                // Find the corresponding donation setting object from the data
                const selectedDonationSetting = <?php echo json_encode($dataDonationSetting); ?>.find(setting => setting.id === selectedOptionValue);
                
                // Update the image source and instruction text
                img.src = 'uploads/' + selectedDonationSetting.account_img;
                instruction.textContent = selectedDonationSetting.instructions;
            });
        });
    </script>
  </div>
</div>
<!-- end donate gcahs etc -->

    <div class="bg-kabarkadogs marketing section-padding-top">
      <div class="container">
        <h3 class="color-kabarkadogs-gold text-center mb-5">Amount Of Pets In Our Shelter</h3>
        <div class="row gy-4 mx-5">
          <div class="col-6 col-md-3">
            <div class="rounded pl-6 pr-6 pt-2 pb-1" style="background: #734900;">
                <h1 class="text-center text-white "><?php echo $catsCount ?></h1>
                <h3 class="text-center text-white ">Cats</h3>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="rounded pl-6 pr-6 pt-2 pb-1 bg-kabarkadogs" style="background: #734900;">
              <h1 class="text-center text-white "><?php echo $adoptedCount ?></h1>
              <h3 class="text-center text-white ">Adopted</h3>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="rounded pl-6 pr-6 pt-2 pb-1 bg-kabarkadogs" style="background: #734900;">
              <h1 class="text-center text-white "><?php echo $dogsCount ?></h1>
              <h3 class="text-center text-white ">Dogs</h3>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="rounded pl-6 pr-6 pt-2 pb-1 bg-kabarkadogs" style="background: #734900;">
              <h1 class="text-center text-white "><?php echo $deceasedCount ?></h1>
              <h3 class="text-center text-white ">Deceased</h3>
            </div>
          </div>
        </div> 
        <hr class="featurette-divider" />
      </div>
  </div>

  <div class="bg-kabarkadogs-2 marketing pt-2">
    <div class="container">
      <div class="row featurette">
        <div class="col-md-5">
          <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
            Please donate and help save our animals
          </h2>
          <p class="lead color-kabarkadogs pt-5" style="text-align: justify !important;">
            The costs of treating and rehabilitating these animals,
            as well as running the shelter and clinic,
            are funded solely by donations.
          </p>
        </div>
        <div class="col-md-7 d-flex justify-content-end">
          <img
            src="assets/images/dogs.png"
            alt="gcash"
            class="img-fluid rounded"
            width="700"
          />
        </div>
        <hr class="featurette-divider" />
      </div>
    </div>
  </div>
<?php require('index-modal-form.php') ?>

  <?php require('./layout/footer.php')?>
<?php 
session_start();
require('./php/connect.php');

$searchName = '';

if(isset($_GET['pets'])){
    $searchName = $_GET['pets'];
}

$sql = "SELECT animals.*
FROM animals
LEFT JOIN adoptions ON animals.id = adoptions.animal_id
LEFT JOIN deceased ON animals.id = deceased.animal_id
WHERE deceased.animal_id IS NULL
AND animals.mammal LIKE '%$searchName%'
AND (adoptions.id IS NULL OR adoptions.status_id = 4)
ORDER BY animals.id DESC";


$result = mysqli_query($conn, $sql);
$data = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
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



// ADOPTION FEE
$sql_fee = "SELECT * FROM adoption_fee LIMIT 1";
$result_fee = mysqli_query($conn, $sql_fee);
$rows_fee = []; // Initialize an empty array
if($result_fee){
  while($row = mysqli_fetch_assoc($result_fee)){ // Fetch each row and add to the array
    $rows_fee[] = $row;
    }
  }else{
    echo "Error executing the query: " . mysqli_error($conn);
  }
// ADOPTION FEE LISSTS
$sql_fee_list = "SELECT * FROM lists
JOIN adoption_fee ON adoption_fee.id = lists.adoption_fee_id";
$result_fee_list = mysqli_query($conn, $sql_fee_list);
$rows_fee_list = []; // Initialize an empty array
if($result_fee_list){
  while($row = mysqli_fetch_assoc($result_fee_list)){ // Fetch each row and add to the array
    $rows_fee_list[] = $row;
    }
  }else{
    echo "Error executing the query: " . mysqli_error($conn);
  }

// ABOUT OUR PETS
$sql_aop = "SELECT * FROM about_our_pets LIMIT 1";
$result_aop = mysqli_query($conn, $sql_aop);
$rows_aop = []; // Initialize an empty array
if($result_aop){
  while($row = mysqli_fetch_assoc($result_aop)){ // Fetch each row and add to the array
    $rows_aop[] = $row;
    }
  }else{
    echo "Error executing the query: " . mysqli_error($conn);
  }
  
  
  mysqli_close($conn);
?>
<?php require('./layout/header.php') ?>
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
        <?php foreach ($currentPageData as $row): ?>
            <div class="col-md-3 ">
                <div class="flip-card shadow">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="uploads/<?php echo $row['picture']; ?>" class="card-img-top" alt="..." height="350">
                        </div>
                      <div class="flip-card-back" style="background-image: url('./assets/images/13999067.jpg'); background-size: cover; position: relative;">
                          <div class="back"></div>
                          <div class="card-body color-kabarkadogs" style="position: relative; z-index: 1;">
                              <h5 class="card-title"><span class="fw-semibold">Name:</span> <?php echo $row['name']; ?></h5>
                              <p class="card-text"><span class="fw-semibold">Breed:</span> <?php echo $row['breed']; ?><br/>
                              <span class="fw-semibold">Sex:</span> <?php echo $row['sex']; ?><br/>
                              <span class="fw-semibold">Weight:</span> <?php echo $row['weight']; ?><br/>
                              <span class="fw-semibold">Color:</span> <?php echo $row['color']; ?><br/>
                              <span class="fw-semibold">Mammal:</span> <?php echo $row['mammal']; ?><br/>
                              <span class="fw-semibold">Age:</span> <?php echo $row['age']; ?><br/>
                              </p>
                              <p class="color-kabarkadogs">
                                  <span class="fw-semibold">Rescue Location: </span> <?php echo $row['rescued_location']; ?><br>
                                  <span class="fw-semibold">Rescue Date: </span> <?php echo $row['rescued_date']; ?><br>
                                  <span class="fw-semibold">Read story here: </span> 
                                  <a href="https://www.facebook.com/TheKabarkaDogs/posts/pfbid02jQTtoD4fZsGko3FRq22fcQFL9RR77zyUHELWyUZx2jwump4UDgiUa5LQvtMi3egnl" target="_blank">Click Here</a>
                              </p>
                          </div>
                            <div class="action-button" style="position: relative; z-index: 1;">
                                <button class="border-0 color-red btn btn-kabarkadogs w-100" data-animal-id="<?php echo $row['id']; ?>" title="adopt" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" onclick="checkLogin()">
                                    <i class="fa-solid fa-dog"> </i> Adopt me <i class="fa-solid fa-cat"></i>
                                </button>
                            </div>
                            <script>
                              function checkLogin() {
                                  console.log('checkLogin function called');
                                  $.ajax({
                                      type: 'GET',
                                      url: 'index-check-login.php',
                                      success: function(response) {
                                          console.log('AJAX request successful');
                                          console.log('Response:', response);
                                          // Handle response here
                                      },
                                      error: function(xhr, status, error) {
                                          console.error('AJAX request error:', error);
                                          alert('An error occurred while checking login status. Please try again later.');
                                      }
                                  });
                              }
                          </script>
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
    <div class="container">
      <div class="p-5 text-center rounded-3 mt-5">
        <!-- <h1
          class="color-kabarkadogs fw-bold hero-title position-relative display-3"
        >
          Our Pets
        </h1> -->
        <hr class="featurette-divider" />
      </div>
    </div>

    <?php foreach ($rows_aop as $row_aop): ?>
    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-md-5">
            <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
              <?php echo $row_aop['title']?>
            </h2>
            <p class="lead color-kabarkadogs pt-5" style="text-align: justify !important;">
                <?php echo $row_aop['description']?>
            </p>
          </div>
          <div class="col-md-7 d-flex justify-content-end">
            <img
              src="uploads/<?php echo $row_aop['img']?>"
              alt="gcash"
              class="img-fluid rounded"
              width="600"
            />
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>
    <?php endforeach;?>


    <div class="bg-kabarkadogs marketing">
      <div class="container">

      <?php foreach($rows_fee as $row_fl):?>
        <div class="row featurette">
          <div class="col-md-5">
            <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
               <?php echo $row_fl['title']?>
            </h2>
            <p class="lead color-kabarkadogs pt-5" style="text-align: justify !important;">
              <?php echo $row_fl['title_description']?>
            </p>
            <h4 class="mt-5"><?php echo $row_fl['subtitle']?></h4>

            <?php foreach($rows_fee_list as $row):?>
              <p class="text-secondary lead fst-italic" style="text-align: justify !important;">
                <!-- When you adopt a pet from us, you can be sure that they are 1) up
                to date on vaccinations, 2) treated for ticks and fleas, and 3)
                already spayed or neutered. All of this would cost between P5,000
                to P10,000 at private vet clinics. Therefore, the adoption fee is
                a very small amount to pay for ensuring that you are taking home a
                healthy pet. -->
                <?php echo $row['description']?>
              </p>
           <?php endforeach;?>

          </div>
          <div class="col-md-7 d-flex justify-content-end">
            <img
              src="assets/images/pets2.jpg"
              alt="gcash"
              class="img-fluid rounded"
              width="600"
            />
          </div>
          <hr class="featurette-divider" />
        </div>
        <?php endforeach; ?>

      </div>
    </div>
    <?php require('index-modal-form.php') ?>
<?php require('./layout/footer.php')?>
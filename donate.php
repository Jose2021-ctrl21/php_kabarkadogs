<?php 
session_start();
require('./php/connect.php');

//Donation setting
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
//end donation setting


// ADOPTION FEE
$sql_hcwp = "SELECT * FROM donation_how_can_we_help LIMIT 1";
$result_hcwp = mysqli_query($conn, $sql_hcwp);
$rows_hcwp = []; // Initialize an empty array
if($result_hcwp){
  while($row = mysqli_fetch_assoc($result_hcwp)){ // Fetch each row and add to the array
    $rows_hcwp[] = $row;
    }
  }else{
    echo "Error executing the query: " . mysqli_error($conn);
  }

// ADOPTION FEE LISTS
$sql_hcwp_list = "SELECT lists.description AS description FROM lists
JOIN donation_how_can_we_help AS hcwp ON hcwp.id = lists.how_can_we_help_id";
$result_hcwp_list = mysqli_query($conn, $sql_hcwp_list);
$rows_hcwp_list = []; // Initialize an empty array
if($result_hcwp_list){
  while($row = mysqli_fetch_assoc($result_hcwp_list)){ // Fetch each row and add to the array
    $rows_hcwp_list[] = $row;
    }
  }else{
    echo "Error executing the query: " . mysqli_error($conn);
  }



mysqli_close($conn);
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Donate</h1>
            <hr class="featurette-divider" />
        </div>
    </div>

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
          <div class="container custom-container" style="text-align: justify !important;">
            <!-- Wrap the paragraph inside a column and apply text-justify class -->
            <div class="text-justify">
              <p id="instruction"><?php echo $dataDonationSetting[0]['instructions']; ?></p>
            </div>
          </div>
      </div>
      <div class="col-md-7 d-flex justify-content-center justify-content-md-end position-relative">
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
          <hr class="featurette-divider" />

  </div>
</div>
<!-- end donate gcahs etc -->

<?php foreach($rows_hcwp as $row_h):?>
    <div class="bg-kabarkadogs marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-lg-6 col-12">
            <h5 class="color-kabarkadogs"><?php echo $row_h['small_title']?></h5>
            <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
                <?php echo $row_h['title']?>
            </h2>
            <p class="lead color-kabarkadogs pt-3" style="text-align: justify !important;">
              <?php echo $row_h['description']?>
            </p>
            <!-- <p class="lead color-kabarkadogs" style="text-align: justify !important;">
              These contributions go a great way in meeting the needs of the animals in our shelter. The following is a list of supplies they require each day:
            </p> -->
          </div>
          <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
            <img
              src="uploads/<?php echo $row_h['img_1']?>"
              alt="gcash"
              class="img-fluid rounded"
              width="400"
            />
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>
    <?php endforeach ?>

    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
        <div class="row featurette gy-3">
          <div class="col-md-6 rounded p-5 position-relative">
          <img src='uploads/donate_dog_pic.png' class="position-absolute h-100 w-100 left-0 top-0">
          </div>
          <div class="col-1"></div>
          <div class="col-md-5 rounded p-5" style="background: #734900;">
              <div class="h-100 overflow-auto" style="height:450px !important">
                  <p class="lead text-white"><b>CATS & DOGS WISHLIST</b></p>
                  <?php foreach($rows_hcwp_list as $row_hl):?>
                      <p class="lead text-white"><i class="fa-solid fa-paw mr-2"></i>
                          <?php echo $row_hl['description']?>
                      </p>
                  <?php endforeach ?>
              </div>
          </div>

          <hr class="featurette-divider" />
        </div>
      </div>
    </div>

<?php require('./layout/footer.php')?>
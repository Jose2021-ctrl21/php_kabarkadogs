<?php 
session_start();
require_once('php/connect.php');

$sql = "SELECT * FROM recommendation";
$result = $conn->query($sql);
if ($result === false) {
    echo "Error: " . $conn->error;
}
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Recommendations</h1>
            <hr class="featurette-divider" />
        </div>
    </div>


    <?php while ($row = $result->fetch_assoc()){?>
    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-lg-6 d-flex justify-content-center justify-content-md-start">
            <img
              src="uploads/<?php echo $row['img']?>"
              alt="logo2"
              class="img-fluid rounded"
              width="500"
            />
          </div>
          <div class="col-lg-6">
            <h3 class="color-kabarkadogs-gold mt-3"><?php echo $row['small_title']?></h3>
            <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
              <?php echo $row['title']?>
            </h2>
            <p class="lead color-kabarkadogs mt-3" style="text-align: justify !important;">
              <?php echo $row['description']?>
            </p>
            <p class="lead color-kabarkadogs mt-3">
              <a href="<?php echo $row['map_link']?>" class="text-decoration-none" target="_blank">
                <i class="fa-solid fa-location-dot"></i>
                  <?php echo $row['map_name']?>
              </a>
            </p>
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>
    <?php }?>

<?php require('./layout/footer.php')?>
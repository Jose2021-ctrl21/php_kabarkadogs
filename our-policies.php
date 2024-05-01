<?php 
session_start();
require_once('php/connect.php');

$sql = "SELECT * FROM policy";
$result = $conn->query($sql);
if ($result === false) {
    echo "Error: " . $conn->error;
}
?>

<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-1">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Our Policies</h1>
            <hr class="featurette-divider" />
        </div>
    </div>
    
    <?php
      while ($row = $result->fetch_assoc()) 
      {
    ?>
    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-md-5">
            <h3 class="color-kabarkadogs-gold"><?php echo $row['republic_act'];?></h3>
            <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
            <?php echo $row['title'];?>
            </h2>
            <p class="lead color-kabarkadogs pt-5 pb-5" style="text-align: justify !important;">
            <?php echo $row['subtitle'];?>
            </p>


            <?php
                    // Use a different variable name for the inner query result set
                    $sql_inner = "SELECT * FROM lists WHERE policy_id = " . $row['id'];
                    $result_inner = $conn->query($sql_inner);
                    if ($result_inner === false) {
                        echo "Error: " . $conn->error;
                    } else {
                        while ($row_inner = $result_inner->fetch_assoc()) {
                ?>
                <p class="lead color-kabarkadogs">
                    <?php echo $row_inner['description'];?>
                </p>
                <?php
                        }
                    }
                ?>

          </div>
          <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
            <img
              src="uploads/<?php echo $row['img'];?>"
              alt="gcash"
              class="img-fluid rounded"
              width="600"
            />
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>
    <?php };
      $conn->close();
    ?>
   
<?php require('./layout/footer.php')?>
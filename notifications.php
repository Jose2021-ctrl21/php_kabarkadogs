<?php 
session_start();
require('./php/connect.php');

$user_id = 0;

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}

$sql = "SELECT * FROM notifications WHERE user_id = $user_id";

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

mysqli_close($conn);

?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Notification</h1>
            <hr class="featurette-divider" />
        </div>
    </div>

    <div class="bg-kabarkadogs marketing">
      <div class="container">
        <div class="row featurette">
            <div class="col-12">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <h6 class="border-bottom pb-2 mb-0">Latest Notifications</h6>
                    <?php foreach ($data as $row): ?>
                    <div class="d-flex text-body-secondary pt-3">
                        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#734900"></rect><text x="50%" y="50%" fill="#734900" dy=".3em">32x32</text></svg>
                        <p class="pb-3 mb-0 small lh-sm border-bottom">
                            <strong class="d-block text-gray-dark"><?php echo $row['title'] .'  ('. $row['created_at'] .')'?></strong>
                            <?php echo $row['description']?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>

<?php require('./layout/footer.php')?>
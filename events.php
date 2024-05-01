<?php 
session_start();
require('php/connect.php');

$sql = "SELECT * FROM events WHERE date >= CURDATE()";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }else
    $message = "No event yet";
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<?php require('./layout/header.php') ?>

<div class="container">
    <div class="text-center rounded-3 mt-5">
        <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Upcoming Events</h1>
    </div>
</div>

<div class="container pt-5">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <?php if(mysqli_num_rows($result) > 0) {?>
        <div class="carousel-inner">
            <?php foreach ($data as $index => $row): ?>
                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?> w-100 h-100 p-5">
                    <div class="card w-100 h-100">
                    <!-- F5F5DC -->
                        <div class="row justify-content-center" style="background:#F1EADA">
                            <div class="col-md-6 shadow p-3">
                                <img src="uploads/<?php echo $row['img']?>" class="w-100 h-100" alt="...">
                            </div>
                            <div class="col-md-4 shadow p-3">
                            <center>
                                <div class="h-100 w-80">
                                    <h3 class="color-kabarkadogs fw-bolder pt-5"><?php echo $row['title']; ?></h3>
                                    <p class="color-kabarkadogs p-5"><?php echo $row['description']; ?></p>
                                    <small class="color-kabarkadogs fw-bolder mb-0"><?php echo $row['date']; ?></small>
                                </div>
                            </center>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php } else {?>
            <center>
            <div class="col-md-4 shadow p-3 align-items-center">
                <img src="assets/images/no-event.png" class="w-100 h-100" alt="...">
            </div>
            </center>
        <?php }?>
        <!-- <style>
            .carousel-control-prev-icon, .carousel-control-next-icon{
                background:black !important;
            }
        </style> -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <hr class="featurette-divider" />

</div>

<?php require('./layout/footer.php') ?>

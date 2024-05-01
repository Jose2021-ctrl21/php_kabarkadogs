<?php
session_start();
require('./php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}
//TOTAL DONOR
$donationSql = "SELECT COUNT(*) as donationCount 
                FROM donations WHERE MONTH(date_of_donation) = MONTH(NOW())";
$donationResult = mysqli_query($conn, $donationSql);

if ($donationResult) {
    $row = mysqli_fetch_assoc($donationResult);
    $donationCount = $row['donationCount'];
} else {
    echo "Error: " . mysqli_error($conn);
}

//TOTAL CAT
$catsSql = "SELECT COUNT(*) as catsCount 
            FROM animals
            LEFT JOIN deceased ON animals.id = deceased.animal_id
            WHERE deceased.animal_id IS NULL
            AND mammal = 'cat' AND animals.archive = 'no'";
$catsResult = mysqli_query($conn, $catsSql);

if ($catsResult) {
    $row = mysqli_fetch_assoc($catsResult);
    $catsCount = $row['catsCount'];
    // echo "Total Cats" . $catsCount;
} else {
    echo "Error: " . mysqli_error($conn);
}
//TOTAL DOG
$dogsSql = "SELECT COUNT(*) as dogsCount 
            FROM animals
            LEFT JOIN deceased ON animals.id = deceased.animal_id
            WHERE deceased.animal_id IS NULL
            AND mammal = 'dog' AND animals.archive = 'no'";
$dogsResult = mysqli_query($conn, $dogsSql);

if ($dogsResult) {
    $row = mysqli_fetch_assoc($dogsResult);
    $dogsCount = $row['dogsCount'];
    // echo "Total Dogs" . $dogsCount;
} else {
    echo "Error: " . mysqli_error($conn);
}

//TOTAL ANIMAL DEATH
$deceasedSql = "SELECT COUNT(*) as deceasedCount 
                FROM deceased
                INNER JOIN animals ON deceased.animal_id = animals.id
                WHERE MONTH(date_of_death) = MONTH(NOW())";
$deceasedResult = mysqli_query($conn, $deceasedSql);

if ($deceasedResult) {
    $row = mysqli_fetch_assoc($deceasedResult);
    $deceasedCount = $row['deceasedCount'];
    // echo "Total Deceased" . $deceasedCount;
} else {
    echo "Error: " . mysqli_error($conn);
}

//TOTAL ADOPTED
$adoptedSql = "SELECT COUNT(*) as adoptedCount 
               FROM adoptions 
               WHERE MONTH(created_date) = MONTH(NOW()) AND status_id = 3";
$adoptedResult = mysqli_query($conn, $adoptedSql);

if ($adoptedResult) {
    $row = mysqli_fetch_assoc($adoptedResult);
    $adoptedCount = $row['adoptedCount'];
    // echo "Total Adopted" . $adoptedCount;
} else {
    echo "Error: " . mysqli_error($conn);
}
//TOTAL REJECTED APPLICATION
$rejectedSql = "SELECT COUNT(*) as rejectedCount
                FROM adoptions
                INNER JOIN statuses ON adoptions.status_id = statuses.id
                WHERE MONTH(created_date) = MONTH(NOW())
                AND adoptions.status_id = 4";
$rejectedResult = mysqli_query($conn, $rejectedSql);

if ($rejectedResult) {
    $row = mysqli_fetch_assoc($rejectedResult);
    $rejectedCount = $row['rejectedCount'];
    // echo "Total rejectedCount" . $rejectedCount;
} else {
    echo "Error: " . mysqli_error($conn);
}

//TOTAL ACCEPTED APPLICATION
$acceptedSql = "SELECT COUNT(*) as acceptedCount
                FROM adoptions
                INNER JOIN statuses ON adoptions.status_id = statuses.id
                WHERE MONTH(created_date) = MONTH(NOW())
                AND adoptions.status_id = 2";
$acceptedResult = mysqli_query($conn, $acceptedSql);

if ($acceptedResult) {
    $row = mysqli_fetch_assoc($acceptedResult);
    $acceptedCount = $row['acceptedCount'];
    // echo "Total acceptedCount" . $acceptedCount;
} else {
    echo "Error: " . mysqli_error($conn);
}

//TOTAL PENDING APPLICATION
$pendingSql = "SELECT COUNT(*) as pendingCount
                FROM adoptions
                INNER JOIN statuses ON adoptions.status_id = statuses.id
                WHERE MONTH(created_date) = MONTH(NOW())
                AND adoptions.status_id = 1";
$pendingResult = mysqli_query($conn, $pendingSql);

if ($pendingResult) {
    $row = mysqli_fetch_assoc($pendingResult);
    $pendingCount = $row['pendingCount'];
    // echo "Total pendingCount" . $pendingCount;
} else {
    echo "Error: " . mysqli_error($conn);
}

//TOTAL APPLICATION
$applicantsSql = "SELECT COUNT(*) as applicantsCount
                FROM adoptions
                WHERE MONTH(created_date) = MONTH(NOW())";
$applicantsResult = mysqli_query($conn, $applicantsSql);

if ($applicantsResult) {
    $row = mysqli_fetch_assoc($applicantsResult);
    $applicantsCount = $row['applicantsCount'];
    // echo "Total applicantsCount" . $applicantsCount;
} else {
    echo "Error: " . mysqli_error($conn);
}


mysqli_close($conn);

?>
<?php require('./layout/header.php')?>
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<?php require('nav_menu.php')?>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Dashboard</h1></div>
            </div>



        <!-- Small boxes (Stat box) -->
        <div class="row">
                <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3> <?php echo $adoptedCount ?> </h3>
                        <p>Total Adopted</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3> <?php echo $catsCount ?> </h3>
                        <p>Total Cat</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3> <?php echo $dogsCount ?> </h3>
                    <p>Total Dogs</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-clock"></i>
                    </div>
                    <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-2 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3> <?php echo $deceasedCount?> </h3>
                            <p>Total Deceased</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-alert-circled"></i>
                        </div>
                        <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-2 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3> <?php echo $donationCount?> </h3>
                            <p>Total Donor</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-2 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3> <?php echo $rejectedCount ?> </h3>
                            <p>Total rejected</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

            </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
               
                <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-pink">
                    <div class="inner">
                        <h3> <?php echo $acceptedCount ?> </h3>
                        <p>Total Accepted</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-clock"></i>
                    </div>
                    <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3> <?php echo $pendingCount ?> </h3>
                        <p>Total Pending</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-alert-circled"></i>
                    </div>
                    <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->

                 <!-- ./col -->
                 <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-indigo">
                    <div class="inner">
                        <h3> <?php echo $applicantsCount ?> </h3>
                        <p>Total Applicants</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-clock"></i>
                    </div>
                    <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                 <!-- ./col -->

            </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                     <!-- BAR CHART -->
                   <!-- ... Your PHP and HTML code ... -->

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">CHART PER MONTH</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart" style="min-height: 250px; height: 60vh; max-height: 100vh; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../pluginssss/jquery/jquery.min.js"></script>
<script src="../pluginssss/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../pluginssss/chart.js/Chart.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<!-- <script src="../dist/js/demo.js"></script> -->


<!-- DONUT CHART -->
<script>
    // Your JavaScript code for the donut chart
    $(function () {
        var a = <?php echo $adoptedCount ?>;
        console.log(a);
        var b = <?php echo $catsCount ?>;
        console.log(b);
        var c = <?php echo $dogsCount ?>;
        console.log(c);
        var d = <?php echo $deceasedCount ?>;
        console.log(d);
        var e = <?php echo $donationCount ?>;
        console.log(e);

        // DOUGHNUT CHART
        var donutChartCanvas = $('#barChart').get(0).getContext('2d');
        var donutChartData = {
            labels: ['Total Adopted', 'Total Cats', 'Total Dogs', 'Total Deceased', 'Total Donor', 'Total rejected','Total accepted', 'Total Pending', 'Total Applicants'],
            datasets: [
                {
                    label: 'Total counts per Month',
                    backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 205, 86, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)', 'rgba(13, 143, 255, 0.8)', 'rgba(200, 123, 255, 0.8)', 'rgba(100, 78, 255, 0.8)','rgba(10, 78, 255, 0.8)'],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 205, 86, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)', 'rgba(13, 143, 255, 0.8)', 'rgba(200, 123, 255, 0.8)', 'rgba(100, 78, 255, 0.8)','rgba(10, 78, 255, 0.8)'],
                    hoverBorderColor: 'rgba(255, 255, 255, 1)',
                    data: [<?php echo $adoptedCount ?>, <?php echo $catsCount ?>, <?php echo $dogsCount ?>, <?php echo $deceasedCount ?>, <?php echo $donationCount ?>, <?php echo $rejectedCount ?>, <?php echo $acceptedCount ?>,<?php echo $pendingCount ?>, <?php echo $applicantsCount ?>], 
                },
            ],
        };

        var donutChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
        };

        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutChartData,
            options: donutChartOptions,
        });
    });
</script>
<?php require('./layout/footer.php')?>
 

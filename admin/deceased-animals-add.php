<?php 

session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}
$created_date = date("Y-m-d");
$sql = "SELECT animals.*
FROM animals
LEFT JOIN deceased ON animals.id = deceased.animal_id
WHERE deceased.animal_id IS NULL";
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

// var_dump($data);

?>
<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php" class="active"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="adoptions.php"><i class="fa-solid fa-heart"></i> Adoptions</a></li>
        <li><a href="archived.php"><i class="fa-solid fa-archive"></i> Archived</a></li>
        <li><a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>
</nav>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Add Deceased Animals</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="_process_add_deceased_animals.php">
                                <div class="mb-3 row">
                                    <label for="animals" class="col-sm-12 col-lg-2 col-form-label">Animals: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <select name="animals" id="animals" class="form-select form-control">
                                            <?php foreach ($data as $animals): ?>
                                                <option value="<?php echo $animals['id']; ?>" <?php if ($animals['id'] == $data[0]['id']) echo 'selected'; ?>>
                                                    <?php echo $animals['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="date_of_death" class="col-sm-12 col-lg-2 col-form-label">Date of death: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="date_of_death" name="date_of_death"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="cause_of_death" class="col-sm-12 col-lg-2 col-form-label">Cause of Death: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="cause_of_death" name="cause_of_death"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-kabarkadogs">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('./layout/footer.php')?>  


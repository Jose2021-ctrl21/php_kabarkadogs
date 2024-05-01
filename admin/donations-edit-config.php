<?php
session_start();
require('../php/connect.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit(); // Add exit() to prevent further execution
}

// Check if the "id" parameter is set in the URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header('Location: donation-config.php');
    exit; // Ensure script execution stops after the redirect
}

$configId = $_GET["id"];

// Fetch the donation configuration from the database
$sql = "SELECT * FROM donation_setting WHERE id = $configId";
$result = mysqli_query($conn, $sql);

$data = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>


<?php require('./layout/header.php')?>

<!-- Your HTML code with PHP embedded here -->



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
                <div><h2 class="title">Edit Donor</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                        <form method="post" action="_process_edit_donations_config.php" enctype="multipart/form-data">
                                <?php foreach ($data as $row): ?>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="configId">
                                    <div class="mb-3 row">
                                    <label for="accountImg" class="col-sm-12 col-lg-2 col-form-label">Current Image:</label>
                                    <input type="file" class="form-control" id="accountImg" name="accountImg" style="display: none;" value="<?php echo $row['account_img']; ?>"/>
                                        <div class="col-lg-10 col-sm-12">
                                            <?php if (!empty($row['account_img'])): ?>
                                                <a href="javascript:void(0);" onclick="triggerFileInput()">
                                                    <img src="../uploads/<?php echo $row['account_img']; ?>" alt="Current Image" style="max-width: 70%; height: 70%;" class="shadow">
                                                </a>
                                            <?php else: ?>
                                                <p>No image available</p>
                                            <?php endif; ?>
                                        </div>
                                        <script>
                                    function triggerFileInput() {
                                        document.getElementById('accountImg').click();
                                    }
                                </script>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="account-name" class="col-sm-12 col-lg-2 col-form-label">Account name: <span class="required">*</span></label>
                                        <div class="col-lg-10 col-sm-12">
                                            <input type="text" class="form-control" id="account-name" name="account-name" value="<?php echo $row['account_name']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="instructions" class="col-sm-12 col-lg-2 col-form-label">Instruction: <span class="required">*</span></label>
                                        <div class="col-lg-10 col-sm-12">
                                            <textarea class="form-control form-control-lg" id="instructions" name="instructions" rows="5"><?php echo $row['instructions']; ?></textarea>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-center mt-5 mb-4">
                                        <button class="btn btn-kabarkadogs">Save</button>
                                    </div>
                                <?php endforeach ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('./layout/footer.php')?>


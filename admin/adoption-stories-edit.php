<?php 
session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

if (!isset($_GET['id'])) {
    header('Location: adoption_stories_settings.php');
    exit(); 
}

$id = $_GET['id'];
$id = intval($id);

$sql = "SELECT * FROM adoption_stories_settings 
WHERE id = $id";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $storyId = $row['id'];
        $img = $row['img'];
        $name = $row['name'];
        $rescueDate = $row['rescue_date'];
        $rescueLocation = $row['rescue_location'];
        $adoptionDate = $row['adoption_date'];
        $adoptionLocation = $row['adoption_location'];
        $storyLink = $row['story_link'];
    }
}
 else {
    echo "Error executing the query: " . mysqli_error($conn);
}

mysqli_close($conn);
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
                <div><h2 class="title">Add story</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="_process_edit_adoption_stories.php" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                <input type="hidden" class="form-control" id="story-id" value="<?php echo $storyId?>" name="story-id"/>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-12 col-lg-2 col-form-label">Name: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="name" value="<?php echo $name?>" name="name"/>
                                    </div>
                                </div>
                               
                                <div class="mb-3 row">
                                    <label for="adoption-date" class="col-sm-12 col-lg-2 col-form-label">Adoption date: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="adoption-date" value="<?php echo $adoptionDate?>" name="adoption-date"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="adoption-location" class="col-sm-12 col-lg-2 col-form-label">Adoption location: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="adoption-location" value="<?php echo $adoptionLocation?>"  name="adoption-location"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="story-link" class="col-sm-12 col-lg-2 col-form-label">Story link: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="story-link" value="<?php echo $storyLink?>" name="story-link"/>
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


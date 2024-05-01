<?php 

session_start();
require('../php/connect.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
}

if (!isset($_GET['id'])) {
    header('Location: animals.php');
    exit(); 
}

$id = $_GET['id'];
$id = intval($id);

if ($id <= 0) {
    header('Location: animals.php');
    exit();
}

$sql = "SELECT * from animals WHERE id = $id";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $img = $row['picture'];
        $name = $row['name'];
        $breed = $row['breed'];
        $sex = $row['sex'];
        $weight = $row['weight'];
        $color = $row['color'];
        $mammal = $row['mammal'];
        $age = $row['age'];
        $rescuedLocation = $row['rescued_location'];
        $rescuedDate = $row['rescued_date'];
        $storyLink = $row['story_link'];
    }
}

$sexArr = [
    ['name' => 'Male', 'value' => 'male'],
    ['name' => 'Female', 'value' => 'female']
];

$mammalArr = [
    ['name' => 'Dog', 'value' => 'dog'],
    ['name' => 'Cat', 'value' => 'cat']
]

?>

<?php require('./layout/header.php')?>

<nav id="column-left">
    <ul id="menu">
        <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li><a href="booking-list.php"><i class="fa-solid fa-book"></i> Booking List</a></li>
        <li><a href="animals.php" class="active"><i class="fa-solid fa-paw"></i> Animals</a></li>
        <li><a href="deceased-animals.php"><i class="fa-solid fa-skull"></i> Deceased animals</a></li>
        <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
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
                <div><h2 class="title">Edit Animals</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="_process_edit_animals.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="animal_id" value="<?php echo $id ?>">
                                <div class="mb-3 row">
                                    <label for="edit-picture" class="col-sm-12 col-lg-2 col-form-label">Picture: <span class="required">*</span>
                                    <div class="col-lg-3 col-sm-3">
                                        <?php if(!empty($img)): ?>
                                        <img src="../uploads/<?php echo $img; ?>" alt="Current Image" width="100px" height="100px">
                                        <?php endif; ?>
                                        <input type="file" class="form-control" id="edit-picture" name="edit-picture" value="<?php echo $img?>" accept="image/*" style="display:none"/>
                                        <input type="hidden" name="existing-image" value="<?php echo $img; ?>">
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="animal_name" class="col-sm-12 col-lg-2 col-form-label">Animal Name: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="animal_name" name="name" value="<?php echo $name?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="age" class="col-sm-12 col-lg-2 col-form-label">Age: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="age" name="age" value="<?php echo $age?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="breed" class="col-sm-12 col-lg-2 col-form-label">Breed: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $breed?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="sex" class="col-sm-12 col-lg-2 col-form-label">Sex: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <select name="sex" id="sex" class="form-select form-control">
                                            <?php foreach ($sexArr as $sexOption): ?>
                                                <option value="<?php echo $sexOption['value']; ?>"
                                                    <?php if ($sexOption['value'] === $sex): ?> selected <?php endif; ?>>
                                                    <?php echo $sexOption['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="weight" class="col-sm-12 col-lg-2 col-form-label">Weight: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $weight?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="color" class="col-sm-12 col-lg-2 col-form-label">Color: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="color" name="color" value="<?php echo $color?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="mammal" class="col-sm-12 col-lg-2 col-form-label">Type of pet: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <select name="mammal" id="mammal" class="form-select form-control">
                                            <?php foreach ($mammalArr as $mammalOption): ?>
                                                <option value="<?php echo $mammalOption['value']; ?>"
                                                    <?php if ($mammalOption['value'] === $mammal): ?> selected <?php endif; ?>>
                                                    <?php echo $mammalOption['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit-rescuedLocation" class="col-sm-12 col-lg-2 col-form-label">Rescued location: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="edit-rescuedLocation" name="edit-rescuedLocation" value="<?php echo $rescuedLocation?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit-rescuedDate" class="col-sm-12 col-lg-2 col-form-label">Rescued Date: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="date" class="form-control" id="edit-rescuedDate" name="edit-rescuedDate" value="<?php echo $rescuedDate?>"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit-story-link" class="col-sm-12 col-lg-2 col-form-label">Read story here: <span class="">*</span></label>
                                    <div class="col-lg-10 col-sm-12">
                                        <input type="text" class="form-control" id="edit-story-link" name="edit-story-link" value="<?php echo $storyLink?>"/>
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

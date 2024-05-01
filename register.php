<?php
session_start();
require('./php/connect.php');

if(isset($_SESSION['user_id'])){
  header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $secqa = $_POST['secqa'];
    $secAnsA = $_POST['sec-ans-a'];
    $secqb = $_POST['secqb'];
    $secAnsB = $_POST['sec-ans-b'];
    $secqc = $_POST['secqc'];
    $secAnsC = $_POST['sec-ans-c'];


    // Check if any of the fields are empty
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>All fields are required.</div>";
    } elseif ($password != $confirm_password) {
        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Password confirmation does not match.</div>";
    } else {
        // All fields are filled and passwords match, proceed with registration
        $sql = "INSERT INTO users (username, password, email, user_role_id, sec_1, ans_1, sec_2, ans_2, sec_3, ans_3) VALUES ('$username', '$password', '$email', 2,'$secqa','$secAnsA','$secqb','$secAnsB','$secqc','$secAnsC')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Registration successful! You can now log in.</div>";
            header("location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Registration failed. Please try again.</div>";
        }
    }
}

$conn->close();
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Register</h1>
        </div>
    </div>
    <div class="bg-kabarkadogs marketing">
        <div class="container">
          <div class="row featurette">
            <div class="col-5 mx-auto d-flex flex-column align-items-center">
              <form class="row g-3" method="post">
                  <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                  ?>
                 
                <center><strong><label for="" class="form-label font-weight-bold pt-3">Create account</label></strong></center>
                <div class="col-12">
                    <label for="username-acc" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username-acc" name="username" required>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-12">
                    <label for="password-acc" class="form-label">Password:</label>
                    <input type="password-acc" class="form-control" id="password-acc" name="password" required>
                </div>
                <div class="col-12">
                    <label for="confirm_password_acc" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password_acc" name="confirm_password" required>
                </div>
               
                <center><strong><label for="" class="form-label font-weight-bold">Create security question</label></strong></center>
                <div class="col-12">
                    <!-- <label for="petName" class="form-label">Name of your pet:</label> -->
                    <select class="col-12 form-select" name="secqa">
                        <option value="secq1a">Pet name</option>
                        <option value="secq2a">Type of pet</option>
                        <option value="secq3a">Type of breed of pet</option>
                        <option value="secq4a">Pet's age</option>
                    </select>
                    <input type="text" class="form-control" id="sec-ans-a" name="sec-ans-a" placeholder="answer" required>
                </div>
                <div class="col-12">
                    <!-- <label for="motherMiddleName" class="form-label">Your mother's middle name:</label> -->
                    <select class="col-12 form-select" name="secqb">
                        <option value="secq1b">Mother's name</option>
                        <option value="secq2b">Father's name</option>
                        <option value="secq3b">Grand mother's name</option>
                        <option value="secq4b">Grand father's name</option>
                    </select>
                    <input type="text" class="form-control" id="sec-ans-b" name="sec-ans-b" placeholder="answer" required>
                </div>
                <div class="col-12">
                    <!-- <label for="lastDigitPhone" class="form-label">Last digits of your phone number:</label> -->
                    <select class="col-12 form-select" name="secqc">
                        <option value="secq1c">First 4 digits of phone number</option>
                        <option value="secq2c">Last 4 digits of phone number</option>
                        <option value="secq3c">Your lucky number</option>
                        <option value="secq4c">Number of your cousin</option>
                    </select>
                    <input type="text" class="form-control" id="sec-ans-c" name="sec-ans-c" placeholder="answer" required>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-kabarkadogs w-100">Submit</button>
                </div>
              </form>
            </div>
            <hr class="featurette-divider" />
          </div>
        </div>
      </div>

<?php require('./layout/footer.php')?>
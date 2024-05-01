<?php
session_start();
require('./php/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_reporting(0);
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $userId = $_SESSION['user_id']; 


    $secqa = $_POST['secqa'];
    $secAnsA = $_POST['sec-ans-a'];
    $secqb = $_POST['secqb'];
    $secAnsB = $_POST['sec-ans-b'];
    $secqc = $_POST['secqc'];
    $secAnsC = $_POST['sec-ans-c'];

    $checkPasswordQuery = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($checkPasswordQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $currentPassword = $row['password'];

        if(($secqa==$row['sec_1'] && $secAnsA == $row['ans_1']) && 
        ($secqb==$row['sec_2'] && $secAnsB == $row['ans_2']) && 
        ($secqc==$row['sec_3'] && $secAnsC == $row['ans_3'])){
            if ($oldPassword == $currentPassword) {
                if ($newPassword != $confirmPassword) {
                    $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>New password and confirm password do not match.</div>";
            // var_dump("confirm pass not match: ",$row['sec_1'], $row['sec_2'], $row['sec_3'], $row['ans_1'], $row['ans_2'], $row['ans_3']);

                } else {

                    $updatePasswordQuery = "UPDATE users SET password = '$newPassword' WHERE id = $userId";
                    if ($conn->query($updatePasswordQuery)) {
                        $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Password changed successfully.</div>";
            // var_dump("password succesfully change: ",$row['sec_1'], $row['sec_2'], $row['sec_3'], $row['ans_1'], $row['ans_2'], $row['ans_3']);

                    } else {
                        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Password change failed. Please try again later.</div>";
            // var_dump("changing password failed: ",$row['sec_1'], $row['sec_2'], $row['sec_3'], $row['ans_1'], $row['ans_2'], $row['ans_3']);

                    }
                }

            } else {
                $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Old password is incorrect.</div>";
                // var_dump("Old password is incorrect: ",$row['sec_1'], $row['sec_2'], $row['sec_3'], $row['ans_1'], $row['ans_2'], $row['ans_3']);

            }
        }
        else{
            $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Security questions not match.</div>";
            // var_dump("Security questions not match: ",$row['sec_1'], $row['sec_2'], $row['sec_3'], $row['ans_1'], $row['ans_2'], $row['ans_3']);
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>User not found.</div>";
        // var_dump("User not found: ",$row['sec_1'], $row['sec_2'], $row['sec_3'], $row['ans_1'], $row['ans_2'], $row['ans_3']);
    }

$conn->close();
}
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-1">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Change password</h1>
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
             
                <center><strong><label for="" class="form-label font-weight-bold">Change password:</label></strong></center>
                <div class="col-12">
                    <label for="old_password" class="form-label">Old password:</label>
                    <input type="password" class="form-control" id="old_password" name="old_password">
                </div>
                <div class="col-12">
                    <label for="new_password" class="form-label">New password:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="col-12">
                    <label for="confirm_password" class="form-label">New confirm password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>


                <center><strong><label for="" class="form-label font-weight-bold">Answer security question</label></strong></center>
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
            <hr class="featurette-divider"/>
          </div>
        </div>
      </div>

<?php require('./layout/footer.php')?>
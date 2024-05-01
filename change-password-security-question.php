<?php
session_start();
require('./php/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $userId = $_SESSION['user_id']; 

    $checkPasswordQuery = "SELECT password FROM users WHERE id = $userId";
    $result = $conn->query($checkPasswordQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $currentPassword = $row['password'];

        if ($oldPassword == $currentPassword) {

            if ($newPassword != $confirmPassword) {
                $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>New password and confirm password do not match.</div>";
            } else {

                $updatePasswordQuery = "UPDATE users SET password = '$newPassword' WHERE id = $userId";
                if ($conn->query($updatePasswordQuery)) {
                    $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Password changed successfully.</div>";
                } else {
                    $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Password change failed. Please try again later.</div>";
                }
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Old password is incorrect.</div>";
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>User not found.</div>";
    }

$conn->close();
}
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Change Password</h1>
        </div>
    </div>
    <div class="bg-kabarkadogs marketing">
        <div class="container">
          <div class="row featurette">
            <div class="col-12 d-flex flex-column align-items-center">
              <form class="row g-3" method="post">
                  <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                  ?>
                <div class="col-12">
                    <label for="old_password" class="form-label">Old Password:</label>
                    <select class="form-control" id="old_password" name="old_password">
                        <option value="password1">Password 1</option>
                        <option value="password2">Password 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="col-12">
                    <label for="new_password" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="col-12">
                    <label for="confirm_password" class="form-label">New Confirm Passowrd:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
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
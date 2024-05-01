<?php
session_start();
require('../php/connect.php');

if(isset($_SESSION['admin_id'])){
  header("Location: dashboard.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, admin_email, admin_password, admin_username FROM admin WHERE admin_email = '$email' AND admin_user_role_id = 1";
    $result = $conn->query($sql);

    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['admin_password']) {
            $_SESSION['admin_username'] = $user['admin_username'];
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_email'] = $user['admin_email'];

            header("Location: dashboard.php");
            exit();
        }
    }

    $_SESSION['message'] = "Invalid login credentials. Please try again.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../assets/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />
    <link rel="icon" href="assets/images/logo.jpg" type="image/x-icon" />
    <title>Login</title>
  </head>
  <body>
  <?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>
    <div id="wrapper">
      <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-0">
          <div id="header-logo" class="seller-center-logo">
            <div
              class="d-flex justify-content-center align-items-center h-100 w-100"
            >
            <img src="assets/images/logo.jpg" alt="THE KABARKADOGS" class="rounded"/>
              <span id="seller-center-text" class="color-kabarkadogs"
                >THE KABARKADOGS</span
              >
            </div>
          </div>
        </div>
      </header>
      <div id="content" class="login-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <div class="col-lg-5 col-sm-10 col-12 col-md-8 mt-5">
                <div id="login-container">
                  <h2>Admin Login</h2>
                  <form method="post">
                    <div class="input-group mb-3 mt-4">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Email"
                        name="email"
                      />
                    </div>
                    <div class="input-group mb-3 mt-4">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-lock"></i
                      ></span>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Password"
                        name="password"
                        id="passwordInput"
                      />
                      <span class="input-group-text" id="eye-toggle">
                        <i class="fa-solid fa-eye"></i> 
                      </span>
                    </div>
                    <button type="submit" class="btn btn-kabarkadogs w-100">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div style="background-color: red; width: 100px; height: 1000px"></div> -->
      <footer style="margin-left: 0">
        THE KABARKADOGS &copy; 2023 All Rights Reserved
      </footer>
    </div>
    <script
      type="text/javascript"
      src="../assets/js/bootstrap.bundle.min.js"
    ></script>
    <script>

        var passwordInput = document.getElementById("passwordInput");
        var eyeIcon = document.querySelector('#eye-toggle i.fa-eye');

        eyeIcon.addEventListener('click',function(){

        if (passwordInput.type === "password") {
            passwordInput.type = "text"; // Change input type to text to show password
            eyeIcon.classList.remove('fa-eye'); // Remove eye icon class
            eyeIcon.classList.add('fa-eye-slash'); // Add eye-slash icon class
        } else {
            passwordInput.type = "password"; // Change input type back to password to hide password
            eyeIcon.classList.remove('fa-eye-slash'); // Remove eye-slash icon class
            eyeIcon.classList.add('fa-eye'); // Add eye icon class
        }
      });
    
</script>


  </body>
</html>

<?php
session_start();
require('./php/connect.php');

if(isset($_SESSION['user_id'])){
  header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // var_dump($email);
    // var_dump($password);

    $sql = "SELECT id, email, password, username FROM users WHERE email = '$email' AND user_role_id = 2";
    $result = $conn->query($sql);

    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        }
    }

    $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Invalid login credentials. Please try again.</div>";
}

$conn->close();
?>
<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Login</h1>
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
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <!-- <div>
                  <a href="forgot-password.php" style="text-decoration:none">Forgot Password?</a>
                </div>   -->
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
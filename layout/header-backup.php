<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/stylee.css" />
    <link rel="stylesheet" href="assets/css/carousell.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="icon" href="assets/images/logo.jpg" type="image/x-icon" />
    <style>
   
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg shadow" id="navbar">
      <div class="container">
        
        <img src="assets/images/logo.jpg" alt="logo" height="60" class="rounded me-3">
        <a class="navbar-brand" href="index.php">THE KABARKADOGS</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="events.php">Events</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Others
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="donate.php">Donate</a></li>
                <li><a class="dropdown-item" href="book-appointment.php">Book Appointment</a></li>
                <li><a class="dropdown-item" href="recommendations.php">Recommendations</a></li>
                <li><a class="dropdown-item" href="faqs.php">Frequently Asked Questions</a></li>
                <li><a class="dropdown-item" href="adoption-stories.php">Adoption Stories</a></li>
                <li><a class="dropdown-item" href="rescue-stories.php">Rescue Stories</a></li>
                <li><a class="dropdown-item" href="our-pets.php">Our pets</a></li>
                <li><a class="dropdown-item" href="our-policies.php">Our Policies</a></li>
              </ul>
            </li>
          </ul>
          <div class="d-flex">
            <!-- <button class="btn btn-kabarkadogs me-2"><a href="our-pets.php" class="text-white text-decoration-none">Apply to Adopt</a></button> -->
            <?php if(!isset($_SESSION['username'])){?>
              <button class="btn btn-outline-kabarkadogs me-2"><a href="login.php" class="text-decoration-none color-kabarkadogs">Login</a></button>
              <button class="btn btn-kabarkadogs"><a href="register.php" class="text-white text-decoration-none">Register</a></button>
            <?php }?>
          </div>
          <?php if(isset($_SESSION['username'])){?>
          <div class="dropdown text-end ms-4">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="assets/images/profile.png" alt="mdo" width="40" height="40" class="rounded-circle">
              <span class="ms-2 fw-bold color-kabarkadogs"><?php echo $_SESSION['username']?></span>
            </a>
            <ul class="dropdown-menu text-small">
              <li><a class="dropdown-item" href="notifications.php">Notification</a></li>
              <li><a class="dropdown-item" href="change-password.php" >Change Password</a></li>
              <li><a class="dropdown-item" href="_process_logout.php">Logout</a></li>
            </ul>
          </div>
          <?php }?>
        </div>
      </div>
    </nav>
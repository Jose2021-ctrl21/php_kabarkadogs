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
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon" />
    <style>
   
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg shadow bg-f5f5dc" id="navbar">
      <!-- <div class="container"> -->
        
        <img src="assets/images/logo.png" alt="logo" height="60" class="rounded me-3">
        <a class="navbar-brand" href="index.php">THE KABARKADOGS</a>
        <button
        class="navbar-toggler" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#offcanvasLightNavbar" 
        aria-controls="offcanvasLightNavbar" 
        aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">The Kabarkadogs</h5>
          <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item" title ="Home">
              <a class="nav-link" aria-current="page" href="index.php">
                <i class="fa-solid fa-home"></i>
                <span class="hide-when">Home</span>
              </a>
            </li>
            <li class="nav-item" title ="About us">
              <a class="nav-link" href="about.php">
                <i class="fas fa-info-circle"></i> 
                <span class="hide-when">About us</span>
              </a>
            </li>
            <li class="nav-item" title ="Our pets">
              <a class="nav-link" href="our-pets.php">
                  <i class="fas fas fa-paw"></i>
                  <span class="hide-when">Our pets</span>
                </a>
            </li>
            <li class="nav-item" title ="Events">
              <a class="nav-link" href="events.php">
                <i class="fas fa-calendar-alt"></i>
                <span class="hide-when">Events</span>
              </a>
            </li>
            <li class="nav-item" title ="Book appointment">
              <a class="nav-link" href="book-appointment.php">
                  <i class="fas fa-calendar-plus"></i>
                  <span class="hide-when">Book Appointment</span>
                </a>
            </li>
            <li class="nav-item" title ="Donate">
              <a class="nav-link" href="donate.php">
                  <i class="fas fa-hand-holding-heart"></i> 
                  <span class="hide-when">Donate</span>
                </a>
              </li>
              <li class="nav-item" title ="Frequently asked questions">
                <a class="nav-link" href="faqs.php">
                  <i class="fas fa-question"></i> 
                  <span class="hide-when">Faqs</span>
                </a>
              </li>
            <li class="nav-item dropdown " title ="Recommendations, Adoption Stories, Rescue stories, Our policies">
              <a
              class="nav-link dropdown-toggle" 
              href="#" 
              role="button" 
              data-bs-toggle="dropdown" 
              aria-expanded="false"
              >
                <i class="fas fa-ellipsis-h"></i>Others
              </a>
              <ul class="dropdown-menu bg-f5f5dc">
               
                <li><a class="dropdown-item dropdown-a" href="recommendations.php">
                  <i class="fas fa-thumbs-up"></i> Recommendations
                </a></li> 
                <li><a class="dropdown-item dropdown-a" href="adoption-stories.php">
                  <i class="fas fa-book"></i> Adoption Stories
                </a></li>
                <li><a class="dropdown-item dropdown-a" href="rescue-stories.php">
                  <i class="fas as fa-life-ring"></i> Rescue Stories
                </a></li>
                <li><a class="dropdown-item dropdown-a" href="our-policies.php">
                  <i class="fas fas fa-file-alt"></i> Our Policies
                </a></li>
              </ul>
            </li>
          </ul>
          <div class="d-flex">
            <!-- <button class="btn btn-kabarkadogs me-2"><a href="our-pets.php" class="text-white text-decoration-none">Apply to Adopt</a></button> -->
            <?php if(!isset($_SESSION['username'])){?>
              <button class="btn btn-outline-kabarkadogs me-2"><a href="login.php" class="text-decoration-none color-kabarkadogs">
                <i class="fas fa-sign-in-alt"></i> Login
              </a></button>
              <button class="btn btn-kabarkadogs"><a href="register.php" class="text-white text-decoration-none">
                <i class="fas fa-user-plus"></i> Register
              </a></button>
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
      <!-- </div> -->
    </nav>
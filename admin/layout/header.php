<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon" />
    <title>Admin</title>
</head>
<body>
    <div id="wrapper">
        <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <div id="header-logo">
                    <div class="d-flex justify-content-center align-items-center h-100 w-100 navbar-brand">
                        <img src="../assets/images/logo.png" alt="THE KABARKADOGS" class="rounded"/>
                        <span id="seller-center-text" class="color-kabarkadogs me-2"
                            >THE KABARKADOGS</span
                        >
                    </div>
                </div>
                <a href="#" id="button-menu"><i class="fa-solid fa-bars"></i></a>
                <a href="#" id="button-menu-close"><i class="fa-solid fa-xmark"></i></a>
                <ul class="navbar-nav">
                    <!-- update/logout -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['admin_username']?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="_process_logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                
            </div>
        </header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JET 2 Travel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <?php require_once __DIR__ . '/config/app.php'; ?>
    <!-- Libraries Stylesheet -->
    <link href="<?= APP_URL ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= APP_URL ?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= APP_URL ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= APP_URL ?>/css/style.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header class="top-bar">
        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                                class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                                class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                                class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i
                                class="fab fa-youtube fw-normal"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <?php
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        if (isset($_SESSION['user_id'])) {
                            // Always fetch latest name from DB
                            require_once __DIR__ . '/config/database.php';
                            $stmt = $pdo->prepare('SELECT NAME FROM users WHERE id = ?');
                            $stmt->execute([$_SESSION['user_id']]);
                            $row = $stmt->fetch();
                            $displayName = $row ? $row['NAME'] : (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '');
                        ?>
                        <span class="me-3 text-light"><i class="fa fa-user me-2"></i>Hi,
                            <b><?= htmlspecialchars($displayName) ?></b></span>
                        <a href="<?= APP_URL ?>/account-profile.php"
                            class="nav-item nav-link<?= $current_page == 'acccount-profile.php' ? ' active' : '' ?>">Dashboard</a>
                        <a href="<?= APP_URL ?>/logout.php"
                            class="nav-item nav-link<?= $current_page == 'logout.php' ? ' active' : '' ?>">Logout</a>
                        <?php } else { ?>
                        <a href="<?= APP_URL ?>/authentication-register.php"
                            class="nav-item nav-link<?= $current_page == 'authentication-register.php' ? ' active' : '' ?>">Register</a>
                        <a href="<?= APP_URL ?>/login.php"
                            class="nav-item nav-link<?= $current_page == 'login.php' ? ' active' : '' ?>">Logout</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>JET to Travel</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <?php
                        $current_page = basename($_SERVER['PHP_SELF']);
                        ?>
                        <a href="<?= APP_URL ?>/index.php"
                            class="nav-item nav-link<?= $current_page == 'index.php' ? ' active' : '' ?>">Home</a>
                        <a href="<?= APP_URL ?>/about.php"
                            class="nav-item nav-link<?= $current_page == 'about.php' ? ' active' : '' ?>">About</a>
                        <a href="<?= APP_URL ?>/packages.php"
                            class="nav-item nav-link<?= $current_page == 'packages.php' ? ' active' : '' ?>">Packages</a>
                        <a href="<?= APP_URL ?>/blog.php"
                            class="nav-item nav-link<?= $current_page == 'blog.php' ? ' active' : '' ?>">Blog</a>
                        <a href="<?= APP_URL ?>/booking.php"
                            class="nav-item nav-link<?= $current_page == 'booking.php' ? ' active' : '' ?>">Book Now</a>
                        <a href="<?= APP_URL ?>/contact.php" class="nav-item nav-link">Contact</a>
                    </div>

                </div>
            </nav>

            <!-- Carousel Start -->
            <div class="carousel-header">
                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="<?= APP_URL ?>/img/carousel-2.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                                        Explore The World</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">Let's The World Together!</h1>
                                    <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                        ever since the 1500s,
                                    </p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                                            href="#">Discover Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?= APP_URL ?>/img/carousel-1.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                                        Explore The World</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">Find Your Perfect Tour At
                                        Travel</h1>
                                    <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                        ever since the 1500s,
                                    </p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                                            href="#">Discover Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?= APP_URL ?>/img/carousel-3.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                                        Explore The World</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">You Like To Go?</h1>
                                    <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                        ever since the 1500s,
                                    </p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                                            href="#">Discover Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Carousel End -->
        </div>
        <div class="container-fluid search-bar position-relative" style="top: -50%; transform: translateY(-50%);">
            <div class="container">
                <div class="position-relative rounded-pill w-100 mx-auto p-5"
                    style="background: rgba(19, 53, 123, 0.8);">
                    <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                        placeholder="Eg: Can Tho - Ho Chi Minh City" aria-label="Search">
                    <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute me-2"
                        style="top: 50%; right: 46px; transform: translateY(-50%);">Search</button>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->
    </header>
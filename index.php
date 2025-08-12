<?php
include 'header.php';
require_once 'config/database.php';
$packages = $pdo->query("SELECT p.*, i.image_url FROM packages p LEFT JOIN images_url i ON p.img_id = i.id ORDER BY p.id DESC")->fetchAll(PDO::FETCH_ASSOC);
$allPackages = $pdo->query("SELECT id, Name_Package, Destination, price FROM packages")->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Header End -->
<?php if (!empty($login_success)): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center"
    };
    toastr.success("<?= htmlspecialchars($login_success) ?>");
});
</script>
<?php endif; ?>
<!-- About Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    <img src="img/about-img.jpg" class="img-fluid w-100 h-100" alt="">
                </div>
            </div>
            <div class="col-lg-7"
                style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                <h5 class="section-about-title pe-3">About Us</h5>
                <h1 class="mb-4">Welcome to <span class="text-primary">Travela</span></h1>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, dolorum,
                    doloribus sunt dicta, officia voluptatibus libero necessitatibus natus impedit quam ullam
                    assumenda? Id atque iste consectetur. Commodi odit ab saepe!</p>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quos voluptatem
                    suscipit neque enim, doloribus ipsum rem eos distinctio, dignissimos nisi saepe nulla? Libero
                    numquam perferendis provident placeat molestiae quia?</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>First Class Flights</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                    </div>
                </div>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->



<!-- Packages Start (reused from packages.php) -->
<?php
// Map img_id to image_url
$imageMap = [];
foreach ($pdo->query("SELECT id, title, image_url FROM images_url") as $img) {
    $imageMap[$img['id']] = $img['image_url'];
}
$packagesList = $pdo->query("SELECT * FROM packages ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Packages</h5>
            <h1 class="mb-0">Our Best Tour Packages</h1>
        </div>
        <div class="packages-carousel owl-carousel">
            <?php foreach ($packagesList as $p): ?>
            <div class="packages-item">
                <div class="packages-img">
                    <?php
                    $imgSrc = isset($imageMap[$p['img_id']]) ? $imageMap[$p['img_id']] : 'img/default.jpg';
                    ?>
                    <img src="<?= htmlspecialchars($imgSrc) ?>" class="img-fluid w-100 rounded-top"
                        alt="<?= htmlspecialchars($p['Destination']) ?>">
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                        style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-map-marker-alt me-2"></i><?= htmlspecialchars($p['Destination']) ?></small>
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-calendar-alt me-2"></i><?= htmlspecialchars($p['duration']) ?> days</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user me-2"></i><?= $p['max_people'] ?>
                            People</small>
                    </div>
                    <div class="packages-price py-2 px-4">$<?= number_format($p['price']) ?></div>
                </div>
                <div class="packages-content bg-light">
                    <div class="p-4 pb-0">
                        <h5 class="mb-0"><?= htmlspecialchars($p['Name_Package']) ?></h5>
                        <small class="text-uppercase">Category:
                            <?= htmlspecialchars($p['category_tours'] ?? '') ?></small>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                        </div>
                        <p class="mb-4">Destination: <?= htmlspecialchars($p['Destination']) ?>. Max people:
                            <?= $p['max_people'] ?>.</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <?php
                            // Map destination to detail page (same as packages.php)
                            $detailPages = [
                                'Can Tho - HCM' => 'CanTho-TPHCM.php',
                                'Da Nang - Hoi An' => 'DaNang-HoiAn.php',
                                'Ha Noi - Ha Long' => 'HaNoi-HaLong.php',
                                'Nha Trang - Phu Quoc' => 'NhaTrang-PhuQuoc.php',
                                'Hue - Phong Nha' => 'Hue-PhongNha.php',
                                'Da Lat - Sapa' => 'DaLat-Sapa.php',
                            ];
                            $currentDestination = trim($p['Destination'] ?? '');
                            $file = $detailPages[$currentDestination] ?? '';
                            $detailUrl = $file ? "Details-Packages/$file" : '#';
                            ?>
                            <a href="<?= $detailUrl ?>" class="btn-hover btn text-white py-2 px-4">Read More</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="Booking.php" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Packages End -->
<?php
       $msg = '';
    // Fetch all packages for destination dropdown and price mapping
    $packages = $pdo->query("SELECT id,
        Name_Package, Destination, price FROM packages")->fetchAll(PDO::FETCH_ASSOC);

        // Handle booking submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_now'])) {
        $package_id = intval($_POST['destination'] ?? 0);
        $num_adults = intval($_POST['persons'] ?? 1);
        $num_kids = intval($_POST['kids'] ?? 0);
        $num_people = $num_adults + $num_kids;
        $user_id = $_SESSION['user_id'] ?? null;
        $start_date = $_POST['start_date'] ?? '';
        $end_date = $_POST['end_date'] ?? '';
        $price = 0;
        // Get price from selected package
        foreach ($packages as $p) {
        if ($p['id'] == $package_id) {
        $price = $p['price'];
        break;
        }
        }
        // Calculate subtotal: adults full price, kids 50% price
        $subtotal = ($price * $num_adults) + ($price * 0.5 * $num_kids);
        if ($package_id && $num_people && $start_date && $end_date && $user_id) {
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, package_id, booking_at, num_people, price, subtotal,
        STATUS,
        start_date, end_date) VALUES (?, ?, NOW(), ?, ?, ?, 'pending', ?, ?)");
        $success = $stmt->execute([$user_id, $package_id, $num_people, $price, $subtotal, $start_date, $end_date]);
        if ($success) {
        $msg = '<div class="alert alert-success">Booking successful! You can view your booking in your profile.</div>';
        } else {
        $msg = '<div class="alert alert-danger">Booking failed. Please try again.</div>';
        }
        } else {
        $msg = '<div class="alert alert-warning">Please fill in all required fields and login.</div>';
        }
        }
        ?>
<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Booking</h5>
                <h1 class="text-white mb-4">Online Booking</h1>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur
                    maxime
                    ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium?
                    Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                </p>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur
                    maxime
                    ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium?
                    Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                </p>
                <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Read More</a>
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">Book A Tour Deals</h1>
                <p class="text-white mb-4">Get <span class="text-warning">50% Off</span> On Your First Adventure
                    Trip
                    With Travela. Get More Deal Offers Here.</p>
                <?= $msg ?>
                <?php
                // PHP price/subtotal calculation for display
                $display_price = '';
                $display_subtotal = '';
                $selected_package_id = $_POST['destination'] ?? '';
                $selected_adults = intval($_POST['persons'] ?? 1);
                $selected_kids = intval($_POST['kids'] ?? 0);
                if ($selected_package_id) {
                    foreach ($packages as $p) {
                        if ($p['id'] == $selected_package_id) {
                            $display_price = $p['price'];
                            break;
                        }
                    }
                    if ($display_price !== '') {
                        $display_subtotal = ($display_price * $selected_adults) + ($display_price * 0.5 * $selected_kids);
                    }
                }
                ?>
                <?php if ($display_price !== ''): ?>
                <div class="mb-2">
                    <span class="fw-bold text-primary">Price: $<?= number_format($display_price) ?></span>
                    <?php if ($display_subtotal !== ''): ?>
                    <span class="fw-bold text-success ms-3">Subtotal:
                        $<?= number_format($display_subtotal) ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="alert alert-warning">You must be <a href="authentication-login.php">logged in</a> to
                    book a
                    tour.</div>
                <a href="authentication-login.php" class="btn btn-primary">Login</a>
                <?php else: ?>
                <form method="post" autocomplete="off">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control bg-white border-0" id="start_date"
                                    name="start_date" required>
                                <label for="start_date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control bg-white border-0" id="end_date" name="end_date"
                                    required>
                                <label for="end_date">End Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="destination" name="destination"
                                    required onchange="updatePrice()">
                                    <option value="">Select Destination</option>
                                    <?php foreach ($allPackages as $p): ?>
                                    <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>">
                                        <?= htmlspecialchars($p['Destination']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="destination">Destination</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectPerson" name="persons" required>
                                    <option value="1">1 Adult</option>
                                    <option value="2">2 Adults</option>
                                    <option value="3">3 Adults</option>
                                    <option value="4">4 Adults</option>
                                    <option value="5">5 Adults</option>
                                </select>
                                <label for="SelectPerson">Adults</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control bg-white border-0" id="kids" name="kids"
                                    min="0" max="10" value="0" required>
                                <label for="kids">Kids</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="CategoriesSelect" name="category">
                                    <option value="Kids">Kids</option>
                                    <option value="Family">Family</option>
                                    <option value="Adventure">Adventure</option>
                                    <option value="Beach">Beach</option>
                                </select>
                                <label for="CategoriesSelect">Categories</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-white border-0" placeholder="Special Request"
                                    id="message" name="special" style="height: 100px"></textarea>
                                <label for="message">Special Request</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit" name="book_now">Book
                                Now</button>
                        </div>
                </form>
                <?php endif; ?>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
<!-- Packages End -->


<!-- Blog Start -->
<?php
// Only select the 3 specific packages for the blog section
$blogPackages = $pdo->query("SELECT p.*, i.image_url FROM packages p LEFT JOIN images_url i ON p.img_id = i.id WHERE p.Destination IN ('Hue - Phong Nha', 'Da Lat - Sapa', 'Ha Noi - Ha Long') ORDER BY FIELD(p.Destination, 'Hue - Phong Nha', 'Da Lat - Sapa', 'Ha Noi - Ha Long')")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Blog</h5>
            <h1 class="mb-4">Popular Travel Blogs</h1>
            <p class="mb-0">Discover our top 3 tour packages, handpicked for your next adventure!</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($blogPackages as $p): ?>
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img class="img-fluid w-100 rounded-top blog-img-click" style="cursor:pointer;"
                                src="<?= htmlspecialchars($p['image_url'] ?? 'img/default.jpg') ?>"
                                alt="<?= htmlspecialchars($p['Name_Package']) ?>" data-bs-toggle="modal"
                                data-bs-target="#galleryModal<?= $p['id'] ?>">
                            <div class="blog-icon">
                                <a href="#" class="my-auto" data-bs-toggle="modal"
                                    data-bs-target="#galleryModal<?= $p['id'] ?>"><i
                                        class="fas fa-link fa-2x text-white"></i></a>
                            </div>
                            <!-- Modal Gallery for this package -->
                            <div class="modal fade" id="galleryModal<?= $p['id'] ?>" tabindex="-1"
                                aria-labelledby="galleryModalLabel<?= $p['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title text-white" id="galleryModalLabel<?= $p['id'] ?>">
                                                Gallery: <?= htmlspecialchars($p['Name_Package']) ?></h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="carousel<?= $p['id'] ?>" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php for ($i=1; $i<=5; $i++): ?>
                                                    <div class="carousel-item<?= $i==1 ? ' active' : '' ?>">
                                                        <img src="img/gallery-<?= $i ?>.jpg"
                                                            class="d-block w-100 rounded" alt="Gallery image <?= $i ?>">
                                                    </div>
                                                    <?php endfor; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carousel<?= $p['id'] ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carousel<?= $p['id'] ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i><?= htmlspecialchars($p['Destination']) ?></small>
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i><?= htmlspecialchars($p['duration']) ?>
                                days</small>
                            <small class="flex-fill text-center py-2"><i
                                    class="fa fa-user text-primary me-2"></i><?= $p['max_people'] ?> People</small>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-3">Price: $<?= number_format($p['price']) ?></p>
                        <?php
                        // Map destination to detail page (reuse logic from packages.php)
                        $detailPages = [
                            'Can Tho - HCM' => 'CanTho-TPHCM.php',
                            'Da Nang - Hoi An' => 'DaNang-HoiAn.php',
                            'Ha Noi - Ha Long' => 'HaNoi-HaLong.php',
                            'Nha Trang - Phu Quoc' => 'NhaTrang-PhuQuoc.php',
                            'Hue - Phong Nha' => 'Hue-PhongNha.php',
                            'Da Lat - Sapa' => 'DaLat-Sapa.php',
                        ];
                        $currentDestination = trim($p['Destination'] ?? '');
                        $file = $detailPages[$currentDestination] ?? '';
                        $detailUrl = $file ? "Details-Packages/$file" : '#';
                        ?>
                        <a href="<?= $detailUrl ?>" class="h4"><?= htmlspecialchars($p['Name_Package']) ?></a>
                        <p class="my-3">Destination: <?= htmlspecialchars($p['Destination']) ?>. Duration:
                            <?= htmlspecialchars($p['duration']) ?> days.</p>
                        <a href="<?= $detailUrl ?>" class="btn btn-primary rounded-pill py-2 px-4">Read More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Blog End -->



<!-- Subscribe Start -->
<div class="container-fluid subscribe py-5">
    <div class="container text-center py-5">
        <div class="mx-auto text-center" style="max-width: 900px;">
            <h5 class="subscribe-title px-3">Subscribe</h5>
            <h1 class="text-white mb-4">Our Newsletter</h1>
            <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam,
                architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium
                fugiat corrupti eum cum repellat a laborum quasi.
            </p>
            <div class="position-relative mx-auto">
                <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                    placeholder="Your email">
                <button type="button"
                    class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Subscribe</button>
            </div>
        </div>
    </div>
</div>

<!-- Subscribe End -->
<?php include 'footer.php'; ?>
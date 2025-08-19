<?php
include 'header.php';
require_once 'config/database.php';

// Lấy toàn bộ bảng images_url để map img_id => image_url (dùng title để kiểm tra)
$imageMap = [];
foreach ($pdo->query("SELECT id, title, image_url FROM images_url") as $img) {
    // Bạn có thể kiểm tra $img['title'] ở đây nếu muốn
    $imageMap[$img['id']] = $img['image_url'];
}

$packages = $pdo->query("SELECT * FROM packages ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Packages Start -->
<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Packages</h5>
            <h1 class="mb-0">Our Best Tour Packages</h1>
        </div>
        <div class="packages-carousel owl-carousel">
            <?php foreach ($packages as $p): ?>
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
                        <p class="mb-4">Destination: <?= htmlspecialchars($p['Destination']) ?> <br> Max people:
                            <?= $p['max_people'] ?>.</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <?php
                            // Map destination to detail page
                            $dest = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', str_replace([' ', '-', '–', '—'], '', $p['Destination'])));
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
                                    <?php foreach ($packages as $p): ?>
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
<!-- Tour Booking End -->

<!-- Subscribe Start -->
<div class="container-fluid subscribe py-5">
    <div class="container text-center py-5">
        <div class="mx-auto text-center" style="max-width: 900px;">
            <h5 class="subscribe-title px-3">Subscribe</h5>
            <h1 class="text-white mb-4">Our Newsletter</h1>
            <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam,
                architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium
                fugiat
                corrupti eum cum repellat a laborum quasi.
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

<!-- Footer Start -->
<div class="container-fluid footer py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Get In Touch</h4>
                    <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
                    <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                    <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                    <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-share fa-2x text-white me-2"></i>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Company</h4>
                    <a href=""><i class="fas fa-angle-right me-2"></i> About</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Careers</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Blog</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Press</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Gift Cards</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Magazine</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Support</h4>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Legal Notice</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Terms and Conditions</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Sitemap</a>
                    <a href=""><i class="fas fa-angle-right me-2"></i> Cookie policy</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <div class="row gy-3 gx-2 mb-4">
                        <div class="col-xl-6">
                            <form>
                                <div class="form-floating">
                                    <select class="form-select bg-dark border" id="select1">
                                        <option value="1">Arabic</option>
                                        <option value="2">German</option>
                                        <option value="3">Greek</option>
                                        <option value="3">New York</option>
                                    </select>
                                    <label for="select1">English</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-6">
                            <form>
                                <div class="form-floating">
                                    <select class="form-select bg-dark border" id="select1">
                                        <option value="1">USD</option>
                                        <option value="2">EUR</option>
                                        <option value="3">INR</option>
                                        <option value="3">GBP</option>
                                    </select>
                                    <label for="select1">$</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h4 class="text-white mb-3">Payments</h4>
                    <div class="footer-bank-card">
                        <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                        <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright text-body py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right
                reserved.
            </div>
            <div class="col-md-6 text-center text-md-start">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                    href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Copyright End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
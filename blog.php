<?php
include 'header.php';
require_once 'config/database.php';
$packages = $pdo->query("SELECT p.*, i.image_url FROM packages p LEFT JOIN images_url i ON p.img_id = i.id ORDER BY p.id DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Blog</h5>
            <h1 class="mb-4">Popular Travel Blogs</h1>
            <p class="mb-0">Discover our top 3 tour packages, handpicked for your next adventure!</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($packages as $p): ?>
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
                        <p class="my-3">Destination: <?= htmlspecialchars($p['Destination']) ?> <br> Duration:
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
                Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
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
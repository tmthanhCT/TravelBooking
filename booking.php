<?php

include 'header.php';
require_once __DIR__ . '/config/database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$msg = '';
// Fetch all packages for destination dropdown and price mapping
$packages = $pdo->query("SELECT id, Name_Package, Destination, price FROM packages")->fetchAll(PDO::FETCH_ASSOC);

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
        if (strtotime($start_date) < strtotime(date('Y-m-d'))) {
            $msg = '<script>Swal.fire({icon:"warning",title:"Invalid date!",text:"Start date cannot be in the past."});</script>';
        } else if (strtotime($end_date) <= strtotime($start_date)) {
            $msg = '<script>Swal.fire({icon:"warning",title:"Invalid date!",text:"End date must be after start date."});</script>';
        } else {
            // Check duplicate booking (same user, package, start_date, end_date, status not cancelled)
            $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE user_id = ? AND package_id = ? AND start_date = ? AND end_date = ? AND STATUS != 'cancelled'");
            $check_stmt->execute([$user_id, $package_id, $start_date, $end_date]);
            $exists = $check_stmt->fetchColumn();
            if ($exists) {
                $msg = '<div class="alert alert-danger">You have already booked this tour for the selected dates.</div>';
            } else {
                // Wallet logic: Deduct 30% of subtotal on booking
                $wallet_stmt = $pdo->prepare("SELECT wallet FROM users WHERE id = ?");
                $wallet_stmt->execute([$user_id]);
                $user_wallet = $wallet_stmt->fetchColumn();
                $deposit = round($subtotal * 0.3, 2);
                if ($user_wallet === false || $user_wallet < $deposit) {
                    $msg = '<div class="alert alert-danger">Insufficient wallet balance. Please top up your wallet.</div>';
                } else {
                    // Deduct 30% from wallet
                    $update_wallet = $pdo->prepare("UPDATE users SET wallet = wallet - ? WHERE id = ?");
                    $update_wallet->execute([$deposit, $user_id]);
                    // Insert booking with status 'pending'
                    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, package_id, booking_at, num_people, price, subtotal, STATUS, start_date, end_date) VALUES (?, ?, NOW(), ?, ?, ?, 'pending', ?, ?)");
                    $success = $stmt->execute([$user_id, $package_id, $num_people, $price, $subtotal, $start_date, $end_date]);
                    if ($success) {
                    } else {
                        // Refund if booking insert fails
                        $pdo->prepare("UPDATE users SET wallet = wallet + ? WHERE id = ?")->execute([$deposit, $user_id]);
                        $msg = '<div class="alert alert-danger">Booking failed. Please try again.</div>';
                    }
                }
            }
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
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking successful, now you can see tour details in profile ',
                        html: `Price: <span class='fw-bold text-primary'>$<?= number_format($display_price) ?></span><br>` +
                            <?php if ($display_subtotal !== ''): ?> `Subtotal: <span class='fw-bold text-success'>$<?= number_format($display_subtotal) ?></span>`
                        <?php else: ?> ''
                        <?php endif; ?>,
                        showConfirmButton: false,
                        timer: 5000
                    });
                });
                </script>
                <?php endif; ?>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="alert alert-warning">You must be <a href="authentication-login.php">logged in</a> to book a
                    tour.</div>
                <a href="authentication-login.php" class="btn btn-primary">Login</a>
                <?php else: ?>
                <form method="post" autocomplete="off">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control bg-white border-0" id="start_date"
                                    name="start_date" required min="<?= date('Y-m-d') ?>">
                                <label for="start_date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control bg-white border-0" id="end_date" name="end_date"
                                    required min="<?= date('Y-m-d') ?>">
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
<?php include 'footer.php'; ?>
<?php ob_end_flush(); ?>
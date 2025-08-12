<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: authentication-login.php');
    exit;
}
require_once __DIR__ . '/config/database.php';
// Handle booking cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking_id'])) {
    $cancelId = intval($_POST['cancel_booking_id']);
    $stmt = $pdo->prepare('UPDATE bookings SET STATUS = ? WHERE id = ? AND user_id = ? AND STATUS != ?');
    $stmt->execute(['cancelled', $cancelId, $_SESSION['user_id'], 'confirmed']);
    $msg = '<div class="alert alert-info">Booking has been cancelled successfully!</div>';
}

// Handle confirm booking (pending -> confirmed)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking_id'])) {
    $confirmId = intval($_POST['confirm_booking_id']);
    $stmt = $pdo->prepare('UPDATE bookings SET STATUS = ? WHERE id = ? AND user_id = ? AND STATUS = ?');
    $stmt->execute(['confirmed', $confirmId, $_SESSION['user_id'], 'pending']);
    $msg = '<div class="alert alert-success">Booking has been confirmed!</div>';
}
include 'header.php';

$msg = '';
// Handle update info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $city = trim($_POST['city'] ?? '');
    if ($name && $email && $phone) {
        $stmt = $pdo->prepare('UPDATE users SET NAME=?, email=?, phone=?, city=? WHERE id=?');
        $success = $stmt->execute([$name, $email, $phone, $city, $_SESSION['user_id']]);
        if ($success) {
            $_SESSION['user_name'] = $name;
            $msg = '<script>Swal.fire("Success!", "Profile updated successfully!", "success");</script>';
        } else {
            $msg = '<script>Swal.fire("Error!", "Failed to update profile. Please try again.", "error");</script>';
        }
    } else {
        $msg = '<script>Swal.fire("Warning!", "Please fill in all required fields.", "warning");</script>';
    }
}
// Fetch user info again (after update)
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
if (!$user) {
    session_destroy();
    header('Location: authentication-login.php');
    exit;
}
?>
<div class="container py-5" style="max-width: 700px;">
    <h2 class="mb-4 text-center"><i class="fa fa-user-circle text-primary me-2"></i>Account Profile</h2>
    <?= $msg ?>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Hello, <b><?= htmlspecialchars($user['NAME']) ?></b></h5>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><i class="fa fa-envelope me-2"></i><b>Email:</b>
                    <?= htmlspecialchars($user['email']) ?></li>
                <li class="list-group-item"><i class="fa fa-phone me-2"></i><b>Phone:</b>
                    <?= htmlspecialchars($user['phone']) ?></li>
                <li class="list-group-item"><i class="fa fa-map-marker-alt me-2"></i><b>City:</b>
                    <?= htmlspecialchars($user['city'] ?? '') ?></li>
                <li class="list-group-item"><i class="fa fa-user-tag me-2"></i><b>Role:</b>
                    <?= htmlspecialchars($user['role'] ?? 'user') ?></li>
                <li class="list-group-item"><i class="fa fa-wallet me-2 text-success"></i><b>My Wallet:</b>
                    <span class="badge bg-info text-dark">$<?= number_format($user['wallet'], 2) ?></span>
                </li>
            </ul>
            <a href="index.php" class="btn btn-primary mt-2"><i class="fa fa-home me-1"></i>Home</a>
            <a href="logout.php" class="btn btn-danger mt-2 ms-2"><i class="fa fa-sign-out-alt me-1"></i>Logout</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"><i class="fa fa-edit text-primary me-2"></i>Edit Profile</h5>
            <form method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fa fa-user me-1"></i>Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="<?= htmlspecialchars($user['NAME']) ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fa fa-envelope me-1"></i>Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="<?= htmlspecialchars($user['email']) ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label"><i class="fa fa-phone me-1"></i>Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required
                        value="<?= htmlspecialchars($user['phone']) ?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label"><i class="fa fa-map-marker-alt me-1"></i>City</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                </div>
                <button type="submit" name="update_profile" class="btn btn-success w-100"><i
                        class="fa fa-save me-1"></i>Update Profile</button>
            </form>
        </div>
    </div>
</div>
<?php
// Fetch user's bookings (all statuses)
$bookings = [];
try {
    $sql = "SELECT b.id AS booking_id, b.package_id, b.booking_at, b.num_people, b.price, b.subtotal, b.STATUS, p.Name_Package, p.Destination
            FROM bookings b
            JOIN packages p ON b.package_id = p.id
            WHERE b.user_id = ?
            ORDER BY b.booking_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // ignore errors if bookings table does not exist
}
?>
<div class="container py-4" style="max-width: 900px;">
    <h3 class="mb-3"><i class="fa fa-suitcase-rolling text-primary me-2"></i>Your Bookings</h3>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Package Name</th>
                    <th>Destination</th>
                    <th>Booking At</th>
                    <th>People</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $today = date('Y-m-d');
                $eligibleReviews = [];
                if (empty($bookings)) {
                ?>
                <tr>
                    <td colspan="8" class="text-center">No bookings found.</td>
                </tr>
                <?php } else {
                    foreach ($bookings as $b) {
                        $bookingAt = $b['booking_at'];
                        $formattedBookingAt = '-';
                        if ($bookingAt && $bookingAt !== '0000-00-00' && $bookingAt !== '0000-00-00 00:00:00') {
                            $dt = DateTime::createFromFormat('Y-m-d H:i:s', $bookingAt);
                            if (!$dt) {
                                $dt = DateTime::createFromFormat('Y-m-d', $bookingAt);
                                if ($dt) {
                                    $formattedBookingAt = $dt->format('d/m/Y');
                                } else {
                                    $formattedBookingAt = htmlspecialchars($bookingAt);
                                }
                            } else {
                                $formattedBookingAt = $dt->format('d/m/Y H:i');
                            }
                        }
                        // Check if eligible for review
                        $stmt_end = $pdo->prepare('SELECT end_date FROM bookings WHERE id = ?');
                        $stmt_end->execute([$b['booking_id']]);
                        $end_date = $stmt_end->fetchColumn();
                        $can_review = false;
                        if ($end_date && $end_date < $today && strtolower($b['STATUS']) === 'confirmed') {
                            $can_review = true;
                            $eligibleReviews[] = [
                                'booking' => $b,
                                'end_date' => $end_date
                            ];
                        }
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($b['Name_Package']) . '</td>';
                        echo '<td>' . htmlspecialchars($b['Destination']) . '</td>';
                        echo '<td>' . $formattedBookingAt . '</td>';
                        echo '<td>' . htmlspecialchars($b['num_people']) . '</td>';
                        echo '<td>$' . number_format($b['price']) . '</td>';
                        echo '<td>$' . number_format($b['subtotal']) . '</td>';
                        echo '<td>' . htmlspecialchars($b['STATUS']);
                        if (strtolower($b['STATUS']) !== 'confirmed' && strtolower($b['STATUS']) !== 'cancelled') {
                            echo '<form method="post" style="display:inline">';
                            echo '<input type="hidden" name="cancel_booking_id" value="' . $b['booking_id'] . '">';
                            echo '<button type="submit" class="btn btn-sm btn-danger ms-2" 
                                onclick="return confirm(\'Are you sure you want to cancel this booking?\');
                                ">Cancel</button>';  
                            echo '</form>';
                        }
                        echo '</td>';
                        // Review button
                        echo '<td>';
                        if ($can_review) {
                            echo '<button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#reviewModal' . $b['booking_id'] . '">Review</button>';
                        } else {
                            echo '-';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Hiển thị bảng đánh giá nếu có từ 2 booking đủ điều kiện
if (count($eligibleReviews) >= 2) {
    echo '<div class="container py-4" style="max-width: 900px;">';
    echo '<h4 class="mb-3 text-primary"><i class="fa fa-star me-1"></i>Review Completed Tours</h4>';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered align-middle">';
    echo '<thead class="table-light"><tr><th>Your Booking</th><th>Review</th></tr></thead><tbody>';
    foreach ($eligibleReviews as $item) {
        $b = $item['booking'];
        $modalId = 'reviewModal' . $b['booking_id'];
        echo '<tr>';
        echo '<td>' . htmlspecialchars($b['Name_Package']) . '<br><span class="text-muted">' . htmlspecialchars($b['Destination']) . '</span><br><span class="text-muted">End Date: ' . htmlspecialchars($item['end_date']) . '</span></td>';
        echo '<td>';
        echo '<button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">Review</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div></div>';
}
?>

<?php
// Handle review submission and update users table, then reload user info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'], $_POST['review_booking_id'])) {
    $bookingId = intval($_POST['review_booking_id']);
    $rating = intval($_POST['rating'] ?? 0);
    $review = trim($_POST['review'] ?? '');
    $stmt = $pdo->prepare('SELECT * FROM bookings WHERE id = ? AND user_id = ?');
    $stmt->execute([$bookingId, $_SESSION['user_id']]);
    $booking = $stmt->fetch();
    $can_review = false;
    if ($booking && !empty($booking['end_date'])) {
        $today = date('Y-m-d');
        if ($booking['end_date'] < $today) {
            $can_review = true;
        }
    }
    if ($can_review && $rating && $review) {
        $stmt = $pdo->prepare('UPDATE users SET rating = ?, review = ?, created_at = NOW() WHERE id = ?');
        $stmt->execute([$rating, $review, $_SESSION['user_id']]);
        // Reload user info after update
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
    }
}

if (!empty($eligibleReviews)) {
    foreach ($eligibleReviews as $item) {
        $b = $item['booking'];
        $modalId = 'reviewModal' . $b['booking_id'];
        echo '<div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="reviewModalLabel' . $b['booking_id'] . '" aria-hidden="true">';
        echo '  <div class="modal-dialog">';
        echo '    <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '        <h5 class="modal-title" id="reviewModalLabel' . $b['booking_id'] . '"><i class="fa fa-star text-warning me-2"></i>Review Tour: ' . htmlspecialchars($b['Name_Package']) . '</h5>';
        echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '      <form method="post">';
        echo '      <div class="modal-body">';
        echo '        <input type="hidden" name="review_booking_id" value="' . $b['booking_id'] . '">';
        echo '        <div class="mb-3">';
        echo '          <label class="form-label">Rating</label>';
        echo '          <select name="rating" class="form-select" required>';
        echo '            <option value="">Select rating</option>';
        for ($i=1; $i<=5; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
        echo '          </select>';
        echo '        </div>';
        echo '        <div class="mb-3">';
        echo '          <label class="form-label">Comment</label>';
        echo '          <input type="text" name="review" class="form-control" placeholder="Your comment" required>';
        echo '        </div>';
        echo '      </div>';
        echo '      <div class="modal-footer">';
        echo '        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        echo '        <button type="submit" name="submit_review" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit Review</button>';
        echo '      </div>';
        echo '      </form>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
}

// Hiển thị review mới nhất nếu đã có, kèm nút Edit Review
if (!empty($user['review']) && !empty($user['rating'])) {
    echo '<div class="container py-3" style="max-width: 700px;">';
    echo '<div class="card border-warning mb-3">';
    echo '<div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">';
    echo '<span><i class="fa fa-star me-1"></i>Your Latest Review</span>';
    echo '<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editReviewModal"><i class="fa fa-edit"></i> Edit Review</button>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title mb-2">' . htmlspecialchars($user['NAME']) . ' <span class="badge bg-secondary">' . htmlspecialchars($user['phone']) . '</span></h5>';
    echo '<p class="mb-1">';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= intval($user['rating'])) {
            echo '<i class="fa fa-star text-warning"></i>';
        } else {
            echo '<i class="fa fa-star text-secondary"></i>';
        }
    }
    echo ' <b>' . intval($user['rating']) . '/5</b>';
    echo '</p>';
    echo '<p class="mb-1"><b>Comment:</b> ' . htmlspecialchars($user['review']) . '</p>';
    echo '<p class="mb-0 text-muted"><i class="fa fa-clock me-1"></i>' . htmlspecialchars($user['created_at']) . '</p>';
    echo '</div></div>';

    // Modal edit review
    echo '<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">';
    echo '  <div class="modal-dialog">';
    echo '    <div class="modal-content">';
    echo '      <div class="modal-header">';
    echo '        <h5 class="modal-title" id="editReviewModalLabel"><i class="fa fa-edit me-1"></i>Edit Review</h5>';
    echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '      </div>';
    echo '      <form method="post">';
    echo '      <div class="modal-body">';
    echo '        <div class="mb-3">';
    echo '          <label class="form-label">Rating</label>';
    echo '          <select name="edit_rating" class="form-select" required>';
    echo '            <option value="">Select rating</option>';
    for ($i=1; $i<=5; $i++) {
        $selected = ($i == intval($user['rating'])) ? 'selected' : '';
        echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
    }
    echo '          </select>';
    echo '        </div>';
    echo '        <div class="mb-3">';
    echo '          <label class="form-label">Comment</label>';
    echo '          <input type="text" name="edit_review" class="form-control" value="' . htmlspecialchars($user['review']) . '" required>';
    echo '        </div>';
    echo '      </div>';
    echo '      <div class="modal-footer">';
    echo '        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
    echo '        <button type="submit" name="submit_edit_review" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>';
    echo '      </div>';
    echo '      </form>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';

    echo '</div>';
}
// Handle edit review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_edit_review'])) {
    $edit_rating = intval($_POST['edit_rating'] ?? 0);
    $edit_review = trim($_POST['edit_review'] ?? '');
    if ($edit_rating && $edit_review) {
        $stmt = $pdo->prepare('UPDATE users SET rating = ?, review = ?, created_at = NOW() WHERE id = ?');
        $stmt->execute([$edit_rating, $edit_review, $_SESSION['user_id']]);
        echo "<script>location.href='account-profile.php';</script>";
        exit;
    }
}
?>
<?php include 'footer.php'; ?>
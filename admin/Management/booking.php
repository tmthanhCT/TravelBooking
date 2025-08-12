<?php
// booking.php - Admin booking management
include '../admin_header.php';
require_once '../../config/database.php';

// Handle status update
if (isset($_POST['update_status'])) {
    $id = intval($_POST['booking_id']);
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE bookings SET STATUS = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
}

// Handle date/time update
if (isset($_POST['update_datetime'])) {
    $id = intval($_POST['booking_id']);
    $booking_at = $_POST['booking_at'];
    $stmt = $pdo->prepare("UPDATE bookings SET booking_at = ? WHERE id = ?");
    $stmt->execute([$booking_at, $id]);
}

// Handle delete (only if status is 'cancelled')
if (isset($_POST['delete_booking'])) {
    $id = intval($_POST['booking_id']);
    // Check status
    $check = $pdo->prepare("SELECT STATUS FROM bookings WHERE id = ?");
    $check->execute([$id]);
    $row = $check->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['STATUS'] === 'cancelled') {
        $del = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        $del->execute([$id]);
    }
}

// Fetch all bookings with user and package info
$bookings = $pdo->query("SELECT * FROM bookings ORDER BY booking_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Prepare user and package lookup arrays
$userMap = [];
foreach ($pdo->query("SELECT id, NAME FROM users") as $u) {
    $userMap[$u['id']] = $u['NAME'];
}
$packageMap = [];
foreach ($pdo->query("SELECT id, Name_Package FROM packages") as $p) {
    $packageMap[$p['id']] = $p['Name_Package'];
}
?>
<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-calendar-check text-primary me-2"></i>Booking Management</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th><i class="fas fa-hashtag"></i> ID</th>
                    <th><i class="fas fa-user"></i> User</th>
                    <th><i class="fas fa-suitcase-rolling"></i> Package</th>
                    <th><i class="fas fa-clock"></i> Booking At</th>
                    <th><i class="fas fa-calendar-day"></i> Start Date</th>
                    <th><i class="fas fa-calendar-day"></i> End Date</th>
                    <th><i class="fas fa-users"></i> People</th>
                    <th><i class="fas fa-dollar-sign"></i> Price</th>
                    <th><i class="fas fa-money-bill-wave"></i> Subtotal</th>
                    <th><i class="fas fa-info-circle"></i> Status</th>
                    <th><i class="fas fa-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= htmlspecialchars($userMap[$b['user_id']] ?? 'Unknown') ?></td>
                    <td><?= htmlspecialchars($packageMap[$b['package_id']] ?? 'Unknown') ?></td>
                    <td>
                        <form method="post" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                            <input type="datetime-local" name="booking_at"
                                value="<?= date('Y-m-d\TH:i', strtotime($b['booking_at'])) ?>"
                                class="form-control form-control-sm" style="width:170px;">
                            <button type="submit" name="update_datetime" class="btn btn-sm btn-secondary"><i
                                    class="fas fa-save"></i></button>
                        </form>
                    </td>
                    <td><?= htmlspecialchars($b['start_date']) ?></td>
                    <td><?= htmlspecialchars($b['end_date']) ?></td>
                    <td><i class="fas fa-user-friends text-primary me-1"></i><?= $b['num_people'] ?></td>
                    <td><span class="badge bg-info text-dark"><i class="fas fa-dollar-sign"></i>
                            <?= number_format($b['price'], 2) ?></span></td>
                    <td><span class="badge bg-success"><i class="fas fa-money-bill-wave"></i>
                            <?= number_format($b['subtotal'], 2) ?></span></td>
                    <td>
                        <form method="post" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                            <select name="status" class="form-select form-select-sm"
                                <?= $b['STATUS']==='cancelled' ? 'disabled' : '' ?>>
                                <option value="pending" <?= $b['STATUS']==='pending' ? 'selected' : '' ?>>&#xf017;
                                    Pending</option>
                                <option value="confirmed" <?= $b['STATUS']==='confirmed' ? 'selected' : '' ?>>&#xf058;
                                    Confirmed</option>
                                <option value="cancelled" <?= $b['STATUS']==='cancelled' ? 'selected' : '' ?>>&#xf05e;
                                    Cancelled</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-sm btn-primary"
                                <?= $b['STATUS']==='cancelled' ? 'disabled' : '' ?>><i class="fas fa-save"></i></button>
                        </form>
                    </td>
                    <td>
                        <?php if ($b['STATUS'] === 'cancelled'): ?>
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                            <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                            <button type="submit" name="delete_booking" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                        <?php else: ?>
                        <span class="text-muted"><i class="fas fa-ban"></i> Delete only if cancelled</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../admin_footer.php'; ?>
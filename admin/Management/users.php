<?php
require_once '../../config/database.php';

// Handle wallet update
if (isset($_POST['update_wallet'])) {
    $user_id = intval($_POST['user_id']);
    $wallet = floatval($_POST['wallet']);
    $stmt = $pdo->prepare("UPDATE users SET wallet = ? WHERE id = ?");
    $stmt->execute([$wallet, $user_id]);
}
include '../admin_header.php';
// Fetch all users
$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")
->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-users text-primary me-2"></i>User Management</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Wallet</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['NAME']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['city']) ?></td>
                    <td><?= htmlspecialchars($u['phone']) ?></td>
                    <td><?= htmlspecialchars($u['role']) ?></td>
                    <td>
                        <form method="post" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                            <input type="number" step="0.01" min="0" name="wallet"
                                value="<?= number_format($u['wallet'], 2, '.', '') ?>"
                                class="form-control form-control-sm" style="width:90px;">
                            <button type="submit" name="update_wallet" class="btn btn-sm btn-info"><i
                                    class="fas fa-save"></i></button>
                        </form>
                    </td>
                    <td><?= is_numeric($u['rating']) ? $u['rating'] : '-' ?></td>
                    <td><?= $u['review'] ? htmlspecialchars($u['review']) : '<span class="text-muted">-</span>' ?></td>
                    <td><?= $u['created_at'] ? date('d/m/Y H:i', strtotime($u['created_at'])) : '-' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../admin_footer.php'; ?>
<?php
require_once __DIR__ . '/config/database.php';
include 'header.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate
    if ($name && $email && $phone && $password) {
        // Check if email or phone already exists
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? OR phone = ?');
        $stmt->execute([$email, $phone]);
        if ($stmt->fetch()) {
            $message = 'Email or phone number is already registered.';
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)');
            $success = $stmt->execute([$name, $email, $phone, $hashedPassword, 'user']);
            if ($success) {
                $message = 'Registration successful!';
            } else {
                $message = 'Registration failed. Please try again.';
            }
        }
    } else {
        $message = 'Please fill in all required fields.';
    }
}
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center"><i class="fa fa-user-plus text-primary me-2"></i>Register Account</h2>
                    <?php if ($message): ?>
                    <div class="alert alert-info text-center"> <?= htmlspecialchars($message) ?> </div>
                    <?php endif; ?>
                    <form method="post" action="" autocomplete="off">
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fa fa-user me-1"></i>Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fa fa-envelope me-1"></i>Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label"><i class="fa fa-phone me-1"></i>Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required
                                value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><i class="fa fa-lock me-1"></i>Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i
                                class="fa fa-user-plus me-1"></i>Register</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span>Already have an account? <a href="authentication-login.php">Login here</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
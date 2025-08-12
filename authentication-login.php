<?php
session_start();
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (!$email || !$password) {
        $error = 'Please enter email and password!';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        $dbPassword = $user['password'] ?? $user['PASSWORD'] ?? null;
        if ($user && $dbPassword && password_verify($password, $dbPassword)) {
            // Set session variables for both admin and client
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'] ?? $user['NAME'] ?? $user['email'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'] ?? '';
            $_SESSION['login_success'] = "Welcome back, " . ($_SESSION['user_name']);
            if (isset($user['role']) && strtolower($user['role']) === 'admin') {
                header('Location: ' . APP_URL . '/admin/index.php');
            } else {
                header('Location: ' . APP_URL . '/index.php');
            }
            exit;
        } else {
            $error = 'Email or password is incorrect! Please try again.';
        }
    }
}
include 'header.php';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="mb-4">Login</h2>
        <?php if ($error): ?>
        <div class="alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="mt-3">
            <a href="authentication-register.php">Don't have an account? Sign up</a>
        </div>

    </div>
</body>

</html>
<?php 
include 'footer.php'; 
?>
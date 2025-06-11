<?php
include './includes/db.php';

$token = $_GET['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE reset_token = :token AND token_expiry > NOW()");
    $stmt->execute(['token' => $token]);

    if ($stmt->rowCount() === 1) {
        $stmt = $pdo->prepare("UPDATE clients SET password = :password, reset_token = NULL, token_expiry = NULL WHERE reset_token = :token");
        $stmt->execute(['password' => $hashedPassword, 'token' => $token]);

        header("Location: login.php");
    } else {
        echo "<script>alert('❌ Invalid or expired token.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/reset_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
</head>
<body>
        <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="form-container">
        <div class="form-header">
            <span class="lock-icon">🔐</span>
            <h1>Reset Password</h1>
            <p>Enter your new password below</p>
        </div>

        <!-- Simulate PHP messages -->
        <div id="message-container"></div>

        <form id="resetForm" method="POST">
 <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>" />            
            <div class="form-group">
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter new password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">👁️</button>
                </div>
                <div class="strength-meter">
                    <div class="strength-fill" id="strength-fill"></div>
                </div>
                <div class="password-requirements">
                    <strong>Password Requirements:</strong>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Include uppercase and lowercase letters</li>
                        <li>Include at least one number</li>
                        <li>Include at least one special character</li>
                    </ul>
                </div>
            </div>

            <button type="submit" class="submit-btn">Reset Password</button>
        </form>

        <div class="back-link">
            <a href="login.php">← Back to Login</a>
        </div>
    </div>
</body>
</html>



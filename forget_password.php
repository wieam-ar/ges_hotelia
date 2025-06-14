 <?php
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() === 1) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", time() + 3600); // 1 hour expiry

        $stmt = $pdo->prepare("UPDATE clients SET reset_token = :token, token_expiry = :expiry WHERE email = :email");
        $stmt->execute(['token' => $token, 'expiry' => $expiry, 'email' => $email]);

        $resetLink = "http://localhost/ges_hotels/reset_password.php?token=$token";

        // Simulate email (in production, use mail())
        echo "Password reset link: <a href='$resetLink'>$resetLink</a>";
    } else {
        echo "<script>alert('❌ No account found with that email.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/forget_password.css">
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
            <span class="mail-icon">📧</span>
            <h1>Forgot Password?</h1>
            <p>No worries! Enter your email address and we'll send you a reset link.</p>
        </div>

        <div class="info-box">
            <h3>ℹ️ How it works:</h3>
            <p>Enter your registered email address below. We'll send you a secure link to reset your password. The link will expire in 1 hour for security.</p>
        </div>

        <!-- Simulate messages -->
        <div id="message-container"></div>

        <form id="resetLinkForm" method="POST">
            <div class="form-group">
                <input type="email" name="email" id="email" class="inputs" placeholder="Enter your email" required />
                <div class="email-validation" id="email-validation">
                    Please enter a valid email address
                </div>
            </div>

            <button type="submit" class="btn btn-save" id="submit-btn">
                <div class="loading-spinner" id="loading-spinner"></div>
                <span id="btn-text">Send Reset Link</span>
            </button>
        </form>

        <div class="back-link">
            <a href="login.php">← Back to Login</a> | 
            <a href="register.php">Create Account</a>
        </div>
    </div>

    
</body>
</html>

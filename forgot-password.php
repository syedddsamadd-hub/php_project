<?php
$page_title = 'Forgot Password';
$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = 'Please enter a valid email address.';
    } else {
        $success_msg = 'Password reset link sent to <strong>' . htmlspecialchars($email) . '</strong>. Please check your inbox.';
    }
}
include 'includes/head.php';
?>

  <nav class="navbar navbar-expand-lg navbar-care">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <div class="brand-logo-icon"><i class="fas fa-heartbeat"></i></div>
        <span class="brand-name">CARE <span>Group</span></span>
      </a>
      <div class="d-flex align-items-center gap-2">
        <a href="login.php" class="nav-link btn-nav-login">Login</a>
        <a href="register.php" class="nav-link btn-nav-register">Register</a>
      </div>
    </div>
  </nav>

  <div class="auth-page">
    <div class="container">
      <div class="auth-card">
        <div class="auth-card-header">
          <div class="auth-icon"><i class="fas fa-key"></i></div>
          <h3>Forgot Password?</h3>
          <p>Enter your email to receive a password reset link</p>
        </div>
        <div class="auth-card-body">
          <?php if ($success_msg): ?>
          <div class="alert alert-success d-flex align-items-center gap-2 mb-3" style="border-radius:var(--radius-sm);">
            <i class="fas fa-check-circle" style="color:var(--success);"></i>
            <div><?php echo $success_msg; ?></div>
          </div>
          <a href="login.php" class="btn-primary-care w-100 justify-content-center" style="padding:13px;">
            <i class="fas fa-sign-in-alt"></i> Back to Login
          </a>
          <?php else: ?>
          <?php if ($error_msg): ?>
          <div class="alert alert-danger mb-3" style="font-size:0.88rem;border-radius:var(--radius-sm);">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error_msg); ?>
          </div>
          <?php endif; ?>
          <form method="POST" action="forgot-password.php">
            <div class="form-floating mb-4">
              <input type="email" class="form-control" name="email" id="resetEmail" placeholder="Email" required
                     value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
              <label for="resetEmail"><i class="fas fa-envelope me-1"></i>Registered Email Address</label>
            </div>
            <button type="submit" class="btn-primary-care w-100 justify-content-center mb-3" style="padding:14px;">
              <i class="fas fa-paper-plane"></i> Send Reset Link
            </button>
            <p class="text-center" style="font-size:0.88rem;color:var(--text-muted);">
              Remembered it? <a href="login.php" style="color:var(--primary);font-weight:700;">Back to Login</a>
            </p>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/scripts.php'; ?>

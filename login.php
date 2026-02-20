<?php
$page_title = 'Login';
include 'includes/head.php';
?>

  <!-- Simple Navbar (no full nav on auth pages) -->
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
    <div style="position:fixed;top:-80px;right:-80px;width:300px;height:300px;background:radial-gradient(circle,rgba(21,101,192,0.12),transparent);border-radius:50%;pointer-events:none;"></div>
    <div style="position:fixed;bottom:-60px;left:-60px;width:250px;height:250px;background:radial-gradient(circle,rgba(0,172,193,0.1),transparent);border-radius:50%;pointer-events:none;"></div>

    <div class="container">
      <div class="auth-card">
        <!-- Header -->
        <div class="auth-card-header">
          <div class="auth-icon"><i class="fas fa-lock"></i></div>
          <h3>Welcome Back</h3>
          <p>Sign in to access your CARE Group account</p>
        </div>

        <!-- Body -->
        <div class="auth-card-body">
<!-- 
          <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="font-size:0.88rem;border-radius:var(--radius-sm);">
            <i class="fas fa-exclamation-circle"></i>
          </div> -->

          <form method="POST" action="login.php" novalidate>

            <!-- Role -->
            <div class="form-floating mb-3">
              <select class="form-select" name="role" id="loginRole" required>
                <option value="" disabled >Select your role</option>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
              </select>
              <label for="loginRole"><i class="fas fa-user-tag me-1"></i>Login As</label>
            </div>

            <!-- Username -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="loginUser" name="username"
                     placeholder="Username or Email"
                     value="" required />
              <label for="loginUser"><i class="fas fa-envelope me-1"></i>Email or Username</label>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <div class="input-group">
                <div class="form-floating flex-grow-1">
                  <input type="password" class="form-control" id="loginPass" name="password"
                         placeholder="Password" required />
                  <label for="loginPass"><i class="fas fa-key me-1"></i>Password</label>
                </div>
                <span class="input-group-text toggle-password" style="cursor:pointer;">
                  <i class="fas fa-eye-slash"></i>
                </span>
              </div>
            </div>
            <!-- Submit -->
            <button type="submit" class="btn-primary-care w-100 justify-content-center mb-3" style="padding:14px;">
              <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
            <p class="text-center" style="font-size:0.88rem;color:var(--text-muted);">
              Don't have an account?
              <a href="register.php" style="color:var(--primary);font-weight:700;">Create Account</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/scripts.php'; ?>

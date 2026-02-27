<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    .navbar-care {
  background: var(--white) !important;
  box-shadow: 0 2px 20px rgba(21,101,192,0.1);
  padding: 12px 0;
  position: sticky;
  top: 0;
  z-index: 1050;
  transition: var(--transition);
}
.navbar-care.scrolled {
  padding: 8px 0;
  box-shadow: 0 4px 24px rgba(21,101,192,0.15);
}
.navbar-brand {
  display: flex;
  align-items: center;
  gap: 10px;
}
.brand-logo-icon {
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg, var(--primary), var(--accent));
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.1rem;
  box-shadow: 0 4px 12px rgba(21,101,192,0.3);
}
.brand-name {
  font-size: 1.3rem;
  font-weight: 800;
  color: var(--primary-dark);
  letter-spacing: -0.5px;
}
.brand-name span { color: var(--accent); }
.navbar-care .nav-link {
  color: var(--text-body) !important;
  font-weight: 500;
  font-size: 0.92rem;
  padding: 8px 14px !important;
  border-radius: var(--radius-sm);
  transition: var(--transition);
  position: relative;
}
.navbar-care .nav-link:hover,
.navbar-care .nav-link.active {
  color: var(--primary) !important;
  background: var(--light-blue);
}
.btn-nav-login {
  background: transparent;
  border: 2px solid var(--primary);
  color: var(--primary) !important;
  padding: 7px 20px !important;
  border-radius: var(--radius-pill);
  font-weight: 600;
  font-size: 0.88rem;
}
.btn-nav-login:hover {
  background: var(--light-blue) !important;
}
.btn-nav-register {
  background: linear-gradient(135deg, var(--primary), var(--primary-light)) !important;
  color: white !important;
  padding: 7px 20px !important;
  border-radius: var(--radius-pill);
  font-weight: 600;
  font-size: 0.88rem;
  border: none;
  box-shadow: 0 4px 12px rgba(21,101,192,0.3);
}
.btn-nav-register:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(21,101,192,0.4) !important;
}

/* =============================
   BUTTONS
   ============================= */
.btn-primary-care {
  background: linear-gradient(135deg, var(--primary), var(--primary-light));
  color: white;
  padding: 12px 32px;
  border-radius: var(--radius-pill);
  font-weight: 600;
  font-size: 0.95rem;
  border: none;
  box-shadow: 0 4px 16px rgba(21,101,192,0.3);
  transition: var(--transition);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
}
.btn-primary-care:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(21,101,192,0.4);
  color: white;
}
.btn-outline-care {
  background: transparent;
  color: white;
  padding: 11px 30px;
  border-radius: var(--radius-pill);
  font-weight: 600;
  font-size: 0.95rem;
  border: 2px solid rgba(255,255,255,0.7);
  transition: var(--transition);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
}
.btn-outline-care:hover {
  background: rgba(255,255,255,0.15);
  border-color: white;
  color: white;
}
.btn-accent {
  background: linear-gradient(135deg, var(--accent), var(--accent-light));
  color: white;
  padding: 10px 26px;
  border-radius: var(--radius-pill);
  font-weight: 600;
  font-size: 0.9rem;
  border: none;
  box-shadow: 0 4px 12px rgba(0,172,193,0.3);
  transition: var(--transition);
  cursor: pointer;
}
.btn-accent:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,172,193,0.4);
  color: white;
}


</style>
<?php
// Determine current page for active link highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-care">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <div class="brand-logo-icon"><i class="fas fa-heartbeat"></i></div>
      <span class="brand-name">CARE <span>Group</span></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
            <i class="fas fa-home me-1"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'search-doctor.php') ? 'active' : ''; ?>" href="search-doctor.php">
            <i class="fas fa-user-md me-1"></i>Search Doctor
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'diseases.php') ? 'active' : ''; ?>" href="diseases.php">
            <i class="fas fa-virus me-1"></i>Diseases
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'medical-news.php') ? 'active' : ''; ?>" href="medical-news.php">
            <i class="fas fa-newspaper me-1"></i>Medical News
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="about.php">
            <i class="fas fa-info-circle me-1"></i>About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">
            <i class="fas fa-envelope me-1"></i>Contact
          </a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <a href="login.php" class="nav-link btn-nav-login">Login</a>
        <a href="register.php" class="nav-link btn-nav-register text-light">Register</a>
      </div>
    </div>
  </div>
</nav>

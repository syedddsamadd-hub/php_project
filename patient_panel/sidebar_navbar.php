
<!-- TOP NAVBAR -->
<nav class="top-navbar">
    <a href="dashboard.php" class="navbar-brand">
        <div class="brand-icon"><i class="fas fa-heartbeat"></i></div>
        <span class="brand-text">MedCare</span>
    </a>
    <div class="d-flex align-items-center gap-2">
        <button class="nav-notif d-md-none border-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    </div>
    <div class="navbar-right">
        <button class="nav-notif">
            <i class="fas fa-bell"></i>
            <span class="notif-dot"></span>
        </button>
        <div class="patient-info">
            <div class="patient-avatar">JD</div>
            <div class="d-none d-sm-block">
                <div class="patient-name">John Doe</div>
                <div class="patient-role">Patient</div>
            </div>
        </div>
        <a href="login.php" class="btn-logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
    </div>
</nav>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-section-label">Main Menu</div>
    <a href="dashboard.php" class="sidebar-link active">
        <i class="fas fa-th-large"></i> Dashboard
    </a>
    <a href="../search-doctor.php" class="sidebar-link">
        <i class="fas fa-search"></i> Search Doctor
    </a>
    <a href="my_appointments.php" class="sidebar-link">
        <i class="fas fa-calendar-alt"></i> My Appointments
        <span class="badge bg-primary badge">3</span>
    </a>
    <div class="sidebar-section-label">Account</div>
    <a href="profile.php" class="sidebar-link">
        <i class="fas fa-user"></i> My Profile
    </a>
    <a href="login.php" class="sidebar-link" style="color:#ef4444;">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</aside>
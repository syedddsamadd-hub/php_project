<?php
require_once __DIR__ . '/_auth.php';
if (isset($_GET['logout'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doctor Dashboard – CARE Group</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <style>
    body{font-family:'Plus Jakarta Sans',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f8fbff}
    .main{padding:24px}
    .card-tile{background:#fff;border:1px solid #e5eef9;border-radius:16px;padding:18px;display:flex;align-items:center;gap:12px}
    .tile-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff}
    .i-blue{background:linear-gradient(135deg,#2563eb,#60a5fa)}
    .i-green{background:linear-gradient(135deg,#059669,#34d399)}
    .i-orange{background:linear-gradient(135deg,#ea580c,#f59e0b)}
    .i-purple{background:linear-gradient(135deg,#7c3aed,#a78bfa)}
  </style>
  <script>
    if (window.top !== window.self) { /* simple clickjacking guard */ document.addEventListener('DOMContentLoaded',()=>{document.body.innerHTML='';}); }
  </script>
  </head>
<body>
<?php include __DIR__ . '/sidebar_navbar.php'; ?>
<main class="main">
  <div class="mb-3">
    <h3 style="font-weight:800;color:#0b3e8a;">Welcome, Doctor</h3>
    <p class="text-muted mb-0">Manage your profile, appointments and availability</p>
  </div>
  <div class="row g-3">
    <div class="col-12 col-md-6 col-xl-3">
      <a class="text-decoration-none" href="profile.php">
        <div class="card-tile">
          <div class="tile-icon i-blue"><i class="fas fa-user-md"></i></div>
          <div>
            <div style="font-weight:700;color:#0b3e8a">My Profile</div>
            <div class="text-muted" style="font-size:.85rem">View & update details</div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <a class="text-decoration-none" href="appointments.php">
        <div class="card-tile">
          <div class="tile-icon i-green"><i class="fas fa-calendar-check"></i></div>
          <div>
            <div style="font-weight:700;color:#0b3e8a">Appointments</div>
            <div class="text-muted" style="font-size:.85rem">Today & upcoming</div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <a class="text-decoration-none" href="availability.php">
        <div class="card-tile">
          <div class="tile-icon i-orange"><i class="fas fa-clock"></i></div>
          <div>
            <div style="font-weight:700;color:#0b3e8a">Availability</div>
            <div class="text-muted" style="font-size:.85rem">Set weekly schedule</div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
      <a class="text-decoration-none" href="dashboard.php?logout=1">
        <div class="card-tile">
          <div class="tile-icon i-purple"><i class="fas fa-sign-out-alt"></i></div>
          <div>
            <div style="font-weight:700;color:#0b3e8a">Logout</div>
            <div class="text-muted" style="font-size:.85rem">Return to home</div>
          </div>
        </div>
      </a>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

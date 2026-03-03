<?php
require_once __DIR__ . '/_auth.php';
$msg = '';
$err = '';
$doc_id = doctor_id();

function get_doctor($db, $doctor_id) {
    $sql = "SELECT doctor_id, first_name, last_name, email, phone, address, qualification, experience, consultation_fee, city_id, specialize_id 
            FROM doctors WHERE doctor_id = ? LIMIT 1";
    $stmt = mysqli_prepare($db, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $doctor_id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);
        return $row ?: null;
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!check_csrf()) {
        $err = 'Invalid form token. Please refresh and try again.';
    } else {
        $phone         = trim($_POST['phone']            ?? '');
        $address       = trim($_POST['address']          ?? '');
        $qualification = trim($_POST['qualification']    ?? '');
        $experience    = intval($_POST['experience']     ?? 0);
        $fee           = intval($_POST['consultation_fee'] ?? 0);
        $city_id       = intval($_POST['city_id']        ?? 0);
        $spec_id       = intval($_POST['specialize_id']  ?? 0);

        if ($phone !== '' && !preg_match('/^[0-9+\-\s]{7,20}$/', $phone)) {
            $err = 'Please provide a valid phone number.';
        } elseif ($fee < 0 || $fee > 1000000) {
            $err = 'Invalid consultation fee.';
        } elseif ($experience < 0 || $experience > 80) {
            $err = 'Invalid years of experience.';
        } else {
            $sql = "UPDATE doctors SET phone=?, address=?, qualification=?, experience=?, consultation_fee=?, city_id=?, specialize_id=? WHERE doctor_id=?";
            $stmt = mysqli_prepare($connect, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'sssiiiii',
                    $phone, $address, $qualification,
                    $experience, $fee, $city_id, $spec_id, $doc_id
                );
                if (mysqli_stmt_execute($stmt)) {
                    $msg = 'Profile updated successfully.';
                } else {
                    $err = 'Failed to update profile.';
                }
                mysqli_stmt_close($stmt);
            } else {
                $err = 'Database error while preparing update.';
            }
        }
    }
}

$doctor = get_doctor($connect, $doc_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile – Doctor Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <style>
    body{font-family:'Plus Jakarta Sans',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f8fbff}
    .main{padding:24px}
    .card-care{background:#fff;border:1px solid #e5eef9;border-radius:16px}
    .form-section-title{font-weight:800;color:#0b3e8a;margin-bottom:8px}
    .info-badge{background:#eef4ff;border:1px solid #d6e4ff;color:#0b3e8a;border-radius:10px;padding:6px 10px;font-size:.8rem;font-weight:700}
  </style>
  <script>
    if (window.top !== window.self) { document.addEventListener('DOMContentLoaded',()=>{document.body.innerHTML='';}); }
  </script>
</head>
<body>
<?php include __DIR__ . '/sidebar_navbar.php'; ?>
<main class="main">
  <div class="mb-3">
    <h3 style="font-weight:800;color:#0b3e8a;">My Profile</h3>
    <p class="text-muted mb-0">View and update your professional details</p>
  </div>

  <?php if ($msg): ?>
    <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>
  <?php if ($err): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
  <?php endif; ?>

  <div class="row g-3">
    <div class="col-12 col-lg-8">
      <div class="card-care p-3 p-md-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <div class="form-section-title"><i class="fas fa-user-md me-2"></i>Basic Details</div>
          <?php if ($doctor): ?>
            <span class="info-badge"><i class="fas fa-id-badge me-1"></i>ID: #<?= (int)$doctor['doctor_id'] ?></span>
          <?php endif; ?>
        </div>
        <form method="post" action="">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">First Name</label>
              <input class="form-control" value="<?= htmlspecialchars($doctor['first_name'] ?? '') ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name</label>
              <input class="form-control" value="<?= htmlspecialchars($doctor['last_name'] ?? '') ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input class="form-control" value="<?= htmlspecialchars($doctor['email'] ?? '') ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input name="phone" class="form-control" value="<?= htmlspecialchars($doctor['phone'] ?? '') ?>">
            </div>
            <div class="col-12">
              <label class="form-label">Address</label>
              <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($doctor['address'] ?? '') ?></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Qualification</label>
              <input name="qualification" class="form-control" value="<?= htmlspecialchars($doctor['qualification'] ?? '') ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Experience (years)</label>
              <input type="number" name="experience" class="form-control" value="<?= htmlspecialchars((string)($doctor['experience'] ?? 0)) ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Consultation Fee</label>
              <input type="number" name="consultation_fee" class="form-control" value="<?= htmlspecialchars((string)($doctor['consultation_fee'] ?? 0)) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <select name="city_id" class="form-select">
                <option value="0">Select City</option>
                <?php
                $result = mysqli_query($connect, "SELECT city_id, city_name FROM cities");
                if ($result) {
                  $curr = intval($doctor['city_id'] ?? 0);
                  while ($row = mysqli_fetch_assoc($result)) {
                      $cid = (int)$row['city_id'];
                      $sel = $cid === $curr ? 'selected' : '';
                      echo "<option value=\"$cid\" $sel>".htmlspecialchars($row['city_name'])."</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Specialization</label>
              <select name="specialize_id" class="form-select">
                <option value="0">Select Specialization</option>
                <?php
                $result2 = mysqli_query($connect, "SELECT specialize_id, specialize FROM specialization");
                if ($result2) {
                  $currs = intval($doctor['specialize_id'] ?? 0);
                  while ($row = mysqli_fetch_assoc($result2)) {
                      $sid = (int)$row['specialize_id'];
                      $sel = $sid === $currs ? 'selected' : '';
                      echo "<option value=\"$sid\" $sel>".htmlspecialchars($row['specialize'])."</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save Changes</button>
            <a href="dashboard.php" class="btn btn-outline-secondary">Back</a>
          </div>
        </form>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card-care p-3 p-md-4">
        <div class="form-section-title"><i class="fas fa-id-card me-2"></i>Account Summary</div>
        <div class="mb-2" style="font-size:.9rem;">
          <div><strong>Name:</strong> <?= htmlspecialchars(($doctor['first_name'] ?? '').' '.($doctor['last_name'] ?? '')) ?></div>
          <div><strong>Email:</strong> <?= htmlspecialchars($doctor['email'] ?? '') ?></div>
          <div><strong>Experience:</strong> <?= htmlspecialchars((string)($doctor['experience'] ?? 0)) ?> years</div>
          <div><strong>Fee:</strong> Rs <?= htmlspecialchars((string)($doctor['consultation_fee'] ?? 0)) ?></div>
        </div>
        <hr>
        <p class="text-muted mb-0" style="font-size:.86rem;">Keep your information up to date so patients can find and book you easily.</p>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


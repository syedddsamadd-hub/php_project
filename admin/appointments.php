<?php
include("../connect.php");
session_start();

if (!isset($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}

// Status Update
if (isset($_POST['btn_update_status'])) {
    $appt_id    = $_POST['appointment_id'];
    $new_status = $_POST['new_status'];
    $sql = "UPDATE appointments SET status='$new_status' WHERE appointment_id='$appt_id'";
    mysqli_query($connect, $sql);
    header("Location: appointments.php");
    exit();
}

// Delete Appointment
if (isset($_POST['btn_delete_appt'])) {
    $appt_id = $_POST['appointment_id'];
    $sql = "DELETE FROM appointments WHERE appointment_id='$appt_id'";
    mysqli_query($connect, $sql);
    header("Location: appointments.php");
    exit();
}

// Count total appointments
$total_result = mysqli_query($connect, "SELECT COUNT(*) AS total FROM appointments");
$total_row    = mysqli_fetch_assoc($total_result);
$total_appts  = $total_row['total'];

// Count by status
$count_pending   = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS c FROM appointments WHERE status='pending'"))['c'];
$count_confirmed = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS c FROM appointments WHERE status='confirmed'"))['c'];
$count_completed = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS c FROM appointments WHERE status='completed'"))['c'];
$count_cancelled = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS c FROM appointments WHERE status='cancelled'"))['c'];

// Filter by status
$filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$where  = ($filter !== 'all') ? "WHERE a.status = '$filter'" : "";

// Fetch appointments with JOIN
$query = "
    SELECT 
        a.appointment_id,
        a.appointment_date,
        a.appointment_time,
        a.status,
        a.created_at,
        CONCAT(d.first_name, ' ', d.last_name) AS doctor_name,
        d.consultation_fee,
        p.name AS patient_name,
        p.email AS patient_email,
        p.phone AS patient_phone,
        p.gender AS patient_gender
    FROM appointments a
    JOIN doctors d  ON a.doctor_id  = d.doctor_id
    JOIN patients p ON a.patient_id = p.patient_id
    $where
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
";
$result = mysqli_query($connect, $query);

$pageTitle = 'appointments';
include('includes/header.php');
include('includes/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointments — Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --blue-deep:   #0a3d8f;
    --blue-mid:    #1565c0;
    --blue-bright: #1e88e5;
    --blue-light:  #e3f0ff;
    --blue-pale:   #f0f7ff;
    --white:       #ffffff;
    --text-dark:   #0d1b3e;
    --text-muted:  #5c7a9e;
    --border:      #c8dff8;
  }

  * { box-sizing: border-box; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f0f7ff;
    color: var(--text-dark);
    min-height: 100vh;
    padding: 36px 0 60px;
  }

  /* ── PAGE TITLE ── */
  .page-title {
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--blue-deep);
    margin-bottom: 4px;
  }
  .page-sub {
    font-size: 0.83rem;
    color: var(--text-muted);
    font-weight: 500;
  }

  /* ── STAT CARDS ── */
  .stat-card {
    background: var(--white);
    border-radius: 14px;
    padding: 20px 22px;
    border: 1.5px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: 0 2px 12px rgba(13,101,253,0.07);
    transition: transform 0.15s;
  }
  .stat-card:hover { transform: translateY(-2px); }

  .stat-icon {
    width: 46px; height: 46px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }
  .stat-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 2px;
  }
  .stat-value {
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--text-dark);
    line-height: 1;
  }

  /* ── SECTION CARD ── */
  .section-card {
    background: var(--white);
    border-radius: 16px;
    border: 1.5px solid var(--border);
    box-shadow: 0 4px 18px rgba(13,101,253,0.07);
    overflow: hidden;
  }

  .section-card-header {
    background: linear-gradient(90deg, var(--blue-deep), var(--blue-bright));
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
  }
  .section-card-header h5 {
    color: var(--white);
    font-size: 0.97rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .info-chip {
    background: rgba(255,255,255,0.22);
    color: white;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.3);
  }

  /* Filter buttons */
  .filter-btns { display: flex; gap: 6px; flex-wrap: wrap; }
  .filter-btn {
    padding: 5px 14px;
    border-radius: 20px;
    border: 1.5px solid rgba(255,255,255,0.4);
    background: transparent;
    color: rgba(255,255,255,0.8);
    font-size: 0.76rem;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
  }
  .filter-btn:hover,
  .filter-btn.active {
    background: rgba(255,255,255,0.25);
    color: white;
    border-color: white;
  }

  /* ── TABLE ── */
  .table-responsive-custom { overflow-x: auto; }

  .admin-table { width: 100%; border-collapse: collapse; margin: 0; }
  .admin-table thead tr { background: var(--blue-pale); }
  .admin-table th {
    padding: 12px 18px;
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--blue-deep);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    border-bottom: 1.5px solid var(--border);
    white-space: nowrap;
  }
  .admin-table td {
    padding: 14px 18px;
    font-size: 0.84rem;
    color: var(--text-dark);
    border-bottom: 1px solid #edf4ff;
    vertical-align: middle;
  }
  .admin-table tbody tr:last-child td { border-bottom: none; }
  .admin-table tbody tr:hover { background: var(--blue-pale); }

  .fw-600 { font-weight: 700; }
  .text-primary-custom { color: var(--blue-bright); }

  /* user cell */
  .user-cell { display: flex; align-items: center; gap: 10px; }
  .user-avatar {
    width: 34px; height: 34px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    color: white;
    font-size: 14px;
    flex-shrink: 0;
  }
  .user-name { font-weight: 600; font-size: 0.85rem; }
  .user-sub  { font-size: 0.75rem; color: var(--text-muted); }

  /* Status badges */
  .badge-status {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.03em;
    text-transform: capitalize;
  }
  .badge-pending   { background: #fff8e1; color: #e65100; border: 1px solid #ffe082; }
  .badge-confirmed { background: #e3f2fd; color: #1565c0; border: 1px solid #90caf9; }
  .badge-completed { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
  .badge-cancelled { background: #fce4ec; color: #c62828; border: 1px solid #f48fb1; }

  /* Action buttons */
  .btn-action {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 0.77rem;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: none;
    cursor: pointer;
    transition: opacity 0.15s, transform 0.1s;
    margin: 0;
  }
  .btn-action:hover { opacity: 0.85; transform: translateY(-1px); }

  /* Status select */
  .status-select {
    padding: 5px 10px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.78rem;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark);
    background: var(--blue-pale);
    outline: none;
    cursor: pointer;
  }
  .status-select:focus { border-color: var(--blue-bright); }

  .no-data {
    text-align: center;
    padding: 40px;
    color: var(--text-muted);
    font-size: 0.9rem;
  }
</style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">

      <!-- Page Title -->
      <div class="mb-4">
        <div class="page-title"><i class="bi bi-calendar2-heart-fill me-2"></i>Appointments</div>
        <div class="page-sub">Manage all patient appointments from here</div>
      </div>

      <!-- ── STAT CARDS ── -->
      <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#e3f0ff;">
              <i class="bi bi-calendar2-check" style="color:#1e88e5;"></i>
            </div>
            <div>
              <div class="stat-label">Total</div>
              <div class="stat-value"><?= $total_appts ?></div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#fff8e1;">
              <i class="bi bi-hourglass-split" style="color:#e65100;"></i>
            </div>
            <div>
              <div class="stat-label">Pending</div>
              <div class="stat-value"><?= $count_pending ?></div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#e8f5e9;">
              <i class="bi bi-check2-circle" style="color:#2e7d32;"></i>
            </div>
            <div>
              <div class="stat-label">Completed</div>
              <div class="stat-value"><?= $count_completed ?></div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#fce4ec;">
              <i class="bi bi-x-circle" style="color:#c62828;"></i>
            </div>
            <div>
              <div class="stat-label">Cancelled</div>
              <div class="stat-value"><?= $count_cancelled ?></div>
            </div>
          </div>
        </div>

      </div>

      <!-- ── APPOINTMENTS TABLE ── -->
      <div class="section-card">

        <div class="section-card-header">
          <h5>
            <i class="bi bi-table"></i> Appointments List
            <span class="info-chip"><?= $total_appts ?></span>
          </h5>
          <!-- Filter Buttons -->
          <div class="filter-btns">
            <a href="appointments.php?status=all"       class="filter-btn <?= $filter=='all'       ? 'active':'' ?>">All</a>
            <a href="appointments.php?status=pending"   class="filter-btn <?= $filter=='pending'   ? 'active':'' ?>">Pending</a>
            <a href="appointments.php?status=confirmed" class="filter-btn <?= $filter=='confirmed' ? 'active':'' ?>">Confirmed</a>
            <a href="appointments.php?status=completed" class="filter-btn <?= $filter=='completed' ? 'active':'' ?>">Completed</a>
            <a href="appointments.php?status=cancelled" class="filter-btn <?= $filter=='cancelled' ? 'active':'' ?>">Cancelled</a>
          </div>
        </div>

        <div class="table-responsive-custom">
          <table class="admin-table table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Fee</th>
                <th>Status</th>
                <th>Update Status</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>

                  <!-- ID -->
                  <td class="fw-600 text-primary-custom">#<?= $row['appointment_id'] ?></td>

                  <!-- Patient -->
                  <td>
                    <div class="user-cell">
                      <div class="user-avatar" style="background:linear-gradient(135deg,#0d6efd,#6610f2);">
                        <i class="bi bi-person-fill"></i>
                      </div>
                      <div>
                        <div class="user-name"><?= htmlspecialchars($row['patient_name']) ?></div>
                        <div class="user-sub"><?= htmlspecialchars($row['patient_email']) ?></div>
                        <div class="user-sub"><?= htmlspecialchars($row['patient_phone'] ?? '—') ?></div>
                      </div>
                    </div>
                  </td>

                  <!-- Doctor -->
                  <td>
                    <div class="user-cell">
                      <div class="user-avatar" style="background:linear-gradient(135deg,#0dcaf0,#0d6efd);">
                        <i class="bi bi-heart-pulse-fill"></i>
                      </div>
                      <div class="user-name">Dr. <?= htmlspecialchars($row['doctor_name']) ?></div>
                    </div>
                  </td>

                  <!-- Date -->
                  <td>
                    <div class="fw-600"><?= date('d M Y', strtotime($row['appointment_date'])) ?></div>
                  </td>

                  <!-- Time -->
                  <td><?= date('h:i A', strtotime($row['appointment_time'])) ?></td>

                  <!-- Fee -->
                  <td class="fw-600">Rs. <?= number_format($row['consultation_fee']) ?></td>

                  <!-- Status Badge -->
                  <td>
                    <span class="badge-status badge-<?= $row['status'] ?>">
                      <?= ucfirst($row['status']) ?>
                    </span>
                  </td>

                  <!-- Update Status -->
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                      <div class="d-flex gap-2 align-items-center">
                        <select name="new_status" class="status-select">
                          <option value="pending"   <?= $row['status']=='pending'   ? 'selected':'' ?>>Pending</option>
                          <option value="confirmed" <?= $row['status']=='confirmed' ? 'selected':'' ?>>Confirmed</option>
                          <option value="completed" <?= $row['status']=='completed' ? 'selected':'' ?>>Completed</option>
                          <option value="cancelled" <?= $row['status']=='cancelled' ? 'selected':'' ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="btn_update_status" class="btn-action alert alert-warning mb-0 py-1">
                          <i class="bi bi-check2"></i>
                        </button>
                      </div>
                    </form>
                  </td>

                  <!-- Delete -->
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                      <button type="submit" name="btn_delete_appt"
                        class="btn-action alert alert-danger mb-0"
                        onclick="return confirm('Are you sure you want to delete this appointment?')">
                        <i class="bi bi-trash-fill"></i> Delete
                      </button>
                    </form>
                  </td>

                </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="9" class="no-data">
                    <i class="bi bi-calendar-x" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                    No appointments found.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('includes/script.php');
?>
</body>
</html>
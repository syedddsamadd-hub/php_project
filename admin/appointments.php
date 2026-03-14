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
  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f4f6f9;
    color: #1a1a2e;
    min-height: 100vh;
    padding: 32px 0 60px;
  }

  /* ── PAGE TITLE ── */
  .page-title-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
  }
  .page-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #1a1a2e;
  }
  .page-title i { color: #3b6fd4; margin-right: 8px; }
  .breadcrumb-text {
    font-size: 0.8rem;
    color: #888;
    margin-top: 3px;
  }
  .breadcrumb-text a { color: #3b6fd4; text-decoration: none; }

  /* ── STAT CARDS ── */
  .stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 18px 20px;
    border: 1px solid #e8ecf3;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.05);
    transition: transform 0.15s, box-shadow 0.15s;
  }
  .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,0.09); }
  .stat-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
  }
  .stat-label {
    font-size: 0.73rem;
    font-weight: 600;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 2px;
  }
  .stat-value {
    font-size: 1.55rem;
    font-weight: 800;
    color: #1a1a2e;
    line-height: 1;
  }

  /* ── MAIN CARD ── */
  .main-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e8ecf3;
    box-shadow: 0 1px 8px rgba(0,0,0,0.05);
    overflow: hidden;
  }

  .main-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid #e8ecf3;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: #fff;
  }

  .main-card-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .main-card-header-left i {
    color: #3b6fd4;
    font-size: 1.1rem;
  }
  .main-card-header-left h5 {
    font-size: 0.97rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
  }
  .count-badge {
    background: #eef2ff;
    color: #3b6fd4;
    font-size: 0.73rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    border: 1px solid #d0d9f5;
  }

  /* Filter tabs */
  .filter-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
  .filter-tab {
    padding: 5px 16px;
    border-radius: 20px;
    border: 1.5px solid #dde3f0;
    background: transparent;
    color: #666;
    font-size: 0.76rem;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.15s;
  }
  .filter-tab:hover { border-color: #3b6fd4; color: #3b6fd4; background: #eef2ff; }
  .filter-tab.active { background: #3b6fd4; color: #fff; border-color: #3b6fd4; }

  /* ── TABLE ── */
  .appt-table { width: 100%; border-collapse: collapse; }
  .appt-table thead tr { background: #f8f9fc; }
  .appt-table th {
    padding: 11px 18px;
    font-size: 0.72rem;
    font-weight: 700;
    color: #555;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    border-bottom: 1.5px solid #e8ecf3;
    white-space: nowrap;
  }
  .appt-table td {
    padding: 13px 18px;
    font-size: 0.84rem;
    color: #1a1a2e;
    border-bottom: 1px solid #f0f2f7;
    vertical-align: middle;
  }
  .appt-table tbody tr:last-child td { border-bottom: none; }
  .appt-table tbody tr:hover { background: #f8f9fc; }

  /* Appointment ID */
  .appt-id {
    font-size: 0.78rem;
    font-weight: 700;
    color: #3b6fd4;
    font-family: monospace;
    background: #eef2ff;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  /* User cell */
  .user-cell { display: flex; align-items: center; gap: 10px; }
  .avatar {
    width: 34px; height: 34px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-size: 0.8rem;
    font-weight: 700;
    flex-shrink: 0;
  }
  .user-name { font-weight: 600; font-size: 0.85rem; color: #1a1a2e; }
  .user-sub  { font-size: 0.74rem; color: #888; margin-top: 1px; }

  /* Date/Time */
  .date-val { font-weight: 600; font-size: 0.84rem; }
  .time-val { font-size: 0.76rem; color: #888; margin-top: 2px; }

  /* Fee */
  .fee-val { font-weight: 700; color: #1a1a2e; font-size: 0.85rem; }

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

  /* Status select — like the "active" input box in screenshot */
  .status-select-wrap {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .status-select {
    padding: 6px 10px;
    border: 1.5px solid #dde3f0;
    border-radius: 8px;
    font-size: 0.78rem;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #1a1a2e;
    background: #fff;
    outline: none;
    cursor: pointer;
    min-width: 110px;
    transition: border-color 0.15s;
  }
  .status-select:focus { border-color: #3b6fd4; }

  /* Action buttons — Edit & Del style like screenshot */
  .btn-edit {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 7px;
    font-size: 0.76rem;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: 1px solid #f5c842;
    background: #fffbea;
    color: #b07d00;
    cursor: pointer;
    transition: background 0.15s, transform 0.1s;
    white-space: nowrap;
  }
  .btn-edit:hover { background: #fef3c7; transform: translateY(-1px); }

  .btn-del {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 7px;
    font-size: 0.76rem;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: 1px solid #fca5a5;
    background: #fff1f1;
    color: #c62828;
    cursor: pointer;
    transition: background 0.15s, transform 0.1s;
    white-space: nowrap;
  }
  .btn-del:hover { background: #fee2e2; transform: translateY(-1px); }

  .no-data {
    text-align: center;
    padding: 50px 20px;
    color: #999;
    font-size: 0.9rem;
  }
  .no-data i { font-size: 2.2rem; display: block; margin-bottom: 10px; color: #ccc; }

  /* Scrollable table on small screens */
  .table-scroll { overflow-x: auto; }
</style>
</head>
<body>

<div class="container-fluid px-4">
  <div class="row justify-content-center">
    <div class="col-12 col-xl-11">

      <!-- Page Title -->
      <div class="page-title-row">
        <div>
          <div class="page-title">
            <i class="bi bi-calendar2-heart-fill"></i> Appointments
          </div>
          <div class="breadcrumb-text">
            <a href="dashboard.php">Home</a> / Appointments
          </div>
        </div>
      </div>

      <!-- ── STAT CARDS ── -->
      <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#eef2ff;">
              <i class="bi bi-calendar2-check" style="color:#3b6fd4;"></i>
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

      <!-- ── APPOINTMENTS TABLE CARD ── -->
      <div class="main-card">

        <div class="main-card-header">
          <div class="main-card-header-left">
            <i class="bi bi-table"></i>
            <h5>Appointments List</h5>
            <span class="count-badge"><?= $total_appts ?></span>
          </div>
          <!-- Filter Tabs -->
          <div class="filter-tabs">
            <a href="appointments.php?status=all"       class="filter-tab <?= $filter=='all'       ? 'active':'' ?>">All</a>
            <a href="appointments.php?status=pending"   class="filter-tab <?= $filter=='pending'   ? 'active':'' ?>">Pending</a>
            <a href="appointments.php?status=confirmed" class="filter-tab <?= $filter=='confirmed' ? 'active':'' ?>">Confirmed</a>
            <a href="appointments.php?status=completed" class="filter-tab <?= $filter=='completed' ? 'active':'' ?>">Completed</a>
            <a href="appointments.php?status=cancelled" class="filter-tab <?= $filter=='cancelled' ? 'active':'' ?>">Cancelled</a>
          </div>
        </div>

        <div class="table-scroll">
          <table class="appt-table">
            <thead>
              <tr>
                <th>Appointment ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date &amp; Time</th>
                <th>Fee</th>
                <th>Status</th>
                <th>Update Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): 
                  $initials = strtoupper(substr($row['patient_name'], 0, 1));
                  $doc_initials = strtoupper(substr($row['doctor_name'], 0, 1));
                ?>
                <tr>

                  <!-- Appointment ID -->
                  <td>
                    <span class="appt-id">#<?= $row['appointment_id'] ?></span>
                  </td>

                  <!-- Patient -->
                  <td>
                    <div class="user-cell">
                      <div class="avatar" style="background: linear-gradient(135deg,#3b6fd4,#6610f2);">
                        <?= $initials ?>
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
                      <div class="avatar" style="background: linear-gradient(135deg,#0dcaf0,#0d6efd);">
                        <?= $doc_initials ?>
                      </div>
                      <div class="user-name">Dr. <?= htmlspecialchars($row['doctor_name']) ?></div>
                    </div>
                  </td>

                  <!-- Date & Time -->
                  <td>
                    <div class="date-val"><?= date('d M Y', strtotime($row['appointment_date'])) ?></div>
                    <div class="time-val"><?= date('h:i A', strtotime($row['appointment_time'])) ?></div>
                  </td>

                  <!-- Fee -->
                  <td>
                    <span class="fee-val">Rs. <?= number_format($row['consultation_fee']) ?></span>
                  </td>

                  <!-- Current Status Badge -->
                  <td>
                    <span class="badge-status badge-<?= $row['status'] ?>">
                      <?= ucfirst($row['status']) ?>
                    </span>
                  </td>

                  <!-- Update Status — select + save btn (like "active" box in screenshot) -->
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                      <div class="status-select-wrap">
                        <select name="new_status" class="status-select">
                          <option value="pending"   <?= $row['status']=='pending'   ? 'selected':'' ?>>Pending</option>
                          <option value="confirmed" <?= $row['status']=='confirmed' ? 'selected':'' ?>>Confirmed</option>
                          <option value="completed" <?= $row['status']=='completed' ? 'selected':'' ?>>Completed</option>
                          <option value="cancelled" <?= $row['status']=='cancelled' ? 'selected':'' ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="btn_update_status" class="btn-edit">
                          <i class="bi bi-check2"></i> Save
                        </button>
                      </div>
                    </form>
                  </td>

                  <!-- Delete Action -->
                  <td>
                    <form method="POST" action=""
                      onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                      <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                      <button type="submit" name="btn_delete_appt" class="btn-del">
                        <i class="bi bi-trash-fill"></i> Del
                      </button>
                    </form>
                  </td>

                </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="no-data">
                    <i class="bi bi-calendar-x"></i>
                    No appointments found.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div><!-- end main-card -->

    </div>
  </div>
</div>

<?php include('includes/script.php'); ?>
</body>
</html>
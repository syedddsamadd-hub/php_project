<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments | MedCare Patient Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="style.css">
    <style>
         
    </style>
</head>
<body>

<nav class="top-navbar">
    <a href="dashboard.php" class="navbar-brand">
        <div class="brand-icon"><i class="fas fa-heartbeat"></i></div>
        <span class="brand-text">MedCare</span>
    </a>
    <div class="d-flex align-items-center gap-3">
        <div class="patient-avatar">JD</div>
        <a href="login.php" class="btn-logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
    </div>
</nav>

<aside class="sidebar">
    <div class="sidebar-section-label">Main Menu</div>
    <a href="dashboard.php" class="sidebar-link"><i class="fas fa-th-large"></i> Dashboard</a>
    <a href="search_doctor.php" class="sidebar-link"><i class="fas fa-search"></i> Search Doctor</a>
    <a href="my_appointments.php" class="sidebar-link active"><i class="fas fa-calendar-alt"></i> My Appointments <span class="badge bg-primary ms-auto">3</span></a>
    <div class="sidebar-section-label">Account</div>
    <a href="profile.php" class="sidebar-link"><i class="fas fa-user"></i> My Profile</a>
    <a href="login.php" class="sidebar-link" style="color:#ef4444;"><i class="fas fa-sign-out-alt"></i> Logout</a>
</aside>

<main class="main-content">
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="fas fa-calendar-alt text-primary me-2"></i>My Appointments</h4>
            <p>Manage and track all your medical appointments</p>
        </div>
        <a href="search_doctor.php" class="btn-new-appt"><i class="fas fa-plus"></i>Book New</a>
    </div>

    <!-- Mini Stats -->
    <div class="mini-stats">
        <div class="mini-stat">
            <div class="mini-stat-icon" style="background:#e8f0ff;"><i class="fas fa-calendar-check" style="color:#0d6efd;"></i></div>
            <div><div class="mini-stat-val">12</div><div class="mini-stat-lbl">Total</div></div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon" style="background:#ecfdf5;"><i class="fas fa-clock" style="color:#10b981;"></i></div>
            <div><div class="mini-stat-val">2</div><div class="mini-stat-lbl">Upcoming</div></div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon" style="background:#fff7e6;"><i class="fas fa-hourglass-half" style="color:#d97706;"></i></div>
            <div><div class="mini-stat-val">3</div><div class="mini-stat-lbl">Pending</div></div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon" style="background:#fff0f0;"><i class="fas fa-times-circle" style="color:#ef4444;"></i></div>
            <div><div class="mini-stat-val">2</div><div class="mini-stat-lbl">Cancelled</div></div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-tabs">
        <a href="#" class="filter-tab active">All <span class="count">12</span></a>
        <a href="#" class="filter-tab">Upcoming <span class="count">2</span></a>
        <a href="#" class="filter-tab">Pending <span class="count">3</span></a>
        <a href="#" class="filter-tab">Approved <span class="count">5</span></a>
        <a href="#" class="filter-tab">Cancelled <span class="count">2</span></a>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-card-header">
            <h6><i class="fas fa-list text-primary me-2"></i>Appointment History</h6>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search doctor or date...">
            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Date & Time</th>
                        <th>Specialization</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $appointments = [
                        ['id'=>'APT-001','doctor'=>'Dr. Sarah Williams','initials'=>'SW','spec'=>'Cardiologist','date'=>'Feb 28, 2025','time'=>'2:30 PM','fee'=>'$80','status'=>'approved','color'=>'#0d6efd'],
                        ['id'=>'APT-002','doctor'=>'Dr. James Carter','initials'=>'JC','spec'=>'Orthopedist','date'=>'Mar 05, 2025','time'=>'10:30 AM','fee'=>'$65','status'=>'pending','color'=>'#10b981'],
                        ['id'=>'APT-003','doctor'=>'Dr. Emily Parker','initials'=>'EP','spec'=>'Dermatologist','date'=>'Jan 15, 2025','time'=>'11:00 AM','fee'=>'$55','status'=>'cancelled','color'=>'#f59e0b'],
                        ['id'=>'APT-004','doctor'=>'Dr. Robert Kim','initials'=>'RK','spec'=>'Neurologist','date'=>'Jan 08, 2025','time'=>'3:00 PM','fee'=>'$95','status'=>'approved','color'=>'#8b5cf6'],
                        ['id'=>'APT-005','doctor'=>'Dr. Lisa Johnson','initials'=>'LJ','spec'=>'Pediatrician','date'=>'Mar 10, 2025','time'=>'9:00 AM','fee'=>'$60','status'=>'pending','color'=>'#ef4444'],
                        ['id'=>'APT-006','doctor'=>'Dr. Priya Sharma','initials'=>'PS','spec'=>'Gynecologist','date'=>'Dec 20, 2024','time'=>'4:00 PM','fee'=>'$70','status'=>'cancelled','color'=>'#ec4899'],
                        ['id'=>'APT-007','doctor'=>'Dr. David Chen','initials'=>'DC','spec'=>'ENT Specialist','date'=>'Dec 12, 2024','time'=>'9:30 AM','fee'=>'$58','status'=>'approved','color'=>'#14b8a6'],
                        ['id'=>'APT-008','doctor'=>'Dr. Michael Brown','initials'=>'MB','spec'=>'General Physician','date'=>'Nov 30, 2024','time'=>'11:30 AM','fee'=>'$45','status'=>'approved','color'=>'#06b6d4'],
                    ];
                    foreach ($appointments as $idx => $appt):
                        $statusClass = 'badge-' . $appt['status'];
                        $statusLabel = ucfirst($appt['status']);
                    ?>
                    <tr>
                        <td style="color:#94a3b8;font-size:0.78rem;font-weight:700;"><?= $appt['id'] ?></td>
                        <td>
                            <div class="doctor-cell">
                                <div class="mini-avatar" style="background:linear-gradient(135deg,<?= $appt['color'] ?>,<?= $appt['color'] ?>aa);"><?= $appt['initials'] ?></div>
                                <div>
                                    <div style="font-weight:700;font-size:0.9rem;"><?= $appt['doctor'] ?></div>
                                    <div style="font-size:0.75rem;color:#94a3b8;"><?= $appt['spec'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700;font-size:0.88rem;"><?= $appt['date'] ?></div>
                            <div style="font-size:0.78rem;color:#64748b;"><i class="fas fa-clock me-1" style="color:#0d6efd;"></i><?= $appt['time'] ?></div>
                        </td>
                        <td><span style="background:#f1f5f9;color:#64748b;padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:600;"><?= $appt['spec'] ?></span></td>
                        <td style="font-weight:800;color:#0d6efd;"><?= $appt['fee'] ?></td>
                        <td><span class="<?= $statusClass ?>"><?= $statusLabel ?></span></td>
                        <td>
                            <a href="book_appointment.php" class="btn-view"><i class="fas fa-eye"></i></a>
                            <?php if ($appt['status'] !== 'cancelled'): ?>
                            <button class="btn-cancel" onclick="return confirm('Cancel this appointment?')"><i class="fas fa-times me-1"></i>Cancel</button>
                            <?php else: ?>
                            <button class="btn-cancel" style="opacity:0.4;cursor:not-allowed;" disabled>Cancelled</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="padding:16px 24px;border-top:1.5px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
            <div style="font-size:0.83rem;color:#64748b;">Showing <strong>1–8</strong> of <strong>12</strong> appointments</div>
            <div style="display:flex;gap:6px;">
                <button style="padding:6px 14px;border:1.5px solid #e2e8f0;border-radius:7px;background:#fff;color:#64748b;font-weight:700;font-size:0.83rem;cursor:pointer;">← Prev</button>
                <button style="padding:6px 14px;border:1.5px solid #0d6efd;border-radius:7px;background:#0d6efd;color:#fff;font-weight:700;font-size:0.83rem;cursor:pointer;">1</button>
                <button style="padding:6px 14px;border:1.5px solid #e2e8f0;border-radius:7px;background:#fff;color:#64748b;font-weight:700;font-size:0.83rem;cursor:pointer;">2</button>
                <button style="padding:6px 14px;border:1.5px solid #e2e8f0;border-radius:7px;background:#fff;color:#64748b;font-weight:700;font-size:0.83rem;cursor:pointer;">Next →</button>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

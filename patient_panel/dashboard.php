<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MedCare Patient Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
   <style>
        
    </style>
</head>
<body>

 <?Php
 require "sidebar_navbar.php";
 ?>
<!-- MAIN -->
<main class="main-content">

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-text">
            <h3>Good Morning, John! 👋</h3>
            <p>You have <strong>2 upcoming appointments</strong> this week. Stay healthy!</p>
        </div>
        <div class="welcome-icon"><i class="fas fa-stethoscope"></i></div>
    </div>

    <div class="page-header">
        <h4>Dashboard Overview</h4>
        <p>Track your health journey and appointments</p>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
                <div class="stat-info">
                    <div class="stat-num">12</div>
                    <div class="stat-label">Total Appointments</div>
                    <div class="stat-trend up"><i class="fas fa-arrow-up me-1"></i>+3 this month</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="fas fa-clock"></i></div>
                <div class="stat-info">
                    <div class="stat-num">2</div>
                    <div class="stat-label">Upcoming</div>
                    <div class="stat-trend up"><i class="fas fa-calendar me-1"></i>Next: Feb 28</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon orange"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <div class="stat-num">8</div>
                    <div class="stat-label">Approved</div>
                    <div class="stat-trend up"><i class="fas fa-thumbs-up me-1"></i>All confirmed</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
                <div class="stat-info">
                    <div class="stat-num">2</div>
                    <div class="stat-label">Cancelled</div>
                    <div class="stat-trend neutral"><i class="fas fa-minus me-1"></i>No change</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <!-- Quick Actions -->
        <div class="col-12 col-lg-4">
            <div class="section-card h-100">
                <div class="section-head"><i class="fas fa-bolt text-warning"></i> Quick Actions</div>
                <div class="row g-3">
                    <div class="col-6">
                        <a href="search_doctor.php" class="quick-action-btn">
                            <i class="fas fa-search"></i> Find Doctor
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="book_appointment.php" class="quick-action-btn">
                            <i class="fas fa-calendar-plus"></i> Book Appt
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="my_appointments.php" class="quick-action-btn">
                            <i class="fas fa-list-alt"></i> My Appts
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="profile.php" class="quick-action-btn">
                            <i class="fas fa-user-edit"></i> My Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="col-12 col-lg-8">
            <div class="section-card">
                <div class="section-head d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-history text-primary"></i> Recent Appointments</span>
                    <a href="my_appointments.php" style="font-size:0.83rem;color:var(--primary);text-decoration:none;font-weight:600;">View All →</a>
                </div>
                <div class="table-responsive">
                    <table class="table appt-table mb-0">
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Specialization</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Dr. Sarah Williams</strong></td>
                                <td><span style="color:#64748b;font-size:0.82rem;">Cardiologist</span></td>
                                <td>Feb 28, 2025</td>
                                <td><span class="badge-status badge-approved">Approved</span></td>
                            </tr>
                            <tr>
                                <td><strong>Dr. James Carter</strong></td>
                                <td><span style="color:#64748b;font-size:0.82rem;">Orthopedist</span></td>
                                <td>Mar 05, 2025</td>
                                <td><span class="badge-status badge-pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td><strong>Dr. Emily Parker</strong></td>
                                <td><span style="color:#64748b;font-size:0.82rem;">Dermatologist</span></td>
                                <td>Jan 15, 2025</td>
                                <td><span class="badge-status badge-cancelled">Cancelled</span></td>
                            </tr>
                            <tr>
                                <td><strong>Dr. Robert Kim</strong></td>
                                <td><span style="color:#64748b;font-size:0.82rem;">Neurologist</span></td>
                                <td>Jan 08, 2025</td>
                                <td><span class="badge-status badge-approved">Approved</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
</body>
</html>

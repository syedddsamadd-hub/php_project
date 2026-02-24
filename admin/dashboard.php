<?php
/**
 * dashboard.php — Main Dashboard Page
 * Healthcare Admin Panel — UI Only
 */
include "..//connect.php";
session_start();
if (!isset($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}
$pageTitle = 'Dashboard';
include('includes/header.php');
include('includes/sidebar.php');
?>

<!-- ╔══════════════════════════════════════════════════════╗
     ║  DASHBOARD PAGE CONTENT                              ║
     ╚══════════════════════════════════════════════════════╝ -->
<div class="page-wrapper" id="dashboardPage">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard Overview</h4>
            <ul class="breadcrumb-custom">
                <li><a href="#">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
        <div class="d-flex gap-2">
            <button class="btn-outline-custom"
                onclick="window.showToast && showToast('info','Refreshed','Data has been refreshed.')">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
            <button class="btn-primary-custom">
                <i class="bi bi-download"></i> Export Report
            </button>
        </div>
    </div>

    <!-- ── STATS CARDS ──────────────────────────────────── -->
    <div class="row row-g4 g-3 mb-4">

        <!-- Cities -->
        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 page-fade-in stagger-1">
            <div class="stat-card blue">
                <div class="stat-icon blue">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="number">
                        <?php
                        $result2 = $connect->query("SELECT COUNT(*) AS total FROM cities");
                        $row2 = $result2->fetch_assoc();
                        $totalcities = $row2['total'];
                        echo $totalcities;
                        ?>
                    </div>
                    <div class="label">Total Cities</div>
                </div>
            </div>
        </div>

        <!-- Doctors -->
        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 page-fade-in stagger-2">
            <div class="stat-card green">
                <div class="stat-icon green">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="number">
                        <?php
                        $result_doctor = $connect->query("SELECT COUNT(*) AS total FROM doctors");
                        $row_doctor = $result_doctor->fetch_assoc();
                        $total_doctor = $row_doctor['total'];
                        echo $total_doctor;
                        ?>
                    </div>
                    <div class="label">Total Doctors</div>
                </div>
            </div>
        </div>

        <!-- Patients -->
        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 page-fade-in stagger-3">
            <div class="stat-card red">
                <div class="stat-icon red">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="number">
                        <?php
                        $result_patient = $connect->query("SELECT COUNT(*) AS total FROM patients");
                        $row_patient = $result_patient->fetch_assoc();
                        $total_patient = $row_patient['total'];
                        echo $total_patient;
                        ?>
                    </div>
                    <div class="label">Total Patients</div>
                </div>
            </div>
        </div>

        <!-- Specializations -->
        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 page-fade-in stagger-4">
            <div class="stat-card purple">
                <div class="stat-icon purple">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="number">
                        <?php
                        $result = $connect->query("SELECT COUNT(*) AS total FROM specialization");
                        $row = $result->fetch_assoc();
                        $totalSpecialists = $row['total'];
                        echo $totalSpecialists;
                        ?>
                    </div>
                    <div class="label">Specializations</div>
                </div>
            </div>
        </div>

        <!-- Diseases -->
        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 page-fade-in stagger-5">
            <div class="stat-card orange">
                <div class="stat-icon orange">
                    <i class="bi bi-virus2"></i>
                </div>
                <div class="stat-info">
                    <div class="number">
                        <?php
                        $result_disease = $connect->query("SELECT COUNT(*) AS total FROM disease");
                        $row_disease = $result_disease->fetch_assoc();
                        $total_disease = $row_disease['total'];
                        echo $total_disease;
                        ?>
                    </div>
                    <div class="label">Total Diseases</div>
                </div>
            </div>
        </div>

        <!-- News Posts -->
        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 page-fade-in stagger-6">
            <div class="stat-card teal">
                <div class="stat-icon teal">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="stat-info">
                    <div class="number">
                        <?php
                        $result_news = $connect->query("SELECT COUNT(*) AS total FROM news");
                        $row_news = $result_news->fetch_assoc();
                        $total_news = $row_news['total'];
                        echo $total_news;
                        ?>
                    </div>
                    <div class="label">News Posts</div>
                </div>
            </div>
        </div>

    </div>
    <!-- END STATS CARDS -->

    <!-- ── RECENT TABLES ROW ────────────────────────────── -->
    <div class="row g-3">

        <!-- Recent Doctors Table -->
        <div class="col-xl-12 col-lg-12 page-fade-in stagger-2">
            <div class="section-card">
                <div class="section-card-header">
                    <h5><i class="bi bi-person-badge-fill"></i> Recent Doctors</h5>
                    <a href="doctors.php" class="btn-view btn-action">
                        <i class="bi bi-arrow-right-circle"></i> View All
                    </a>
                </div>
                <div class="section-card-body table-responsive-custom">
                    <table class="admin-table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Specialization</th>
                                <th>City</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-600 text-primary-custom">001</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av1">AK</div>
                                        <div>
                                            <div class="user-name">Dr. Ayesha Khan</div>
                                            <div class="user-email">ayesha@mediadmin.pk</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Cardiologist</td>
                                <td>Karachi</td>
                                <td><span class="badge-status badge-active">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">002</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av2">RA</div>
                                        <div>
                                            <div class="user-name">Dr. Raza Ahmed</div>
                                            <div class="user-email">raza@mediadmin.pk</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Neurologist</td>
                                <td>Lahore</td>
                                <td><span class="badge-status badge-active">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">003</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av3">SM</div>
                                        <div>
                                            <div class="user-name">Dr. Sara Malik</div>
                                            <div class="user-email">sara@mediadmin.pk</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Pediatrician</td>
                                <td>Islamabad</td>
                                <td><span class="badge-status badge-inactive">Inactive</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">004</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av4">OB</div>
                                        <div>
                                            <div class="user-name">Dr. Omar Baig</div>
                                            <div class="user-email">omar@mediadmin.pk</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Orthopedic</td>
                                <td>Rawalpindi</td>
                                <td><span class="badge-status badge-active">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">005</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av5">NZ</div>
                                        <div>
                                            <div class="user-name">Dr. Nadia Zubair</div>
                                            <div class="user-email">nadia@mediadmin.pk</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologist</td>
                                <td>Faisalabad</td>
                                <td><span class="badge-status badge-pending">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        <!-- Recent Patients Table -->
        <div class="col-xl-12 col-lg-12 page-fade-in stagger-3">
            <div class="section-card">
                <div class="section-card-header">
                    <h5><i class="bi bi-people-fill"></i> Recent Patients</h5>
                    <a href="patients.php" class="btn-view btn-action">
                        <i class="bi bi-arrow-right-circle"></i> View All
                    </a>
                </div>
                <div class="section-card-body table-responsive-custom">
                    <table class="admin-table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient</th>
                                <th>Age</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-600 text-primary-custom">P001</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av2">MH</div>
                                        <div class="user-name">Muhammad Hassan</div>
                                    </div>
                                </td>
                                <td>34</td>
                                <td><span class="badge-status badge-active">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">P002</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av1">FA</div>
                                        <div class="user-name">Fatima Ali</div>
                                    </div>
                                </td>
                                <td>27</td>
                                <td><span class="badge-status badge-active">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">P003</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av3">BK</div>
                                        <div class="user-name">Bilal Khan</div>
                                    </div>
                                </td>
                                <td>52</td>
                                <td><span class="badge-status badge-inactive">Inactive</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">P004</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av5">ZR</div>
                                        <div class="user-name">Zara Rehman</div>
                                    </div>
                                </td>
                                <td>19</td>
                                <td><span class="badge-status badge-pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td class="fw-600 text-primary-custom">P005</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar av4">IQ</div>
                                        <div class="user-name">Imran Qureshi</div>
                                    </div>
                                </td>
                                <td>45</td>
                                <td><span class="badge-status badge-active">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- END TABLES ROW -->

</div>
<!-- END DASHBOARD PAGE -->

<?php include('includes/footer.php'); ?>
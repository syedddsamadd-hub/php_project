<?php
/**
 * patients.php — Manage Patients Page
 * Healthcare Admin Panel — UI Only
 */
session_start();
if (!isset($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}
$pageTitle = 'Manage Patients';
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="page-wrapper">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="bi bi-people-fill me-2 text-primary"></i>Manage Patients</h4>
            <ul class="breadcrumb-custom">
                <li><a href="dashboard.php">Home</a></li>
                <li>Manage Patients</li>
            </ul>
        </div>
        <button class="btn-primary-custom" id="addNewBtn" data-bs-toggle="modal" data-bs-target="#patientModal">
            <i class="bi bi-plus-lg"></i> Add New Patient
        </button>
    </div>

    <!-- Search & Filter Bar -->
    <div class="search-filter-bar page-fade-in">
        <div class="search-input-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="tableSearch" placeholder="Search patients by name, phone, city…" />
        </div>
        <select class="filter-select">
            <option value="">All Cities</option>
            <option>Karachi</option><option>Lahore</option>
            <option>Islamabad</option><option>Rawalpindi</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Active</option><option>Inactive</option>
        </select>
    </div>

    <!-- Patients Table -->
    <div class="section-card page-fade-in stagger-2">
        <div class="section-card-header">
            <h5><i class="bi bi-table"></i> Patients List
                <span class="info-chip ms-2">3,452 Records</span>
            </h5>
            <button class="btn-outline-custom" onclick="showToast('success','Exported','Patients list exported.')">
                <i class="bi bi-file-earmark-excel"></i> Export
            </button>
        </div>
        <div class="section-card-body table-responsive-custom">
            <table class="admin-table table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Age / Gender</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Blood Group</th>
                        <th>Assigned Doctor</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $patients = [
                        ['P001','MH','Muhammad Hassan','hassan@gmail.com','av1',34,'Male','0312-1122334','Karachi','B+','Dr. Ayesha Khan','active'],
                        ['P002','FA','Fatima Ali','fatima@gmail.com','av2',27,'Female','0333-5566778','Lahore','O+','Dr. Raza Ahmed','active'],
                        ['P003','BK','Bilal Khan','bilal@gmail.com','av3',52,'Male','0300-9900112','Islamabad','A-','Dr. Sara Malik','inactive'],
                        ['P004','ZR','Zara Rehman','zara@gmail.com','av5',19,'Female','0321-3344556','Rawalpindi','AB+','Dr. Omar Baig','pending'],
                        ['P005','IQ','Imran Qureshi','imran@gmail.com','av4',45,'Male','0345-7788990','Faisalabad','O-','Dr. Nadia Zubair','active'],
                        ['P006','MA','Mahnoor Anwar','mahnoor@gmail.com','av2',31,'Female','0311-2233445','Karachi','B-','Dr. Tariq Hussain','active'],
                        ['P007','SK','Sohail Karim','sohail@gmail.com','av1',65,'Male','0333-6677889','Multan','A+','Dr. Zara Iqbal','inactive'],
                        ['P008','HN','Hira Naseer','hira@gmail.com','av3',23,'Female','0312-0011223','Lahore','AB-','Dr. Ali Raza','active'],
                    ];
                    foreach ($patients as $p):
                        $badgeClass = $p[11]==='active' ? 'badge-active' : ($p[11]==='inactive' ? 'badge-inactive' : 'badge-pending');
                    ?>
                    <tr>
                        <td class="fw-600 text-primary-custom"><?= $p[0] ?></td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar <?= $p[4] ?>"><?= $p[1] ?></div>
                                <div>
                                    <div class="user-name"><?= $p[2] ?></div>
                                    <div class="user-email"><?= $p[3] ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?= $p[5] ?> / <span class="fw-600"><?= $p[6] ?></span></td>
                        <td><?= $p[7] ?></td>
                        <td><i class="bi bi-geo-alt text-primary me-1"></i><?= $p[8] ?></td>
                        <td><span class="info-chip"><?= $p[9] ?></span></td>
                        <td><?= $p[10] ?></td>
                        <td><span class="badge-status <?= $badgeClass ?>"><?= ucfirst($p[11]) ?></span></td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#patientModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                                <button class="btn-action btn-delete btn-delete-row">
                                    <i class="bi bi-trash-fill"></i> Del
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-top">
            <p class="mb-0" style="font-size:13px;color:#7f8fa6;">Showing 1–8 of 3,452 records</p>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">…</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add/Edit Patient Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-plus-fill me-2"></i>Add New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom" placeholder="Patient full name" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Email Address</label>
                            <input type="email" class="form-control-custom" placeholder="patient@email.com" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Age <span class="text-danger">*</span></label>
                            <input type="number" class="form-control-custom" placeholder="Age" min="0" max="120" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Gender <span class="text-danger">*</span></label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;" required>
                                <option value="">Select</option>
                                <option>Male</option><option>Female</option><option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Blood Group</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option value="">Select</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>O+</option><option>O-</option>
                                <option>AB+</option><option>AB-</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Phone Number</label>
                            <input type="tel" class="form-control-custom" placeholder="03XX-XXXXXXX" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">City</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option value="">Select City</option>
                                <option>Karachi</option><option>Lahore</option>
                                <option>Islamabad</option><option>Rawalpindi</option><option>Multan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Assign Doctor</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option value="">Select Doctor</option>
                                <option>Dr. Ayesha Khan</option><option>Dr. Raza Ahmed</option>
                                <option>Dr. Sara Malik</option><option>Dr. Omar Baig</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Status</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option>Active</option><option>Inactive</option><option>Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Medical Notes</label>
                            <textarea class="form-control-custom" rows="3" placeholder="Any relevant medical history or notes…" style="resize:vertical;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button type="button" class="btn-primary-custom modal-save-btn">
                    <i class="bi bi-check-circle-fill"></i> Save Patient
                </button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
/**
 * patients.php — Manage Patients Page
 * Healthcare Admin Panel — UI Only
 */
include "..//connect.php";
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
            <option>Karachi</option>
            <option>Lahore</option>
            <option>Islamabad</option>
            <option>Rawalpindi</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Active</option>
            <option>Inactive</option>
        </select>
    </div>

    <!-- Patients Table -->
    <div class="section-card page-fade-in stagger-2">
        <div class="section-card-header">
            <h5><i class="bi bi-table"></i> Patients List
                <span class="info-chip ms-2">
                     <?php
                    $result_patient= $connect->query("SELECT COUNT(*) AS total FROM patients");
                    $row_patient = $result_patient->fetch_assoc();
                    $total_patient = $row_patient['total'];
                    echo $total_patient;
                    ?>
                </span>
            </h5>
            <button class="btn-outline-custom" onclick="showToast('success','Exported','Patients list exported.')">
                <i class="bi bi-file-earmark-excel"></i> Export
            </button>
        </div>
        <div class="section-card-body table-responsive-custom">
            <table class="admin-table table">
                <thead>
                    <tr>
                        <th>Patients ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_patients = "select * from patients";
                    $select_patients_query = mysqli_query($connect, $select_patients);
                    if (mysqli_num_rows($select_patients_query) > 0) {
                        while ($patients_table_row = mysqli_fetch_assoc($select_patients_query)) {
                            $patients_id = $patients_table_row["patient_id"];
                            $patients_name = $patients_table_row["name"];
                            $patients_gender = $patients_table_row["gender"];
                            $patients_email = $patients_table_row["email"];
                            $patients_number = $patients_table_row["phone"];
                            $patients_status = $patients_table_row["status"];
                            $city_id = $patients_table_row["city_id"];

                            $select_city_patients = "select * from cities where city_id='$city_id'";
                            $select_city_patients_query = mysqli_query($connect, $select_city_patients);
                            if (mysqli_num_rows($select_city_patients_query) > 0) {
                                while ($city_patients_table_row = mysqli_fetch_assoc($select_city_patients_query)) {
                                    $city_patients = $city_patients_table_row["city_name"];
                                    ?>
                                    <tr>
                                        <td class="fw-600 text-primary-custom"><?= $patients_id ?></td>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar av2">
                                                    <?php
                                                    $query = "SELECT name, UPPER(LEFT(name,2)) AS initials FROM patients";
                                                    $result = mysqli_query($connect, $query);
                                                    ?>
                                                </div>
                                                <div class="user-name"><?= $patients_name ?></div>
                                            </div>
                                        </td>
                                        <td><?= $patients_gender ?></td>
                                        <td><?= $patients_number ?></td>
                                        <td><?= $city_patients ?></td>
                                        <td><span class="badge-status badge-active"><?= $patients_status?></span></td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <button class="btn-action btn-edit" name="btn-edit-disease">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                                <button onclick="return confirm('are you sure to delete this this row.')"
                                                    class="btn-action btn-delete btn-delete-row" name="btn-delete-disease">
                                                    <i class="bi bi-trash-fill"></i> Del
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
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
                            <input type="number" class="form-control-custom" placeholder="Age" min="0" max="120"
                                required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Gender <span class="text-danger">*</span></label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;"
                                required>
                                <option value="">Select</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Blood Group</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option value="">Select</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>O+</option>
                                <option>O-</option>
                                <option>AB+</option>
                                <option>AB-</option>
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
                                <option>Karachi</option>
                                <option>Lahore</option>
                                <option>Islamabad</option>
                                <option>Rawalpindi</option>
                                <option>Multan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Assign Doctor</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option value="">Select Doctor</option>
                                <option>Dr. Ayesha Khan</option>
                                <option>Dr. Raza Ahmed</option>
                                <option>Dr. Sara Malik</option>
                                <option>Dr. Omar Baig</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Status</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Medical Notes</label>
                            <textarea class="form-control-custom" rows="3"
                                placeholder="Any relevant medical history or notes…"
                                style="resize:vertical;"></textarea>
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
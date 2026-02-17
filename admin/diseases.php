<?php
/**
 * diseases.php — Manage Diseases Page
 * Healthcare Admin Panel — UI Only
 */

$pageTitle = 'Manage Diseases';
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="page-wrapper">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="bi bi-virus2 me-2 text-primary"></i>Manage Diseases</h4>
            <ul class="breadcrumb-custom">
                <li><a href="dashboard.php">Home</a></li>
                <li>Manage Diseases</li>
            </ul>
        </div>
        <button class="btn-primary-custom" id="addNewBtn" data-bs-toggle="modal" data-bs-target="#diseaseModal">
            <i class="bi bi-plus-lg"></i> Add Disease
        </button>
    </div>

    <!-- Search Bar -->
    <div class="search-filter-bar page-fade-in">
        <div class="search-input-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="tableSearch" placeholder="Search diseases by name or category…" />
        </div>
        <select class="filter-select">
            <option value="">All Categories</option>
            <option>Cardiovascular</option><option>Neurological</option>
            <option>Respiratory</option><option>Infectious</option>
            <option>Metabolic</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Active</option><option>Inactive</option>
        </select>
    </div>

    <!-- Diseases Table -->
    <div class="section-card page-fade-in stagger-2">
        <div class="section-card-header">
            <h5><i class="bi bi-table"></i> Diseases List
                <span class="info-chip ms-2">94 Records</span>
            </h5>
        </div>
        <div class="section-card-body table-responsive-custom">
            <table class="admin-table table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Disease Name</th>
                        <th>ICD Code</th>
                        <th>Category</th>
                        <th>Related Specialization</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $diseases = [
                        [1,'Hypertension','I10','Cardiovascular','Cardiologist','High','active'],
                        [2,'Type 2 Diabetes','E11','Metabolic','General Physician','Medium','active'],
                        [3,'Migraine','G43','Neurological','Neurologist','Medium','active'],
                        [4,'Pneumonia','J18','Respiratory','General Physician','High','active'],
                        [5,'Asthma','J45','Respiratory','General Physician','Medium','active'],
                        [6,'Osteoarthritis','M15','Musculoskeletal','Orthopedic','Low','active'],
                        [7,'Eczema','L20','Dermatological','Dermatologist','Low','active'],
                        [8,'Epilepsy','G40','Neurological','Neurologist','High','active'],
                        [9,'Tuberculosis','A15','Infectious','General Physician','High','inactive'],
                        [10,'Hyperthyroidism','E05','Endocrine','General Physician','Medium','active'],
                    ];
                    $severityClass = ['High'=>'badge-inactive','Medium'=>'badge-pending','Low'=>'badge-active'];
                    $iconColors = ['av1','av2','av3','av4','av5'];
                    foreach ($diseases as $i => $d):
                        $badge = $d[6]==='active' ? 'badge-active' : 'badge-inactive';
                        $sevClass = $severityClass[$d[5]] ?? 'badge-pending';
                        $ic = $iconColors[$i % 5];
                    ?>
                    <tr>
                        <td class="fw-600 text-primary-custom"><?= str_pad($d[0],2,'0',STR_PAD_LEFT) ?></td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar <?= $ic ?>">
                                    <i class="bi bi-virus" style="font-size:14px;"></i>
                                </div>
                                <span class="user-name"><?= $d[1] ?></span>
                            </div>
                        </td>
                        <td><span class="info-chip"><?= $d[2] ?></span></td>
                        <td><?= $d[3] ?></td>
                        <td><?= $d[4] ?></td>
                        <td><span class="badge-status <?= $sevClass ?>"><?= $d[5] ?></span></td>
                        <td><span class="badge-status <?= $badge ?>"><?= ucfirst($d[6]) ?></span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#diseaseModal">
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
            <p class="mb-0" style="font-size:13px;color:#7f8fa6;">Showing 1–10 of 94 records</p>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">…</a></li>
                    <li class="page-item"><a class="page-link" href="#">10</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Disease Modal -->
<div class="modal fade" id="diseaseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-virus2 me-2"></i>Add New Disease</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Disease Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom" placeholder="Enter disease name" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">ICD Code</label>
                            <input type="text" class="form-control-custom" placeholder="e.g. I10" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Category <span class="text-danger">*</span></label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;" required>
                                <option value="">Select Category</option>
                                <option>Cardiovascular</option><option>Neurological</option>
                                <option>Respiratory</option><option>Infectious</option>
                                <option>Metabolic</option><option>Musculoskeletal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Related Specialization</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option value="">Select Specialization</option>
                                <option>Cardiologist</option><option>Neurologist</option>
                                <option>Pediatrician</option><option>Orthopedic</option>
                                <option>General Physician</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Severity Level</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option>Low</option><option>Medium</option><option>High</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Status</label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                                <option>Active</option><option>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Description / Symptoms</label>
                            <textarea class="form-control-custom" rows="3" placeholder="Brief description of this disease and common symptoms…" style="resize:vertical;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button type="button" class="btn-primary-custom modal-save-btn">
                    <i class="bi bi-check-circle-fill"></i> Save Disease
                </button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
/**
 * news.php — Manage News Page
 * Healthcare Admin Panel — UI Only
 */

$pageTitle = 'Manage News';
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="page-wrapper">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="bi bi-newspaper me-2 text-primary"></i>Manage News</h4>
            <ul class="breadcrumb-custom">
                <li><a href="dashboard.php">Home</a></li>
                <li>Manage News</li>
            </ul>
        </div>
        <button class="btn-primary-custom" id="addNewBtn" data-bs-toggle="modal" data-bs-target="#newsModal">
            <i class="bi bi-plus-lg"></i> Add News Post
        </button>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter-bar page-fade-in">
        <div class="search-input-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="tableSearch" placeholder="Search news by title or author…" />
        </div>
        <select class="filter-select">
            <option value="">All Categories</option>
            <option>General Health</option><option>Medical Research</option>
            <option>Hospital News</option><option>Events</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Published</option><option>Draft</option><option>Archived</option>
        </select>
    </div>

    <!-- News Table -->
    <div class="section-card page-fade-in stagger-2">
        <div class="section-card-header">
            <h5><i class="bi bi-table"></i> News Posts
                <span class="info-chip ms-2">58 Records</span>
            </h5>
        </div>
        <div class="section-card-body table-responsive-custom">
            <table class="admin-table table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Published Date</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $news = [
                        [1,'New Cardiac Surgery Wing Inaugurated at City Hospital','Dr. Ayesha Khan','Hospital News','Jan 10, 2025',2430,'published'],
                        [2,'Breakthrough in Diabetes Treatment: Local Research Team','Dr. Raza Ahmed','Medical Research','Jan 15, 2025',1890,'published'],
                        [3,'Free Medical Camp Scheduled for Feb 2025 in Karachi','Admin','Events','Jan 20, 2025',3210,'published'],
                        [4,'Understanding Mental Health: Awareness Drive 2025','Dr. Nadia Zubair','General Health','Jan 25, 2025',1240,'published'],
                        [5,'COVID-19 Booster Guidelines Updated by Health Ministry','Admin','General Health','Feb 01, 2025',890,'draft'],
                        [6,'Annual Healthcare Conference — Registration Open','Dr. Omar Baig','Events','Feb 05, 2025',650,'published'],
                        [7,'New Pediatric Ward Opens at Children\'s Hospital Lahore','Dr. Sara Malik','Hospital News','Feb 08, 2025',1120,'archived'],
                        [8,'Advances in Orthopedic Surgery Techniques','Dr. Omar Baig','Medical Research','Feb 10, 2025',780,'published'],
                    ];
                    $statusClass = [
                        'published'=>'badge-active',
                        'draft'=>'badge-pending',
                        'archived'=>'badge-inactive'
                    ];
                    $avatarClasses = ['av1','av2','av3','av4','av5'];
                    foreach ($news as $i => $n):
                        $sc = $statusClass[$n[6]] ?? 'badge-pending';
                        $ic = $avatarClasses[$i % 5];
                    ?>
                    <tr>
                        <td class="fw-600 text-primary-custom"><?= str_pad($n[0],2,'0',STR_PAD_LEFT) ?></td>
                        <td style="max-width:280px;">
                            <div class="user-cell">
                                <div class="user-avatar <?= $ic ?>">
                                    <i class="bi bi-file-text" style="font-size:14px;"></i>
                                </div>
                                <div>
                                    <div class="user-name" style="font-size:13px;line-height:1.3;"><?= $n[1] ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?= $n[2] ?></td>
                        <td><span class="info-chip"><?= $n[3] ?></span></td>
                        <td><i class="bi bi-calendar3 text-primary me-1"></i><?= $n[4] ?></td>
                        <td><i class="bi bi-eye text-primary me-1"></i><?= number_format($n[5]) ?></td>
                        <td><span class="badge-status <?= $sc ?>"><?= ucfirst($n[6]) ?></span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn-action btn-view" data-bs-toggle="modal" data-bs-target="#newsModal">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#newsModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                                <button class="btn-action btn-delete btn-delete-row">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-top">
            <p class="mb-0" style="font-size:13px;color:#7f8fa6;">Showing 1–8 of 58 records</p>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">…</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- News Modal -->
<div class="modal fade" id="newsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-newspaper me-2"></i>Add News Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Post Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom" placeholder="Enter news post title" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Category <span class="text-danger">*</span></label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;" required>
                                <option value="">Select Category</option>
                                <option>General Health</option><option>Medical Research</option>
                                <option>Hospital News</option><option>Events</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Author</label>
                            <input type="text" class="form-control-custom" placeholder="Author name" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Status <span class="text-danger">*</span></label>
                            <select class="form-control-custom filter-select" style="width:100%;border-radius:9px;" required>
                                <option>Published</option><option>Draft</option><option>Archived</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Featured Image</label>
                            <input type="file" class="form-control-custom" accept="image/*" style="padding:7px 14px;" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Short Summary</label>
                            <textarea class="form-control-custom" rows="2" placeholder="Brief summary or excerpt of the post…" style="resize:vertical;"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Full Content <span class="text-danger">*</span></label>
                            <textarea class="form-control-custom" rows="6" placeholder="Write your full news article here…" style="resize:vertical;" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button type="button" class="btn-primary-custom modal-save-btn">
                    <i class="bi bi-check-circle-fill"></i> Publish Post
                </button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

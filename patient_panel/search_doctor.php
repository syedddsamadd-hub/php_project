<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctor | MedCare Patient Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="style.css">
    <style>
        
    </style>
</head>
<body>

<?php
require "sidebar_navbar.php";
?>
<main class="main-content">
    <div class="page-header">
        <h4><i class="fas fa-search text-primary me-2"></i>Find a Doctor</h4>
        <p>Search from our network of 500+ verified specialists</p>
    </div>

    <!-- Filter -->
    <div class="filter-card">
        <h6><i class="fas fa-filter text-primary me-2"></i>Filter Doctors</h6>
        <form action="#" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt me-1 text-primary"></i>City</label>
                    <select class="form-select" name="city">
                        <option value="">All Cities</option>
                        <option>New York</option>
                        <option>Los Angeles</option>
                        <option>Chicago</option>
                        <option>Houston</option>
                        <option>Phoenix</option>
                        <option>Philadelphia</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label"><i class="fas fa-stethoscope me-1 text-primary"></i>Specialization</label>
                    <select class="form-select" name="specialization">
                        <option value="">All Specializations</option>
                        <option>Cardiologist</option>
                        <option>Dermatologist</option>
                        <option>Neurologist</option>
                        <option>Orthopedist</option>
                        <option>Pediatrician</option>
                        <option>Psychiatrist</option>
                        <option>General Physician</option>
                        <option>ENT Specialist</option>
                        <option>Ophthalmologist</option>
                        <option>Gynecologist</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 d-flex gap-2">
                    <button type="submit" class="btn-search flex-fill"><i class="fas fa-search me-2"></i>Search Doctors</button>
                    <a href="search_doctor.php" style="background:#f1f5f9;color:#64748b;border:none;border-radius:10px;padding:11px 14px;font-weight:700;font-size:0.88rem;text-decoration:none;display:flex;align-items:center;"><i class="fas fa-redo"></i></a>
                </div>
            </div>
        </form>
    </div>

    <!-- Results -->
    <div class="results-header">
        <h6>Available Doctors</h6>
        <span class="results-count">8 doctors found</span>
    </div>

    <div class="row g-4">
        <?php
        $doctors = [
            ['name' => 'Dr. Sarah Williams', 'spec' => 'Cardiologist', 'exp' => '12 Years', 'fee' => '$80', 'city' => 'New York', 'rating' => '4.9', 'reviews' => '142', 'initials' => 'SW'],
            ['name' => 'Dr. James Carter', 'spec' => 'Orthopedist', 'exp' => '8 Years', 'fee' => '$65', 'city' => 'Los Angeles', 'rating' => '4.7', 'reviews' => '98', 'initials' => 'JC'],
            ['name' => 'Dr. Emily Parker', 'spec' => 'Dermatologist', 'exp' => '6 Years', 'fee' => '$55', 'city' => 'Chicago', 'rating' => '4.8', 'reviews' => '210', 'initials' => 'EP'],
            ['name' => 'Dr. Robert Kim', 'spec' => 'Neurologist', 'exp' => '15 Years', 'fee' => '$95', 'city' => 'New York', 'rating' => '5.0', 'reviews' => '87', 'initials' => 'RK'],
            ['name' => 'Dr. Lisa Johnson', 'spec' => 'Pediatrician', 'exp' => '10 Years', 'fee' => '$60', 'city' => 'Houston', 'rating' => '4.9', 'reviews' => '173', 'initials' => 'LJ'],
            ['name' => 'Dr. Michael Brown', 'spec' => 'General Physician', 'exp' => '5 Years', 'fee' => '$45', 'city' => 'Chicago', 'rating' => '4.6', 'reviews' => '65', 'initials' => 'MB'],
            ['name' => 'Dr. Priya Sharma', 'spec' => 'Gynecologist', 'exp' => '9 Years', 'fee' => '$70', 'city' => 'Phoenix', 'rating' => '4.9', 'reviews' => '134', 'initials' => 'PS'],
            ['name' => 'Dr. David Chen', 'spec' => 'ENT Specialist', 'exp' => '7 Years', 'fee' => '$58', 'city' => 'Philadelphia', 'rating' => '4.7', 'reviews' => '92', 'initials' => 'DC'],
        ];
        $colors = ['#0d6efd','#10b981','#f59e0b','#8b5cf6','#ef4444','#06b6d4','#ec4899','#14b8a6'];
        foreach ($doctors as $idx => $doc):
            $color = $colors[$idx % count($colors)];
        ?>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="doctor-card">
                <div class="doctor-top">
                    <div class="doctor-avatar-placeholder" style="background:linear-gradient(135deg, <?= $color ?>, <?= $color ?>aa);">
                        <?= $doc['initials'] ?>
                    </div>
                    <div class="doctor-info">
                        <h6><?= $doc['name'] ?></h6>
                        <span class="spec-badge"><?= $doc['spec'] ?></span>
                        <div class="rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <span><?= $doc['rating'] ?> (<?= $doc['reviews'] ?>)</span>
                        </div>
                    </div>
                </div>
                <div class="doctor-meta">
                    <div class="doctor-meta-item"><i class="fas fa-briefcase-medical"></i><?= $doc['exp'] ?> Experience</div>
                    <div class="doctor-meta-item"><i class="fas fa-map-marker-alt"></i><?= $doc['city'] ?></div>
                </div>
                <div class="doctor-divider"></div>
                <div class="doctor-footer">
                    <div>
                        <div class="fee-label">Consultation Fee</div>
                        <div class="fee-amount"><?= $doc['fee'] ?></div>
                    </div>
                    <a href="book_appointment.php" class="btn-book"><i class="fas fa-calendar-plus me-1"></i>Book</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

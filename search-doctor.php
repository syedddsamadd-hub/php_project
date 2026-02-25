<?php
include "connect.php";
$page_title = 'Find a Doctor';

// Get filter values from GET params
$city_filter = isset($_GET['city']) ? trim($_GET['city']) : '';
$spec_filter = isset($_GET['spec']) ? trim($_GET['spec']) : '';
$sort_filter = isset($_GET['sort']) ? trim($_GET['sort']) : 'rating';

// Sample doctor data array
$all_doctors = [
  ['name' => 'Dr. Sarah Ahmed', 'spec' => 'Cardiology', 'spec_icon' => 'heartbeat', 'qual' => 'MBBS, FCPS (Cardiology)', 'exp' => 12, 'city' => 'Karachi', 'area' => 'Clifton', 'fee' => 2000, 'rating' => 4.9, 'reviews' => 120, 'avail' => 'Available Today', 'bg' => 'linear-gradient(135deg,#E3F2FD,#BBDEFB)', 'ic' => 'var(--primary)'],
  ['name' => 'Dr. Imran Malik', 'spec' => 'Neurology', 'spec_icon' => 'brain', 'qual' => 'MBBS, MD (Neurology)', 'exp' => 9, 'city' => 'Lahore', 'area' => 'Gulberg', 'fee' => 2500, 'rating' => 4.8, 'reviews' => 95, 'avail' => 'Available Today', 'bg' => 'linear-gradient(135deg,#E0F7FA,#B2EBF2)', 'ic' => 'var(--accent)'],
  ['name' => 'Dr. Fatima Khan', 'spec' => 'Orthopedics', 'spec_icon' => 'bone', 'qual' => 'MBBS, FRCS', 'exp' => 15, 'city' => 'Islamabad', 'area' => 'F-7', 'fee' => 3000, 'rating' => 4.7, 'reviews' => 80, 'avail' => 'Tomorrow', 'bg' => 'linear-gradient(135deg,#FFF3E0,#FFE0B2)', 'ic' => '#F57F17'],
  ['name' => 'Dr. Ali Hassan', 'spec' => 'Ophthalmology', 'spec_icon' => 'eye', 'qual' => 'MBBS, DOMS', 'exp' => 8, 'city' => 'Faisalabad', 'area' => 'Civil Lines', 'fee' => 1800, 'rating' => 4.9, 'reviews' => 140, 'avail' => 'Available Today', 'bg' => 'linear-gradient(135deg,#EDE7F6,#D1C4E9)', 'ic' => '#6A1B9A'],
  ['name' => 'Dr. Hira Baig', 'spec' => 'Pediatrics', 'spec_icon' => 'baby', 'qual' => 'MBBS, DCH', 'exp' => 11, 'city' => 'Lahore', 'area' => 'DHA', 'fee' => 1500, 'rating' => 4.8, 'reviews' => 205, 'avail' => 'Available Today', 'bg' => 'linear-gradient(135deg,#E8F5E9,#C8E6C9)', 'ic' => 'var(--success)'],
  ['name' => 'Dr. Usman Tariq', 'spec' => 'Dentistry', 'spec_icon' => 'tooth', 'qual' => 'BDS, FCPS', 'exp' => 7, 'city' => 'Karachi', 'area' => 'North Naz.', 'fee' => 1200, 'rating' => 4.5, 'reviews' => 60, 'avail' => 'Busy', 'bg' => 'linear-gradient(135deg,#FFEBEE,#FFCDD2)', 'ic' => 'var(--danger)'],
  ['name' => 'Dr. Noman Shah', 'spec' => 'Cardiology', 'spec_icon' => 'heartbeat', 'qual' => 'MBBS, MD (Cardio)', 'exp' => 14, 'city' => 'Islamabad', 'area' => 'G-9', 'fee' => 2800, 'rating' => 4.8, 'reviews' => 110, 'avail' => 'Available Today', 'bg' => 'linear-gradient(135deg,#E3F2FD,#BBDEFB)', 'ic' => 'var(--primary)'],
  ['name' => 'Dr. Rabia Qureshi', 'spec' => 'Dermatology', 'spec_icon' => 'hand-paper', 'qual' => 'MBBS, DDVL', 'exp' => 6, 'city' => 'Lahore', 'area' => 'Johar Town', 'fee' => 1600, 'rating' => 4.6, 'reviews' => 75, 'avail' => 'Tomorrow', 'bg' => 'linear-gradient(135deg,#FFF9C4,#FFF176)', 'ic' => '#F9A825'],
  ['name' => 'Dr. Tariq Mehmood', 'spec' => 'Pulmonology', 'spec_icon' => 'lungs', 'qual' => 'MBBS, FCPS (Pulmo)', 'exp' => 13, 'city' => 'Karachi', 'area' => 'PECHS', 'fee' => 2200, 'rating' => 4.7, 'reviews' => 88, 'avail' => 'Available Today', 'bg' => 'linear-gradient(135deg,#E3F2FD,#BBDEFB)', 'ic' => 'var(--accent)'],
];

// Filter
$doctors = $all_doctors;
if ($city_filter) {
  $doctors = array_filter($doctors, fn($d) => strtolower($d['city']) === strtolower($city_filter));
}
if ($spec_filter) {
  $doctors = array_filter($doctors, fn($d) => strtolower($d['spec']) === strtolower($spec_filter));
}
// Sort
if ($sort_filter === 'fee_asc')
  usort($doctors, fn($a, $b) => $a['fee'] - $b['fee']);
elseif ($sort_filter === 'exp')
  usort($doctors, fn($a, $b) => $b['exp'] - $a['exp']);
else
  usort($doctors, fn($a, $b) => $b['rating'] <=> $a['rating']);

$cities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan'];
$specs = ['Cardiology', 'Neurology', 'Orthopedics', 'Ophthalmology', 'Pediatrics', 'Dentistry', 'Psychiatry', 'Dermatology', 'Pulmonology'];
include 'includes/head.php';
?>

<?php include 'includes/navbar.php'; ?>

<!-- Hero Banner -->
<section class="search-hero">
  <div class="container text-center">
    <span class="badge-accent"
      style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.3);">500+ Verified
      Doctors</span>
    <h1 class="hero-title mt-2 mb-2" style="font-size:2.4rem;">Find the Right Doctor</h1>
    <p style="color:rgba(255,255,255,0.8);">Search from our network of specialists across Pakistan</p>
  </div>
</section>

<!-- Filter Box -->
<div class="container" style="margin-top:-10px;position:relative;z-index:10;">
  <div class="search-filter-box">
    <form method="GET" action="search-doctor.php">
      <div class="row g-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label"
            style="font-size:0.82rem;font-weight:600;color:var(--text-dark);text-transform:uppercase;letter-spacing:.5px;">
            <i class="fas fa-city me-1" style="color:var(--primary);"></i> City
          </label>
          <select class="filter-select" name="city">
            <option value="">All Cities</option>
            <?php
            $city_query = mysqli_query($connect, "SELECT city_id, city_name FROM cities");
            while ($row1 = mysqli_fetch_assoc($city_query)) {
              echo "<option value='" . $row1['city_id'] . "'>" . $row1['city_name'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label"
            style="font-size:0.82rem;font-weight:600;color:var(--text-dark);text-transform:uppercase;letter-spacing:.5px;">
            <i class="fas fa-stethoscope me-1" style="color:var(--primary);"></i> Specialization
          </label>
          <select class="filter-select" name="spec">
            <option value="">All Specializations</option>
            <?php
            $specialize_query = mysqli_query($connect, "SELECT specialize_id, specialize FROM specialization");
            while ($row2 = mysqli_fetch_assoc($specialize_query)) {
              echo "<option value='" . $row2['specialize_id'] . "'>" . $row2['specialize'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label"
            style="font-size:0.82rem;font-weight:600;color:var(--text-dark);text-transform:uppercase;letter-spacing:.5px;">
            <i class="fas fa-sort me-1" style="color:var(--primary);"></i> Sort By
          </label>
          <select class="filter-select" name="sort">
            <option value="rating" <?php echo ($sort_filter === 'rating') ? 'selected' : ''; ?>>Highest Rated</option>
            <option value="exp" <?php echo ($sort_filter === 'exp') ? 'selected' : ''; ?>>Most Experienced</option>
            <option value="fee_asc" <?php echo ($sort_filter === 'fee_asc') ? 'selected' : ''; ?>>Lowest Fee</option>
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn-primary-care w-100 justify-content-center" style="padding:13px;">
            <i class="fas fa-search"></i> Search Doctors
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Results -->
<section class="section-padding">
  <div class="container">
    <div class="results-header">
      <p class="results-count">Showing <strong><?php echo count($doctors); ?></strong> doctor(s) found</p>
      <?php if ($city_filter || $spec_filter): ?>
        <a href="search-doctor.php" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:0.8rem;">
          <i class="fas fa-times me-1"></i>Clear Filters
        </a>
      <?php endif; ?>
    </div>

    <?php if (empty($doctors)): ?>
      <div class="text-center py-5">
        <i class="fas fa-search" style="font-size:3rem;color:var(--medium-gray);"></i>
        <h5 class="mt-3" style="color:var(--text-muted);">No doctors found matching your criteria.</h5>
        <a href="search-doctor.php" class="btn-primary-care mt-3"><i class="fas fa-refresh"></i> Reset Filters</a>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php $i = 0;
        foreach ($doctors as $doc):
          $i++; ?>
          <div class="col-md-6 col-lg-4 animate-on-scroll" style="transition-delay:<?php echo (($i - 1) % 6) * 0.07; ?>s">
            <div class="doctor-card">
              <div class="doctor-card-img" style="background:<?php echo $doc['bg']; ?>">
                <i class="fas fa-user-md" style="color:<?php echo $doc['ic']; ?>"></i>
                <span class="availability-badge" <?php echo ($doc['avail'] === 'Busy') ? 'style="background:#FFEBEE;color:var(--danger);border-color:rgba(198,40,40,.2);"' : ''; ?>>
                  <i class="fas fa-circle"
                    style="font-size:7px;margin-right:4px;"></i><?php echo htmlspecialchars($doc['avail']); ?>
                </span>
              </div>
              <div class="doctor-card-body">
                <h5><?php echo htmlspecialchars($doc['name']); ?></h5>
                <p class="doctor-spec"><i
                    class="fas fa-<?php echo $doc['spec_icon']; ?> me-1"></i><?php echo htmlspecialchars($doc['spec']); ?>
                </p>
                <p class="doctor-meta"><i class="fas fa-graduation-cap"></i><?php echo htmlspecialchars($doc['qual']); ?>
                </p>
                <p class="doctor-meta"><i class="fas fa-briefcase"></i><?php echo $doc['exp']; ?> Years Experience</p>
                <p class="doctor-meta"><i class="fas fa-map-marker-alt"></i><?php echo htmlspecialchars($doc['city']); ?>
                  &ndash; <?php echo htmlspecialchars($doc['area']); ?></p>
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <span class="doctor-fees-badge"><i class="fas fa-tag me-1"></i>Rs.
                    <?php echo number_format($doc['fee']); ?></span>
                  <div>
                    <span class="stars">★★★★<?php echo $doc['rating'] >= 4.8 ? '★' : '☆'; ?></span>
                    <span class="rating-text"><?php echo $doc['rating']; ?> (<?php echo $doc['reviews']; ?>)</span>
                  </div>
                </div>
                <a href="appointment.php?doctor=<?php echo urlencode($doc['name']); ?>&spec=<?php echo urlencode($doc['spec']); ?>&fee=<?php echo $doc['fee']; ?>"
                  class="btn-primary-care w-100 justify-content-center">
                  <i class="fas fa-calendar-plus"></i> Book Appointment
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Pagination (UI only) -->
    <?php if (count($doctors) > 0): ?>
      <div class="d-flex justify-content-center mt-5">
        <nav>
          <ul class="pagination gap-1">
            <li class="page-item"><a class="page-link"
                href="?<?php echo http_build_query(array_merge($_GET, ['page' => 1])); ?>" style="border-radius:8px;"><i
                  class="fas fa-chevron-left"></i></a></li>
            <li class="page-item active"><a class="page-link" href="#"
                style="border-radius:8px;background:var(--primary);border-color:var(--primary);">1</a></li>
            <li class="page-item"><a class="page-link" href="#" style="border-radius:8px;">2</a></li>
            <li class="page-item"><a class="page-link" href="#" style="border-radius:8px;">3</a></li>
            <li class="page-item"><a class="page-link" href="#" style="border-radius:8px;"><i
                  class="fas fa-chevron-right"></i></a></li>
          </ul>
        </nav>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
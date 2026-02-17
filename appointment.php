<?php
$page_title = 'Book Appointment';

// // Get doctor info from URL params
// $doctor_name = isset($_GET['doctor']) ? htmlspecialchars(urldecode($_GET['doctor'])) : 'Dr. Sarah Ahmed';
// $doctor_spec = isset($_GET['spec'])   ? htmlspecialchars(urldecode($_GET['spec']))   : 'Cardiologist';
// $doctor_fee  = isset($_GET['fee'])    ? (int)$_GET['fee']                            : 2000;

// // Morning and evening slots
// $morning_slots = ['09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM'];
// $evening_slots = ['04:00 PM','04:30 PM','05:00 PM','05:30 PM','06:00 PM','06:30 PM','07:00 PM','07:30 PM'];
// // Unavailable slots (sample)
// $unavailable = ['10:00 AM','11:30 AM','05:00 PM','07:00 PM'];

// // Next 6 days
// $days = [];
// for ($i = 0; $i < 6; $i++) {
//     $ts = strtotime("+$i day");
//     $days[] = [
//         'label' => date('D', $ts),
//         'full'  => date('d M', $ts),
//         'ts'    => $ts,
//     ];
// }
include 'includes/head.php';
?>

<?php include 'includes/navbar.php'; ?>

  <!-- Breadcrumb -->
  <div style="background:var(--off-white);padding:12px 0;border-bottom:1px solid rgba(21,101,192,0.08);">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0" style="font-size:0.83rem;">
          <li class="breadcrumb-item"><a href="index.php" style="color:var(--primary);">Home</a></li>
          <li class="breadcrumb-item"><a href="search-doctor.php" style="color:var(--primary);">Search Doctor</a></li>
          <li class="breadcrumb-item active" style="color:var(--text-muted);">Book Appointment</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="appointment-page section-padding">
    <div class="container">
      <div class="row g-4 align-items-start">

        <!-- LEFT: Doctor Profile -->
        <div class="col-lg-4">
          <div class="doc-summary-card mb-4">
            <div class="doc-summary-avatar"><i class="fas fa-user-md"></i></div>
            <h4 class="fw-700 text-dark text-center mb-1" style="font-weight:700;color:var(--text-dark);"><?php echo $doctor_name; ?></h4>
            <p class="text-center" style="color:var(--primary);font-weight:600;font-size:0.9rem;"><?php echo $doctor_spec; ?></p>
            <div class="text-center mb-3">
              <span class="stars">★★★★★</span>
              <span class="rating-text"> 4.9 (120 reviews)</span>
            </div>
            <hr style="border-color:rgba(21,101,192,0.15);" />
            <div class="d-flex flex-column gap-2 mt-3">
              <div class="d-flex align-items-center gap-2" style="font-size:0.88rem;color:var(--text-muted);">
                <i class="fas fa-briefcase" style="color:var(--primary);width:18px;"></i>
                <span>12 Years Experience</span>
              </div>
              <div class="d-flex align-items-center gap-2" style="font-size:0.88rem;color:var(--text-muted);">
                <i class="fas fa-map-marker-alt" style="color:var(--primary);width:18px;"></i>
                <span>Karachi – Medical Complex</span>
              </div>
              <div class="d-flex align-items-center gap-2" style="font-size:0.88rem;color:var(--text-muted);">
                <i class="fas fa-tag" style="color:var(--primary);width:18px;"></i>
                <span>Fee: <strong style="color:var(--text-dark);">Rs. <?php echo number_format($doctor_fee); ?></strong></span>
              </div>
              <div class="d-flex align-items-center gap-2" style="font-size:0.88rem;color:var(--text-muted);">
                <i class="fas fa-clock" style="color:var(--primary);width:18px;"></i>
                <span>Avg. Wait: 15 minutes</span>
              </div>
            </div>
            <div class="mt-3 p-2 rounded" style="background:rgba(46,125,50,0.08);color:var(--success);font-size:0.82rem;font-weight:600;text-align:center;">
              <i class="fas fa-circle" style="font-size:7px;margin-right:4px;"></i> Available Today
            </div>
          </div>

          <!-- Patient Info -->
          <div class="card-care p-4">
            <h6 style="font-weight:700;color:var(--text-dark);margin-bottom:16px;"><i class="fas fa-notes-medical me-1" style="color:var(--primary);"></i>Patient Information</h6>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="patientName" placeholder="Full Name" value="Zara Khan" />
              <label>Full Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="patientAge" placeholder="Age" value="34" />
              <label>Age</label>
            </div>
            <div class="form-floating">
              <textarea class="form-control" id="patientSymptoms" placeholder="Symptoms" style="height:90px;"></textarea>
              <label>Symptoms / Reason for Visit</label>
            </div>
          </div>
        </div>

        <!-- RIGHT: Slot Selection -->
        <div class="col-lg-8">
          <div class="card-care p-4 mb-4">
            <h5 style="font-weight:700;color:var(--text-dark);margin-bottom:20px;">
              <i class="fas fa-calendar-alt me-2" style="color:var(--primary);"></i>Select Date &amp; Time
            </h5>

            <!-- Date Selection -->
            <div class="mb-4">
              <div class="section-label"><i class="fas fa-calendar me-1"></i> Choose Date</div>
              <div class="d-flex flex-wrap gap-2">
                <?php foreach ($days as $idx => $day): ?>
                <button type="button" class="time-slot-btn <?php echo $idx === 0 ? 'selected' : ''; ?>" style="min-width:80px;text-align:center;" onclick="selectDate(this, '<?php echo $day['full']; ?>')">
                  <div style="font-size:0.72rem;opacity:.75;"><?php echo $day['label']; ?></div>
                  <div style="font-weight:700;"><?php echo $day['full']; ?></div>
                </button>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Morning Slots -->
            <div class="mb-4">
              <div class="section-label"><i class="fas fa-sun me-1"></i> Morning Slots</div>
              <div class="row g-2">
                <?php foreach ($morning_slots as $slot): ?>
                <div class="col-6 col-md-3">
                  <button type="button" class="time-slot-btn <?php echo in_array($slot, $unavailable) ? 'unavailable' : ''; ?>"
                    onclick="selectSlot(this)"><?php echo $slot; ?></button>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Evening Slots -->
            <div class="mb-4">
              <div class="section-label"><i class="fas fa-moon me-1"></i> Evening Slots</div>
              <div class="row g-2">
                <?php foreach ($evening_slots as $slot): ?>
                <div class="col-6 col-md-3">
                  <button type="button" class="time-slot-btn <?php echo in_array($slot, $unavailable) ? 'unavailable' : ''; ?>"
                    onclick="selectSlot(this)"><?php echo $slot; ?></button>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Legend -->
            <div class="d-flex flex-wrap gap-3 mb-4" style="font-size:0.8rem;">
              <span><span style="display:inline-block;width:12px;height:12px;background:var(--primary);border-radius:3px;margin-right:5px;"></span>Selected</span>
              <span><span style="display:inline-block;width:12px;height:12px;background:white;border:2px solid rgba(21,101,192,0.2);border-radius:3px;margin-right:5px;"></span>Available</span>
              <span><span style="display:inline-block;width:12px;height:12px;background:var(--light-gray);border-radius:3px;margin-right:5px;"></span>Unavailable</span>
            </div>

            <!-- Summary -->
            <div class="p-4 rounded mb-4" style="background:var(--light-blue);border:1px solid rgba(21,101,192,0.15);">
              <h6 style="font-weight:700;color:var(--text-dark);margin-bottom:12px;"><i class="fas fa-receipt me-1" style="color:var(--primary);"></i>Appointment Summary</h6>
              <div class="row g-2" style="font-size:0.88rem;">
                <div class="col-6"><span style="color:var(--text-muted);">Doctor:</span></div>
                <div class="col-6"><strong><?php echo $doctor_name; ?></strong></div>
                <div class="col-6"><span style="color:var(--text-muted);">Specialization:</span></div>
                <div class="col-6"><strong><?php echo $doctor_spec; ?></strong></div>
                <div class="col-6"><span style="color:var(--text-muted);">Date:</span></div>
                <div class="col-6"><strong id="summaryDate"><?php echo $days[0]['full'] . ', ' . date('Y'); ?></strong></div>
                <div class="col-6"><span style="color:var(--text-muted);">Time:</span></div>
                <div class="col-6"><strong id="summaryTime">Select a slot above</strong></div>
                <div class="col-6"><span style="color:var(--text-muted);">Consultation Fee:</span></div>
                <div class="col-6"><strong style="color:var(--primary);">Rs. <?php echo number_format($doctor_fee); ?></strong></div>
              </div>
            </div>

            <button onclick="confirmAppointment()" class="btn-primary-care w-100 justify-content-center" style="padding:15px;font-size:1rem;">
              <i class="fas fa-check-circle"></i> Confirm Appointment
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Confirm Modal -->
  <div class="modal fade modal-care" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-calendar-check me-2"></i>Appointment Confirmed!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center py-4">
          <div style="width:72px;height:72px;background:var(--light-blue);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:2rem;color:var(--primary);">
            <i class="fas fa-check"></i>
          </div>
          <h5 style="font-weight:700;color:var(--text-dark);">Appointment Confirmed!</h5>
          <p style="font-size:0.9rem;color:var(--text-muted);">
            With <strong><?php echo $doctor_name; ?></strong><br/>
            Date: <strong id="confirmDate"></strong><br/>
            Time: <strong id="confirmTime"></strong>
          </p>
          <p style="font-size:0.85rem;color:var(--text-muted);">A confirmation will be sent to your email.</p>
        </div>
        <div class="modal-footer">
          <a href="patient-dashboard.php" class="btn-primary-care"><i class="fas fa-tachometer-alt"></i> View Dashboard</a>
          <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
  <script>
    function selectDate(el, dateStr) {
      document.querySelectorAll('.time-slot-btn').forEach(b => {
        if (!b.classList.contains('unavailable') && b.dataset.type === 'date') b.classList.remove('selected');
      });
      el.dataset.type = 'date';
      el.classList.add('selected');
      document.getElementById('summaryDate').textContent = dateStr + ', <?php echo date('Y'); ?>';
    }

    function selectSlot(el) {
      document.querySelectorAll('.time-slot-btn:not(.unavailable)').forEach(b => {
        if (b.dataset.type !== 'date') b.classList.remove('selected');
      });
      el.classList.add('selected');
      document.getElementById('summaryTime').textContent = el.textContent.trim();
    }

    function confirmAppointment() {
      const time = document.getElementById('summaryTime').textContent;
      if (time === 'Select a slot above') {
        alert('Please select a time slot first.');
        return;
      }
      document.getElementById('confirmTime').textContent = time;
      document.getElementById('confirmDate').textContent = document.getElementById('summaryDate').textContent;
      new bootstrap.Modal(document.getElementById('confirmModal')).show();
    }
  </script>

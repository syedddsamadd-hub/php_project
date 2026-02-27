<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment | MedCare Patient Portal</title>
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
    <a href="my_appointments.php" class="sidebar-link"><i class="fas fa-calendar-alt"></i> My Appointments</a>
    <div class="sidebar-section-label">Account</div>
    <a href="profile.php" class="sidebar-link"><i class="fas fa-user"></i> My Profile</a>
    <a href="login.php" class="sidebar-link" style="color:#ef4444;"><i class="fas fa-sign-out-alt"></i> Logout</a>
</aside>

<main class="main-content">
    <div class="page-header">
        <a href="search_doctor.php" style="color:#64748b;font-size:0.85rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;"><i class="fas fa-arrow-left"></i>Back to Search</a>
        <h4><i class="fas fa-calendar-plus text-primary me-2"></i>Book Appointment</h4>
        <p>Schedule your consultation with the doctor</p>
    </div>

    <!-- Doctor Info -->
    <div class="doctor-info-card">
        <div class="doctor-avatar-big">SW</div>
        <div class="doctor-details">
            <h4>Dr. Sarah Williams</h4>
            <span class="spec-badge"><i class="fas fa-heart me-1"></i>Cardiologist</span>
            <div class="doc-meta-row">
                <div class="doc-meta-item"><i class="fas fa-briefcase-medical"></i> 12 Years Exp.</div>
                <div class="doc-meta-item"><i class="fas fa-map-marker-alt"></i> New York</div>
                <div class="doc-meta-item"><i class="fas fa-star"></i> 4.9 (142 reviews)</div>
                <div class="doc-meta-item"><i class="fas fa-dollar-sign"></i> $80 Consultation</div>
            </div>
        </div>
    </div>

    <!-- Availability -->
    <div class="availability-strip">
        <div class="avail-dot"></div>
        <span>Dr. Williams is <strong>available this week</strong> — Select your preferred date and time slot below</span>
    </div>

    <div class="row g-4">
        <!-- Booking Form -->
        <div class="col-12 col-lg-8">
            <div class="card-block">
                <div class="section-heading"><i class="fas fa-calendar me-1"></i> Select Date</div>
                <div class="mb-4">
                    <label class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" name="appt_date" id="apptDate">
                    <div style="font-size:0.8rem;color:#94a3b8;margin-top:5px;"><i class="fas fa-info-circle me-1"></i>Available Mon–Sat. Select a future date.</div>
                </div>

                <div class="section-divider"></div>
                <div class="section-heading"><i class="fas fa-clock me-1"></i> Select Time Slot</div>
                <div class="time-slot-label">Morning Slots</div>
                <div class="slots-grid">
                    <button type="button" class="time-slot">9:00 AM</button>
                    <button type="button" class="time-slot">9:30 AM</button>
                    <button type="button" class="time-slot unavailable">10:00 AM</button>
                    <button type="button" class="time-slot">10:30 AM</button>
                    <button type="button" class="time-slot unavailable">11:00 AM</button>
                    <button type="button" class="time-slot">11:30 AM</button>
                </div>
                <div class="time-slot-label">Afternoon Slots</div>
                <div class="slots-grid">
                    <button type="button" class="time-slot">2:00 PM</button>
                    <button type="button" class="time-slot selected">2:30 PM</button>
                    <button type="button" class="time-slot">3:00 PM</button>
                    <button type="button" class="time-slot unavailable">3:30 PM</button>
                    <button type="button" class="time-slot">4:00 PM</button>
                    <button type="button" class="time-slot">4:30 PM</button>
                </div>

                <div class="d-flex align-items-center gap-16 mt-2 mb-4" style="gap:16px;flex-wrap:wrap;">
                    <span style="font-size:0.78rem;color:#64748b;display:flex;align-items:center;gap:6px;"><span style="width:14px;height:14px;background:#fff;border:1.5px solid #e2e8f0;border-radius:3px;display:inline-block;"></span>Available</span>
                    <span style="font-size:0.78rem;color:#64748b;display:flex;align-items:center;gap:6px;"><span style="width:14px;height:14px;background:#0d6efd;border-radius:3px;display:inline-block;"></span>Selected</span>
                    <span style="font-size:0.78rem;color:#64748b;display:flex;align-items:center;gap:6px;"><span style="width:14px;height:14px;background:#f8faff;border:1.5px solid #f1f5f9;border-radius:3px;display:inline-block;"></span>Unavailable</span>
                </div>

                <div class="section-divider"></div>
                <div class="section-heading"><i class="fas fa-notes-medical me-1"></i> Additional Notes</div>
                <div class="mb-0">
                    <label class="form-label">Reason for Visit (Optional)</label>
                    <textarea class="form-control" name="notes" rows="3" placeholder="Briefly describe your symptoms or reason for visit..."></textarea>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-12 col-lg-4">
            <div class="card-block">
                <div class="section-heading"><i class="fas fa-receipt me-1"></i> Booking Summary</div>
                <div class="summary-box">
                    <div class="summary-row">
                        <span class="label"><i class="fas fa-user-md me-1 text-primary"></i>Doctor</span>
                        <span class="value">Dr. Sarah Williams</span>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fas fa-stethoscope me-1 text-primary"></i>Specialization</span>
                        <span class="value">Cardiologist</span>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fas fa-calendar me-1 text-primary"></i>Date</span>
                        <span class="value" id="selectedDate">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fas fa-clock me-1 text-primary"></i>Time</span>
                        <span class="value" style="color:#10b981;">2:30 PM</span>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fas fa-map-marker-alt me-1 text-primary"></i>Location</span>
                        <span class="value">New York</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span class="label"><i class="fas fa-dollar-sign me-1 text-primary"></i>Consultation Fee</span>
                        <span class="value">$80.00</span>
                    </div>
                </div>

                <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:10px;padding:12px;margin-bottom:20px;font-size:0.82rem;color:#92400e;">
                    <i class="fas fa-info-circle me-1"></i>
                    <strong>Note:</strong> Please arrive 15 minutes early. Bring any previous medical records.
                </div>

                <form action="#" method="POST">
                    <input type="hidden" name="doctor_id" value="1">
                    <input type="hidden" name="time_slot" value="2:30 PM">
                    <button type="submit" class="btn-book-appt"><i class="fas fa-calendar-check me-2"></i>Confirm Appointment</button>
                </form>

                <div style="text-align:center;margin-top:14px;">
                    <a href="search_doctor.php" style="color:#64748b;font-size:0.83rem;font-weight:600;text-decoration:none;"><i class="fas fa-arrow-left me-1"></i>Choose Different Doctor</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Time slot selection
    document.querySelectorAll('.time-slot:not(.unavailable)').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.time-slot').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
    // Update summary date
    document.getElementById('apptDate')?.addEventListener('change', function() {
        const d = new Date(this.value);
        document.getElementById('selectedDate').textContent = d.toLocaleDateString('en-US', {year:'numeric',month:'short',day:'numeric'});
    });
</script>
</body>
</html>

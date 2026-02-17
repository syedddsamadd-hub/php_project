<?php $page_title = 'Home'; include 'includes/head.php'; ?>

<?php include 'includes/navbar.php'; ?>

  <!-- ====== HERO SECTION ====== -->
  <section class="hero-section">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>
    <div class="container position-relative" style="z-index:2; ">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <div class="hero-badge">
            <i class="fas fa-shield-alt"></i> Trusted Healthcare Platform
          </div>
          <h1 class="hero-title">Your Health, Our <span>Priority</span> &amp; Care</h1>
          <p class="hero-desc">Book appointments with top-rated specialists, track your medical history, and access quality healthcare – all in one place.</p>
          <div class="hero-buttons d-flex flex-wrap gap-3">
            <a href="search-doctor.php" class="btn-primary-care">
              <i class="fas fa-search"></i> Find a Doctor
            </a>
            <a href="register.php" class="btn-outline-care">
              <i class="fas fa-user-plus"></i> Get Started
            </a>
          </div>
          <div class="hero-stats">
            <div class="hero-stat">
              <div class="hero-stat-num" data-count="500" data-suffix="+">500+</div>
              <div class="hero-stat-label">Specialists</div>
            </div>
            <div class="hero-stat">
              <div class="hero-stat-num" data-count="50000" data-suffix="+">50K+</div>
              <div class="hero-stat-label">Patients Served</div>
            </div>
            <div class="hero-stat">
              <div class="hero-stat-num" data-count="30" data-suffix="+">30+</div>
              <div class="hero-stat-label">Specializations</div>
            </div>
            <div class="hero-stat">
              <div class="hero-stat-num" data-count="15" data-suffix="">15</div>
              <div class="hero-stat-label">Cities</div>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-6 mt-5 mt-lg-0 hero-visual text-center">
          <div class="hero-img-wrap position-relative d-inline-block">
            <div class="hero-img-placeholder">
              <i class="fas fa-hospital-user"></i>
              <p>Healthcare Professionals</p>
            </div>
            <div class="hero-card-float card-1">
              <div class="hero-card-icon blue"><i class="fas fa-calendar-check"></i></div>
              <div class="hero-card-text">
                <strong>Appointment Booked</strong>
                <span>Dr. Arif – Cardiologist</span>
              </div>
            </div>
            <div class="hero-card-float card-2">
              <div class="hero-card-icon teal"><i class="fas fa-star"></i></div>
              <div class="hero-card-text">
                <strong>4.9 Rating</strong>
                <span>12,000+ Reviews</span>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>

  <!-- ====== HOW IT WORKS ====== -->
  <section class="how-it-works section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge-accent">Simple Process</span>
        <h2 class="section-title">How It Works</h2>
        <p class="section-subtitle mt-2">Book your appointment in just 3 easy steps and get the care you deserve.</p>
      </div>
      <div class="row g-4 align-items-center">
        <div class="col-md-4 animate-on-scroll">
          <div class="step-card">
            <div class="step-number">1</div>
            <i class="fas fa-search step-icon"></i>
            <h5>Search a Doctor</h5>
            <p>Browse our network of verified specialists by city, specialization, or name.</p>
          </div>
        </div>
        <div class="col-md-1 d-none d-md-flex step-connector">
          <i class="fas fa-chevron-right"></i>
        </div>
        <div class="col-md-3 animate-on-scroll" style="transition-delay:0.1s">
          <div class="step-card">
            <div class="step-number">2</div>
            <i class="fas fa-clock step-icon"></i>
            <h5>Select a Time Slot</h5>
            <p>Choose from available time slots that fit your schedule perfectly.</p>
          </div>
        </div>
        <div class="col-md-1 d-none d-md-flex step-connector">
          <i class="fas fa-chevron-right"></i>
        </div>
        <div class="col-md-3 animate-on-scroll" style="transition-delay:0.2s">
          <div class="step-card">
            <div class="step-number">3</div>
            <i class="fas fa-check-circle step-icon"></i>
            <h5>Confirm Appointment</h5>
            <p>Receive instant confirmation and reminders for your appointment.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ====== FEATURED DOCTORS ====== -->
  <?php
  $doctors = [
    ['name'=>'Dr. Sarah Ahmed','spec'=>'Cardiologist','spec_icon'=>'heartbeat','qual'=>'MBBS, FCPS (Cardiology)','exp'=>'12','city'=>'Karachi','fee'=>'2,000','rating'=>'4.9','reviews'=>'120','bg'=>'linear-gradient(135deg,#E3F2FD,#BBDEFB)','color'=>'var(--primary)','avail'=>'Available','avail_style'=>''],
    ['name'=>'Dr. Imran Malik','spec'=>'Neurologist','spec_icon'=>'brain','qual'=>'MBBS, MD (Neurology)','exp'=>'9','city'=>'Lahore','fee'=>'2,500','rating'=>'4.8','reviews'=>'95','bg'=>'linear-gradient(135deg,#E0F7FA,#B2EBF2)','color'=>'var(--accent)','avail'=>'Available','avail_style'=>''],
    ['name'=>'Dr. Fatima Khan','spec'=>'Orthopedic','spec_icon'=>'bone','qual'=>'MBBS, FRCS','exp'=>'15','city'=>'Islamabad','fee'=>'3,000','rating'=>'4.7','reviews'=>'80','bg'=>'linear-gradient(135deg,#FFF3E0,#FFE0B2)','color'=>'#F57F17','avail'=>'Tomorrow','avail_style'=>''],
    ['name'=>'Dr. Ali Hassan','spec'=>'Ophthalmologist','spec_icon'=>'eye','qual'=>'MBBS, DOMS','exp'=>'8','city'=>'Faisalabad','fee'=>'1,800','rating'=>'4.9','reviews'=>'140','bg'=>'linear-gradient(135deg,#EDE7F6,#D1C4E9)','color'=>'#6A1B9A','avail'=>'Busy','avail_style'=>'background:#FFEBEE;color:var(--danger);border-color:rgba(198,40,40,0.2);'],
  ];
  ?>
  <section class="section-padding bg-white">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <div>
          <span class="badge-accent">Top Rated</span>
          <h2 class="section-title mt-1">Featured Doctors</h2>
        </div>
        <a href="search-doctor.php" class="btn-primary-care d-none d-md-flex">View All <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="row g-4">
        <?php foreach ($doctors as $i => $doc): ?>
        <div class="col-md-6 col-lg-3 animate-on-scroll" style="transition-delay:<?php echo $i * 0.1; ?>s">
          <div class="doctor-card">
            <div class="doctor-card-img" style="background:<?php echo $doc['bg']; ?>">
              <i class="fas fa-user-md" style="color:<?php echo $doc['color']; ?>"></i>
              <span class="availability-badge" style="<?php echo $doc['avail_style']; ?>">
                <i class="fas fa-circle" style="font-size:7px;margin-right:4px;"></i><?php echo $doc['avail']; ?>
              </span>
            </div>
            <div class="doctor-card-body">
              <h5><?php echo htmlspecialchars($doc['name']); ?></h5>
              <p class="doctor-spec"><i class="fas fa-<?php echo $doc['spec_icon']; ?> me-1"></i><?php echo htmlspecialchars($doc['spec']); ?></p>
              <p class="doctor-meta"><i class="fas fa-graduation-cap"></i><?php echo htmlspecialchars($doc['qual']); ?></p>
              <p class="doctor-meta"><i class="fas fa-briefcase"></i><?php echo htmlspecialchars($doc['exp']); ?> Years Experience</p>
              <p class="doctor-meta"><i class="fas fa-map-marker-alt"></i><?php echo htmlspecialchars($doc['city']); ?></p>
              <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="doctor-fees-badge"><i class="fas fa-tag me-1"></i>Rs. <?php echo $doc['fee']; ?></span>
                <div><span class="stars">★★★★★</span> <span class="rating-text"><?php echo $doc['rating']; ?></span></div>
              </div>
              <a href="appointment.php?doctor=<?php echo urlencode($doc['name']); ?>" class="btn-primary-care w-100 justify-content-center">
                <i class="fas fa-calendar-plus"></i> Book Now
              </a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-4 d-md-none">
        <a href="search-doctor.php" class="btn-primary-care">View All Doctors <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- ====== SPECIALIZATIONS ====== -->
  <?php
  $specs = [
    ['icon'=>'heartbeat','name'=>'Cardiology','count'=>'24'],
    ['icon'=>'brain','name'=>'Neurology','count'=>'18'],
  ];
  ?>
  <section class="spec-section section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge-accent">Our Expertise</span>
        <h2 class="section-title">Browse Specializations</h2>
        <p class="section-subtitle mt-2">Find specialists across 30+ medical disciplines, ready to help you.</p>
      </div>
      <div class="row g-3">
        <?php foreach ($specs as $i => $spec): ?>
        <div class="col-6 col-md-4 col-lg-2 animate-on-scroll" style="transition-delay:<?php echo $i * 0.05; ?>s">
          <a href="search-doctor.php?spec=<?php echo urlencode($spec['name']); ?>" class="spec-card d-block text-decoration-none">
            <div class="spec-icon"><i class="fas fa-<?php echo $spec['icon']; ?>"></i></div>
            <h6><?php echo htmlspecialchars($spec['name']); ?></h6>
            <span> Doctors</span>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section-padding bg-white">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge-accent">What Patients Say</span>
        <h2 class="section-title">Patient Testimonials</h2>
        <p class="section-subtitle mt-2">Hear from thousands of patients who found the right care through CARE Group.</p>
      </div>
      <!-- <div class="row g-4">
        <div class="col-md-4 animate-on-scroll" style="">
          <div class="testimonial-card">
            <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
          description  <p></p>
            <div class="testimonial-author">
        shuru ke do alfaaz  (avatar) <div class="testimonial-avatar"></div>
              <div>
              name  <strong></strong>
               location <span></span>
               rating <div class="stars mt-1"></div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </section>

  <!-- ====== CTA BANNER ====== -->
  <section class="cta-banner">
    <div class="container text-center position-relative" style="z-index:1;">
      <span class="badge-accent mb-3" style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.3);">Get Started Today</span>
      <h2 class="mb-3">Ready to Take Control of Your Health?</h2>
      <p class="mb-5 mx-auto" style="max-width:500px;">Join over 50,000 patients who have found the right doctor and managed their health with CARE Group.</p>
      <div class="d-flex flex-wrap gap-3 justify-content-center">
        <a href="register.php" class="btn-primary-care" style="background:white;color:var(--primary);box-shadow:0 4px 16px rgba(0,0,0,0.15);">
          <i class="fas fa-user-plus"></i> Create Free Account
        </a>
        <a href="search-doctor.php" class="btn-outline-care">
          <i class="fas fa-search"></i> Browse Doctors
        </a>
      </div>
    </div>
  </section>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

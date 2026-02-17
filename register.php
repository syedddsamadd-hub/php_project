<?php
$page_title = 'Register';

include 'includes/head.php';
?>

  <nav class="navbar navbar-expand-lg navbar-care">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <div class="brand-logo-icon"><i class="fas fa-heartbeat"></i></div>
        <span class="brand-name">CARE <span>Group</span></span>
      </a>
      <div class="d-flex align-items-center gap-2">
        <a href="login.php" class="nav-link btn-nav-login">Login</a>
        <a href="register.php" class="nav-link btn-nav-register">Register</a>
      </div>
    </div>
  </nav>

  <main class="auth-page register-page py-5">
    <div class="container">
      <div class="auth-card mx-auto" style="max-width:680px;">
        <div class="auth-card-header">
          <div class="auth-icon"><i class="fas fa-user-plus"></i></div>
          <h3>Create Your Account</h3>
          <p>Join CARE Group and get access to top medical professionals</p>
        </div>

        <!-- Tabs -->
        <div style="background:var(--off-white);padding:0 32px;border-bottom:1px solid rgba(21,101,192,0.1);">
          <ul class="nav tab-care" id="registerTabs" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" id="patient-tab" data-bs-toggle="tab" data-bs-target="#patientTab" type="button">
                <i class="fas fa-user me-2"></i>Patient
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="doctor-tab" data-bs-toggle="tab" data-bs-target="#doctorTab" type="button">
                <i class="fas fa-user-md me-2"></i>Doctor
              </button>
            </li>
          </ul>
        </div>

        <div class="auth-card-body">
          <div class="tab-content">

            <!-- PATIENT form -->
            <div class="tab-pane fade show active" id="patientTab">
              <form method="POST" action="#" novalidate class="needs-validation">
                <input type="hidden" name="register_type" value="patient" />
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="first_name" placeholder="First Name" required />
                      <label><i class="fas fa-user me-1"></i>First Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="last_name" placeholder="Last Name" required />
                      <label><i class="fas fa-user me-1"></i>Last Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="email" class="form-control" name="email" placeholder="Email" required />
                      <label><i class="fas fa-envelope me-1"></i>Email Address</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="tel" class="form-control" name="phone" placeholder="Phone" required />
                      <label><i class="fas fa-phone me-1"></i>Phone Number</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="date" class="form-control" name="dob" required />
                      <label><i class="fas fa-calendar me-1"></i>Date of Birth</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" name="gender" required>
                        <option value="" disabled selected>Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                      <label><i class="fas fa-venus-mars me-1"></i>Gender</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <select class="form-select" name="city" required>
                        <option value="" disabled selected>Select city</option>
                      </select>
                      <label><i class="fas fa-city me-1"></i>City</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <textarea class="form-control" name="address" placeholder="Address" style="height:80px;" required></textarea>
                      <label><i class="fas fa-map-marker-alt me-1"></i>Full Address</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="password" placeholder="Password" required />
                        <label><i class="fas fa-lock me-1"></i>Password</label>
                      </div>
                      <span class="input-group-text toggle-password"><i class="fas fa-eye-slash"></i></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm" required />
                        <label><i class="fas fa-lock me-1"></i>Confirm Password</label>
                      </div>
                      <span class="input-group-text toggle-password"><i class="fas fa-eye-slash"></i></span>
                    </div>
                  </div>
                  <!-- <a href="#" style="color:var(--primary);">Terms of Service</a> and <a href="#" style="color:var(--primary);">Privacy Policy</a> -->
                  <div class="col-12">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="agreePatient" name="agree" required />
                      <label class="form-check-label" for="agreePatient" style="font-size:0.85rem;color:var(--text-muted);">
                        I agree to the terms and conditions.
                      </label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" name="submit_patient" class="btn-primary-care w-100 justify-content-center" style="padding:14px;">
                      <i class="fas fa-user-plus"></i> Create Patient Account
                    </button>
                  </div>
                </div>
              </form>
            </div>

            <?Php
            
            ?>
            <!-- DOCTOR TAB -->
            <div class="tab-pane fade" id="doctorTab">
              <form method="POST" action="register.php" novalidate class="needs-validation">
                <input type="hidden" name="register_type" value="doctor" />
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="first_name" placeholder="First Name" required />
                      <label>First Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="last_name" placeholder="Last Name" required />
                      <label>Last Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="email" class="form-control" name="email" placeholder="Email" required />
                      <label><i class="fas fa-envelope me-1"></i>Email</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="tel" class="form-control" name="phone" placeholder="Phone" required />
                      <label><i class="fas fa-phone me-1"></i>Phone</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" name="specialization" required>
                        <option value="" disabled selected>Select</option>
                        <?php foreach (['Cardiology','Neurology','Orthopedics','Ophthalmology','Pediatrics','General Surgery','Dentistry','Psychiatry','Dermatology','Pulmonology'] as $s): ?>
                        <option value="<?php echo strtolower($s); ?>"><?php echo $s; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <label><i class="fas fa-stethoscope me-1"></i>Specialization</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="qualification" placeholder="Qualification" required />
                      <label><i class="fas fa-graduation-cap me-1"></i>Qualification</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="number" class="form-control" name="experience" placeholder="Experience" min="0" max="60" required />
                      <label><i class="fas fa-briefcase me-1"></i>Experience (Years)</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="number" class="form-control" name="fees" placeholder="Fees" required />
                      <label><i class="fas fa-rupee-sign me-1"></i>Consultation Fee (Rs.)</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="pmc_number" placeholder="PMC Number" required />
                      <label><i class="fas fa-id-card me-1"></i>PMC Registration No.</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <select class="form-select" name="city" required>
                        <option value="" disabled selected>Select city</option>
                        <?php foreach (['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan'] as $city): ?>
                        <option value="<?php echo strtolower($city); ?>"><?php echo $city; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <label><i class="fas fa-city me-1"></i>City</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <textarea class="form-control" name="clinic_address" placeholder="Address" style="height:80px;"></textarea>
                      <label><i class="fas fa-hospital me-1"></i>Clinic / Hospital Address</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="password" placeholder="Password" required />
                        <label><i class="fas fa-lock me-1"></i>Password</label>
                      </div>
                      <span class="input-group-text toggle-password"><i class="fas fa-eye-slash"></i></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm" required />
                        <label><i class="fas fa-lock me-1"></i>Confirm Password</label>
                      </div>
                      <span class="input-group-text toggle-password"><i class="fas fa-eye-slash"></i></span>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="p-3 rounded" style="background:var(--light-blue);font-size:0.83rem;color:var(--text-muted);">
                      <i class="fas fa-info-circle me-1" style="color:var(--primary);"></i>
                      Doctor registrations are reviewed within 24–48 hours. You'll receive a confirmation email once approved.
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn-accent w-100" style="padding:14px;border-radius:var(--radius-pill);">
                      <i class="fas fa-user-md"></i> Submit Doctor Application
                    </button>
                  </div>
                </div>
              </form>
            </div>

          </div>
          <p class="text-center mt-4" style="font-size:0.88rem;color:var(--text-muted);">
            Already have an account? <a href="login.php" style="color:var(--primary);font-weight:700;">Sign In</a>
          </p>
        </div>
      </div>
    </div>
  </main>

<?php include 'includes/scripts.php'; ?>

<?php
require "../connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | MedCare Patient Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <?Php
 include "sidebar_navbar.php";
 ?>

<main class="main-content">
    <header class="page-header">
        <h4><i class="fas fa-user-circle text-primary me-2"></i>My Profile</h4>
        <p>Manage your personal information and account settings</p>
    </header>

    <!-- Profile Hero -->
    <div class="profile-hero">
        <div class="avatar-wrapper">
            <div class="profile-avatar">JD</div>
            <div class="avatar-edit-btn" title="Change Photo"><i class="fas fa-camera"></i></div>
        </div>
        <div class="profile-hero-info">
            <h3>John Doe</h3>
            <div class="email-badge"><i class="fas fa-envelope me-2"></i>john.doe@email.com</div>
            <div class="profile-badges">
                <span class="profile-badge"><i class="fas fa-id-card"></i> Patient ID: #P-20250001</span>
                <span class="profile-badge"><i class="fas fa-map-marker-alt"></i> New York</span>
                <span class="profile-badge"><i class="fas fa-calendar"></i> Member since Jan 2024</span>
                <span class="profile-badge" style="background:rgba(16,185,129,0.25);"><i class="fas fa-check-circle"></i> Verified</span>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <!-- <div class="profile-tabs">
        <a href="#" class="profile-tab active"><i class="fas fa-user-edit me-2"></i>Edit Profile</a>
        <a href="#" class="profile-tab"><i class="fas fa-lock me-2"></i>Change Password</a>
        <a href="#" class="profile-tab"><i class="fas fa-bell me-2"></i>Notifications</a>
        <a href="#" class="profile-tab"><i class="fas fa-shield-alt me-2"></i>Privacy</a>
    </div> -->

    <div class="row g-4">
        <!-- Edit Form -->
        <div class="col-12 col-lg-8">
            <div class="form-card">
                <div class="form-card-header">
                    <h6><i class="fas fa-user-edit text-primary me-2"></i>Edit Personal Information</h6>
                    <p>Update your personal details and contact information</p>
                </div>
                <div class="form-card-body">
                    <form action="#" method="POST">

                        <div class="section-heading"><i class="fas fa-user me-1"></i> Basic Information</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="name" value="John Doe">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" value="john.doe@email.com" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" name="phone" value="+1 (555) 234-5678">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" name="dob" value="1990-05-15">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    <select class="form-select" name="gender" style="border-left:none;border-radius:0 10px 10px 0;">
                                        <option selected>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Blood Group</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                    <select class="form-select" name="blood_group" style="border-left:none;border-radius:0 10px 10px 0;">
                                        <option>A+</option>
                                        <option selected>B+</option>
                                        <option>O+</option>
                                        <option>AB+</option>
                                        <option>A-</option>
                                        <option>B-</option>
                                        <option>O-</option>
                                        <option>AB-</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="section-heading"><i class="fas fa-map-marker-alt me-1"></i> Address Information</div>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label">Street Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <textarea class="form-control" name="address" rows="2" style="border-left:none;border-radius:0 10px 10px 0;">123 Medical Lane, Apt 4B</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    <select class="form-select" name="city" style="border-left:none;border-radius:0 10px 10px 0;">
                                        <option selected>New York</option>
                                        <option>Los Angeles</option>
                                        <option>Chicago</option>
                                        <option>Houston</option>
                                        <option>Phoenix</option>
                                        <option>Philadelphia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ZIP Code</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    <input type="text" class="form-control" name="zip" value="10001">
                                </div>
                            </div>
                        </div>

                        <div class="section-heading"><i class="fas fa-ambulance me-1"></i> Emergency Contact</div>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Emergency Contact Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                    <input type="text" class="form-control" name="emergency_name" value="Jane Doe">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Emergency Contact Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    <input type="tel" class="form-control" name="emergency_phone" value="+1 (555) 987-6543">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn-update"><i class="fas fa-save me-2"></i>Update Profile</button>
                            <button type="reset" class="btn-cancel2"><i class="fas fa-undo me-1"></i>Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-12 col-lg-4">
            <!-- Account Info -->
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <h6><i class="fas fa-id-badge text-primary me-2"></i>Account Summary</h6>
                </div>
                <div class="form-card-body">
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-hashtag"></i></div>
                        <div><div class="info-label">Patient ID</div><div class="info-value">#P-20250001</div></div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div><div class="info-label">Member Since</div><div class="info-value">January 2024</div></div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-calendar-check"></i></div>
                        <div><div class="info-label">Total Appointments</div><div class="info-value">12 Appointments</div></div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-tint"></i></div>
                        <div><div class="info-label">Blood Group</div><div class="info-value">B+ Positive</div></div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fas fa-check-circle" style="color:#10b981;"></i></div>
                        <div><div class="info-label">Account Status</div><div class="info-value" style="color:#10b981;">Verified & Active</div></div>
                    </div>
                </div>
            </div>

            <!-- Security Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <h6><i class="fas fa-shield-alt text-primary me-2"></i>Security</h6>
                </div>
                <div class="form-card-body">
                    <div style="margin-bottom:16px;">
                        <div style="font-size:0.83rem;font-weight:600;margin-bottom:4px;">Password Strength</div>
                        <div style="background:#f1f5f9;border-radius:6px;height:8px;overflow:hidden;">
                            <div style="width:75%;height:100%;background:linear-gradient(90deg,#10b981,#34d399);border-radius:6px;"></div>
                        </div>
                        <div style="font-size:0.75rem;color:#10b981;margin-top:4px;font-weight:700;">Strong</div>
                    </div>
                    <div style="font-size:0.82rem;color:#64748b;margin-bottom:16px;">
                        Last password changed: <strong>3 months ago</strong>
                    </div>
                    <a href="#" style="background:var(--primary-light);color:var(--primary);border:none;border-radius:8px;padding:10px 16px;font-size:0.83rem;font-weight:700;text-decoration:none;display:block;text-align:center;transition:all 0.2s;" onmouseover="this.style.background='#0d6efd';this.style.color='#fff';" onmouseout="this.style.background='var(--primary-light)';this.style.color='var(--primary)';"><i class="fas fa-key me-2"></i>Change Password</a>
                    <a href="#" style="background:#fff0f0;color:#ef4444;border:none;border-radius:8px;padding:10px 16px;font-size:0.83rem;font-weight:700;text-decoration:none;display:block;text-align:center;margin-top:8px;transition:all 0.2s;" onmouseover="this.style.background='#ef4444';this.style.color='#fff';" onmouseout="this.style.background='#fff0f0';this.style.color='#ef4444';"><i class="fas fa-trash me-2"></i>Delete Account</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

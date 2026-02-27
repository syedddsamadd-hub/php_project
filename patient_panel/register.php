<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration | MedCare Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --primary-light: #e8f0ff;
            --white: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 24px rgba(13,110,253,0.10);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #e8f0ff 0%, #f0f7ff 60%, #dbeafe 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .top-bar {
            background: var(--primary);
            padding: 12px 0;
            text-align: center;
        }
        .top-bar .brand {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .top-bar .brand i { margin-right: 8px; color: #90cdf4; }
        .register-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }
        .register-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 820px;
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #0d6efd 0%, #1e88e5 100%);
            padding: 32px 40px;
            color: #fff;
        }
        .register-header h2 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .register-header p { opacity: 0.85; font-size: 0.93rem; }
        .register-body { padding: 36px 40px 40px; }
        .section-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-light);
        }
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }
        .input-group-text {
            background: var(--primary-light);
            border: 1.5px solid var(--border);
            border-right: none;
            color: var(--primary);
        }
        .form-control, .form-select {
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
            color: var(--text);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-group .form-control { border-left: none; border-radius: 0 8px 8px 0; }
        .input-group .input-group-text { border-radius: 8px 0 0 8px; }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
            outline: none;
        }
        .form-control::placeholder { color: #b0bec5; }
        .gender-group { display: flex; gap: 16px; flex-wrap: wrap; margin-top: 4px; }
        .gender-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.88rem;
            font-weight: 500;
        }
        .gender-option:hover { border-color: var(--primary); background: var(--primary-light); }
        .gender-option input[type="radio"] { accent-color: var(--primary); }
        .btn-register {
            background: linear-gradient(135deg, #0d6efd 0%, #1e88e5 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-size: 1rem;
            font-weight: 700;
            width: 100%;
            margin-top: 8px;
            letter-spacing: 0.3px;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(13,110,253,0.3);
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13,110,253,0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: var(--muted);
        }
        .login-link a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
        @media (max-width: 576px) {
            .register-header { padding: 24px 20px; }
            .register-body { padding: 24px 20px; }
        }
    </style>
</head>
<body>
<div class="top-bar">
    <span class="brand"><i class="fas fa-heartbeat"></i>MedCare Patient Portal</span>
</div>
<div class="register-wrapper">
    <div class="register-card">
        <div class="register-header">
            <h2><i class="fas fa-user-plus me-2"></i>Create Your Account</h2>
            <p>Register to book appointments and manage your healthcare easily</p>
        </div>
        <div class="register-body">
            <form action="#" method="POST">

                <!-- Personal Info -->
                <div class="section-title mb-3"><i class="fas fa-user me-1"></i> Personal Information</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="full_name" placeholder="John Doe" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="john@email.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="tel" class="form-control" name="phone" placeholder="+1 234 567 8900">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" name="dob">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Gender</label>
                        <div class="gender-group">
                            <label class="gender-option">
                                <input type="radio" name="gender" value="male"> <i class="fas fa-mars text-primary"></i> Male
                            </label>
                            <label class="gender-option">
                                <input type="radio" name="gender" value="female"> <i class="fas fa-venus" style="color:#e91e8c"></i> Female
                            </label>
                            <label class="gender-option">
                                <input type="radio" name="gender" value="other"> <i class="fas fa-genderless text-secondary"></i> Other
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="section-title mb-3"><i class="fas fa-map-marker-alt me-1"></i> Location Details</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <textarea class="form-control" name="address" rows="2" placeholder="Street address, apartment, etc."></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-city"></i></span>
                            <select class="form-select" name="city" style="border-left:none;border-radius:0 8px 8px 0;">
                                <option value="">Select City</option>
                                <option>New York</option>
                                <option>Los Angeles</option>
                                <option>Chicago</option>
                                <option>Houston</option>
                                <option>Phoenix</option>
                                <option>Philadelphia</option>
                                <option>San Antonio</option>
                                <option>San Diego</option>
                                <option>Dallas</option>
                                <option>Austin</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Security -->
                <div class="section-title mb-3"><i class="fas fa-lock me-1"></i> Account Security</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Min. 8 characters" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Re-enter password" required>
                        </div>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label" for="terms" style="font-size:0.87rem;color:var(--muted);">
                        I agree to the <a href="#" style="color:var(--primary);font-weight:600;">Terms & Conditions</a> and <a href="#" style="color:var(--primary);font-weight:600;">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn-register"><i class="fas fa-user-plus me-2"></i>Create My Account</button>
            </form>
            <div class="login-link">
                Already have an account? <a href="login.php">Sign In Here</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

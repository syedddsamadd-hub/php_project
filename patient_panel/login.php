<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login | MedCare Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --primary-light: #e8f0ff;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d6efd 0%, #1e88e5 40%, #42a5f5 100%);
            padding: 20px;
        }
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }
        .login-left {
            flex: 1;
            background: linear-gradient(160deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.05) 100%);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            backdrop-filter: blur(10px);
            color: #fff;
        }
        .login-left .brand {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 40px;
        }
        .login-left .brand i { color: #90cdf4; margin-right: 10px; }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }
        .feature-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .feature-text h6 { font-weight: 700; margin: 0 0 2px; font-size: 0.95rem; }
        .feature-text p { margin: 0; opacity: 0.75; font-size: 0.82rem; }
        .login-right {
            flex: 1;
            background: #fff;
            padding: 50px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
        }
        .login-subtitle { color: #64748b; font-size: 0.9rem; margin-bottom: 32px; }
        .form-label { font-size: 0.85rem; font-weight: 600; color: #1e293b; margin-bottom: 6px; }
        .input-group-text {
            background: var(--primary-light);
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: var(--primary);
            border-radius: 10px 0 0 10px;
        }
        .form-control {
            border: 1.5px solid #e2e8f0;
            border-left: none;
            border-radius: 0 10px 10px 0;
            padding: 12px 14px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
        }
        .btn-login {
            background: linear-gradient(135deg, #0d6efd, #1e88e5);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-size: 1rem;
            font-weight: 700;
            width: 100%;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(13,110,253,0.3);
            letter-spacing: 0.3px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13,110,253,0.4);
        }
        .forgot-link { color: var(--primary); font-size: 0.83rem; font-weight: 600; text-decoration: none; }
        .forgot-link:hover { text-decoration: underline; }
        .divider { border-top: 1.5px solid #e2e8f0; margin: 24px 0; }
        .register-cta {
            text-align: center;
            font-size: 0.9rem;
            color: #64748b;
        }
        .register-cta a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .register-cta a:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-right { border-radius: 24px; padding: 36px 24px; }
            .login-wrapper { border-radius: 24px; }
        }
    </style>
</head>
<body>
<div class="login-wrapper">
    <!-- Left Panel -->
    <div class="login-left">
        <div class="brand"><i class="fas fa-heartbeat"></i>MedCare</div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="feature-text">
                <h6>Easy Appointment Booking</h6>
                <p>Schedule visits with top doctors instantly</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-stethoscope"></i></div>
            <div class="feature-text">
                <h6>500+ Specialists</h6>
                <p>Find the right doctor for your needs</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-file-medical"></i></div>
            <div class="feature-text">
                <h6>Health Records</h6>
                <p>Track your medical history securely</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-bell"></i></div>
            <div class="feature-text">
                <h6>Smart Reminders</h6>
                <p>Never miss an appointment again</p>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="login-right">
        <div class="login-title">Welcome Back 👋</div>
        <div class="login-subtitle">Sign in to access your patient dashboard</div>

        <form action="#" method="POST">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember" style="font-size:0.85rem;color:#64748b;">Remember Me</label>
                </div>
                <a href="#" class="forgot-link"><i class="fas fa-key me-1"></i>Forgot Password?</a>
            </div>
            <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i>Sign In to Portal</button>
        </form>

        <div class="divider"></div>

        <div class="register-cta">
            New patient? <a href="register.php">Create an account →</a>
        </div>

        <div style="margin-top:24px;padding:14px;background:#f0f7ff;border-radius:10px;border-left:4px solid var(--primary);">
            <div style="font-size:0.78rem;font-weight:700;color:var(--primary);margin-bottom:4px;text-transform:uppercase;letter-spacing:1px;">Demo Credentials</div>
            <div style="font-size:0.83rem;color:#64748b;">Email: <strong>patient@medcare.com</strong> &nbsp;|&nbsp; Password: <strong>demo123</strong></div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

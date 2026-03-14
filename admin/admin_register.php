<?php
include("../connect.php");
session_start();

if (!isset($_SESSION["admin_email"])) {
    header("Location: dashboard.php");
    exit();
}
// DELETE ADMIN
if (isset($_POST['delete_admin'])) {
    $del_id = intval($_POST['admin_id']);
    
    // Apne aap ko delete hone se rokna
    $current_admin = $connect->query("SELECT admin_id FROM admin WHERE admin_email = '{$_SESSION['admin_email']}'");
    $current_row = $current_admin->fetch_assoc();
    
    if ($del_id == $current_row['admin_id']) {
        $error_admin = "Aap apna khud ka account delete nahi kar sakte!";
    } else {
        $del_stmt = $connect->prepare("DELETE FROM admin WHERE admin_id = ?");
        $del_stmt->bind_param("i", $del_id);
        if ($del_stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_admin = "Delete failed.";
        }
    }
}
$error_admin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $admin_name = trim($_POST['name'] ?? '');
    $admin_email = trim($_POST['email'] ?? '');
    $admin_password = trim($_POST['password'] ?? '');
    $admin_confirmPassword = trim($_POST['confirmPassword'] ?? '');

    if (empty($admin_name)) {
        $error_admin = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}$/", $admin_name)) {
        $error_admin = "Name must be 3-30 letters only.";
    } elseif (empty($admin_email)) {
        $error_admin = "Email is required.";
    } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        $error_admin = "Invalid email format.";
    } elseif (empty($admin_password)) {
        $error_admin = "Password is required.";
    } elseif (strlen($admin_password) < 6) {
        $error_admin = "Password must be at least 6 characters.";
    } elseif ($admin_password !== $admin_confirmPassword) {
        $error_admin = "Passwords do not match.";
    } else {
        $stmt = $connect->prepare("SELECT admin_id FROM admin WHERE admin_email = ?");
        $stmt->bind_param("s", $admin_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_admin = "Email already registered.";
        } else {
            $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
            $insert = $connect->prepare("INSERT INTO admin (admin_name, admin_email, admin_password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $admin_name, $admin_email, $hashed_password);

            if ($insert->execute()) {
                $_SESSION['admin_email'] = $admin_email;
                header("Location: dashboard.php");
                exit();
            } else {
                $error_admin = "Something went wrong.";
            }
        }
    }
}
$pageTitle = 'Admin register';
include('includes/header.php');
include('includes/sidebar.php');
// Admins fetched inline in table below
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --blue-deep: #0a3d8f;
            --blue-mid: #1565c0;
            --blue-bright: #1e88e5;
            --blue-light: #e3f0ff;
            --blue-pale: #f0f7ff;
            --white: #ffffff;
            --text-dark: #0d1b3e;
            --text-muted: #5c7a9e;
            --border: #c8dff8;
            --shadow: 0 8px 32px rgba(13, 101, 253, 0.13);
            --shadow-deep: 0 16px 48px rgba(10, 61, 143, 0.18);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            padding: 40px 0;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative background circles */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            opacity: 0.10;
            pointer-events: none;
        }

        body::before {
            width: 520px;
            height: 520px;
            background: #fff;
            top: -140px;
            left: -140px;
        }

        body::after {
            width: 380px;
            height: 380px;
            background: #fff;
            bottom: -100px;
            right: -100px;
        }

        .page-wrapper {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* ── REGISTER CARD ── */
        .register-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-deep);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .card-header-custom {
            background: linear-gradient(90deg, var(--blue-deep), var(--blue-bright));
            padding: 26px 32px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            border: 1.5px solid rgba(255, 255, 255, 0.25);
        }

        .header-text h2 {
            color: var(--white);
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            margin-bottom: 2px;
        }

        .header-text p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.78rem;
            font-weight: 500;
        }

        .card-body-custom {
            padding: 30px 32px;
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #fecaca;
            color: #c0392b;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 7px;
            letter-spacing: 0.01em;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            opacity: 0.45;
            pointer-events: none;
        }

        .form-control-custom {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.88rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background: var(--blue-pale);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-control-custom::placeholder {
            color: #aac1de;
        }

        .form-control-custom:focus {
            border-color: var(--blue-bright);
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
            background: var(--white);
        }

        .btn-register {
            width: 100%;
            padding: 13px;
            background: linear-gradient(90deg, var(--blue-deep), var(--blue-bright));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.92rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            letter-spacing: 0.02em;
            box-shadow: 0 4px 18px rgba(21, 101, 192, 0.35);
            margin-top: 6px;
        }

        .btn-register:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(21, 101, 192, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 0.83rem;
            color: var(--text-muted);
        }

        .login-link a {
            color: var(--blue-bright);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* ── ADMINS LIST CARD ── */
        .admins-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .admins-card-header {
            background: linear-gradient(90deg, var(--blue-pale), #dbeeff);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1.5px solid var(--border);
        }

        .admins-card-header h3 {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--blue-deep);
            flex: 1;
        }

        .badge-count {
            background: var(--blue-bright);
            color: white;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.03em;
        }

        .admins-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admins-table thead tr {
            background: var(--blue-pale);
        }

        .admins-table th {
            padding: 11px 20px;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--blue-deep);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border-bottom: 1.5px solid var(--border);
            text-align: left;
        }

        .admins-table td {
            padding: 13px 20px;
            font-size: 0.84rem;
            color: var(--text-dark);
            border-bottom: 1px solid #edf4ff;
            vertical-align: middle;
        }

        .admins-table tbody tr:last-child td {
            border-bottom: none;
        }

        .admins-table tbody tr {
            transition: background 0.15s;
        }

        .admins-table tbody tr:hover {
            background: var(--blue-pale);
        }

        .admin-id-badge {
            display: inline-block;
            background: var(--blue-light);
            color: var(--blue-deep);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 6px;
            letter-spacing: 0.04em;
        }

        .admin-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-mid), var(--blue-bright));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            margin-right: 9px;
            flex-shrink: 0;
            vertical-align: middle;
        }

        .name-cell {
            display: flex;
            align-items: center;
        }

        .email-text {
            color: var(--text-muted);
            font-size: 0.81rem;
        }

        .no-admins {
            text-align: center;
            padding: 30px;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="page-wrapper">

                    <!-- ── REGISTER FORM CARD ── -->
                    <div class="register-card">
                        <div class="card-header-custom">
                            <div class="header-icon">🏥</div>
                            <div class="header-text">
                                <h2>Admin Registration</h2>
                                <p>Medical Management System</p>
                            </div>
                        </div>

                        <div class="card-body-custom">

                            <?php if (!empty($error_admin)): ?>
                                <div class="alert-error">
                                    ⚠️ <?= htmlspecialchars($error_admin) ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST">

                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">👤</span>
                                        <input type="text" name="name" class="form-control-custom"
                                            placeholder="Enter full name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">✉️</span>
                                        <input type="email" name="email" class="form-control-custom"
                                            placeholder="Enter email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">🔒</span>
                                        <input type="password" name="password" class="form-control-custom"
                                            placeholder="Enter password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">🔑</span>
                                        <input type="password" name="confirmPassword" class="form-control-custom"
                                            placeholder="Confirm password" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn-register">Register Admin →</button>

                                <div class="login-link">
                                    Already have an account? <a href="login.php">Login here</a>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- ── ADMINS LIST TABLE (cities-style) ── -->
                    <div class="section-card page-fade-in stagger-2">
                        <div class="section-card-header">
                            <h5>
                                <i class="bi bi-people-fill"></i> Admins List
                                <span class="info-chip ms-2">
                                    <?php
                                    $result_count = $connect->query("SELECT COUNT(*) AS total FROM admin");
                                    $row_count = $result_count->fetch_assoc();
                                    echo $row_count['total'];
                                    ?>
                                </span>
                            </h5>
                        </div>
                        <div class="section-card-body table-responsive-custom">
                            <table class="admin-table table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_admin = "SELECT * FROM admin";
                                    $select_admin_query = mysqli_query($connect, $select_admin);
                                    if (mysqli_num_rows($select_admin_query) > 0):
                                        while ($admin_row = mysqli_fetch_assoc($select_admin_query)):
                                            $a_id = $admin_row['admin_id'];
                                            $a_name = $admin_row['admin_name'];
                                            $a_email = $admin_row['admin_email'];
                                            ?>
                                            <tr>
                                                <form method="POST" action="">
                                                    <input type="hidden" name="admin_id" value="<?= $a_id ?>">

                                                    <td class="fw-600 text-primary-custom">#<?= $a_id ?></td>

                                                    <td>
                                                        <div class="user-cell">
                                                            <div class="user-avatar av1"
                                                                style="border-radius:9px;background:linear-gradient(135deg,#0d6efd,#6610f2);">
                                                                <i class="bi bi-person-fill" style="font-size:14px;"></i>
                                                            </div>
                                                            <span class="user-name"><?= htmlspecialchars($a_name) ?></span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <?= htmlspecialchars($a_email) ?>
                                                    </td>
                                                    <td>
                                                        <form method="POST"
                                                            onsubmit="return confirm('Kya aap sure hain delete karna chahte hain?')">
                                                            <input type="hidden" name="admin_id" value="<?= $a_id ?>">
                                                            <button type="submit" name="delete_admin"
                                                                class="btn btn-sm btn-danger">
                                                                🗑️ Delete
                                                            </button>
                                                        </form>
                                                    </td>

                                                </form>
                                            </tr>
                                            <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div><!-- end page-wrapper -->
            </div><!-- end col-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <?php
    include('includes/script.php');
    ?>
</body>

</html>
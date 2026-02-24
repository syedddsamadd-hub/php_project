<?php
session_start();
if (!isset($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}
include "..//connect.php";

//delete city row
if (isset($_POST["btn-delete-doc"])) {
    $get_doctor_id = $_POST['doctor_id'];
    $delete_doctor = "delete  from doctors where doctor_id='$get_doctor_id'";
    mysqli_query($connect, $delete_doctor);
    header("location:doctors.php");
} else {
    echo "";
}
//edit city row 
if (isset($_POST['btn-edit-doc'])) {

    $doctor_id = intval($_POST['doctor_id']);

    $first_name = mysqli_real_escape_string($connect, trim($_POST['doctor_name_update']));
    $email = mysqli_real_escape_string($connect, trim($_POST['doctor_email_update']));
    $phone = intval($_POST['doctor_phone_update']);
    $experience = intval($_POST['doctor_experience']);
    $status = intval($_POST['doctor_status_update']);
    $city_id = intval($_POST['city_id_update']);
    $specialize_id = intval($_POST['specialize_id_update']);

    if (empty($first_name) || empty($email)) {
        echo "Name and Email required.";
        exit;
    }

    $update_query = "UPDATE doctors SET
        first_name = '$first_name',
        email = '$email',
        phone = $phone,
        experience = $experience,
        doctor_status = $status,
        city_id = $city_id,
        specialize_id = $specialize_id
        WHERE doctor_id = $doctor_id";

    if (mysqli_query($connect, $update_query)) {
        header("Location: doctors.php");
        // exit;
    } else {
        echo "Update failed: " . mysqli_error($connect);
    }
}
$pageTitle = 'Manage Doctors';
include('includes/header.php');
include('includes/sidebar.php');
?>
<!-- ╔══════════════════════════════════════════════════════╗
     ║  MANAGE DOCTORS PAGE                                 ║
     ╚══════════════════════════════════════════════════════╝ -->
<div class="page-wrapper">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="bi bi-person-badge-fill me-2 text-primary"></i>Manage Doctors</h4>
            <ul class="breadcrumb-custom">
                <li><a href="dashboard.php">Home</a></li>
                <li>Manage Doctors</li>
            </ul>
        </div>
        <button class="btn-primary-custom" id="addNewBtn" data-bs-toggle="modal" data-bs-target="#doctorModal">
            <i class="bi bi-plus-lg"></i><a href="#form_id" class="btn text-decoration-none text-light btn-sm"> Add New
                Doctor </a>
        </button>
    </div>

    <!-- Search & Filter Bar -->
    <div class="search-filter-bar page-fade-in">
        <div class="search-input-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="tableSearch" placeholder="Search doctors by name, email, city…" />
        </div>
        <select class="filter-select">
            <option value="">All Cities</option>
            <option>Karachi</option>
            <option>Lahore</option>
            <option>Islamabad</option>
            <option>Rawalpindi</option>
            <option>Faisalabad</option>
            <option>Multan</option>
        </select>
        <select class="filter-select">
            <option value="">All Specializations</option>
            <option>Cardiologist</option>
            <option>Neurologist</option>
            <option>Pediatrician</option>
            <option>Orthopedic</option>
            <option>Dermatologist</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Active</option>
            <option>Inactive</option>
        </select>
    </div>

    <!-- Doctors Table Card -->
    <div class="section-card page-fade-in stagger-2">
        <div class="section-card-header">
            <h5><i class="bi bi-table"></i> Doctors List
                <span class="info-chip ms-2">
                    <?php
                    $result_doctor = $connect->query("SELECT COUNT(*) AS total FROM doctors");
                    $row_doctor = $result_doctor->fetch_assoc();
                    $total_doctor = $row_doctor['total'];
                    echo $total_doctor;
                    ?>
                </span>
            </h5>
            <div class="d-flex gap-2">
                <button class="btn-outline-custom" onclick="showToast('success','Exported','Doctors list exported.')">
                    <i class="bi bi-file-earmark-excel"></i> Export
                </button>
            </div>
        </div>
        <div class="section-card-body table-responsive-custom">
            <table class="admin-table table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doctor</th>
                        <th>email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Specialization</th>
                        <th>Experience</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    ?>
                    <?php
                    $select_doctors = "select * from doctors";
                    $select_doctors_query = mysqli_query($connect, $select_doctors);
                    if (mysqli_num_rows($select_doctors_query) > 0) {
                        while ($doctors_table_row = mysqli_fetch_assoc($select_doctors_query)) {
                            $doctor_id = $doctors_table_row["doctor_id"];
                            $first_name = $doctors_table_row["first_name"];
                            $last_name = $doctors_table_row["last_name"];
                            $doctor_email = $doctors_table_row["email"];
                            $doctor_phone = $doctors_table_row["phone"];
                            $doctor_experience = $doctors_table_row["experience"];
                            $doctor_status = $doctors_table_row["doctor_status"];
                            $doctor_city_id = $doctors_table_row["city_id"];
                            $specialize_id = $doctors_table_row["specialize_id"];

                            $select_city = "select * from cities where city_id='$doctor_city_id'";
                            $select_city_query = mysqli_query($connect, $select_city);
                            if (mysqli_num_rows($select_city_query) > 0) {
                                while ($city_table_row = mysqli_fetch_assoc($select_city_query)) {
                                    $city_name = $city_table_row["city_name"];

                                    $select_specialization = "select * from specialization where specialize_id='$specialize_id'";
                                    $select_specialize_query = mysqli_query($connect, $select_specialization);
                                    if (mysqli_num_rows($select_specialize_query) > 0) {
                                        while ($specialize_table_row = mysqli_fetch_assoc($select_specialize_query)) {
                                            $specialize = $specialize_table_row["specialize"];
                                            ?>
                                            <tr>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="doctor_id" value="<?= $doctor_id ?>">
                                                    <td class="fw-600 text-primary-custom"><?= $doctor_id ?></td>
                                                    <td>
                                                        <div class="user-cell">
                                                            <!-- <div class="user-avatar"> $d[1] </div> -->
                                                            <div>
                                                                <b class="user-name"><input type="text" name="doctor_name_update"
                                                                        class="form-control" value="<?= $first_name ?>"></b>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="doctor_email_update"
                                                            value="<?= $doctor_email ?>"></td>
                                                    <td><input type="text" class="form-control" name="doctor_phone_update"
                                                            value="<?= $doctor_phone ?>"></td>
                                                    <td><select name="city_id_update" class="form-control">
                                                            <?php
                                                            $city_query = mysqli_query($connect, "SELECT city_id, city_name FROM cities");
                                                            while ($city = mysqli_fetch_assoc($city_query)) {
                                                                $selected = ($city['city_id'] == $doctor_city_id) ? "selected" : "";
                                                                echo "<option value='{$city['city_id']}' $selected>{$city['city_name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><select name="specialize_id_update" class="form-control">
                                                            <?php
                                                            $sp_query = mysqli_query($connect, "SELECT specialize_id, specialize FROM specialization");
                                                            while ($sp = mysqli_fetch_assoc($sp_query)) {
                                                                $selected = ($sp['specialize_id'] == $specialize_id) ? "selected" : "";
                                                                echo "<option value='{$sp['specialize_id']}' $selected>{$sp['specialize']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="doctor_experience"
                                                            value="<?= $doctor_experience ?>"></td>
                                                    <td><span class="badge-status"><input type="text" class="form-control"
                                                                name="doctor_status_update" value="<?= $doctor_status ?>"></span></td>
                                                    <td>
                                                        <div class="d-flex gap-1 flex-wrap">
                                                            <button class="btn-action btn-edit" name="btn-edit-doc">
                                                                <i class="bi bi-pencil-fill"></i> Edit
                                                            </button>
                                                            <button onclick="return confirm('are you sure to delete this this row.')"
                                                                class="btn-action btn-delete btn-delete-row" name="btn-delete-doc">
                                                                <i class="bi bi-trash-fill"></i> Del
                                                            </button>
                                                        </div>
                                                    </td>
                                                </form>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination (UI only) -->
        <!-- <div class="d-flex align-items-center justify-content-between px-4 py-3 border-top">
            <p class="mb-0" style="font-size:13px;color:#7f8fa6;">Showing 1–8 of 187 records</p>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">…</a></li>
                    <li class="page-item"><a class="page-link" href="#">24</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </nav>
        </div> -->
    </div>

</div>
<!-- END PAGE -->

<!-- ╔══════════════════════════════════════════════════════╗
     ║  ADD / EDIT DOCTOR MODAL                             ║
     ╚══════════════════════════════════════════════════════╝ -->

<!-- <div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="doctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> -->
<form id="form_id" action="" style="height: auto;" class="m-5 alert alert-primary" method="POST"
    enctype="multipart/form-data">
    <div class="d-flex justify-content-center">
        <h2 class="modal-title">
            <i class="bi bi-person-plus-fill me-2"></i>Add New Doctor
        </h2>
    </div>
    <!-- 
    <div class=""> -->
    <div class="row g-3">

        <!-- First Name -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>First Name *</label>
                <input type="text" class="form-control-custom" name="first_name" placeholder="First Name">
            </div>
        </div>
        <!-- Last Name -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Last Name *</label>
                <input type="text" name="last_name" class="form-control-custom" placeholder="Dr. last Name">
            </div>
        </div>

        <!-- Email -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Email Address *</label>
                <input type="text" name="email" class="form-control-custom" placeholder="Dr. Email Address">
            </div>
        </div>

        <!-- Phone -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Phone Number</label>
                <input type="number" name="phone_number" pattern="03[0-9]{9}" class="form-control-custom"
                    placeholder="03XXXXXXXXX" maxlength="11">
            </div>
        </div>

        <!-- Experience -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Years of Experience</label>
                <input type="number" name="experience" class="form-control-custom" placeholder="Experience">
            </div>
        </div>

        <!-- Fee -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Rs consulation fee(Rs)</label>
                <input type="number" name="fees" class="form-control-custom" placeholder="fees" min="200"
                    maxlength="5000">
            </div>
        </div>

        <!-- City -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>City *</label>
                <select name="cities" class="form-control-custom filter-select" style="width:100%;border-radius:9px;">
                    <option value="">Select City</option>
                    <?php
                    $city_query = mysqli_query($connect, "SELECT city_id, city_name FROM cities");
                    while ($row1 = mysqli_fetch_assoc($city_query)) {
                        echo "<option value='" . $row1['city_id'] . "'>" . $row1['city_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Specialization -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Specialization *</label>
                <select name="specialization" class="form-control-custom filter-select"
                    style="width:100%;border-radius:9px;">
                    <option value="">Select Specialization</option>
                    <?php
                    $specialize_query = mysqli_query($connect, "SELECT specialize_id, specialize FROM specialization");
                    while ($row2 = mysqli_fetch_assoc($specialize_query)) {
                        echo "<option value='" . $row2['specialize_id'] . "'>" . $row2['specialize'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Profile Photo -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Profile Photo</label>
                <input type="file" name="profile_photo" class="form-control-custom form-control" accept="image/*"
                    style="padding:7px 14px;">
            </div>
        </div>

        <!-- Status -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Qualification</label>
                <input type="text" class="form-control-custom" max="100" name="qualification"
                    placeholder="MBBS,FBCS etc.">
            </div>
        </div>

        <!-- Bio -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Short Bio</label>
                <textarea name="doctor_bio" class="form-control-custom" rows="3" minlength="" maxlength="500"
                    placeholder="Brief professional description…" style="resize:vertical;"></textarea>
            </div>
        </div>

        <!-- Address -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>Addres</label>
                <textarea name="doctor_address" minlength="10" maxlength="300" class="form-control-custom" rows="3"
                    placeholder="Addres" style="resize:vertical;"></textarea>
            </div>
        </div>
        <!-- password -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>password</label>
                <textarea name="password" class="form-control-custom" rows="3" minlength="" maxlength="500"
                    placeholder="password" style="resize:vertical;"></textarea>
            </div>
        </div>

        <!-- confirm password -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="form-group-custom">
                <label>confirm password</label>
                <textarea name="confirmPassword" minlength="10" maxlength="300" class="form-control-custom" rows="3"
                    placeholder="Addres" style="resize:vertical;"></textarea>
            </div>
        </div>

    </div>
    <!-- </div> -->

    <button type="submit" name="add_doc_btn"
        class="btn text-capitalize bg-primary text-light btn-lg d-block mx-auto w-75">
        add doctor
    </button>
    <?php
    $error_message = addDoctor();

    if (!empty($error_message)) {
        echo "<h6 style='color:red;' class='text-center text-capitalize my-2'>$error_message</h6>";
    }

    ?>
</form>
<?php
function addDoctor()
{

    // global $emails;
    $error_message = '';
    global $connect;
    $select_doctor = "SELECT email,phone FROM doctors";
    $select_check = mysqli_query($connect, $select_doctor);
    $emails = [];
    $phones_check = [];

    while ($row_checking = mysqli_fetch_assoc($select_check)) {
        $emails[] = $row_checking['email'];
        $phones_check[] = $row_checking["phone"];
    }
    if (isset($_POST['add_doc_btn'])) {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $doctor_email = trim($_POST['email']);
        $phone_number = trim($_POST['phone_number']);
        $experience = trim($_POST['experience']);
        $qualification = trim($_POST['qualification']);
        $doctor_fees = trim($_POST['fees']);
        $doctor_city = $_POST['cities'];
        $doctor_specialization = trim($_POST['specialization']);
        $profile_photo = $_FILES['profile_photo']['name'];
        $tmp_name = $_FILES['profile_photo']['tmp_name'];
        $doctor_bio = trim($_POST['doctor_bio']);
        $doctor_address = trim($_POST['doctor_address']);
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        $max_size = 2 * 1024 * 1024; // 2MB

        $src = "src/" . $profile_photo;

        move_uploaded_file($tmp_name, $src);

        if (empty($first_name)) {
            $error_message = "Enter your first name.";
        } elseif (!preg_match("/^[a-zA-Z\s]{2,20}$/", $first_name)) {
            $error_message = "First name must contain only letters and be 2 to 20 characters.";
        } elseif (empty($last_name)) {
            $error_message = "Enter your last name.";
        } elseif (!preg_match("/^[a-zA-Z\s]{2,20}$/", $last_name)) {
            $error_message = "Last name must contain only letters and be 2 to 20 characters.";
        } elseif (empty($doctor_email)) {
            $error_message = "enter your email.";
        } elseif (
            !empty($doctor_email) &&
            !preg_match("/@gmail\.com$/", $doctor_email) &&
            !preg_match("/@aptechsite\.net$/", $doctor_email) &&
            !preg_match("/@yahoo\.com$/", $doctor_email)
        ) {
            $error_message = "Enter email in ( @gmail.com OR @aptechsite.net OR yahoo.com ).";
        } elseif (in_array($doctor_email, $emails)) {
            $error_message = "Your email is already there. Try a different email.";
        } elseif (empty($phone_number)) {
            $error_message = "enter your phone number.";
        } elseif (!empty($phone_number) && !preg_match("/^03[0-9]{9}$/", $phone_number)) {
            $error_message = "Invalid Phone Number";
        } elseif (in_array($phone_number, $phones_check)) {
            $error_message = "Your phone number is already there. Try a different number.";
        } elseif (empty($experience)) {
            $error_message = "Enter your experiecnce.";
        } elseif (!is_numeric($experience) || $experience < 1 || $experience > 60) {
            $error_message = "experience allowed between 0 to 60";
        } elseif (empty($doctor_fees)) {
            $error_message = "Enter your fees.";
        } elseif (!is_numeric($doctor_fees) || $doctor_fees < 200 || $doctor_fees > 5000) {
            $error_message = "enter valid fee between 200 to 5000";
        } elseif (empty($doctor_city)) {
            $error_message = "Enter your City.";
        } elseif (empty($doctor_specialization)) {
            $error_message = "Enter specialization.";
        } elseif (empty($profile_photo)) {
            $error_message = "choose profile pic";
        } elseif (empty($qualification)) {
            $error_message = "Qualification is required";
        } elseif (strlen($qualification) > 100) {
            $error_message = "Qualification length is too long";
        } elseif (!preg_match("/^[a-zA-Z0-9\s,.-]+$/", $qualification)) {
            $error_message = "Qualification contains invalid characters";
        } elseif (empty($doctor_bio)) {
            $error_message = "enter your bio.";
        } elseif (strlen($doctor_bio) > 500) {
            $error_message = "Bio too long";
        } elseif (empty($doctor_address)) {
            $error_message = "enter your address.";
        } elseif (strlen($doctor_address) < 10 || strlen($doctor_address) > 300) {
            $error_message = "Address must be between 10 and 300 characters";
        } elseif ($_FILES['profile_photo']['size'] > $max_size) {
            $error_message = "File too large";
        } elseif (!in_array($_FILES['profile_photo']['type'], $allowed_types)) {
            $error_message = "Invalid Image Type";
        } else {
            $insert_doctor = "INSERT INTO doctors 
(first_name,last_name,email,phone,address,
qualification,experience,consultation_fee,
city_id,specialize_id,doctor_image)
VALUES
('$first_name','$last_name','$doctor_email',$phone_number,'$doctor_address',
'$qualification',$experience,$doctor_fees,
$doctor_city,$doctor_specialization,'$profile_photo')";

            $insert_doctor_query = mysqli_query($connect, $insert_doctor);
            $error_message = "doctor added sucessfully";
        }
    } else {
        echo "<h6 class='text-center my-2 text-capitalize'>all fields are mandatory to filed</h6>";
    }

    return $error_message;
}

?>
<?php include('includes/footer.php'); ?>
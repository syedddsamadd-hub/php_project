<?php
/**
 * news.php — Manage News Page
 * Healthcare Admin Panel — UI Only
 */
include "..//connect.php";

// DELETE
if (isset($_POST["btn-delete-article"])) {

    $delete_id = intval($_POST['article_id']);

    // get image first
    $get_img = mysqli_query($connect,"SELECT article_img FROM news WHERE article_id=$delete_id");
    $img_row = mysqli_fetch_assoc($get_img);

    if($img_row){
        $img_path = "uploads/".$img_row['article_img'];
        if(file_exists($img_path)){
            unlink($img_path);
        }
    }

    mysqli_query($connect,"DELETE FROM news WHERE article_id=$delete_id");
    header("location:news.php");
    exit;
}


// UPDATE
if (isset($_POST['btn-edit-article'])) {

    $article_id  = intval($_POST['article_id']);
    $title       = mysqli_real_escape_string($connect, trim($_POST['article_title_update']));
    $description = mysqli_real_escape_string($connect, trim($_POST['article_description_update']));
    $detail      = mysqli_real_escape_string($connect, trim($_POST['article_detail_update']));
    $badge       = mysqli_real_escape_string($connect, trim($_POST['article_badge_update']));

    if (empty($title) || empty($description) || empty($detail) || empty($badge)) {
        echo "All fields are required.";
        exit;
    }

    $update_query = "UPDATE news SET
        article_title = '$title',
        article_description = '$description',
        article_detail_description = '$detail',
        article_badge = '$badge'
        WHERE article_id = $article_id";

    mysqli_query($connect,$update_query);
    header("Location: news.php");
    exit;
}


session_start();
if (!isset($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}
$pageTitle = 'Manage News';
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="page-wrapper">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h4><i class="bi bi-newspaper me-2 text-primary"></i>Manage News</h4>
            <ul class="breadcrumb-custom">
                <li><a href="dashboard.php">Home</a></li>
                <li>Manage News</li>
            </ul>
        </div>
         <button class="btn-primary-custom" id="addNewBtn">
            <i class="bi bi-plus-lg"></i><a href="#news_id" class="btn text-decoration-none text-light btn-sm"> Add New
                Doctor </a>
        </button>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter-bar page-fade-in">
        <div class="search-input-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="tableSearch" placeholder="Search news by title or author…" />
        </div>
        <select class="filter-select">
            <option value="">All Categories</option>
            <option>General Health</option><option>Medical Research</option>
            <option>Hospital News</option><option>Events</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Published</option><option>Draft</option><option>Archived</option>
        </select>
    </div>

<!-- News Cards -->
<div class="section-card page-fade-in stagger-2">
    <div class="section-card-header">
        <h5><i class="bi bi-newspaper"></i> News Posts</h5>
        <h6 class="text-capitalize">total news <?php
              $result_news = $connect->query("SELECT COUNT(*) AS total FROM news");
              $row_news = $result_news->fetch_assoc();
              $total_news = $row_news['total'];
              echo $total_news;
              ?></h6>
    </div>

    <div class="section-card-body">
        <div class="container-fluid">
            <div class="row justify-content-center">

<?php
$select_news = "SELECT * FROM news ORDER BY article_id DESC";
$select_news_query = mysqli_query($connect, $select_news);

while ($row = mysqli_fetch_assoc($select_news_query)) {

    $article_id     = $row["article_id"];
    $title          = $row["article_title"];
    $desc           = $row["article_description"];
    $detail         = $row["article_detail_description"];
    $badge          = $row["article_badge"];
    $date           = $row["article_date"];
    $img            = $row["article_img"];
    $article_status = $row["articles_status"];
?>

<div class="col-10 my-4">
    <div class="card shadow-sm p-4">

        <form method="POST">

            <input type="hidden" name="article_id" value="<?= $article_id ?>">

            <div class="row">

                <!-- Image -->
                <div class="col-md-3 h-100">

    <img src="src/<?= $img ?>"
         class="img-fluid rounded mb-2"
         style="height: 300px; width:100%; align-items: center; trans">
<!-- 
    <label class="btn btn-outline-primary btn-sm w-100">
        Change Image
        <input type="file" name="article_img_update" hidden>
    </label> -->
</div>
                
                <!-- Content -->
                <div class="col-md-9">
                    <div class="mb-2">
                        <label class="fw-bold form-label">Title</label>
                        <input type="text" name="article_title_update"
                               value="<?= $title ?>"
                               class="form-control">
                    </div>

                    <div class="mb-2">
                        <label class="fw-bold">Description</label>
                        <textarea name="article_description_update"
                                  class="form-control"
                                  rows="2"><?= $desc ?></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="fw-bold">Detail Description</label>
                        <textarea name="article_detail_update"
                                  class="form-control"
                                  rows="3"><?= $detail ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="fw-bold">Badge</label>
                            <input type="text" name="article_badge_update"
                                   value="<?= $badge ?>"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="fw-bold">Date</label>
                            <input type="date"
                                   value="<?= $date ?>"
                                   class="form-control"
                                   readonly>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label class="fw-bold">Status</label>
                            <input type="text"
                                   value="<?= $article_status ?>"
                                   class="form-control"
                                   readonly>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button class="btn btn-primary"
                                name="btn-edit-article">
                            Update
                        </button>

                        <button class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this post?')"
                                name="btn-delete-article">
                            Delete
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
<?php } ?>
            </div>
        </div>
    </div>
</div>

<div id="news_id" class="conteiner-fluid">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary p-5 m-3">
                <h2>Article Information Form</h2>

                <form method="POST" id="diseaseForm" action="" enctype="multipart/form-data">

                    <!-- Image -->
                    <div class="form-group">
                        <label>Article Image</label>
                        <input type="file" name="article_img" class="form-control">
                    </div>

                    <!-- Title -->
                    <div class="form-group">
                        <label>Article Title</label>
                        <input type="text" name="article_title" class="form-control"
                            placeholder="Enter article title">
                    </div>

                    <!-- Short Description -->
                    <div class="form-group">
                        <label>Article Description</label>
                        <textarea name="article_description" class="form-control" rows="3"
                            placeholder="Enter short description"></textarea>
                    </div>

                    <!-- Detail Description -->
                    <div class="form-group">
                        <label>Article Detail Description</label>
                        <textarea name="article_detail_description" class="form-control" rows="4"
                            placeholder="Enter detailed description"></textarea>
                    </div>

                    <!-- Badge -->
                    <div class="form-group">
                        <label>Article Badge</label>
                        <input type="text" name="article_badge" class="form-control"
                            placeholder="Enter badge name">
                    </div>

                    <button type="submit" name="submit"
                        class="btn btn-primary d-block btn-lg mx-auto w-75 mt-5">
                        Submit
                    </button>

                    <?php
                    $error = addArticle();

                    if (!empty($error)) {
                        echo "<h6 style='color:red;' class='text-center text-capitalize my-2'>$error</h6>";
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
function addArticle()
{
    global $connect;
    $error = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

        $title  = mysqli_real_escape_string($connect, trim($_POST['article_title'] ?? ''));
        $desc   = mysqli_real_escape_string($connect, trim($_POST['article_description'] ?? ''));
        $detail = mysqli_real_escape_string($connect, trim($_POST['article_detail_description'] ?? ''));
        $badge  = mysqli_real_escape_string($connect, trim($_POST['article_badge'] ?? ''));

        if ($title == "" || $desc == "" || $detail == "" || $badge == "") {
            $error = "All fields are required.";
        }

        // IMAGE
        elseif (empty($_FILES['article_img']['name'])) {
            $error = "Image required.";
        }

        else {

            $img_name = $_FILES['article_img']['name'];
            $tmp      = $_FILES['article_img']['tmp_name'];
            $size     = $_FILES['article_img']['size'];

            $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

            if (!in_array($ext, ['jpg','jpeg','png','webp'])) {
                $error = "Only JPG, JPEG, PNG and webp allowed.";
            }
            elseif ($size > 2000000) {
                $error = "Image must be under 2MB.";
            }
            else {

                $new_name = time().".".$ext;
                move_uploaded_file($tmp, "src/".$new_name);

                $insert = "INSERT INTO news 
                (article_title,article_description,
                article_detail_description,article_badge,
                article_date,article_img)
                VALUES
                ('$title','$desc','$detail','$badge',
                CURDATE(),'$new_name')";

                mysqli_query($connect,$insert);
                header("Location: news.php");
                exit;
            }
        }
    }

    return $error;
}
?>

<?php include('includes/footer.php'); ?>

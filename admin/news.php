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
    $get_img = mysqli_query($connect, "SELECT article_img FROM news WHERE article_id=$delete_id");
    $img_row = mysqli_fetch_assoc($get_img);

    if ($img_row) {
        $img_path = "uploads/" . $img_row['article_img'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }

    mysqli_query($connect, "DELETE FROM news WHERE article_id=$delete_id");
    header("location:news.php");
    exit;
}


// UPDATE
if (isset($_POST['btn-edit-article'])) {

    $article_id = intval($_POST['article_id']);
    $title = mysqli_real_escape_string($connect, trim($_POST['article_title_update']));
    $description = mysqli_real_escape_string($connect, trim($_POST['article_description_update']));
    $detail = mysqli_real_escape_string($connect, trim($_POST['article_detail_update']));
    $badge = mysqli_real_escape_string($connect, trim($_POST['article_badge_update']));
    $update_articles_status = mysqli_real_escape_string($connect, trim($_POST['articles_status_update']));

    if (empty($title) || empty($description) || empty($detail) || empty($badge)) {
        echo "All fields are required.";
        exit;
    }

    $update_query = "UPDATE news SET
        article_title = '$title',
        article_description = '$description',
        article_detail_description = '$detail',
        article_badge = '$badge',
        articles_status = '$update_articles_status'
        WHERE article_id = $article_id";

    mysqli_query($connect, $update_query);
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
<style>
  :root {
    --accent: #0f62fe;
    --accent-soft: #e8f0fe;
    --danger: #da1e28;
    --success: #24a148;
    --surface: #ffffff;
    --bg: #f0f4ff;
    --border: #dce3f5;
    --text: #161b2e;
    --muted: #6b7592;
    --radius: 16px;
    --shadow: 0 4px 24px rgba(15, 98, 254, 0.10), 0 1px 4px rgba(0,0,0,0.06);
  }

  /* body {
    font-family: 'Sora', sans-serif;
    background: var(--bg);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 16px;
  } */

  /* ── CARD ── */
  .edit-card {
    background: var(--surface);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    overflow: hidden;
    animation: slideUp .45s cubic-bezier(.22,1,.36,1) both;
    max-width: 860px;
    width: 100%;
  }

  @keyframes slideUp {
    from { opacity:0; transform: translateY(22px); }
    to   { opacity:1; transform: translateY(0); }
  }

  /* ── CARD HEADER ── */
  .edit-card-header {
    background: linear-gradient(100deg, #0f62fe 0%, #4589ff 100%);
    padding: 16px 24px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .edit-card-header .header-icon {
    background: rgba(255,255,255,0.18);
    border-radius: 8px;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
  }

  .edit-card-header h6 {
    color: #fff;
    font-size: 0.9rem;
    font-weight: 600;
    margin: 0;
    letter-spacing: 0.3px;
  }

  .edit-card-header small {
    color: rgba(255,255,255,0.7);
    font-size: 0.72rem;
  }

  /* ── CARD BODY ── */
  .edit-card-body {
    padding: 22px 24px 20px;
  }

  /* ── IMAGE COLUMN ── */
  .article-img-wrap {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background: #eef2ff;
    height: 100%;
    min-height: 220px;
  }

  .article-img-wrap img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }

  .article-img-wrap:hover img { transform: scale(1.03); }

  .img-overlay {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(transparent, rgba(15,25,60,0.55));
    padding: 10px 12px 8px;
  }

  .img-overlay span {
    font-size: 0.68rem;
    color: rgba(255,255,255,0.8);
    font-weight: 500;
    letter-spacing: 0.4px;
  }

  /* ── FORM LABELS ── */
  .form-label-styled {
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--muted);
    letter-spacing: 0.6px;
    text-transform: uppercase;
    margin-bottom: 5px;
    display: block;
  }

  /* ── INPUTS ── */
  .form-control-styled {
    font-family: 'Sora', sans-serif;
    font-size: 0.83rem;
    color: var(--text);
    background: #f7f9ff;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    padding: 9px 13px;
    width: 100%;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    outline: none;
    resize: vertical;
  }

  .form-control-styled:focus {
    border-color: var(--accent);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(15,98,254,0.10);
  }

  .form-control-styled[readonly] {
    background: #eef2f8;
    color: var(--muted);
    cursor: not-allowed;
  }

  /* ── DIVIDER ── */
  .mini-divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 16px 0 14px;
  }

  /* ── BUTTONS ── */
  .btn-update {
    background: linear-gradient(135deg, #0f62fe, #4589ff);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 9px 22px;
    font-size: 0.82rem;
    font-weight: 600;
    font-family: 'Sora', sans-serif;
    cursor: pointer;
    box-shadow: 0 3px 12px rgba(15,98,254,0.28);
    transition: transform 0.15s, box-shadow 0.15s;
    display: inline-flex; align-items: center; gap: 6px;
  }

  .btn-update:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(15,98,254,0.35);
  }

  .btn-delete {
    background: #fff0f1;
    color: var(--danger);
    border: 1.5px solid #f5c2c5;
    border-radius: 10px;
    padding: 9px 22px;
    font-size: 0.82rem;
    font-weight: 600;
    font-family: 'Sora', sans-serif;
    cursor: pointer;
    transition: background 0.15s, transform 0.15s;
    display: inline-flex; align-items: center; gap: 6px;
  }

  .btn-delete:hover {
    background: #ffd7d9;
    transform: translateY(-1px);
  }

  /* ── FIELD GROUPS ── */
  .field-group { margin-bottom: 12px; }
    
</style>
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
            <option>General Health</option>
            <option>Medical Research</option>
            <option>Hospital News</option>
            <option>Events</option>
        </select>
        <select class="filter-select" style="min-width:120px;">
            <option value="">All Status</option>
            <option>Published</option>
            <option>Draft</option>
            <option>Archived</option>
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

                        $article_id = $row["article_id"];
                        $title = $row["article_title"];
                        $desc = $row["article_description"];
                        $detail = $row["article_detail_description"];
                        $badge = $row["article_badge"];
                        $date = $row["article_date"];
                        $img = $row["article_img"];
                        $article_status = $row["articles_status"];
                        ?>

<div class="col-10 my-4" style="width:100%; display:flex; justify-content:center;">
  <div class="edit-card">

    <!-- Header -->
    <div class="edit-card-header">
      <div class="header-icon">✏️</div>
      <div>
        <h6>Edit Article</h6>
        <small>Update or remove this post</small>
      </div>
    </div>

    <!-- Body -->
    <div class="edit-card-body">
      <form method="POST">
        <input type="hidden" name="article_id" value="<?= $article_id ?>">

        <div class="row g-3">

          <!-- Image Column -->
          <div class="col-md-3">
            <div class="article-img-wrap">
              <img src="src/<?= $img ?>" alt="Article Image">
              <div class="img-overlay">
                <span>📷 Article Image</span>
              </div>
            </div>
          </div>

          <!-- Content Column -->
          <div class="col-md-9">

            <!-- Title -->
            <div class="field-group">
              <label class="form-label-styled">Title</label>
              <input type="text" name="article_title_update" value="<?= $title ?>"
                class="form-control-styled">
            </div>

            <!-- Description -->
            <div class="field-group">
              <label class="form-label-styled">Description</label>
              <textarea name="article_description_update" class="form-control-styled"
                rows="2"><?= $desc ?></textarea>
            </div>

            <!-- Detail Description -->
            <div class="field-group">
              <label class="form-label-styled">Detail Description</label>
              <textarea name="article_detail_update" class="form-control-styled"
                rows="3"><?= $detail ?></textarea>
            </div>

            <hr class="mini-divider">

            <!-- Badge / Date / Status -->
            <div class="row g-2">
              <div class="col-md-4">
                <label class="form-label-styled">Badge</label>
                <input type="text" name="article_badge_update" value="<?= $badge ?>"
                  class="form-control-styled">
              </div>
              <div class="col-md-4">
                <label class="form-label-styled">Date</label>
                <input type="date" value="<?= $date ?>" class="form-control-styled" readonly>
              </div>
              <div class="col-md-4">
                <label class="form-label-styled">Status</label>
                <input type="text" name="articles_status_update" value="<?= $article_status ?>"
                  class="form-control-styled">
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-2 mt-3">
              <button class="btn-update" name="btn-edit-article">
                ✅ Update
              </button>
              <button class="btn-delete"
                onclick="return confirm('Are you sure you want to delete this post?')"
                name="btn-delete-article">
                🗑 Delete
              </button>
            </div>

          </div><!-- /col-md-9 -->

        </div><!-- /row -->

      </form>
    </div><!-- /body -->

  </div><!-- /card -->
</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div id="news_id" class="conteiner-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary  m-3">
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
                            <input type="text" name="article_badge" class="form-control" placeholder="Enter badge name">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary d-block btn-lg mx-auto w-75 mt-5">
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

            $title = mysqli_real_escape_string($connect, trim($_POST['article_title'] ?? ''));
            $desc = mysqli_real_escape_string($connect, trim($_POST['article_description'] ?? ''));
            $detail = mysqli_real_escape_string($connect, trim($_POST['article_detail_description'] ?? ''));
            $badge = mysqli_real_escape_string($connect, trim($_POST['article_badge'] ?? ''));

            if ($title == "" || $desc == "" || $detail == "" || $badge == "") {
                $error = "All fields are required.";
            }

            // IMAGE
            elseif (empty($_FILES['article_img']['name'])) {
                $error = "Image required.";
            } else {

                $img_name = $_FILES['article_img']['name'];
                $tmp = $_FILES['article_img']['tmp_name'];
                $size = $_FILES['article_img']['size'];

                $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $error = "Only JPG, JPEG, PNG and webp allowed.";
                } elseif ($size > 2000000) {
                    $error = "Image must be under 2MB.";
                } else {

                    $new_name = time() . "." . $ext;
                    move_uploaded_file($tmp, "src/" . $new_name);

                    $insert = "INSERT INTO news 
                (article_title,article_description,
                article_detail_description,article_badge,
                article_date,article_img)
                VALUES
                ('$title','$desc','$detail','$badge',
                CURDATE(),'$new_name')";

                    mysqli_query($connect, $insert);
                    header("Location: news.php");
                    exit;
                }
            }
        }

        return $error;
    }
    ?>

    <?php include('includes/footer.php'); ?>
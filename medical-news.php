<?php
include "connect.php";
$page_title = 'Medical News';
$category = isset($_GET['cat']) ? $_GET['cat'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$articles = [
  ['title' => 'New Breakthrough in Heart Disease Prevention Using AI-Powered Diagnostics', 'cat' => 'research', 'icon' => 'heartbeat', 'bg' => 'linear-gradient(135deg,#E3F2FD,#BBDEFB)', 'ic' => 'var(--primary)', 'date' => '15 Jun 2025', 'author' => 'Dr. Noman Riaz', 'read' => '8', 'excerpt' => 'Researchers at the University of Karachi have developed an AI model that can predict coronary artery disease 5 years before symptoms appear, revolutionizing preventive cardiology.', 'featured' => true],
  ['title' => 'Pakistan Launches National Cancer Screening Program for Early Detection', 'cat' => 'health', 'icon' => 'microscope', 'bg' => 'linear-gradient(135deg,#E3F2FD,#BBDEFB)', 'ic' => 'var(--primary)', 'date' => '14 Jun 2025', 'author' => 'Health Desk', 'read' => '5', 'excerpt' => 'The Ministry of Health has announced a nationwide cancer screening initiative targeting breast and cervical cancer across 15 major cities in Pakistan.', 'featured' => false],
  ['title' => 'New Dengue Vaccine Shows 87% Efficacy in Phase 3 Clinical Trials', 'cat' => 'vaccines', 'icon' => 'syringe', 'bg' => 'linear-gradient(135deg,#E8F5E9,#C8E6C9)', 'ic' => 'var(--success)', 'date' => '12 Jun 2025', 'author' => 'Research Team', 'read' => '4', 'excerpt' => 'A new dengue fever vaccine has demonstrated high efficacy in final-stage trials with plans for rollout in South Asia.', 'featured' => false],
  ['title' => 'Researchers Identify New Biomarker for Early Alzheimer\'s Detection', 'cat' => 'neurology', 'icon' => 'brain', 'bg' => 'linear-gradient(135deg,#EDE7F6,#D1C4E9)', 'ic' => '#6A1B9A', 'date' => '10 Jun 2025', 'author' => 'Dr. Asim Raza', 'read' => '6', 'excerpt' => 'Scientists have discovered a blood-based biomarker that can detect Alzheimer\'s disease up to 10 years before cognitive symptoms emerge.', 'featured' => false],
  ['title' => 'AI-Powered Radiology Now Available at 50+ Pakistan Hospitals', 'cat' => 'technology', 'icon' => 'robot', 'bg' => 'linear-gradient(135deg,#E0F7FA,#B2EBF2)', 'ic' => 'var(--accent)', 'date' => '08 Jun 2025', 'author' => 'Tech Health', 'read' => '7', 'excerpt' => 'Cutting-edge artificial intelligence radiology tools have been deployed at over 50 hospitals across Pakistan, reducing diagnosis time dramatically.', 'featured' => false],
  ['title' => 'New Cholesterol Drug Reduces Heart Attack Risk by 40%', 'cat' => 'cardiology', 'icon' => 'pills', 'bg' => 'linear-gradient(135deg,#FFF3E0,#FFE0B2)', 'ic' => '#E65100', 'date' => '06 Jun 2025', 'author' => 'Cardio Desk', 'read' => '5', 'excerpt' => 'A novel PCSK9 inhibitor has shown remarkable results in reducing LDL cholesterol and significantly lowering the risk of major cardiovascular events.', 'featured' => false],
  ['title' => 'Pakistan\'s Child Immunization Rate Reaches Record High of 89%', 'cat' => 'vaccines', 'icon' => 'child', 'bg' => 'linear-gradient(135deg,#FFEBEE,#FFCDD2)', 'ic' => 'var(--danger)', 'date' => '04 Jun 2025', 'author' => 'Health Desk', 'read' => '4', 'excerpt' => 'Pakistan has achieved its highest-ever childhood immunization coverage, attributed to community health worker programs and mobile vaccination units.', 'featured' => false],
];

// Filter
if ($category !== 'all')
  $articles = array_filter($articles, fn($a) => $a['cat'] === $category);
if ($search)
  $articles = array_filter($articles, fn($a) => stripos($a['title'], $search) !== false || stripos($a['excerpt'], $search) !== false);

$featured = array_shift($articles);
$categories = ['all' => 'All', 'research' => 'Research', 'cardiology' => 'Cardiology', 'neurology' => 'Neurology', 'vaccines' => 'Vaccines', 'technology' => 'Technology', 'health' => 'Pakistan Health'];
include 'includes/head.php';
?>

<?php include 'includes/navbar.php'; ?>

<section style="background:linear-gradient(135deg,#0097A7,#00695C);padding:60px 0;color:white;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="badge-accent"
          style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.3);">Stay
          Informed</span>
        <h1 class="hero-title mt-2 mb-2" style="font-size:2.4rem;">Medical News &amp; Updates</h1>
        <p style="color:rgba(255,255,255,0.8);">Latest healthcare news from Pakistan and around the world.</p>
      </div>
      <div class="col-lg-5 mt-3 mt-lg-0">
        <form method="GET" action="medical-news.php" class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search news articles..."
            value="<?php echo htmlspecialchars($search); ?>"
            style="border-radius:var(--radius-sm) 0 0 var(--radius-sm);border:none;padding:14px 18px;" />
          <?php if ($category !== 'all'): ?><input type="hidden" name="cat"
              value="<?php echo htmlspecialchars($category); ?>" /><?php endif; ?>
          <button type="submit" class="btn"
            style="background:var(--primary);color:white;border-radius:0 var(--radius-sm) var(--radius-sm) 0;padding:0 20px;"><i
              class="fas fa-search"></i></button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="section-padding">
  <div class="container">
    <!-- Category Filters -->
    <!-- <div class="d-flex flex-wrap gap-2 mb-5">
        <?php foreach ($categories as $key => $label): ?>
        <a href="medical-news.php?cat=<?php echo $key; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>"
           class="<?php echo $category === $key ? 'btn-primary-care' : 'btn btn-outline-secondary rounded-pill'; ?>"
           style="<?php echo $category === $key ? 'padding:8px 18px;font-size:0.83rem;' : 'font-size:0.83rem;'; ?> text-decoration:none;">
          <?php echo htmlspecialchars($label); ?>
        </a>
        <?php endforeach; ?>
      </div> -->

    <!-- Featured Article -->
    <?php if ($featured && empty($search) && $category === 'all'): ?>
      <div class="news-featured mb-5 animate-on-scroll">
        <div class="row g-0">
          <div class="col-lg-6">
            <div class="news-featured-body h-100 d-flex flex-column justify-content-center">
              <span class="news-category">Featured Research</span>
              <h3><?php echo htmlspecialchars($featured['title']); ?></h3>
              <p><?php echo htmlspecialchars($featured['excerpt']); ?></p>
              <div class="d-flex align-items-center gap-3" style="font-size:0.82rem;opacity:.85;margin-bottom:24px;">
                <span><i class="fas fa-calendar me-1"></i><?php echo $featured['date']; ?></span>
                <span><i class="fas fa-user me-1"></i><?php echo $featured['author']; ?></span>
                <span><i class="fas fa-clock me-1"></i><?php echo $featured['read']; ?> min read</span>
              </div>
              <a href="#" class="btn-outline-care" style="width:fit-content;"><i class="fas fa-arrow-right"></i> Read Full
                Article</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div
              style="height:100%;min-height:280px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;font-size:6rem;opacity:0.3;">
              <i class="fas fa-<?php echo $featured['icon']; ?>"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

      <div class="row g-4">
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
          <div class="col-md-6 col-lg-4 news-card-item animate-on-scroll"
            style="transition-delay:<?php echo (($i - 1) % 3) * 0.07; ?>s">
            <div class="news-card">
              <div class="news-card-img" style="background:<?php echo $art['bg']; ?>">
                <img src="admin/src/<?= $img ?>" width="100%" height="200px" alt="">
                <span class="news-category"><?= $badge ?></span>
              </div>
              <div class="news-card-body">
                <div class="news-meta">
                  <span><i class="fas fa-calendar"></i> <?= $date ?></span>
                </div>
                <h5><?= $title ?></h5>
                <p class="news-excerpt"><?= $desc ?></p>
                <a href="#" class="btn-read-more">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    <div class="text-center mt-5">
      <button class="btn-primary-care" style="padding:12px 40px;">
        <i class="fas fa-sync-alt me-2"></i>Load More Articles
      </button>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
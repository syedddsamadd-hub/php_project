<?php
$page_title = 'Diseases Guide';
$filter = isset($_GET['cat']) ? $_GET['cat'] : 'all';

$diseases = [
  ['name'=>'Coronary Artery Disease','cat'=>'heart','icon'=>'heartbeat','ic_color'=>'#C62828','bg'=>'linear-gradient(135deg,#FFEBEE,#FFCDD2)','tags'=>['Heart','Cardiovascular'],'symptoms'=>'Chest pain, shortness of breath, fatigue, irregular heartbeat, dizziness.','causes'=>'Plaque buildup in arteries, high cholesterol, hypertension, smoking.','prevention'=>'Regular exercise, healthy diet, quit smoking, manage blood pressure.','treatment'=>'Medications, lifestyle changes, angioplasty, bypass surgery.','spec'=>'Cardiologist'],
  ['name'=>'Type 2 Diabetes','cat'=>'other','icon'=>'syringe','ic_color'=>'#E65100','bg'=>'linear-gradient(135deg,#FFF3E0,#FFE0B2)','tags'=>['Endocrine','Metabolic'],'symptoms'=>'Frequent urination, excessive thirst, blurred vision, slow healing wounds.','causes'=>'Insulin resistance, obesity, sedentary lifestyle, genetics.','prevention'=>'Maintain healthy weight, exercise regularly, eat a balanced diet.','treatment'=>'Oral medications, insulin therapy, diet control, regular monitoring.','spec'=>'Endocrinologist'],
  ['name'=>'Stroke','cat'=>'brain','icon'=>'brain','ic_color'=>'#6A1B9A','bg'=>'linear-gradient(135deg,#EDE7F6,#D1C4E9)','tags'=>['Brain','Neurological'],'symptoms'=>'Sudden numbness, confusion, trouble speaking, severe headache, vision problems.','causes'=>'Blocked artery, bleeding in brain, hypertension, atrial fibrillation.','prevention'=>'Control blood pressure, don\'t smoke, manage diabetes, exercise.','treatment'=>'Clot-busting drugs, surgery, rehabilitation therapy.','spec'=>'Neurologist'],
  ['name'=>'Asthma','cat'=>'respiratory','icon'=>'lungs','ic_color'=>'var(--primary)','bg'=>'linear-gradient(135deg,#E3F2FD,#BBDEFB)','tags'=>['Respiratory','Lung'],'symptoms'=>'Wheezing, shortness of breath, chest tightness, coughing (especially at night).','causes'=>'Allergens, air pollution, exercise, respiratory infections, genetics.','prevention'=>'Avoid triggers, use air purifiers, take prescribed medications.','treatment'=>'Inhalers (bronchodilators), corticosteroids, allergy shots.','spec'=>'Pulmonologist'],
  ['name'=>'Rheumatoid Arthritis','cat'=>'bone','icon'=>'bone','ic_color'=>'var(--success)','bg'=>'linear-gradient(135deg,#E8F5E9,#C8E6C9)','tags'=>['Bone','Autoimmune'],'symptoms'=>'Joint pain, swelling, morning stiffness, fatigue, fever.','causes'=>'Autoimmune response, genetics, hormonal factors.','prevention'=>'Exercise regularly, healthy weight, avoid smoking, omega-3 diet.','treatment'=>'DMARDs, NSAIDs, biologics, physical therapy.','spec'=>'Orthopedist'],
  ['name'=>'Eczema','cat'=>'skin','icon'=>'hand-paper','ic_color'=>'#F9A825','bg'=>'linear-gradient(135deg,#FFF9C4,#FFF176)','tags'=>['Skin','Allergic'],'symptoms'=>'Itchy inflamed patches on skin, blisters, oozing, redness.','causes'=>'Immune system dysfunction, genetics, environmental triggers.','prevention'=>'Moisturize regularly, avoid harsh soaps, manage stress.','treatment'=>'Topical corticosteroids, antihistamines, immunosuppressants.','spec'=>'Dermatologist'],
];

// Filter
$filtered = ($filter === 'all') ? $diseases : array_filter($diseases, fn($d) => $d['cat'] === $filter);
$categories = ['all'=>'All Diseases','heart'=>'Heart','brain'=>'Brain & Neuro','respiratory'=>'Respiratory','bone'=>'Bone & Joint','skin'=>'Skin'];
include 'includes/head.php';
?>

<?php include 'includes/navbar.php'; ?>

  <section style="background:linear-gradient(135deg,#1565C0,#0D47A1);padding:60px 0;color:white;">
    <div class="container text-center">
      <span class="badge-accent" style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.3);">Health Guide</span>
      <h1 class="hero-title mt-2" style="font-size:2.4rem;">Disease Information Center</h1>
      <p style="color:rgba(255,255,255,0.8);max-width:500px;margin:0 auto;">Learn about common diseases – symptoms, causes, prevention, and treatments.</p>
    </div>
  </section>

  <!-- Filters -->
  <div style="background:var(--off-white);border-bottom:1px solid rgba(21,101,192,0.1);padding:20px 0;">
    <div class="container">
      <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($categories as $key=>$label): ?>
          <a href="diseases.php?cat=<?php echo $key; ?>" class="<?php echo $filter===$key ? 'btn-primary-care' : 'btn btn-outline-secondary rounded-pill'; ?>" style="<?php echo $filter===$key ? 'padding:8px 20px;font-size:0.83rem;' : 'font-size:0.83rem;'; ?> text-decoration:none;">
            <?php echo htmlspecialchars($label); ?>
          </a>
          <?php endforeach; ?>
        </div>
        <form method="GET" action="diseases.php" class="d-flex gap-2">
          <input type="hidden" name="cat" value="<?php echo htmlspecialchars($filter); ?>" />
          <input type="text" name="search" class="filter-select" placeholder="🔍  Search disease..." style="max-width:220px;" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" />
          <button type="submit" class="btn-primary-care" style="padding:10px 16px;font-size:0.85rem;"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </div>
  </div>

  <section class="section-padding">
    <div class="container">
      <?php if (empty($filtered)): ?>
      <div class="text-center py-5">
        <i class="fas fa-search" style="font-size:3rem;color:var(--medium-gray);"></i>
        <h5 class="mt-3" style="color:var(--text-muted);">No diseases found.</h5>
        <a href="diseases.php" class="btn-primary-care mt-3">Reset Filter</a>
      </div>
      <?php else: ?>
      <div class="row g-4">
        <?php $i=0; foreach ($filtered as $d): $i++; ?>
        <div class="col-md-6 col-lg-4 animate-on-scroll" style="transition-delay:<?php echo (($i-1)%3)*0.07; ?>s">
          <div class="disease-card">
            <div class="disease-card-img" style="background:<?php echo $d['bg']; ?>">
              <i class="fas fa-<?php echo $d['icon']; ?>" style="color:<?php echo $d['ic_color']; ?>"></i>
            </div>
            <div class="disease-card-body">
              <h5><?php echo htmlspecialchars($d['name']); ?></h5>
              <div class="mb-2">
                <?php foreach ($d['tags'] as $tag): ?>
                <span class="disease-tag"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
              </div>
              <div class="disease-info-label">Symptoms</div>
              <p class="disease-info-text"><?php echo htmlspecialchars($d['symptoms']); ?></p>
              <div class="disease-info-label">Causes</div>
              <p class="disease-info-text"><?php echo htmlspecialchars($d['causes']); ?></p>
              <div class="disease-info-label">Prevention</div>
              <p class="disease-info-text"><?php echo htmlspecialchars($d['prevention']); ?></p>
              <div class="disease-info-label">Treatment</div>
              <p class="disease-info-text"><?php echo htmlspecialchars($d['treatment']); ?></p>
              <a href="search-doctor.php?spec=<?php echo urlencode($d['spec']); ?>" class="btn-primary-care mt-3" style="padding:9px 20px;font-size:0.83rem;">
                <i class="fas fa-user-md"></i> Find <?php echo htmlspecialchars($d['spec']); ?>
              </a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="cta-banner">
    <div class="container text-center position-relative" style="z-index:1;">
      <h2 class="mb-3">Have Symptoms? Consult a Doctor Now</h2>
      <p class="mb-4">Early diagnosis saves lives. Book an appointment with a specialist today.</p>
      <a href="search-doctor.php" class="btn-primary-care" style="background:white;color:var(--primary);">
        <i class="fas fa-search"></i> Find a Specialist
      </a>
    </div>
  </section>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

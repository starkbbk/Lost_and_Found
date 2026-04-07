

<section class="section dashboard">
    
    <!-- Welcome Banner with Glass Effect -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-banner glass-card p-5 position-relative overflow-hidden">
                <div class="position-relative z-index-2">
                    <h2 class="display-4 fw-black text-accent-glow mb-2">Welcome Back, <?= $_settings->userdata('firstname') ?>!</h2>
                    <p class="lead text-muted">Here's a quick overview of what's happening with the Lost & Found system today.</p>
                </div>
                <div class="position-absolute end-0 bottom-0 opacity-10 pe-4 pb-0">
                    <i class="bi bi-speedometer2" style="font-size: 15rem; transform: translateY(20%);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
      <!-- Active Categories -->
      <div class="col-xxl-3 col-md-6">
        <a href="<?= base_url ?>admin/?page=categories" class="text-decoration-none">
            <div class="glass-card h-100 stat-card-v2 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary p-3 rounded-xl border border-primary border-opacity-20">
                        <i class="bi bi-grid-fill fs-3"></i>
                    </div>
                </div>
                <h5 class="text-muted small text-uppercase fw-bold letter-spacing-1 mb-1">Active Categories</h5>
                <?php $categories = $conn->query("SELECT * FROM `category_list` where `status` = 1")->num_rows; ?>
                <h2 class="fw-black mb-0"><?= format_num($categories) ?></h2>
            </div>
        </a>
      </div>

      <!-- Inactive Categories -->
      <div class="col-xxl-3 col-md-6">
        <a href="<?= base_url ?>admin/?page=categories" class="text-decoration-none">
            <div class="glass-card h-100 stat-card-v2 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box bg-secondary bg-opacity-10 text-muted p-3 rounded-xl border border-white border-opacity-10">
                        <i class="bi bi-dash-circle fs-3"></i>
                    </div>
                </div>
                <h5 class="text-muted small text-uppercase fw-bold letter-spacing-1 mb-1">Inactive Categories</h5>
                <?php $categories_inactive = $conn->query("SELECT * FROM `category_list` where `status` = 0")->num_rows; ?>
                <h2 class="fw-black mb-0"><?= format_num($categories_inactive) ?></h2>
            </div>
        </a>
      </div>

       <!-- Pending Items -->
       <div class="col-xxl-3 col-md-6">
        <a href="<?= base_url ?>admin/?page=items" class="text-decoration-none">
            <div class="glass-card h-100 stat-card-v2 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning p-3 rounded-xl border border-warning border-opacity-20">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-2 py-1 small">Needs Review</span>
                </div>
                <h5 class="text-muted small text-uppercase fw-bold letter-spacing-1 mb-1">Pending Items</h5>
                <?php $items_pending = $conn->query("SELECT * FROM `item_list` where `status` = 0")->num_rows; ?>
                <h2 class="fw-black mb-0"><?= format_num($items_pending) ?></h2>
            </div>
        </a>
      </div>

      <!-- Published Items -->
      <div class="col-xxl-3 col-md-6">
        <a href="<?= base_url ?>admin/?page=items" class="text-decoration-none">
            <div class="glass-card h-100 stat-card-v2 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box bg-success bg-opacity-10 text-success p-3 rounded-xl border border-success border-opacity-20">
                        <i class="bi bi-check-all fs-3"></i>
                    </div>
                </div>
                <h5 class="text-muted small text-uppercase fw-bold letter-spacing-1 mb-1">Published Items</h5>
                <?php $items_published = $conn->query("SELECT * FROM `item_list` where `status` = 1")->num_rows; ?>
                <h2 class="fw-black mb-0"><?= format_num($items_published) ?></h2>
            </div>
        </a>
      </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="glass-card p-4">
                <h4 class="fw-bold mb-4 text-accent-glow"><i class="bi bi-images me-2"></i>System Banners</h4>
                <?php 
                  if(is_dir(base_app.'uploads/banner')){
                    $images = scandir(base_app.'uploads/banner');
                    foreach($images as $k=>$v){
                      if(in_array($v, ['.', '..'])){
                        unset($images[$k]);
                      }
                    }
                  }
                ?>
                <?php if(isset($images) && count($images) > 0): ?>
                <div id="banner-slider" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner shadow-2xl rounded-xl border border-white border-opacity-10 overflow-hidden" style="height: 350px;">
                    <?php foreach(array_values($images) as $k => $fname): ?>
                    <div class="carousel-item h-100 <?= ($k == 0) ? "active" : "" ?>">
                      <img src="<?= validate_image('uploads/banner/'.$fname) ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Banner <?= $k + 1 ?>">
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#banner-slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon p-3 glass-card rounded-circle"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#banner-slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon p-3 glass-card rounded-circle"></span>
                  </button>
                </div>
                <?php else: ?>
                  <div class="text-muted text-center py-5 glass-card border-dashed">
                      <i class="bi bi-image display-1 opacity-10"></i>
                      <p class="mt-3">No banners have been set yet.</p>
                  </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .fw-black { font-weight: 900; }
    .letter-spacing-1 { letter-spacing: 0.1em; }
    .text-accent-glow { color: var(--accent-glow) !important; }
    .stat-card-v2 {
        transition: all 0.3s ease;
        border-color: rgba(255, 255, 255, 0.05) !important;
    }
    .stat-card-v2:hover {
        transform: translateY(-5px);
        border-color: var(--accent-vibrant) !important;
        background: rgba(255, 255, 255, 0.08) !important;
    }
    .rounded-xl { border-radius: 1.25rem; }
    .z-index-2 { z-index: 2; }
</style>
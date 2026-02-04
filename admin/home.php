<style>
  .welcome-banner {
    background: linear-gradient(135deg, #ff9900 0%, #ffcc80 100%);
    color: white;
    border-radius: var(--border-radius);
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 20px rgba(255, 153, 0, 0.2);
    position: relative;
    overflow: hidden;
  }
  .welcome-banner h2 {
    color: white !important;
    font-weight: 700;
    margin-bottom: 10px;
  }
  .welcome-banner p {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    margin-bottom: 0;
  }
  .stat-card {
    transition: transform 0.3s ease;
  }
  .stat-card:hover {
    transform: translateY(-5px);
  }
  .stat-card .card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .stat-card h6 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 5px;
  }
  .stat-card .card-title {
    color: var(--text-muted);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0;
  }
  .stat-icon {
    position: absolute;
    right: 25px;
    top: 25px;
    font-size: 3rem;
    opacity: 0.1;
    color: var(--primary-color);
  }
</style>

<section class="section dashboard">
    
    <!-- Welcome Banner user name -->
    <div class="row">
        <div class="col-12">
            <div class="welcome-banner">
                <h2>Hello, <?= $_settings->userdata('firstname') ?>!</h2>
                <p>Welcome back to your dashboard. Here's what's happening today.</p>
                <i class="bi bi-emoji-smile position-absolute text-white" style="font-size: 10rem; right: -20px; bottom: -40px; opacity: 0.2;"></i>
            </div>
        </div>
    </div>

    <div class="row">

      <!-- Stats Cards -->
      <!-- Categories Active -->
      <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <a href="<?= base_url ?>admin/?page=categories" class="text-decoration-none">
            <div class="card info-card stat-card">
            <div class="card-body">
                <h5 class="card-title">Active Categories</h5>
                <?php 
                $categories = $conn->query("SELECT * FROM `category_list` where `status` = 1")->num_rows;
                ?>
                <div class="d-flex align-items-center">
                    <h6><?= format_num($categories) ?></h6>
                </div>
                <i class="bi bi-grid-fill stat-icon"></i>
            </div>
            </div>
        </a>
      </div>

      <!-- Categories Inactive -->
      <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <a href="<?= base_url ?>admin/?page=categories" class="text-decoration-none">
            <div class="card info-card stat-card">
            <div class="card-body">
                <h5 class="card-title">Inactive Categories</h5>
                <?php 
                $categories_inactive = $conn->query("SELECT * FROM `category_list` where `status` = 0")->num_rows;
                ?>
                <div class="d-flex align-items-center">
                    <h6><?= format_num($categories_inactive) ?></h6>
                </div>
                <i class="bi bi-grid stat-icon"></i>
            </div>
            </div>
        </a>
      </div>

       <!-- Items Pending -->
       <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <a href="<?= base_url ?>admin/?page=items" class="text-decoration-none">
            <div class="card info-card stat-card">
            <div class="card-body">
                <h5 class="card-title">Pending Items</h5>
                <?php 
                $items_pending = $conn->query("SELECT * FROM `item_list` where `status` = 0")->num_rows;
                ?>
                <div class="d-flex align-items-center">
                    <h6><?= format_num($items_pending) ?></h6>
                </div>
                <i class="bi bi-hourglass-split stat-icon"></i>
            </div>
            </div>
        </a>
      </div>

      <!-- Items Published -->
      <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <a href="<?= base_url ?>admin/?page=items" class="text-decoration-none">
            <div class="card info-card stat-card">
            <div class="card-body">
                <h5 class="card-title">Published Items</h5>
                <?php 
                $items_published = $conn->query("SELECT * FROM `item_list` where `status` = 1")->num_rows;
                ?>
                <div class="d-flex align-items-center">
                    <h6><?= format_num($items_published) ?></h6>
                </div>
                <i class="bi bi-check-circle-fill stat-icon"></i>
            </div>
            </div>
        </a>
      </div>

    </div>

    <div class="row">
         <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">System Banners</h5>
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
                  <div class="carousel-inner" style="border-radius: var(--border-radius); overflow: hidden;">
                    <?php foreach(array_values($images) as $k => $fname): ?>
                    <div class="carousel-item <?= ($k == 0) ? "active" : "" ?>">
                      <img src="<?= validate_image('uploads/banner/'.$fname) ?>" class="d-block w-100" alt="Banner Image <?= $k + 1 ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                  <div class="text-muted text-center py-5">No Banner has been set</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
    </div>
  </section>
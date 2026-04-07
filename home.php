<div class="col-12 px-0">
    <div class="welcome-container mb-5">
        <div class="glass-card p-5">
            <h2 class="display-4 fw-bold mb-4">Welcome to <?= $_settings->info('name') ?></h2>
            <div class="row">
                <div class="col-md-6 border-end border-white border-opacity-10">
                    <p class="lead text-muted mb-4"><?php echo is_file(base_app.'pages/welcome.html') ? file_get_contents((base_app.'pages/welcome.html')) : 'Your trusted platform for recovering lost belongings and returning found items to their rightful owners.' ?></p>
                </div>
                <div class="col-md-6 ps-md-4">
                    <div class="d-flex gap-3 mt-2">
                        <a href="./?page=found" class="btn btn-primary btn-lg flex-grow-1">Report Found Item</a>
                        <a href="./?page=lost" class="btn btn-outline-light btn-lg flex-grow-1">Report Lost Item</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Lost Items Section -->
    <div class="section-header mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold"><i class="bi bi-search me-2 text-danger"></i>Recent Lost Items</h3>
        <a href="./?page=items&t=2" class="btn btn-sm btn-outline-light rounded-pill">View All</a>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php 
        $lost = $conn->query("SELECT * FROM `item_list` where `status` = 1 and `type` = 2 order by unix_timestamp(`date_created`) desc limit 3");
        while($row = $lost->fetch_assoc()):
        ?>
        <div class="col">
            <div class="card h-100 glass-card item-card">
                <img src="<?= validate_image($row['image_path']) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-truncate"><?= $row['title'] ?></h5>
                    <p class="card-text text-muted text-truncate small mb-3"><?= $row['description'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-danger">Lost</span>
                        <a href="./?page=items/view_item&id=<?= $row['id'] ?>" class="btn btn-sm btn-primary rounded-pill">Details</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <!-- Recent Found Items Section -->
    <div class="section-header mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold"><i class="bi bi-check2-circle me-2 text-success"></i>Recent Found Items</h3>
        <a href="./?page=items&t=1" class="btn btn-sm btn-outline-light rounded-pill">View All</a>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php 
        $found = $conn->query("SELECT * FROM `item_list` where `status` = 1 and `type` = 1 order by unix_timestamp(`date_created`) desc limit 3");
        while($row = $found->fetch_assoc()):
        ?>
        <div class="col">
            <div class="card h-100 glass-card item-card">
                <img src="<?= validate_image($row['image_path']) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-truncate"><?= $row['title'] ?></h5>
                    <p class="card-text text-muted text-truncate small mb-3"><?= $row['description'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">Found</span>
                        <a href="./?page=items/view_item&id=<?= $row['id'] ?>" class="btn btn-sm btn-primary rounded-pill">Details</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<style>
    .item-card {
        transition: transform 0.3s ease, border-color 0.3s ease;
    }
    .item-card:hover {
        transform: scale(1.03);
        border-color: var(--accent-vibrant) !important;
    }
    .item-card img {
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid var(--glass-border);
    }
    .welcome-container .lead {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<div class="col-12 px-0">
    <div class="quick-actions-container mb-5 mt-n4 position-relative" style="z-index: 10;">
        <div class="glass-card p-4 rounded-4 shadow-lg border-white border-opacity-10">
            <div class="row align-items-center">
                <div class="col-md-6 border-end border-white border-opacity-10 text-center text-md-start mb-3 mb-md-0">
                    <h4 class="fw-bold mb-1"><i class="bi bi-lightning-charge text-warning me-2"></i>Quick Actions</h4>
                    <p class="text-muted small mb-0">Report an item securely to our system to help our community.</p>
                </div>
                <div class="col-md-6 ps-md-4">
                    <div class="d-flex gap-3 justify-content-center justify-content-md-end">
                        <a href="./?page=found" class="btn btn-primary btn-lg px-4 fw-bold shadow"><i class="bi bi-check-circle me-2"></i>Report Found Item</a>
                        <a href="./?page=lost" class="btn btn-outline-light btn-lg px-4 fw-bold shadow-sm"><i class="bi bi-search me-2"></i>Report Lost Item</a>
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
        $lost = $conn->query("SELECT * FROM `item_list` where `status` = 1 and `type` = 2 order by unix_timestamp(`created_at`) desc limit 3");
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
        $found = $conn->query("SELECT * FROM `item_list` where `status` = 1 and `type` = 1 order by unix_timestamp(`created_at`) desc limit 3");
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
    .item-card img {
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid var(--glass-border);
    }
</style>
<div class="container-xl py-5">
    <div class="row g-4">
        <!-- Category Sidebar -->
        <div class="col-lg-3">
            <div class="glass-card p-4">
                <h4 class="fw-bold mb-4 text-accent-glow">Categories</h4>
                <div class="nav flex-column nav-pills gap-2">
                    <a href="<?= base_url.'?page=items' ?>" class="nav-link glass-nav-link <?= !isset($_GET['cid']) ? 'active': '' ?>">
                        <i class="bi bi-grid-fill me-2 font-size-1.2rem"></i> All Categories
                    </a>
                    <?php 
                    $qry = $conn->query("SELECT * FROM `category_list` where `status` = 1 order by `name` asc");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <a href="<?= base_url.'?page=items&cid='.$row['id'] ?>" class="nav-link glass-nav-link <?= (isset($_GET['cid']) && $_GET['cid'] == $row['id']) ? 'active': '' ?>">
                        <i class="bi bi-tag me-2 font-size-1.2rem"></i> <?= $row['name'] ?>
                    </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Items Listing -->
        <div class="col-lg-9">
            <?php if(isset($cat['name'])): ?>
                <div class="glass-card p-4 mb-4">
                    <h2 class="fw-bold mb-2 text-accent-glow"><?= $cat['name'] ?></h2>
                    <?php if(isset($cat['description'])): ?>
                        <p class="text-muted mb-0"><?= str_replace("\n", "<br>", htmlspecialchars_decode($cat['description'])) ?></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="section-title mb-4">
                    <h2 class="fw-bold">All Lost & Found Items</h2>
                    <p class="text-muted">Browse through all reported items to find a match.</p>
                </div>
            <?php endif; ?>

            <?php 
            $where = "";
            if(isset($cat['id'])){
                $where = " and `category_id` = '{$cat['id']}'";
            }
            $items = $conn->query("SELECT * FROM `item_list` where `status` = 1 {$where} order by unix_timestamp(`created_at`) desc")->fetch_all(MYSQLI_ASSOC);
            ?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <?php if(count($items) > 0): ?>
                    <?php foreach($items as $row): ?>
                    <div class="col">
                        <a href="<?= base_url.'?page=items/view&id='.$row['id'] ?>" class="text-decoration-none">
                            <div class="card h-100 glass-card item-card-v2">
                                <div class="item-img-wrapper">
                                    <img src="<?= validate_image($row['image_path']) ?>" class="card-img-top" alt="<?= $row['title'] ?>">
                                    <?php if(isset($row['type']) && $row['type'] == 2): ?>
                                        <span class="badge-status lost">Lost</span>
                                    <?php else: ?>
                                        <span class="badge-status found">Found</span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title text-truncate mb-3"><?= $row['title'] ?></h5>
                                    <p class="card-text text-muted mb-4 line-clamp-3 small">
                                        <?= strip_tags(htmlspecialchars_decode($row['description'])) ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top border-white border-opacity-10">
                                        <span class="small text-muted"><i class="bi bi-clock me-1"></i><?= date("M d, Y", strtotime($row['created_at'])) ?></span>
                                        <span class="btn btn-sm btn-link text-accent-glow p-0 text-decoration-none fw-bold">View Detail <i class="bi bi-arrow-right ms-1"></i></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <div class="glass-card p-5">
                            <i class="bi bi-inbox text-muted display-1 mb-4"></i>
                            <h4 class="text-muted">No items found in this category.</h4>
                            <p class="text-muted small">Try checking another category or browse all items.</p>
                            <a href="<?= base_url.'?page=items' ?>" class="btn btn-primary mt-3">Browse All Items</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-nav-link {
        color: var(--text-muted) !important;
        background: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        transition: all 0.3s ease;
    }
    .glass-nav-link:hover, .glass-nav-link.active {
        background: var(--primary-gradient) !important;
        color: white !important;
        border-color: transparent !important;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }
    .item-card-v2 {
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease;
    }
    .item-card-v2:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3) !important;
    }
    .item-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    .item-img-wrapper img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .item-card-v2:hover .item-img-wrapper img {
        transform: scale(1.1);
    }
    .badge-status {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .badge-status.lost { background: rgba(239, 68, 68, 0.8); color: white; }
    .badge-status.found { background: rgba(34, 197, 94, 0.8); color: white; }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .text-accent-glow { color: var(--accent-glow) !important; }
</style>
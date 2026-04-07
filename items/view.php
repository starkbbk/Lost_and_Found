<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT *, COALESCE((SELECT `name` FROM `category_list` where `category_list`.`id` = `item_list`. `category_id` ) ,'N/A') as `category` from `item_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
		echo '<script>alert("item ID is not valid."); location.replace("./?page=items")</script>';
	}
}else{
	echo '<script>alert("item ID is Required."); location.replace("./?page=items")</script>';
}
?>
<div class="container-xl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card overflow-hidden shadow-2xl">
                <div class="row g-0">
                    <!-- Image Showcase -->
                    <div class="col-md-6 border-end border-white border-opacity-10 bg-black bg-opacity-20 d-flex align-items-center justify-content-center p-4">
                        <div class="detail-image-wrapper p-2 bg-white bg-opacity-5 rounded-xl border border-white border-opacity-10 shadow-lg">
                            <img src="<?= validate_image($image_path ?? "") ?>" class="img-fluid rounded-lg shadow-inner" alt="<?= $title ?? "" ?>">
                        </div>
                    </div>
                    
                    <!-- Information Panel -->
                    <div class="col-md-6 p-5 d-flex flex-column">
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <?php if(isset($type) && $type == 2): ?>
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">Lost Item</span>
                                <?php else: ?>
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Found Item</span>
                                <?php endif; ?>
                                <span class="badge bg-dark bg-opacity-50 text-muted px-3 py-2 rounded-pill border border-white border-opacity-10"><?= $category ?? "General" ?></span>
                            </div>
                            <h1 class="display-5 fw-black text-accent-glow mb-2"><?= $title ?? "Untitled Item" ?></h1>
                            <p class="text-muted small"><i class="bi bi-calendar3 me-2"></i>Reported on <?= date("F d, Y", strtotime($date_created ?? 'now')) ?></p>
                        </div>

                        <div class="flex-grow-1 overflow-auto custom-scrollbar mb-4 pe-2" style="max-height: 300px;">
                            <h6 class="text-uppercase fw-bold text-accent-glow small mb-3 letter-spacing-1">Description</h6>
                            <p class="text-muted leading-relaxed"><?= isset($description) ? str_replace("\n", "<br>", htmlspecialchars_decode($description)) : "No description provided." ?></p>
                        </div>

                        <div class="mt-auto border-top border-white border-opacity-10 pt-4">
                            <h6 class="text-uppercase fw-bold text-accent-glow small mb-3 letter-spacing-1">Contact Information</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary p-2 rounded-circle border border-primary border-opacity-20">
                                        <i class="bi bi-person-fill px-1"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Reported By</p>
                                        <p class="fw-bold mb-0"><?= $fullname ?? "Anonymous" ?></p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-circle bg-success bg-opacity-10 text-success p-2 rounded-circle border border-success border-opacity-20">
                                        <i class="bi bi-telephone-fill px-1"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Contact Number</p>
                                        <p class="fw-bold mb-0 font-monospace"><?= $contact ?? "N/A" ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-3">
                            <a href="./?page=items" class="btn btn-outline-light flex-grow-1"><i class="bi bi-arrow-left me-2"></i>Back to List</a>
                            <button onclick="window.print()" class="btn btn-primary px-4"><i class="bi bi-printer"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .detail-image-wrapper {
        width: 100%;
        max-width: 450px;
        transition: transform 0.5s ease;
    }
    .detail-image-wrapper:hover {
        transform: scale(1.02);
    }
    .detail-image-wrapper img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: contain;
    }
    .fw-black { font-weight: 900; }
    .letter-spacing-1 { letter-spacing: 0.1em; }
    .leading-relaxed { line-height: 1.7; }
    .text-accent-glow { color: var(--accent-glow) !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--accent-vibrant); border-radius: 10px; }
</style>
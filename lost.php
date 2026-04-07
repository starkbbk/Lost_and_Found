<div class="container-xl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-5">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-black text-accent-glow mb-2">Post Lost Item</h1>
                    <p class="text-muted">Provide as much detail as possible to help others identify your lost item.</p>
                    <div class="mx-auto bg-primary-gradient mt-3" style="width: 60px; height: 4px; border-radius: 2px;"></div>
                </div>

                <form action="" id="item-form">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="hidden" name="type" value="2">

                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="category_id" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Category</label>
                            <select name="category_id" id="category_id" class="form-select glass-input" required>
                                <option value="" disabled <?= !isset($category_id) ? "selected" : "" ?>>Select a category</option>
                                <?php 
                                $query = $conn->query("SELECT * FROM `category_list` where `status` = 1 order by `name` asc");
                                while($row=$query->fetch_assoc()):
                                ?>
                                <option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="fullname" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Owner Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control glass-input" value="<?php echo isset($fullname) ? $fullname : ''; ?>" placeholder="Enter your full name" required autofocus>
                        </div>

                        <div class="col-md-6">
                            <label for="contact" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Contact Number</label>
                            <input type="text" name="contact" id="contact" class="form-control glass-input" value="<?php echo isset($contact) ? $contact : ''; ?>" placeholder="e.g., +1 234 567 890" required>
                        </div>

                        <div class="col-md-12">
                            <label for="title" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Item Name</label>
                            <input type="text" name="title" id="title" class="form-control glass-input" value="<?php echo isset($title) ? $title : ''; ?>" placeholder="e.g., Blue Leather Wallet" required>
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Description</label>
                            <textarea rows="4" name="description" id="description" class="form-control glass-input" placeholder="Describe unique features, where you might have lost it..." required><?php echo isset($description) ? $description : ''; ?></textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Item Image (Optional)</label>
                            <div class="glass-file-upload mt-2">
                                <input type="file" id="customFile" name="image" class="d-none" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
                                <label for="customFile" class="upload-area d-flex flex-column align-items-center justify-content-center p-5 border-dashed rounded-xl cursor-pointer">
                                    <i class="bi bi-cloud-arrow-up display-4 text-accent-glow mb-2"></i>
                                    <span class="text-muted">Click to upload or drag and drop</span>
                                    <span class="text-muted small mt-1">(PNG, JPG up to 5MB)</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="image-preview-wrapper glass-card p-2 d-none" id="preview-container">
                                <img src="<?php echo validate_image(isset($image_path) ? $image_path :'') ?>" alt="Preview" id="cimg" class="img-fluid rounded-lg shadow-lg">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" form="item-form" class="btn btn-primary btn-lg w-100 py-3 shadow-glow">
                                <i class="bi bi-send-fill me-2"></i> Submit Lost Item Report
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-black { font-weight: 900; }
    .text-accent-glow { color: var(--accent-glow) !important; }
    .letter-spacing-1 { letter-spacing: 0.1em; }
    .bg-primary-gradient { background: var(--primary-gradient); }
    .glass-input {
        background: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        padding: 14px 20px !important;
    }
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.08) !important;
        border-color: var(--accent-vibrant) !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2) !important;
    }
    .upload-area {
        border: 2px dashed rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.02);
    }
    .upload-area:hover {
        border-color: var(--accent-vibrant);
        background: rgba(255, 255, 255, 0.05);
    }
    .cursor-pointer { cursor: pointer; }
    .shadow-glow { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4) !important; }
    .image-preview-wrapper { max-width: 300px; }
    #cimg { max-height: 250px; object-fit: contain; }
</style>

<script>
    function displayImg(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
                $('#preview-container').removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(){
        $('#category_id').select2({
            placeholder: 'Select a category',
            width: '100%',
            dropdownParent: $('#item-form')
        })
        $('#item-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_item",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        location.replace('./?page=items')
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>').addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").scrollTop(0);
                        end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                    }
                }
            })
        })
    })
</script>

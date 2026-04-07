<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="login-page">
  <style>
    /* body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      backdrop-filter: brightness(.7);
      overflow-x:hidden;
    } */
    /* #page-title{
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    } */
    .logo img {
        max-height: 55px;
        margin-right: 25px;
    }
    .logo span{
      color: #fff;
      text-shadow:0px 0px 10px #000;
    }
  </style>
  <main class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
      <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center w-100">
            <div class="col-lg-4 col-md-8 col-sm-10">

              <div class="text-center mb-5 mt-n4">
                <a href="<?= base_url ?>" class="logo d-inline-flex align-items-center justify-content-center gap-3 text-decoration-none">
                  <img src="<?= base_url ?>uploads/logo.jpg" class="rounded-circle border border-white border-opacity-10 shadow-lg" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                  <span class="site-title-glass"><?= $_settings->info('name') ?></span>
                </a>
              </div>

              <div class="glass-card p-4 p-md-5 shadow-2xl">
                <div class="text-center mb-5">
                    <h2 class="fw-black text-accent-glow mb-2">Admin Login</h2>
                    <p class="text-muted small">Please enter your credentials to access the dashboard.</p>
                </div>

                <form class="row g-4 needs-validation" novalidate id="login-frm">
                  <div class="col-12">
                    <label for="yourUsername" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Username</label>
                    <div class="input-group has-validation shadow-inner">
                      <span class="input-group-text glass-input border-end-0" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                      <input type="text" name="username" class="form-control glass-input border-start-0" id="yourUsername" placeholder="Enter username" required>
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label fw-bold text-accent-glow small text-uppercase letter-spacing-1">Password</label>
                    <div class="input-group has-validation shadow-inner">
                      <span class="input-group-text glass-input border-end-0" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                      <input type="password" name="password" class="form-control glass-input border-start-0" id="yourPassword" placeholder="Enter password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                  </div>

                  <div class="col-12 mt-5">
                    <button class="btn btn-primary btn-lg w-100 py-3 shadow-glow fw-black" type="submit">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Log In
                    </button>
                  </div>
                  
                  <div class="col-12 text-center mt-4">
                      <a href="<?= base_url ?>" class="btn btn-link text-muted text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Back to Site</a>
                  </div>
                </form>
              </div>

              <p class="text-center text-muted small mt-5 opacity-50">&copy; <?= date("Y") ?> <?= $_settings->info('name') ?>. All rights reserved.</p>

            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

<style>
    .site-title-glass {
        font-family: 'Outfit', sans-serif;
        font-weight: 900;
        font-size: 2rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .fw-black { font-weight: 900; }
    .text-accent-glow { color: var(--accent-glow) !important; }
    .letter-spacing-1 { letter-spacing: 0.1em; }
    .glass-input {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        padding: 12px 16px !important;
    }
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.1) !important;
        border-color: var(--accent-vibrant) !important;
        box-shadow: none !important;
    }
    .input-group-text.glass-input {
        background: rgba(255, 255, 255, 0.08) !important;
        color: var(--accent-glow) !important;
    }
    .shadow-glow { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4) !important; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; }
    .mt-n4 { margin-top: -1.5rem !important; }
</style>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- jQuery -->
<script src="<?= base_url ?>assets/js/jquery-3.6.4.min.js"></script>
<script src="<?= base_url ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url ?>assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?= base_url ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= base_url ?>assets/vendor/quill/quill.min.js"></script>
<script src="<?= base_url ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= base_url ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= base_url ?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url ?>assets/js/main.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>
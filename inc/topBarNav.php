<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="container-lg d-flex align-items-center justify-content-between px-4">
    <a href="<?= base_url ?>" class="logo d-flex align-items-center">
      <img src="<?= base_url ?>uploads/logo.jpg" alt="System Logo">
      <span class="d-none d-lg-block">Lost and Found</span>
    </a>

    <!-- Mobile Toggle Button -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list"></i>
    </button>

    <!-- Collapsible Wrapper -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
      <nav class="header-nav">
        <ul class="d-flex align-items-center h-100 flex-column flex-lg-row">
            <li class="nav-item pe-3">
                <a href="<?= base_url ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item pe-3">
                <a href="<?= base_url.'?page=items' ?>" class="nav-link">Lost and Found</a>
            </li>
            <li class="nav-item pe-3">
                <a href="<?= base_url.'?page=found' ?>" class="nav-link">Post Found Item</a>
            </li>
            <li class="nav-item pe-3">
                <a href="<?= base_url.'?page=lost' ?>" class="nav-link">Post Lost Item</a>
            </li>
            <li class="nav-item pe-3">
                <a href="<?= base_url."?page=about" ?>" class="nav-link">About</a>
            </li>
            <li class="nav-item pe-3">
                <a href="<?= base_url.'?page=contact' ?>" class="nav-link">Contact Us</a>
            </li>
            <li class="nav-item ps-3 mt-3 mt-lg-0">
                <a href="<?= base_url.'admin' ?>" class="btn btn-primary d-block w-100">Login</a>
            </li>
        </ul>
      </nav>
    </div>
  </div>

</header><!-- End Header -->
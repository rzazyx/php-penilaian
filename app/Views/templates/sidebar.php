<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">ASDP SISTEM</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if (session()->user_level == 'admin') { ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('cabang/index'); ?>">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data Cabang</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('vendor/index'); ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Vendor</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Acces
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('kontrak/index'); ?>">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kontrak</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('penilaian/index'); ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Penilaian</span></a>
        </li>

    <?php } ?>

    <?php if (session()->user_level == 'vendor') { ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            Acces
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('kontrak/index'); ?>">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kontrak</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('penilaian/index'); ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Penilaian</span></a>
        </li>
    <?php } ?>

    <?php if (session()->user_level == 'pic') { ?>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('penilaian/index'); ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Penilaian</span></a>
        </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('loginController/logout'); ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
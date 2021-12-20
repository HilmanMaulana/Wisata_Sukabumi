    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-0">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Wisata Sukabumi</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">
        
        <!-- Looping Menu-->
        
        <!-- Heading -->
        <div class="sidebar-heading">
        Master Data
        </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?= base_url('wisata/kategori'); ?>">
                        <i class="fa fa-fw fa-bars"></i>
                        <span>Kategori Wisata</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?= base_url('wisata'); ?>">
                        <i class="fa fa-fw fa-mountain"></i>
                        <span>Wisata ALam</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-0" href="<?= base_url('wisata/wisata_sejarah'); ?>">
                        <i class="fa fa-fw fa-archway"></i>
                        <span>Wisata Sejarah</span></a>
                </li>
            </li>


        <!-- Divider -->
        <hr class="sidebar-divider mt-3">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    </ul>
    <!-- End of Sidebar -- > 
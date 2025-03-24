<div id="loading-wrapper">
    <div class='spin-wrapper'>
        <div class='spin'>
            <div class='inner'></div>
        </div>
        <div class='spin'>
            <div class='inner'></div>
        </div>
        <div class='spin'>
            <div class='inner'></div>
        </div>
        <div class='spin'>
            <div class='inner'></div>
        </div>
        <div class='spin'>
            <div class='inner'></div>
        </div>
        <div class='spin'>
            <div class='inner'></div>
        </div>
    </div>
</div>

<div class="page-wrapper pinned">


    <!-- App header starts -->
    <div class="app-header d-flex align-items-center">

        <!-- Toggle buttons starts -->
        <div class="d-flex">
            <button class="toggle-sidebar">
                <i class="ri-menu-line"></i>
            </button>
            <button class="pin-sidebar">
                <i class="ri-menu-line"></i>
            </button>
        </div>
        <!-- Toggle buttons ends -->

        <!-- App brand starts -->
        <div class="app-brand ms-3">
            <a href="<?php echo APP_URL; ?>" class="d-lg-block d-none">
                <img src="<?php echo APP_URL; ?>app/views/images/logo.svg" class="logo" alt="BROSS">
            </a>
            <a href="<?php echo APP_URL; ?>dashboard" class="d-lg-none d-md-block">
                <img src="<?php echo APP_URL; ?>app/views/images/logo.svg" class="logo" alt="BROSS Admin ">
            </a>
        </div>
        <!-- App brand ends -->

        <!-- App header actions starts -->
        <div class="header-actions">



            <!-- Header actions starts -->
            <div class="d-lg-flex d-none gap-2">

                <!-- Notifications dropdown starts -->
                <div class="dropdown">
                    <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ri-list-check-3"></i>
                        <span class="count-label warning"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-300">
                        <h5 class="fw-semibold px-3 py-2 text-primary">Activity</h5>

                        <!-- Scroll starts -->
                        <div class="scroll300">

                            <!-- Activity List Starts -->
                            
                            <!-- Activity List Ends -->

                        </div>
                        <!-- Scroll ends -->

                        <!-- View all button starts -->
                        <div class="d-grid m-3">
                            <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                        </div>
                        <!-- View all button ends -->

                    </div>
                </div>
                <!-- Notifications dropdown ends -->



            </div>
            <!-- Header actions ends -->

            <!-- Header user settings starts -->
            <div class="dropdown ms-2">
                <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-box"><?php echo $_SESSION['nick'];?><span class="status busy"></span></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-lg">
                    <div class="px-3 py-2">
                        <span class="small">Admin</span>
                        <h6 class="m-0"><?php echo $_SESSION['nombre'];?></h6>
                    </div>
                    <div class="mx-3 my-2 d-grid">
                        <a href="<?php echo APP_URL."logOut/"; ?>" class="btn btn-danger" id="btn_exit">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Header user settings ends -->

        </div>
        <!-- App header actions ends -->

    </div>
    <!-- App header ends -->
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
                            <div class="p-3">
                                <ul class="p-0 activity-list2">
                                    <li class="activity-item pb-3 mb-3">
                                        <a href="#!">
                                            <h5 class="fw-regular">
                                                <i class="ri-circle-fill text-danger me-1"></i>
                                                Invoices.
                                            </h5>
                                            <div class="ps-3 ms-2 border-start">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/products/1.jpg"
                                                            class="img-shadow img-3x rounded-1"
                                                            alt="Hospital Admin Templates">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        23 invoices have been paid to the MediCare Labs.
                                                    </div>
                                                </div>
                                                <p class="m-0 small">10:20AM Today</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="activity-item pb-3 mb-3">
                                        <a href="#!">
                                            <h5 class="fw-regular">
                                                <i class="ri-circle-fill text-info me-1"></i>
                                                Purchased.
                                            </h5>
                                            <div class="ps-3 ms-2 border-start">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/products/2.jpg"
                                                            class="img-shadow img-3x rounded-1"
                                                            alt="Hospital Admin Templates">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        28 new surgical equipments have been purchased.
                                                    </div>
                                                </div>
                                                <p class="m-0 small">04:30PM Today</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="activity-item pb-3 mb-3">
                                        <a href="#!">
                                            <h5 class="fw-regular">
                                                <i class="ri-circle-fill text-success me-1"></i>
                                                Appointed.
                                            </h5>
                                            <div class="ps-3 ms-2 border-start">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/products/8.jpg"
                                                            class="img-shadow img-3x rounded-1"
                                                            alt="Hospital Admin Templates">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        36 new doctors and 28 staff members appointed.
                                                    </div>
                                                </div>
                                                <p class="m-0 small">06:50PM Today</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="activity-item">
                                        <a href="#!">
                                            <h5 class="fw-regular">
                                                <i class="ri-circle-fill text-warning me-1"></i>
                                                Requested
                                            </h5>
                                            <div class="ps-3 ms-2 border-start">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/products/9.jpg"
                                                            class="img-shadow img-3x rounded-1"
                                                            alt="Hospital Admin Templates">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        Requested for 6 new vehicles for medical emergency. .
                                                    </div>
                                                </div>
                                                <p class="m-0 small">08:30PM Today</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
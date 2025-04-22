<!-- Main container starts -->
<div class="main-container">

    <!-- Sidebar wrapper starts -->
    <nav id="sidebar" class="sidebar-wrapper">

        <!-- Sidebar profile starts -->
        <div class="sidebar-profile">
            <img src="<?php echo APP_URL; ?>app/views/fotos/<?php echo $_SESSION['foto']?>"
                class="img-shadow img-3x me-3 rounded-5" alt="Admin">
            <div class="m-0">
                <h5 class="mb-1 profile-name text-nowrap text-truncate"><?php echo $_SESSION['nombre'];?></h5>
                <p class="m-0 small profile-name text-nowrap text-truncate">Dept Admin</p>
            </div>
        </div>
        <!-- Sidebar profile ends -->

        <!-- Sidebar menu starts -->
        <div class="page-wrapper">
            <ul class="sidebar-menu">
                <li class="current-page">
                    <a href="<?php echo APP_URL; ?>dashboard">
                        <i class="ri-home-6-line"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo APP_URL; ?>userNew">
                        <i class="ri-home-smile-2-line"></i>
                        <span class="menu-text">Usuario Nuevo</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="ri-terminal-window-line"></i>
                        <span class="menu-text">Catálogos</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                        <a href="<?php echo APP_URL; ?>clienteAlta">Alta Cliente</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>bancoAlta">Alta Banco</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>razonAlta">Alta Razon </a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>proveedorAlta">Alta Provedor</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>colaboradoresAlta">Alta Colaboradores</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>VehiculosAlta">Alta Vehículos</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="ri-road-map-line"></i>
                        <span class="menu-text">Modulos</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                        <a href="<?php echo APP_URL; ?>cotizacion">Modulo Cotización</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>remision">Modulo Remisión</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="ri-notification-badge-line"></i>
                        <span class="menu-text">Vistas</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                        <a href="<?php echo APP_URL; ?>listColaboradores">Colaboradores</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>listClientes">Clientes</a>
                        </li>
                        <li>
                        <a href="<?php echo APP_URL; ?>listVehiculos">Vehiculos</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar menu ends -->

        <!-- Sidebar contact starts -->
        <div class="sidebar-contact">
            <p class="fw-light mb-1 text-nowrap text-truncate">Contact</p>
            <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
            <i class="ri-phone-line"></i>
        </div>
        <!-- Sidebar contact ends -->

    </nav>
    <!-- Sidebar wrapper ends -->

    <!-- App container starts -->
    <div class="app-container">

        <!-- App hero header starts -->
        <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                    <a href="<?php echo APP_URL; ?>dashboard">Home</a>
                </li>
                <li class="breadcrumb-item text-primary" aria-current="page">
                    <?php echo $url[0] ?>
                </li>
            </ol>
            <!-- Breadcrumb ends -->


        </div>
        <!-- App Hero header ends -->

        <!-- App body starts -->
        <div class="app-body">
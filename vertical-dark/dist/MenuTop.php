

<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown d-none d-lg-block">
            <div class="dropdown-menu dropdown-menu-right">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <img src="assets/images/flags/russia.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Russian</span>
                </a>

            </div>
        </li>

        <?php
            include "config/conexion.php";
            
            $result = $conexion->query("SELECT sum(cantidad) as cantidad from tcarrito;");
            if ($result) {
                while ($fila = $result->fetch_object()) {
                    if(($fila->cantidad)!=null)
                        echo '
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light"  href="carrito.php" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-cart noti-icon"></i>
                                <span class="badge badge-info noti-icon-badge">'.$fila->cantidad.'</span>
                            </a>
                        </li>';
                    else
                        echo '
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light"  href="carrito.php" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-cart noti-icon"></i>
                                <span class="badge badge-info noti-icon-badge">0</span>
                            </a>
                        </li>';
                }
            }
                
            
        ?>
        
        <li class="dropdown notification-list">
        
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="assets/images/users/user.png" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                   <?php echo $nombre;?> <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h6 class="m-0">
                        Bienvenido a Greeva!
                    </h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-user"></i>
                    <span><?php echo $_SESSION["tipo"];?></span>
                </a>                

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="cerrarSesion.php" class="dropdown-item notify-item" >
                    <i class="dripicons-power"></i>
                    <span>Cerrar sesion</span>
                </a>

            </div>
        </li>

    </ul>

    <ul class="list-unstyled menu-left mb-0">
        <li class="float-left">
            <a href="Contenido.php" class="logo">
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="22">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="24">
                </span>
            </a>
        </li>
        <li class="float-left">
            <a class="button-menu-mobile navbar-toggle">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </li>
    </ul>
</div>
            
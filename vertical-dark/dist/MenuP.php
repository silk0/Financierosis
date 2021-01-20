<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <?php if($_SESSION["tipo"]=="Administrador" or $_SESSION["tipo"]=="Vendedor" ){ 
            echo '<li class="menu-title">Ventas e inventario</li>';}?>
        <?php if($_SESSION["tipo"]=="Administrador" or $_SESSION["tipo"]=="Vendedor"){
        echo '
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-24px  mdi-account-multiple"></i>
                    <span>Clientes </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="ingresoCliente.php">Nuevo Cliente</a>
                    </li>
                    <li>
                        <a href="listaCliente.php">Lista de Clientes</a>
                    </li>
                </ul>
            </li>
        
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-24px mdi-shield-account"></i>
                    <span> Fiadores </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="ingresoFiador.php">Nuevo Fiador</a>
                    </li>
                    <li>
                        <a href="listaFiador.php">Lista de Fiadores</a>
                    </li>
                </ul>
            </li>'
            ;}?>
        <?php if($_SESSION["tipo"]=="Administrador"){
        echo '
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-24px mdi-truck-check"></i>
                    <span> Proveedores </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="IngresoProveedor.php">Nuevo Proveedor</a>
                    </li>
                    <li>
                        <a href="ListaProveedor.php">Lista de Proveedores</a>
                    </li>
                </ul>
            </li>'
        ;}?>
        <?php if($_SESSION["tipo"]=="Administrador"){
        echo '
        <li>
            <a href="javascript: void(0);">
                <i class="mdi mdi-24px mdi-account-card-details"></i>
                <span> Empleados </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a href="ingresoEmpleado.php">Nuevo Empleado</a>
                </li>
                <li>
                    <a href="listaEmpleado.php">Lista de Empleados</a>
                </li>
            </ul>
        </li>'
        ;}?>
        <?php if($_SESSION["tipo"]=="Administrador" or $_SESSION["tipo"]=="Vendedor"){
        echo '
            <li>
                <a href="javascript: void(0);">
                    <i class=" mdi mdi-24px mdi-dropbox"></i>
                    <span>Inventario</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="ingresarProducto.php">Nuevo Articulo</a>
                    </li>
                    <li>
                        <a href="listadoProducto.php">Lista de Articulos</a>
                    </li>
                    <li>
                        <a href="ingresoCategoria.php">Categoria de Articulos</a>
                    </li>
                </ul>
            </li>'
        ;}?>
        <?php if($_SESSION["tipo"]=="Administrador" or $_SESSION["tipo"]=="Vendedor"){
        echo '
            <li>
            <a href="javascript: void(0);">
                    <i class="mdi mdi-24px mdi-cart"></i>
                    <span>ventas</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="venderContado.php">Ventas al contado</a>
                    </li>
                    <li>
                        <a href="venderCredito.php">Ventas al credito</a>
                    </li>  
                    <li>
                        <a href="listaVentas.php">Ventas y pagos</a>
                    </li> 
                                
                </ul>
            </li>
            <li>
            <a href="cuentasCobrar.php">
                    <i class="mdi mdi-24px mdi-book-open-page-variant"></i>
                    <span>Cuentas por cobrar</span>                
                </a>
            </li>'
        ;}?>
        <?php if($_SESSION["tipo"]=="Administrador" or $_SESSION["tipo"]=="Activo Fijo"){
        echo '
            <li class="menu-title">Activo</li>
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-24px mdi-notebook"></i>
                    <span>Activo Fijo</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="ingresoActivo.php">Registro Activo</a>
                    </li>
                    <li>
                        <a href="listaActivos.php">Listado de Activo</a>
                    </li> 
                    <li>
                        <a href="ingresoInstituciones.php">Instituciones</a>
                    </li>
                    <li>
                        <a href="departamentos.php">Unidades</a>
                    </li>  
                    <li>
                        <a href="tiposActivo.php">Tipos de Activo</a>
                    </li>
                    <li>
                        <a href="clasificacionActivo.php">Clasificaciòn de Activo</a>
                    </li>              
                </ul>
            </li>'
        ;}?>
       <li class="menu-title">Otros</li>
            <li>
                <a href="Contenido.php">
                    <i class=" mdi mdi-24px mdi-chart-areaspline"></i>
                    <span>Estadisticas</span>                
                </a>
            </li>

    </ul>

</div>

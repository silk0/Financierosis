<?php
//Codigo que muestra solo los errores exceptuando los notice.
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    if($_SESSION["logueado"] == TRUE) {
        $usuario=$_SESSION["usuario"];
        $nombre = $_SESSION["nombre"];
        $tipo  = $_REQUEST["tipo"];
        $id  = $_REQUEST["id"];
    }else {
        header("Location:../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>

<body >

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include_once 'MenuTop.php';?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="slimscroll-menu">

                <!--- Sidemenu -->
                <?php include_once 'MenuP.php';?>
                <!-- End Sidebar -->               

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">                                
                                <h4 class="page-title">Venta</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
    
                                <!-- Logo & title -->
                                <div class="clearfix">
                                    <div class="float-left">
                                        <img src="assets/images/logo-dark.png" alt="logo_dark" height="20" class="d-none d-print-inline-block">
                                        <img src="assets/images/logo-light.png" alt="logo_light" height="20" class="d-print-none">

                                    </div>
                                    <div class="float-right">
                                        <h4 class="m-0 d-print-none">Venta al contado</h4>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                        <label for="inputState" class="col-form-label">Clientes</label>
                                            <select  class="form-control" name="cartera" id="cartera" style="overflow-y: scroll;" required >
                                                <option selected >Seleccione</option>
                                                <?php
                                                include 'config/conexion.php';
                                                $result = $conexion->query("select id_cliente as id, CONCAT(nombre, ' ', apellido) as nombre, apellido  FROM tclientes");
                                                if ($result) {
                                                    while ($fila = $result->fetch_object()) {
                                                        
                                                        echo '<option value="' . $fila->id . '">' . $fila->nombre .'</opcion>';
                                                        
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
    
                                    </div><!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mt-2 float-right">
                                            
                                            <?php 
                                                include 'config/conexion.php';
                                                $fecha_actual = date("d-m-Y");
                                                $hoy = date("d-m-Y",strtotime($fecha_actual."- 1 days"));
                                                echo'
                                                    <p><strong>Fecha : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp; '. $hoy .'</span></p>
                                                ';
                                                $result = $conexion->query("SHOW TABLE STATUS LIKE 'tventas'");
                                                if ($result) {
                                                    while ($fila = $result->fetch_object()) {                                               
                                                        $codigoR=str_pad($fila->Auto_increment, 6, "0", STR_PAD_LEFT);
                                                        echo'<p><strong>Venta No. : </strong> <span class="float-right">'. $codigoR .'</span></p>';
                                                    }
                                                } 
                                                echo'<p><strong>NRC : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp; 0</span></p>
                                                     <p><strong>NIT : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp; 0</span></p>';                                             

                                            ?>
                                            
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->
    
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mt-4 table-centered">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%">Codigo</th>
                                                    <th>Articulo</th>
                                                    <th style="width: 10%" class="text-center">Cantidad</th>
                                                    <th style="width: 10%" class="text-center">Precio Unitario</th>
                                                    <th style="width: 10%" class="text-right">Total</th>
                                                </tr></thead>
                                                <tbody>
                                               
                                                <?php
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("
                                                        select p.codigo,p.nombre, p.descripcion, p.precio_venta,
                                                        t.cantidad, p.precio_venta*t.cantidad,p.precio_venta*t.cantidad as total
                                                        FROM tcarrito t
                                                        inner join tproducto as p on p.id_producto=t.id_producto
                                                        order by p.codigo asc;
                                                    ");
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {                                                                               
                                                            
                                                            echo '
                                                            <tr>
                                                                <td>' . $fila->codigo . '</td>
                                                                <td>
                                                                    <b>' . $fila->nombre . '</b> 
                                                                    <br/>
                                                                    ' . $fila->descripcion . '
                                                                </td>
                                                                <td class="text-center">' . $fila->cantidad . '</td>
                                                                <td class="text-center">$' . $fila->precio_venta . '</td>
                                                                <td class="text-right">$' . $fila->total . '</td>
                                                            </tr>
                                                            ';                                                                                
                                                        }
                                                    }
                                                ?>                                                    
                                                
    
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive -->
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="clearfix pt-5">
                                            <h6>Notes:</h6>
    
                                            <small class="text-muted">
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                            </small>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="float-right pt-4">
                                            <?php
                                                include 'config/conexion.php';
                                                $result = $conexion->query("
                                                    select CONCAT('$',sum(p.precio_venta*t.cantidad)) as total
                                                    FROM tcarrito t
                                                    inner join tproducto as p on p.id_producto=t.id_producto;
                                                ");
                                                
                                                if ($result) {
                                                    while ($fila = $result->fetch_object()) {                                                                               
                                                        
                                                        echo '
                                                        <p><b>Total pagar:</b> <span class="float-right">' . $fila->total . '</span></p>
                                                        ';                                                                                
                                                    }
                                                }
                                            ?>                                            
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
    
                                <div class="mt-4 mb-1">
                                    <div class="text-right d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light">
                                            <i class="mdi mdi-printer mr-1"></i> Print
                                        </a>
                                        <a href="#" class="btn btn-info waves-effect waves-light">Realizar venta</a>                                        
                                    </div>
                                </div>
                            </div>
    
                        </div>
    
                    </div>
                    <!-- end row -->
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-center">
                        <?php echo date('Y'); ?> - Financiero UES-FMP 
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php include_once 'Pie.php';?>

</body>

</html>
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
<script  language=JavaScript> 
    function eliminar(id_pro){
        //validacion respectiva me da hueva
        document.getElementById("id_producto").value=id_pro;
        $("#carritoForm").submit();;         
    } 
</script>

<body>

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
                                <h4 class="page-title"></h4>
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
                                        <h4 class="m-0 d-print-none">Carrito de articulos</h4>
                                    </div>
                                </div>      
    
                                <div class="row">
                                    <div class="col-12">
                                    <form id="carritoForm" name="carritoForm" method="post" action="scriptsphp/ajaxCarrito.php?op=2"  class="parsley-examples">
                                       <input type="hidden" id="id_producto" name="id_producto">
                                        <div class="table-responsive">
                                            <table class="table mt-4 table-centered">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%">Quitar</th>
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
                                                        select p.id_producto as id,p.codigo,p.nombre, p.descripcion, p.precio_venta,
                                                        t.cantidad,p.precio_venta*t.cantidad as total
                                                        FROM tcarrito t
                                                        inner join tproducto as p on p.id_producto=t.id_producto
                                                        order by p.codigo asc;
                                                    ");
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {                                                                               
                                                            
                                                            echo "
                                                            <tr>
                                                                <td align='center'> 
                                                                    <span  data-toggle='modal' data-target='#verProducto'>                                                                                                                          
                                                                        <button
                                                                        button type='button'
                                                                        title='Quitar articulo del carrito'
                                                                        data-toggle='tooltip' 
                                                                        data-placement='bottom'                                                                     
                                                                        class='btn btn-icon btn-danger waves-effect waves-light' onclick=\"
                                                                        eliminar(
                                                                        '$fila->id'                                                                        
                                                                        )\";>
                                                                            <i class='mdi mdi-close'></i> 
                                                                        </button>  
                                                                    </span>
                                                                </td>
                                                                <td>$fila->codigo</td>
                                                                <td>
                                                                    <b>$fila->nombre</b> 
                                                                    <br/>
                                                                    $fila->descripcion
                                                                </td>
                                                                <td class='text-center'> $fila->cantidad</td>
                                                                <td class='text-center'>$ $fila->precio_venta</td>
                                                                <td class='text-center'>$ $fila->total</td>
                                                            </tr>
                                                            ";                                                                                
                                                        }
                                                    }
                                                ?>                                                    
                                                

                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive -->
                                    </form>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="clearfix pt-5">
                                            
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="float-right pt-4">
                                            <?php
                                                include 'config/conexion.php';
                                                $result = $conexion->query("
                                                    select sum(p.precio_venta*t.cantidad) as total
                                                    FROM tcarrito t
                                                    inner join tproducto as p on p.id_producto=t.id_producto;
                                                ");
                                                if ($result) {
                                                    while ($fila = $result->fetch_object()) {                                                                               
                                                        
                                                        echo '
                                                        <p><b>Sub-total:</b> <span class="float-right">&nbsp;&nbsp;&nbsp;$' . $fila->total . ' USD</span></p>
                                                        ';                                                                                
                                                    }
                                                }
                                            ?>                                             
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
    
                        </div>
    
                    </div>
                                        
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
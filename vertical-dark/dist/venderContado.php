<?php
//Codigo que muestra solo los errores exceptuando los notice.
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    if($_SESSION["logueado"] == TRUE) {
        $usuario = $_SESSION["usuario"];
        $nombre = $_SESSION["nombre"];
        $tipo  = $_REQUEST["tipo"];
        $id  = $_SESSION["id"];
    }else {
        header("Location:../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>
<SCRIPT  language=JavaScript> 
    function go(){
        //validacion respectiva me da hueva
        $("#venderContado").submit();;         
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
                                <form action="scriptsphp/ajaxPagoContado.php?bandera=0" id="venderContado" name="venderContado" method="POST" class="parsley-examples">
                                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $_SESSION["id"];?>" >
                                                <label for="inputState" class="col-form-label">Clientes</label>
                                                <select class="form-control" data-toggle="select2" name="cliente" id="cliente" required >
                                                    <option selected >Seleccione</option>
                                                    <?php
                                                    include 'config/conexion.php';
                                                    $duiC=null;
                                                    $nitC=null;
                                                    $direccionC=null;
                                                    $nombreC=null;
                                                    $result = $conexion->query("select id_cliente as id, CONCAT(nombre, ' ', apellido) as nombre, dui, nit, direccion  FROM tclientes");
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {
                                                            $duiC = $fila->dui;
                                                            $nitC = $fila->nit;
                                                            $nombreC=$fila->nombre;
                                                            $direccionC = $fila -> direccion;
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
                                                    $codigoR = null;
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {                                               
                                                            $codigoR=str_pad($fila->Auto_increment, 6, "0", STR_PAD_LEFT);
                                                            echo'                                                                
                                                                <input type="hidden" name="venta" id="venta" value="' . $codigoR . '" >
                                                                <p><strong>Venta No. : </strong> <span class="float-right">'. $codigoR .'</span></p>
                                                                
                                                            ';
                                                        }
                                                    }


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
                                                    $result = $conexion->query("select CONCAT(' $',sum(p.precio_venta*t.cantidad)) as subtotal,
                                                        CONCAT(' $',ROUND(sum(p.precio_venta*t.cantidad)*0.13,1)) as iva,
                                                        CONCAT(' $', (sum(p.precio_venta*t.cantidad)*0.13)+sum(p.precio_venta*t.cantidad)) as total
                                                        FROM tcarrito t
                                                        inner join tproducto as p on p.id_producto=t.id_producto;
                                                    ");
                                                    
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {                                                                               
                                                            
                                                            echo '
                                                                <input type="hidden" name="total" id="total" value="' . $fila->total . '" >
                                                                <p><b>Sub-total: </b> <span class="float-right">' . $fila->subtotal . '</span></p>
                                                                <p><b>Iva (13%): </b> <span class="float-right">' . $fila->iva . '</span></p>
                                                                <h4><p><b>Total: </b> <span class="float-right">' . $fila->total . '</span></p></h4>
                                                            ';                                                                                
                                                        }
                                                    }
                                                ?>                                            
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </form>
                                <div class="mt-4 mb-1">
                                    <div class="text-right d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light">
                                            <i class="mdi mdi-printer mr-1"></i> Factura credito fiscal
                                        </a>
                                        <a data-toggle='modal' data-target='#consumidorFinal' class="btn btn-primary waves-effect waves-light">
                                            <i class="mdi mdi-printer mr-1"></i> Factura consumidor final
                                        </a>
                                        <a type=button onclick="go();" class="btn btn-info waves-effect waves-light">Realizar venta</a>                                        
                                    </div>
                                </div>
                            </div>
    
                        </div>
    
                    </div>
                    <!-- end row -->
                    <!-- Bootstrap Modals -->
                    <div class="row">
                        <div class="col-12">                               
                            <!--  Modal mostrar Factura consumidor Final-->
                            <div id="consumidorFinal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-box">
                                                        <form  method="post"  class="parsley-examples" readonly>
                                                        
                                                            <h4 class="header-title" align="center">FACTURA DE CONSUMIDOR FINAL</h4>
                                                            <div class="row ">
                                                                <div class="col-md-3">
                                                                    
                                                                </div> <!-- end col -->
                                                                <div class="col-md-3">
                                                                    
                                                                </div> <!-- end col -->
                                                                <div class="col-md-3">
                                                                    
                                                                </div> <!-- end col -->
                                                                <div class="col-md-3" >
                                                                    <div class="text-md-right">
                                                                        <div class="line-h-24 " align="left" style=" padding: 5px 5px 5px 5px;
                                                                                                                        border: solid;">
                                                                            <label>Factura No. <?php echo $codigoR;?></label>
                                                                            <br>
                                                                            <label>NRC:</label><br>
                                                                            <LABEL>NIT:</LABEL><br>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end col -->
                                                            </div> 
                                                            <div class="row mt-3">
                                                                <div class="col-md-8">    
                                                                    <h6>Cliente: <small><?php echo $nombreC;?></small></h6>                                   
                                                                    <h5>Direccion: <?php echo $direccionC;?></h5>
                                                                    <h5>Dui: <?php echo $duiC;?>   Nit: <?php echo $nitC;?></h5>
                                                                </div> <!-- end col -->
                                
                                                                <div class="col-md-4">
                                                                    <div class="text-md-right" >
                                                                        <h5>Fecha: </h5>
                                                                        <h5>Condicion venta: </h5>
                                                                        <h5>vendedor: </h5>                                            
                                                                    </div>
                                                                </div> <!-- end col -->
                                                            </div>    
                                                            </br>                     		
                                                            <div class="col-12">      
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-striped mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center" style="width: 10%"><small>Cantidad</small></th>
                                                                                <th><small>Descripcion</small></th>
                                                                                <th style="width: 10%"><small>Precio unitario</small></th>
                                                                                <th style="width: 10%"><small>Ventas sujetas</small></th>
                                                                                <th style="width: 10%"><small>Vts no sujetas</small></th>     
                                                                                <th style="width: 10%"><small>Ventas gravadas</small></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td><small>540px</small></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td><small>540px</small></td>                      
                                                                                <td><small>540px</small></td>
                                                                            </tr>          
                                                                        </tbody>                                            
                                                                    </table>
                                                                    <table class="table table-bordered table-striped mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="padding: 0px; width: 49.5%;" >
                                                                                    <table class="table table-bordered table-striped mb-0">       
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td  style="height: 50px;"><small>Son:</small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center" style="padding: 0px 0px 0px 0px; height: 5px;"><small>Llenar si la operacion es igual o superior a $200</small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="padding: 0px 0px 0px 0px;">
                                                                                                    <table class="table table-bordered table-striped mb-0">       
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td style="padding: 10px 0px 5px 0px;">
                                                                                                                    <small>Recibido:</small>
                                                                                                                    </br>
                                                                                                                    <small>Nombre:</small>
                                                                                                                    </br>
                                                                                                                    <small>D.u.i.:</small>
                                                                                                                    </br>
                                                                                                                    <small>Firma:</small>
                                                                                                                </td>
                                                                                                                <td style="padding: 10px 0px 5px 0px;">
                                                                                                                    <small>Entregado:</small>
                                                                                                                    </br>
                                                                                                                    <small>Nombre:</small>
                                                                                                                    </br>
                                                                                                                    <small>D.u.i.:</small>
                                                                                                                    </br>
                                                                                                                    <small>Firma:</small>
                                                                                                                </td>
                                                                                                            </tr>                  
                                                                                                        </tbody>                     
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>                     
                                                                                    </table>
                                                                                </th>
                                                                                <th style="width: 19%; padding: 0px 0px 5px 10px;">
                                                                                    <small>SUMAS</small>
                                                                                    </br>
                                                                                    <small>13% IVA</small>
                                                                                    </br>
                                                                                    <small>SUB-TOTAL</small>
                                                                                    </br>
                                                                                    <small>(-)IVA RETENIDO</small>
                                                                                    </br>
                                                                                    <small>VENTAS EXENTAS</small>
                                                                                    </br>
                                                                                    <small>VENTAS NO SUJETAS</small>
                                                                                    </br>
                                                                                    <small>VENTA TOTAL</small>
                                                                                </th>  
                                                                                <th style="width: 19.5%; padding: 0px 0px 5px 10px;" class="text-md-right">
                                                                                    <small>$</small>
                                                                                    </br>
                                                                                <small>$</small>
                                                                                    </br>
                                                                                    <small>$</small>
                                                                                    </br>
                                                                                    <small>$</small>
                                                                                    </br>
                                                                                    <small>$</small>
                                                                                    </br>
                                                                                    <small>$</small>
                                                                                    </br>
                                                                                    <small>$</small>
                                                                                    </br>
                                                                                </th>
                                                                                <th style="width: 10.4%;"></th>   
                                                                            </tr>
                                                                        </thead>                                                                                                                           
                                                                    </table>
                                                                </div> <!-- end table-responsive-->
                                                                
                                                            </div> <!-- end col -->                                                            
                                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">                                                                                
                                            <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"><span>Guardar Cambios</span><i class="mdi mdi-content-save ml-1"></i></button> 
                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal --> 
                            <!--  Modal mostrar ComprarProductos-->
                            <div id="creditoFiscal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="tituloC" name="tituloC">Comprar producto</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-box">
                                                        <form id="comprarProducto" name="comprarProducto" method="post"  class="parsley-examples" readonly>                                                            
                                                        
                                                            <div class="form-row">                                                               
                                                                <div class="form-group col-md-6">
                                                                    <input type="hidden" class="form-control" name="id" id="id">
                                                                </div>                                                                   
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="codigoC" class="col-form-label">Codigo</label>
                                                                    <input type="text" class="form-control" name="codigoC" id="codigoC" readonly
                                                                        placeholder="0000000">
                                                                </div> 
                                                                <div class="form-group col-md-6">
                                                                    <label for="nombreC" class="col-form-label">Nombre</label>
                                                                    <input type="text" class="form-control" name="nombreC" id="nombreC" readonly
                                                                        placeholder="Nombre">
                                                                </div>                                                                   
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="idproveedorC" class="col-form-label">Proveedor</label>
                                                                    <select  class="form-control" name="idproveedorC" id="idproveedorC" disabled >
                                                                    <option value='0' selected>Seleccione</option>
                                                                    <?php
                                                                        include 'config/conexion.php';
                                                                        $result = $conexion->query("select id_proveedor, nombre, representante,email FROM tproveedor");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                                                                
                                                                                echo '<option value="' . $fila->id_proveedor . '">' . $fila->nombre . ' - ' . $fila->representante . ' ('. $fila->email .')</opcion>';                                                                                
                                                                            }
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="stock" class="col-form-label">Precio</label>
                                                                    <input type="number" class="form-control" name="precioC" id="precioC" 
                                                                        placeholder="$0.00">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="stock" class="col-form-label">Cantidad</label>
                                                                    <input type="number" class="form-control" name="cantidadC" id="cantidadC"
                                                                        placeholder="$0.00">
                                                                </div>
                                                            </div> 

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="stock" class="col-form-label">Precio Total</label>
                                                                    <input type="text" class="form-control" name="precioTC" id="precioTC" 
                                                                        placeholder="$0.00" readonly>
                                                                </div>                                                                
                                                            </div>   
                                                                                        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">    
                                            <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal">Registrar compra</button>
                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->                                            
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
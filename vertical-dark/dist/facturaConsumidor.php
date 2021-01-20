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
                        	<div class="card-box col-md-12">
                        		<h4 class="header-title" align="center">FACTURA DE CONSUMIDOR FINAL</h4>
                        		<div class="row ">
                                    <div class="col-md-3">
                                        
                                    </div> <!-- end col -->
                                    <div class="col-md-3">
                                        
                                    </div> <!-- end col -->
                                    <div class="col-md-3">
                                        
                                    </div> <!-- end col -->
                                    <div class="col-md-3" >
                                    <?php
                                   
                                     ?>
                                        <div class="text-md-right">
                                            <div class="line-h-24 " align="left" style=" padding: 5px 5px 5px 5px;
                                                                                            border: solid;">
                                                                                            <?php 
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("SHOW TABLE STATUS LIKE 'tventas'");
                                                    $codigoR = null;
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {                                               
                                                            $codigoR=str_pad($fila->Auto_increment, 6, "0", STR_PAD_LEFT);
                                                            echo'<label>Factura No.'.$codigoR .'</label>';
                                                        }
                                                    }


                                                ?>
                                            
                                                <br>
                                                <label>NRC:1559-33</label><br>
                                                <LABEL>NIT:1010-269638-102-9</LABEL><br>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> 
                                <div class="row mt-3">
                                    <div class="col-md-6">   
                                    <?php  $id  = $_REQUEST["id_client"];
                                    $result = $conexion->query("SELECT*FROM tclientes WHERE id_cliente='$id'");
                                    if ($result) {
                                        while ($fila = $result->fetch_object()) { 
                                        echo "<h6>Cliente:  $fila->nombre $fila->apellido </h6>";                                  
                                       echo " <h6>Direccion:  $fila->direccion</h6>";
                                       echo " <h6>Dui:  $fila->dui    Nit:   $fila->nit</h6>"; }} ?>
                                    </div> <!-- end col -->
    
                                    <div class="col-md-6">
                                        <div class="text-md-right" >
                                        <?php 
                                                    include 'config/conexion.php';
                                                    $fecha_actual = date("d-m-Y");
                                                    $hoy = date("d-m-Y",strtotime($fecha_actual."- 1 days"));
                                                    echo'
                                            <h6>Fecha: '. $hoy .'</h6>';
                                            ?>
                                            <h6>Condicion venta: Contado</h6>
                                            <h6>vendedor: <?php echo $_SESSION["ncompleto"];?> </h6>                                            
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
                                                    <th style="width: 10%"><small>Ventas no sujetas</small></th>     
                                                    <th style="width: 10%"><small>Ventas gravadas</small></th>
                                                </tr>
                                            </thead>
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
                                                            $j=17;
                                                            while ($fila = $result->fetch_object()) {                                                                               
                                                                $j--;
                                                                echo '
                                                                <tr>
                                                                    <td class="text-center" style="padding: 4px 4px 4px 4px; height: 10px;"><small>' . $fila->cantidad . '</small></td>
                                                                    <td style="padding: 0px 0px 0px 0px; height: 10px;">
                                                                        <small>' . $fila->nombre . '</small>
                                                                    </td>
                                                                    
                                                                    <td style="padding: 0px 0px 0px 0px; height: 10px;" class="text-center"><small>$' . $fila->precio_venta . '</small></td>
                                                                    <td style="padding: 0px 0px 0px 0px; height: 10px;"></td>
                                                                    <td style="padding: 0px 0px 0px 0px; height: 10px;"><small></small></td>
                                                                    <td style="padding: 0px 0px 0px 0px; height: 10px;" class="text-center"><small>$' . $fila->total . '</small></td>
                                                                    
                                                                </tr>
                                                                ';                                                                                
                                                            }
                                                            for ($i=$j; $i >0 ; $i--) { 
                                                                echo '
                                                                <tr>
                                                                    <td class="text-center"><small></small></td>
                                                                    <td>
                                                                        <small></small>
                                                                    </td>
                                                                    
                                                                    <td class="text-center"><small></small></td>
                                                                    <td></td>
                                                                    <td><small></small></td>
                                                                    <td class="text-center"><small></small></td>
                                                                    
                                                                </tr>
                                                                ';
                                                            }
                                                        }
                                                    ?>
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
                                                    <th style="width: 10.4%; padding: 0px 0px 5px 10px;" class="text-md-letf">
                                                    <?php
                                                            include 'config/conexion.php';
                                                            $result = $conexion->query("select sum(p.precio_venta*t.cantidad) as subtotal,
                                                                ROUND(sum(p.precio_venta*t.cantidad)*0.13,1) as iva,
                                                                 (sum(p.precio_venta*t.cantidad)*0.13)+sum(p.precio_venta*t.cantidad) as total,
                                                                (sum(p.precio_venta*t.cantidad)*0.13)+sum(p.precio_venta*t.cantidad) as tota
                                                                FROM tcarrito t
                                                                inner join tproducto as p on p.id_producto=t.id_producto;
                                                            ");
                                                            
                                                            if ($result) {
                                                                while ($fila = $result->fetch_object()) {                                                                               
                                                                    
                                                                    echo '
                                                                        <small>' . $fila->subtotal . '</small>
                                                                        </br>
                                                                        <small>' . $fila->iva . '</small></p>
                                                                        
                                                                        </br>
                                                                        <small></small>
                                                                        </br>
                                                                        <small></small>
                                                                        </br>
                                                                        <small>' . $fila->total . '</small>
                                                                        </br>
                                                                        
                                                                    ';                                                                                
                                                                }
                                                            }
                                                        ?> 
                                                </th>   
                                                
                                                </tr>
                                            </thead>                                                                                                                           
                                        </table>
                                    </div> <!-- end table-responsive-->
	                                
	                            </div> <!-- end col -->
	                            <div class="mt-4 mb-1">
	                                <div class="text-right d-print-none">
	                                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Imprimir</a>
	                                    
	                                </div>
	                            </div>
                            </div> <!-- end card-box -->
                        </div>
                    <!-- end page title -->
                                        
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
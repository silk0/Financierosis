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
<script>
    function go(idventa){
    //validacion respectiva me da hueva
        if(idventa>0){
            $url = "coutasCredito.php?id="+idventa;
            window.open($url,"_blank"); 
        }                 
    } 

</script>
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
        <!-- ============================================================== 

        Consultas que agregar

        /*Cambio de saldo de la tabla tventas*/
        update tventas v set v.saldo_actual= if(v.prestamo_original-(select truncate(sum(monto),2)+truncate(sum(mora),2)
        from tpago where id_venta=v.id_venta and estado=1)<0,0,v.prestamo_original-(select truncate(sum(monto),2)+truncate(sum(mora),2)
        from tpago where id_venta=v.id_venta and estado=1)),
            v.mora_acumulada = (select truncate(sum(mora),2) from tpago where id_venta=v.id_venta and estado=2)
        where v.id_venta = 28;

        /*Calculo de mora de tabla tpago*/
        update tpago as p inner join tventas v on p.id_venta = v.id_venta
            set p.estado= if(curdate()>p.fecha, 2, p.estado),
            p.mora=((v.interes/100)*p.monto*(DATEDIFF(p.fecha,curdate())*-1))
        where curdate()>p.fecha;
    
    
        -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Listado de Empleado</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <form id="fCartera" name="fCartera" action="" method="GET" class="parsley-examples">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th>Venta</th>                                                
                                                <th>Saldo</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("select d.id_detalleventa as id,t.fecha as fecha, concat(t2.nombre,' ',t2.apellido) as cliente, concat('Venta NO.',t.codigo) as venta,
                                                                concat('$ ',t.saldo_actual) as saldo, t.estado as estado
                                                        from tdetalle_venta  as d
                                                        inner join tventas t on d.id_venta = t.id_venta
                                                        inner join tclientes t2 on t.id_cliente = t2.id_cliente
                                                        where d.tipo=1;
                                            ");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->fecha . "</td>";
                                                echo "<td>" . $fila->cliente . "</td>";                                                
                                                echo "<td>" . $fila->venta. "</td>";
                                                echo "<td>" . $fila->saldo . "</td>";
                                                echo "<td>" . $fila->estado. "</td>";                                                
                                                echo "<td align='center'>    
                                                <span data-toggle='modal'                                                    
                                                data-target='#ver'>                                             
                                                    <button 
                                                    button type='button' title='Ver cuotas' data-toggle='tooltip' 
                                                    data-placement='bottom'                            
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    go(
                                                        '$fila->id'
                                                    )\";>
                                                        <i class='mdi mdi-eye'></i> 
                                                    </button></span>                                                    
                                                </div>
                                                </td>";
                                                echo "</tr>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </form>
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
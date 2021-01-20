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
<script>
    function obtenerId(id){
    //validacion respectiva me da hueva
        if(id>0){
            document.getElementById("id").value=id;
            $("#idCuota").submit();  
        }                 
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
                        <?php
                        include "config/conexion.php";
                        $result = $conexion->query("
                        select d.id_detalleventa as id,t.fecha as fecha, concat(t2.nombre,' ',t2.apellido) as cliente, concat('Venta NO.',t.codigo) as venta,
                        concat('$ ',truncate(t.saldo_actual,2)) as saldo, t.estado as estado
                        from tdetalle_venta  as d
                        inner join tventas t on d.id_venta = t.id_venta
                        inner join tclientes t2 on t.id_cliente = t2.id_cliente
                        where d.tipo=1 and d.id_detalleventa='".$_REQUEST["id"]."';");
                        
                        if ($result) {
                            while ($fila = $result->fetch_object()) {
                                echo "<div class='card-box'>
                                    <div class='form-row' align='center'>
                                    <div class='form-group col-md-3'>                                
                                        <label for='inputEmail4' class='col-form-label'>Cliente: <span >".$fila->cliente."</span></label><br>                                        
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label for='inputEmail4' class='col-form-label'><span >". $fila->venta."</span></label><br>
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label for='inputEmail4' class='col-form-label'>Saldo: <span >".$fila->saldo."</span></label><br>
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label for='inputEmail4' class='col-form-label'>Estado: <span >".$fila->estado."</span></label><br>
                                    </div>
                                </div>
                                </div>";
                                }
                            }
                        ?>
                        </div>
                    </div>
                    <?php
                        include 'config/conexion.php';
                        $result = $conexion->query("select p.id_pago, p.monto, p.fecha,p.mora,p.estado
                            from tpago p
                            inner join tventas v on p.id_venta = v.id_venta
                            inner join tdetalle_venta dv on v.id_venta = dv.id_venta
                            where dv.id_detalleventa='".$_REQUEST["id"]."';
                        ");
                        echo '<form id="idCuota" name="form" method="post" action="scriptsphp/pagarCuota.php?bandera=1"
                                class="parsley-examples">
                            <input type="hidden" id="id" name="id">
                        ';
                        if ($result) {
                            while ($fila = $result->fetch_object()) {                                                                               
                                echo '<div class="row">';
                                $b=0;
                                while($b<3 and ($fila->fecha)!=null){
                                    
                                    echo '<div class="col-lg-4">
                                            <div class="card-box ribbon-box">';
                                            if(($fila->estado)==0)
                                                echo '<div class="ribbon ribbon-primary   float-left">Pendiente</div>';
                                            if(($fila->estado)==1)
                                                echo '<div class="ribbon ribbon-success float-left">Cancelado</div>';
                                            if(($fila->estado)==2)
                                                echo '<div class="ribbon ribbon-danger float-left">Moroso</div>';
                                             echo '<div class="ribbon-content">
                                                <h4>fecha de pago: '.$fila->fecha.'</h4>
                                                <p class="mb-0">Monto: '.$fila->monto.'</p>
                                                <p class="mb-0">Mora: '.$fila->mora.'</p>  
                                                </br>';
                                                if(($fila->estado)==1)
                                                    echo '<button type=button onclick="obtenerId('.$fila->id_pago.');"                                                
                                                    class="btn btn-info waves-effect waves-light" disabled>Pagar</button>';
                                                else
                                                    echo '<button type=button onclick="obtenerId('.$fila->id_pago.');"                                                
                                                    class="btn btn-info waves-effect waves-light" >Pagar</button>';                            
                                           echo'</div>                                    
                                            </div> 
                                        </div>';
                                    if($b!=2)
                                        $fila = $result->fetch_object();
                                    $b++;
                                }
                                echo '</div>';
                                                                                                             
                            }
                            
                        }echo '</form>';
                    ?>
                    <!-- end page title -->
                  

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
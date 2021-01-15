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
function edi(){
    //validacion respectiva me da hueva
    //enviarDatos(2);
    $("#editarForm").submit();;      
} 

    function edit(nom, tiempo, corre) {
        // document.getElementById("baccion2").value=id;
        document.getElementById("nombrev").value = nom;
        document.getElementById("tiempo").value = tiempo;
        document.getElementById("correv").value = corre;
    }

    function modify(id,nom, tiem, corre) {
        document.getElementById("id_clasificacion").value = id;
        document.getElementById("nombrem").value = nom;
        document.getElementById("timpo").value = tiem;
        document.getElementById("correm").value = corre;
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
                                <h4 class="page-title">Clasificacion de Activos</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- STAR row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div align="right"><button type="button"
                                        class="btn btn-outline-success btn-rounded waves-effect waves-light width-md"
                                        data-toggle='modal' data-target='#nuevo'>Nuevo</button>
                                </div>
                                <br>
                                <h4 class="header-title"></h4>
                                <p class="sub-header">
                                </p>
                                <form id="fCartera" name="fCartera" action="" method="GET" class="parsley-examples">

                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Clasificacion</th>
                                                <th>Tiempo Depreciacion</th>
                                                <th>Correlativo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT * from tclasificacion ORDER BY nombre");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->tiempo_depreciacion . "</td>";
                                                echo "<td>" . $fila->correlativo . "</td>";
                                                
                                                echo "<td> 
                                                <span data-toggle='modal'                                                    
                                                data-target='#ver'>                                                
                                                    <button 
                                                    type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                          
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                        '$fila->id_clasificacion',
                                                        '$fila->nombre',
                                                        '$fila->correlativo',
                                                        '$fila->tiempo_depreciacion',
                                                        
                                                    )\";><i class='mdi mdi-eye'></i> 
                                                    </button></span>
                                                    <span data-toggle='modal'                                                    
                                                    data-target='#editar'>
                                                    <button 
                                                    type='button' title='Modificar' data-toggle='tooltip' 
                                                    data-placement='bottom'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                        '$fila->nombre',
                                                         '$fila->tiempo_depreciacion',
                                                        '$fila->correlativo',
                                                    )\";>                                                    
                                                        <i class='mdi mdi-pencil-outline'></i></i>
                                                    </button></span>
                                                </div>
                                                </td>";
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

                     
 <!-- Bootstrap Modals -->
 <div class="row">
                        <div class="col-12">
                            <div class="">
                                 <!--  Modal AGREGAR -->
                                 <div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Datos Clasificacion</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form action="clasificacionActivo.php" method="POST"
                                                                class="parsley-examples">

                                                                <div class="form-row">
                                                                    <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'tclasificacion'");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                               
                                                                                $codigoR=str_pad($fila->Auto_increment, 4, "300", STR_PAD_LEFT);
                                                                                echo'
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="inputEmail4"
                                                                                        class="col-form-label">Correlativo</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="corre" id="corre" value ="'.$codigoR.'" required placeholder="0000" readonly>
                                                                                </div>
                                                                                ';
                                                                            }
                                                                        } 
                                                                    ?>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Nombre</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombre" id="nombre" required
                                                                            placeholder="Nombre de la Clasificacion">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Tiempo Depreciacion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tip" id="tip" required
                                                                            placeholder="0">
                                                                    </div>

                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="agregar"
                                                            class="btn  btn-primary waves-effect">Regisrar</button>
                                                        <button type="button" class="btn  btn-primary waves-effect"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>

                                                    </form><!-- form-->
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                            </div> <!-- container -->
                        </div> <!-- FIN BOOSTRA MODAL -->

                                <!--  Modal VER-->
                     <div id="ver" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Informaciòn Clasificacion</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="form" id="form" method="post" action="" required
                                                                class="parsley-examples">

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Clasificacion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombrev" id="nombrev" required
                                                                            placeholder="Nombre de la clasificaion"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Tiempo Depreciacion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tiempo" id="tiempo" required readonly>
                                                                    </div>
                                                                    <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'tclasificacion'");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                               
                                                                                $codigoR=str_pad($fila->Auto_increment, 4, "300", STR_PAD_LEFT);
                                                                                echo'
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="inputEmail4"
                                                                                        class="col-form-label">Correlativo</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="correv" id="correv" value ="'.$codigoR.'" required placeholder="0000" readonly>
                                                                                </div>
                                                                                ';
                                                                            }
                                                                        } 
                                                                    ?>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-primary waves-effect"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!--  Modal EDITAR-->
                                <div id="editar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Modificar Datos Clasificacion</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarClasificacion.php?bandera=1" required
                                                                class="parsley-examples">
                                                                <div class="form-row">
                                                                <input type="hidden" id="id_clasificacion" name="id_clasificacion">
                                                            </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Clasificacion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombrem" id="nombrem" required
                                                                            placeholder="Nombre Clasificacion">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Tiempo Depreciacion</label>
                                                                        <select class="form-control" name="instim"
                                                                            id="timpo">
                                                                            <?php
                                                                                  include 'config/conexion.php';
                                                                                    $result = $conexion->query("select id_clasificacion as id,nombre FROM tclasificacion");
                                                                                     if ($result) {
                                                                                        while ($fila = $result->fetch_object()) {                                                                                
                                                                                        echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                                                         }
                                                                                    }
                                                                                ?>
                                                                        </select>
                                                                    </div>
                                                                    <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'tclasificacion'");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                               
                                                                                $codigoR=str_pad($fila->Auto_increment, 4, "300", STR_PAD_LEFT);
                                                                                echo'
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="inputEmail4"
                                                                                        class="col-form-label">Correlativo</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="correm" id="correm" value ="'.$codigoR.'" required placeholder="0000" readonly>
                                                                                </div>
                                                                                ';
                                                                            }
                                                                        } 
                                                                    ?>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn  btn-primary waves-effect" id="cambios"
                                                    name="cambios" onclick="edi();">Guardar Cambios</button>
                                                <button type="button" class="btn  btn-primary waves-effect"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                        </div>
                    </div><!-- FIN Bootstrap Modals -->

                </div> <!-- container -->
            </div> <!-- content -->
        </div> <!-- container -->


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

<?php
    include "config/conexion.php";
        $accion = $_REQUEST['bandera'];
        if($accion==1){
        $nombre   = $_POST['nombre'];
        $tiempo   = $_POST['tip'];
        $corre   = $_POST['corre'];
        $consulta  = "INSERT INTO tclasificacion VALUES('null','" .$tiempo. "','" .$nombre. "','" .$corre. "')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            msgI("Los datos fueron almacenados con exito");
        } else {
            msgE("Los datos no pudieron almacenarce");
        }     
    }
function msgI($texto)
{
    echo "<script type='text/javascript'>";
    echo "notify('Exito','$texto','top', 'right', 'any', 'success');";
    echo "</script>";
}
function msgA($texto)
{
    echo "<script type='text/javascript'>";
    echo "notify('Advertencia','$texto','top', 'right', 'any', 'warning');";
    echo "</script>";
}
function msgE($texto)
{
    echo "<script type='text/javascript'>";
    echo "notify('Error','$texto','top', 'right', 'any', 'danger');";
    echo "</script>";
}
?>
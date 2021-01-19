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
<SCRIPT language=JavaScript>
    function go() {
        //validacion respectiva me da hueva
        $("#editarForm").submit();;
    }

    function edit(nom, clasi, corre) {
        //document.getElementById("baccion2").value=id;
        document.getElementById("correv").value = corre;
        document.getElementById("nomv").value = nom;
        document.getElementById("clasiv").value = clasi;
        
    }

    function modify(id, nomb, clas, correl) {
        document.getElementById("id_tipo").value = id;
        document.getElementById("correm").value = correl;
        document.getElementById("nomm").value = nomb;
        document.getElementById("clasim").value = clas;
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
                                <h4 class="page-title">Tipos de Activo</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div align="right"><button type="button"
                                class="btn  btn-primary waves-effect"
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
                                                <th>Correlativo</th>
                                                <th>Tipo de Activo</th>
                                                <th>Clasificaciòn</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT ttipo_activo.nombre, tclasificacion.nombre as clasi, ttipo_activo.correlativo, ttipo_activo.id_tipo FROM ttipo_activo INNER JOIN tclasificacion ON ttipo_activo.id_clasificacion = tclasificacion.id_clasificaion ORDER BY id_tipo");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->correlativo . "</td>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->clasi . "</td>";
                                                echo "<td> 
                                                <span data-toggle='modal'                                                    
                                                data-target='#ver'>                                                
                                                    <button 
                                                    type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                          
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                        '$fila->nombre',
                                                        '$fila->clasi',
                                                        '$fila->correlativo'
                                                    )\";><i class='mdi mdi-eye'></i> 
                                                    </button></span>
                                                    <span data-toggle='modal'                                                    
                                                    data-target='#editar'>
                                                    <button 
                                                    type='button' title='Modificar' data-toggle='tooltip' 
                                                    data-placement='bottom'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                        '$fila->id_tipo',
                                                        '$fila->nombre',
                                                        '$fila->clasi',
                                                        '$fila->correlativo'
                                                        
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
                                <!--  Modal NUEVO-->
                                <div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form method="POST" action="tiposActivo.php" class="parsley-examples">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Datos del Activo
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card-box">
                                                                <div class="form-row">
                                                                <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'ttipo_activo'");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                               
                                                                                $codigoR=str_pad($fila->Auto_increment, 4, "0", STR_PAD_LEFT);
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
                                                                </div>
                                                                <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Tipo de
                                                                            Activo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombre" id="nombre" required
                                                                            placeholder="Nombre del Tipo de Activo">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Clasificaciòn</label>
                                                                        <select class="form-control" name="clasi"
                                                                            id="clasi">
                                                                            <?php
                                                                                  include 'config/conexion.php';
                                                                                    $result = $conexion->query("select id_clasificaion as id,nombre FROM tclasificacion");
                                                                                     if ($result) {
                                                                                        while ($fila = $result->fetch_object()) {                                                                                
                                                                                        echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                                                         }
                                                                                    }
                                                                                ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn  btn-primary waves-effect"
                                                        id="cambios" name="agg">Registrar</button>
                                                    <button type="button" class="btn btn-light waves-effect"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </form>
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!--  Modal VER-->
                                <div id="ver" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Informaciòn de Tipo Activo</h4>
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
                                                                <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'ttipo_activo'");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                               
                                                                                $codigoR=str_pad($fila->Auto_increment, 4, "0", STR_PAD_LEFT);
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
                                                                <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Tipo de
                                                                            Activo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nomv" id="nomv" required readonly>
                                                                </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Clasificaciòn</label>
                                                                        <input type="text" class="form-control"
                                                                            name="clasiv" id="clasiv" required readonly>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
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
                                                <h4 class="modal-title">Modificar Datos del Tipo Activo</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post"
                                                                action="scriptsphp/modificarTipo.php?bandera=1" required
                                                                class="parsley-examples">
                                                                <div class="form-row">
                                                                    <input type="hidden" id="id_tipo" name="id_tipo">
                                                                </div>
                                                                <div class="form-row">
                                                                <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'ttipo_activo'");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                               
                                                                                $codigoR=str_pad($fila->Auto_increment, 4, "0", STR_PAD_LEFT);
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
                                                                <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Tipo de
                                                                            Activo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nomm" id="nomm" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Clasificaciòn</label>
                                                                        <select class="form-control" name="clasim"
                                                                            id="clasim">
                                                                            <?php
                                                                                  include 'config/conexion.php';
                                                                                    $result = $conexion->query("select id_clasificaion as id,nombre FROM tclasificacion");
                                                                                     if ($result) {
                                                                                        while ($fila = $result->fetch_object()) {                                                                                
                                                                                        echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                                                         }
                                                                                    }
                                                                                ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-primary waves-effect" id="cambios"
                                                    name="cambios" onclick="go();">Guardar Cambios</button>
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                        </div>
                    </div><!-- FIN Bootstrap Modals -->

                </div>
            </div> <!-- container -->
        </div> <!-- content -->

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

<?php
    include "config/conexion.php";
      //  $accion = $_REQUEST[''];
        if(isset($_POST['agg'])){
        $nombre   = $_POST['nombre'];
        $clasi   = $_POST['clasi'];
        $corre   = $_POST['corre'];
        $consulta  = "INSERT INTO ttipo_activo (id_clasificacion,nombre,correlativo) VALUES('$clasi','$nombre','$corre')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            msgI("Los datos fueron almacenados con exito");
        } else {
            msgE("Los datos no pudieron almacenarce");
        }   
        echo '<script>location.href="tiposActivo.php";</script>';  
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
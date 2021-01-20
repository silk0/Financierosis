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
    function go() {
        //Validaciones
        if (document.getElementById('nombre').value == "") {
            notify(' Advertencia:', 'El campo Nombre es obligatorio.', 'top', 'right', 'any', 'warning');
            document.getElementById("nombre").focus();
        } else if (document.getElementById('insti').value == "") {
            notify(' Advertencia:', 'El campo Instituciòn es obligatorio,', 'top', 'right', 'any', 'warning');
            document.getElementById("apellido").focus();
        } else if (document.getElementById('corre').value == "") {
            notify(' Advertencia:', 'El campo Correlativo es obligatorio', 'top', 'right', 'any', 'warning');
            document.getElementById("corre").focus();
        } else {
            document.form.submit();
        }
    }

    function edi(){
    //validacion respectiva me da hueva
    //enviarDatos(2);
    $("#editarForm").submit();;      
} 

    function edit(nom, insti, corre) {
        // document.getElementById("baccion2").value=id;
        document.getElementById("nombrev").value = nom;
        document.getElementById("instiv").value = insti;
        document.getElementById("correv").value = corre;
    }

    function modify(id,nom, insti, corre) {
        document.getElementById("id_departamento").value = id;
        document.getElementById("nombrem").value = nom;
        document.getElementById("instim").value = insti;
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
                                <h4 class="page-title">Unidades</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- STAR row -->
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
                                                <th>Unidad</th>
                                                <th>Instituciòn</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT tdepartamento.nombre,tdepartamento.correlativo,tinstitucion.nombre as nombrei,tdepartamento.id_departamento FROM tinstitucion INNER JOIN tdepartamento ON tdepartamento.id_institucion = tinstitucion.id_institucion ORDER BY id_departamento");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->correlativo . "</td>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->nombrei . "</td>";
                                                echo "<td> 
                                                <span data-toggle='modal'                                                    
                                                data-target='#ver'>                                                
                                                    <button 
                                                    type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                          
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                        '$fila->nombre',
                                                        '$fila->nombrei',
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
                                                        '$fila->id_departamento',
                                                        '$fila->nombre',
                                                        '$fila->nombrei',
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
                                    <form method="POST" action="departamentos.php" required class="parsley-examples">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Datos de la Unidad
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
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'tdepartamento'");
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
                                                                            class="col-form-label">Unidad</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombre" id="nombre" required
                                                                            placeholder="Nombre de la Unidad">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Instituciòn</label>
                                                                        <select class="form-control" name="insti"
                                                                            id="insti">
                                                                            <?php
                                                                                  include 'config/conexion.php';
                                                                                    $result = $conexion->query("select id_institucion as id,nombre FROM tinstitucion");
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
                                                <button type="submit" class="btn  btn-primary waves-effect" id="cambios"
                                                    name="cambios">Registrar</button>
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
                                                <h4 class="modal-title">Informaciòn de la Unidad</h4>
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
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'tdepartamento'");
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
                                                                            class="col-form-label">Unidad</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombrev" id="nombrev" required
                                                                            placeholder="Nombre de de la Unidad"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Instituciòn</label>
                                                                        <input type="text" class="form-control"
                                                                            name="instiv" id="instiv" required readonly>
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
                                                <h4 class="modal-title">Modificar Datos de la Unidad</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarDpto.php?bandera=1" required
                                                                class="parsley-examples">
                                                            <div class="form-row">
                                                                <input type="hidden" id="id_departamento" name="id_departamento">
                                                            </div>
                                                                <div class="form-row">
                                                                <?php 
                                                                        include 'config/conexion.php';                                                                        
                                                                        $result = $conexion->query("SHOW TABLE STATUS LIKE 'tdepartamento'");
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
                                                                            class="col-form-label">Unidad</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombrem" id="nombrem" required
                                                                            placeholder="Nombre de la Unidad">
                                                                    </div>
                                                                <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Instituciòn</label>
                                                                        <select class="form-control" name="instim"
                                                                            id="instim">
                                                                            <?php
                                                                                  include 'config/conexion.php';
                                                                                    $result = $conexion->query("select id_institucion as id,nombre FROM tinstitucion");
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
                                                    name="cambios" onclick="edi();">Guardar Cambios</button>
                                                <button type="button" class="btn btn-light waves-effect"
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
        if(isset($_POST['cambios'])){
        $nombre   = $_POST['nombre'];
        $insti   = $_POST['insti'];
        $corre   = $_POST['corre'];
        $consulta  = "INSERT INTO tdepartamento (id_institucion,nombre,correlativo) VALUES('$insti','$nombre','$corre')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            msgI("Los datos fueron almacenados con exito");
        } else {
            msgE("Los datos no pudieron almacenarce");
        }    
        echo '<script>location.href="departamentos.php";</script>';  
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
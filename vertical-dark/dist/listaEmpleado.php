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
        header("Location:../../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<script>
    function go(){
    //validacion respectiva me da hueva
    $("#editarForm").submit();;         
} 
    function edit(id, nom, ape, dui, rol, usu, contra, dir) {
        // document.getElementById("baccion2").value=id;
        document.getElementById("nombrev").value = nom;
        document.getElementById("apellidov").value = ape;
        document.getElementById("duiv").value = dui;
        document.getElementById("rolv").value = rol;
        document.getElementById("usuariov").value = usu;
        document.getElementById("contrav").value = contra;
        document.getElementById("direcv").value = dir;
    }

    function modify(id, nom, ape, dui, rol, usu, contra, dir) {
        // document.getElementById("baccion2").value=id;
        document.getElementById("id_empleado").value = id;
        document.getElementById("nombrem").value = nom;
        document.getElementById("apellidom").value = ape;
        document.getElementById("duim").value = dui;
        document.getElementById("rolm").value = rol;
        document.getElementById("usuariom").value = usu;
        document.getElementById("contram").value = contra;
        document.getElementById("direcm").value = dir;
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
        <!-- ============================================================== -->

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
                                                <th>DUI</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Direcciòn</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT * from templeados ORDER BY nombre");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->dui . "</td>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->apellido . "</td>";
                                                echo "<td>" . $fila->zona . "</td>";
                                                echo "<td style='width: 10%;' align='center'>    
                                                <span data-toggle='modal'                                                    
                                                data-target='#ver'>                                             
                                                    <button 
                                                    button type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                            
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                        '$fila->id_empleado',
                                                        '$fila->nombre',
                                                        '$fila->apellido',
                                                        '$fila->dui',
                                                        '$fila->rol',
                                                        '$fila->usuario',
                                                        '$fila->pass',
                                                        '$fila->zona'
                                                    )\";>
                                                        <i class='mdi mdi-eye'></i> 
                                                    </button></span>
                                                    <span data-toggle='modal'                                                    
                                                    data-target='#editar'>
                                                    <button 
                                                    type='button' title='Modificar' data-toggle='tooltip' 
                                                    data-placement='bottom'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                        '$fila->id_empleado',
                                                        '$fila->nombre',
                                                        '$fila->apellido',
                                                        '$fila->dui',
                                                        '$fila->rol',
                                                        '$fila->usuario',
                                                        '$fila->pass',
                                                        '$fila->zona'
                                                    )\";>                                                    
                                                        <i class='mdi mdi-pencil-outline'></i></i>
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

                    <!-- Bootstrap Modals -->
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <!--  Modal mostrar -->
                                <div id="ver" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Informacion del Empleado
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="form" required class="parsley-examples">

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Nombre</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombrev" id="nombrev" required
                                                                            placeholder="Jose Alfredo" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Apellido</label>
                                                                        <input type="text" class="form-control"
                                                                            name="apellidov" id="apellidov" required
                                                                            placeholder="Rodriguez Perez" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Dui</label>
                                                                        <input type="text" class="form-control"
                                                                            name="duiv" id="duiv" required
                                                                            data-mask="99999999-9"
                                                                            placeholder="99999999-9" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Rol</label>
                                                                        <input type="text" class="form-control"
                                                                            name="rolv" id="rolv" required
                                                                            placeholder="" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Usuario</label>
                                                                        <input type="text" class="form-control"
                                                                            name="usuariov" id="usuariov" required
                                                                            placeholder="Usuario" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Contraseña</label>
                                                                        <input type="password" class="form-control"
                                                                            placeholder="Password" name="contrav"
                                                                            id="contrav" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="inputAddress"
                                                                            class="col-form-label">Direccion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="direcv" id="direcv" required
                                                                            placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23"
                                                                            readonly>
                                                                    </div>
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
                                <!--  Modal editar -->
                                <div id="editar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Editar Datos del Empleado
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarEmpleado.php?bandera=1" required class="parsley-examples">
                                                            <div class="form-row">
                                                                <input type="hidden" id="idfiador" name="idfiador">
                                                                <input type="hidden" id="id_empleado" name="id_empleado">
                                                            </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Nombre</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombrem" id="nombrem" required
                                                                            placeholder="Jose Alfredo">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Apellido</label>
                                                                        <input type="text" class="form-control"
                                                                            name="apellidom" id="apellidom" required
                                                                            placeholder="Rodriguez Perez">
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Dui</label>
                                                                        <input type="text" class="form-control"
                                                                            name="duim" id="duim" required
                                                                            data-mask="99999999-9"
                                                                            placeholder="99999999-9" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"
                                                                            class="col-form-label">Rol</label>
                                                                        <select class="form-control" name="rolm"
                                                                            id="rolm" required>
                                                                            <option selected>Seleccione</option>
                                                                            <option>Administrador</option>
                                                                            <option>Vendedor</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Usuario</label>
                                                                        <input type="text" class="form-control"
                                                                            name="usuariom" id="usuariom" required
                                                                            placeholder="Usuario" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Contraseña</label>
                                                                        <input type="password" class="form-control"
                                                                            placeholder="Password" name="contram"
                                                                            id="contram" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="inputAddress"
                                                                            class="col-form-label">Direccion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="direcm" id="direcm" required
                                                                            placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23"
                                                                            >
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
                                                <button type="button" class="btn  btn-primary waves-effect"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
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
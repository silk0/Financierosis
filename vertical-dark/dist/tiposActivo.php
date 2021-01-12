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
                                                <th>Tipo de Activo</th>
                                                <th>Clasificaciòn</th>
                                                <th>Correlativo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                                <th>Tipo de Activo</th>
                                                <th>Clasificaciòn</th>
                                                <th>Correlativo</th>
                                                <th>Acciones</th>
                                            </tr>
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
                                <!--  Modal editar fiador-->
                                <div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Datos del Activo
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post"
                                                                action="scriptsphp/modificarFiador.php?bandera=1"
                                                                required class="parsley-examples">

                                                                <div class="form-row">
                                                                    <input type="hidden" id="idfiador" name="idfiador">
                                                                    <input type="hidden" id="id_fiador"
                                                                        name="id_fiador">
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Tipo de Activo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombre" id="nombre" required
                                                                            placeholder="Nombre del Activo">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                    <label for="inputState" class="col-form-label">Clasificaciòn</label>
                                                                    <select class="form-control" name="carteram" id="carteram" >                                                                        
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
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Correlativo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="celular" id="celular" required
                                                                            data-mask="9999"
                                                                            placeholder="9999">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-primary waves-effect" id="cambios"
                                                    name="cambios" onclick="go();">Regisrar</button>
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
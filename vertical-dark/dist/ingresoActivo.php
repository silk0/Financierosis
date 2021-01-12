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
                            <div class="page-title-box" >                                
                                <h4 class="page-title">Registro de Activo Fijo</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Ingreso de datos generales</h4>     
                                <form name="form" method="post" action="ingresoActivo.php?bandera=1" required class="parsley-examples">
                                <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                    <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Tipo de Activo</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                <option selected >Seleccione</option>
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Departamento</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                <option selected >Seleccione</option>
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Proveedor</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                <option selected >Seleccione</option>
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Encargado</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                <option selected >Seleccione</option>
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Tipo Adquisicion</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                <option selected >Seleccione</option>
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Valor de Activo</label>
                                            <input type="text"  class="form-control" name="telefono" id="telefono" required  data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Marca</label>
                                            <input type="text" class="form-control" name="celular" id="celular" required data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Correlativo</label>
                                            <input type="text" class="form-control" name="celular" id="celular" required data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                        <textarea class="form-control" id="observ" name="observ" rows="5"></textarea>
                                    </div> 
                                    
                                     </br>
                                    <div class="form-row"> 
                                    <div class="form-group">
                                        <button type="buttom" onclick="go();" class="btn btn-success btn-rounded waves-light width-md">Registrar</button>                                        
                                        <button type="reset"  class="btn btn-danger btn-rounded waves-light width-md">Cancelar</button>  
                                    </div>                                      
                                    </div>
                                </form>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
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
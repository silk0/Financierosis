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
                                <h4 class="page-title" align="center">Registro de Proveedor</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Ingreso de datos generales del Proveedor</h4>     
                                <form name="form" method="post" action="IngresoProveedor.php?bandera=1" required class="parsley-examples">
                                <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Nombre</label>
                                            <input type="text"  class="form-control" name="nombre" id="nombre" required  placeholder="Jose Alfredo">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Telefono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono" required data-mask="9999-9999"  placeholder="9999-9999">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="inputAddress" class="col-form-label">Direccion</label>
                                        <input type="text" class="form-control"  name="direc" id="direc" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23">
                                    </div>
                                    </div>  
                                    </br>                            
                                    <h4 class="header-title">Datos del representante del proveedor</h4>                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Representante</label>
                                            <input type="text"  class="form-control" name="repre" id="repre" required  placeholder="Jose Alfredo">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Dui</label>
                                            <input type="text"  class="form-control" name="dui" id="dui" required  data-mask="99999999-9" placeholder="99999999-9">
                                        </div>
                                    </div>
                                    <div class="form-row"> 
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Nit</label>
                                            <input type="text" class="form-control" name="nit" id="nit" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Celular</label>
                                            <input type="text" class="form-control" name="cel" id="cel" required data-mask="9999-9999"  placeholder="9999-9999">
                                        </div>
                                        
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Email</label>
                                            <input type="email"  class="form-control" name="email" id="email"  required  placeholder="Correo@correo.com">
                                        </div>
                                     
                                    </div> 
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

<?php
    include "config/conexion.php";
    $accion = $_REQUEST['bandera'];
        if($accion==1){
        $nombre   = $_POST['nombre'];
        $telefono   = $_POST['telefono'];
        $direccion   = $_POST['direc'];
        $representante   = $_POST['repre'];
        $dui  = $_POST['dui'];
        $nit   = $_POST['nit'];
        $cel   = $_POST['cel'];
        $email   = $_POST['email'];
        $consulta  = "INSERT INTO tproveedor VALUES('null','" .$nombre. "','" .$direccion. "','" .$telefono. "','" .$representante. "','" .$dui. "','" .$nit. "','" .$cel. "','" .$email. "')";
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
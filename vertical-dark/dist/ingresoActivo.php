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
function enviar(){
        var idt=document.getElementById("tipoA").value;
        var idd=document.getElementById("depa").value;
       
        if(idt=="Seleccione" || idd=="Seleccione"){
           // notify(' Advertencia:','Seleccione el tipo de activo y el departamento al que pertenece para generar correlativo','top', 'right', 'any', 'warning');
        }else{
            $.ajax({
        data:{"id":5,"idd":idd,"idt":idt,},
        url: 'scriptsphp/recuperarCorrelativo.php',
        type: 'post',
        beforeSend: function(){
          notify('Exito','Codigo Generado','top', 'right', 'any', 'success');
        },
        success: function(response){
            document.getElementById("correlativo").value=response;
        }
        });
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
                            <div class="page-title-box">
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
                                <form name="form" method="post" action="ingresoActivo.php?bandera=1" required
                                    class="parsley-examples">
                                    <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Tipo de Activo</label>
                                            <select class="form-control" name="tipoA" id="tipoA">
                                            <option selected>Seleccione</option>
                                                <?php
                                                 include 'config/conexion.php';
                                                  $result = $conexion->query("select id_tipo as id,nombre FROM ttipo_activo");
                                                   if ($result) {
                                                   while ($fila = $result->fetch_object()) {                                                                                
                                                   echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                    }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Departamento</label>
                                            <select class="form-control" name="depa" id="depa">
                                            <option selected>Seleccione</option>
                                                <?php
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("select id_departamento as id,nombre FROM tdepartamento");
                                                    if ($result) {
                                                    while ($fila = $result->fetch_object()) {                                                                                
                                                    echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                      }
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Proveedor</label>
                                            <select class="form-control" name="prove" id="prove">
                                            <option selected>Seleccione</option>
                                                <?php
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("select id_proveedor as id,nombre FROM tproveedor");
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
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Encargado</label>
                                            <select class="form-control" name="emple" id="emple">
                                            <option selected>Seleccione</option>
                                                <?php
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("select id_empleado as id,nombre FROM templeados");
                                                    if ($result) {
                                                    while ($fila = $result->fetch_object()) {                                                                                
                                                    echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                      }
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Tipo Adquisicion</label>
                                            <select class="form-control" name="tipo" id="tipo" required>
                                                <option selected>Seleccione</option>
                                                <?php
                                             echo "<option value='1'>Nuevo</option>";
                                             echo "<option value='2'>Usado</option>";
                                             echo "<option value='3'>Donado</option>";
                                        
                                        ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4" class="col-form-label">Valor del Activo</label>
                                            <input type="text" class="form-control" name="valor" id="valor"
                                                required  placeholder="0.00">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4" class="col-form-label">Marca</label>
                                            <input type="text" class="form-control" name="marca" id="marca" required
                                             placeholder="Marca del Activo">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4" class="col-form-label">Correlativo</label>
                                            <input type="text" class="form-control" name="corre" id="corre" required
                                            placeholder="9999">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                        <textarea class="form-control" id="observ" name="observ" rows="5"></textarea>
                                    </div>

                                    </br>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <button type="buttom" onclick="go();"
                                                class="btn btn-success btn-rounded waves-light width-md">Registrar</button>
                                            <button type="reset"
                                                class="btn btn-danger btn-rounded waves-light width-md">Cancelar</button>
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
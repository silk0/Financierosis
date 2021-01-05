<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>

<script>
    function go(){

//Validaciones
if(document.getElementById('nombre').value==""){
//    alert("El campo nombre es obligatorio");
//    prueba :p
 notify(' Advertencia:','El campo Nombre es obligatorio.','top', 'right', 'any', 'warning');
   document.getElementById("nombre").focus();
}else if(document.getElementById('apellido').value==""){
    notify(' Advertencia:','El campo Apellido es obligatorio,','top', 'right', 'any', 'warning');
   document.getElementById("apellido").focus();
}else if(document.getElementById('dui').value==""){
    notify(' Advertencia:','El campo DUI es obligatorio','top', 'right', 'any', 'warning');
   document.getElementById("dui").focus();
}else if(document.getElementById('nit').value==""){
    notify(' Advertencia:','El campo NIT es obligatorio', 'top', 'right', 'any', 'warning');
   document.getElementById("nit").focus();
}else if(document.getElementById('direc').value==""){
    notify(' Advertencia:','El campo Direccion es obligatorio', 'top', 'right', 'any', 'warning');
   document.getElementById("direc").focus();
}else if(document.getElementById('telefono').value=="" && document.getElementById('celular').value==""){
    notify(' Advertencia:','Ingrese telefono', 'top', 'right', 'any', 'warning');
   document.getElementById("telefono").focus();
}else if(document.getElementById('email').value==""){
    notify(' Advertencia:','El campo E-mail es obligatorio,','top', 'right', 'any', 'warning');
   document.getElementById("email").focus();
}else if(document.getElementById('trabajo').value==""){
    notify(' Advertencia:','El campo Tabajo que realiza es obligatorio', 'top', 'right', 'any', 'warning');
   document.getElementById("trabajo").focus();
}else if(document.getElementById('salario').value==""){
    notify(' Advertencia:','El campo Salario  es obligatorio', 'top', 'right', 'any', 'warning');
   document.getElementById("salario").focus();
}else{
  document.form.submit();  
}   
}
</script>

<body class="left-side-menu-dark">

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
                                <h4 class="page-title" align="center">Registro de Fiador</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Ingreso de datos generales del fiador</h4>     
                                <form name="form" method="post" action="ingresoFiador.php?bandera=1" required class="parsley-examples">
                                <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Nombre</label>
                                            <input type="text"  class="form-control" name="nombre" id="nombre" required  placeholder="Jose Alfredo">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido" required  placeholder="Rodriguez Perez">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Dui</label>
                                            <input type="text"  class="form-control" name="dui" id="dui" required  data-mask="99999999-9" placeholder="99999999-9">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Nit</label>
                                            <input type="text" class="form-control" name="nit" id="nit" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Telefono fijo</label>
                                            <input type="text"  class="form-control" name="telefono" id="telefono" required  data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Telefono Movil</label>
                                            <input type="text" class="form-control" name="celular" id="celular" required data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Direccion</label>
                                        <input type="text" class="form-control"  name="direc" id="direc" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Email</label>
                                            <input type="email"  class="form-control" name="email" id="email"  required  placeholder="Correo@correo.com">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Profesion u oficio</label>
                                            <input type="text" class="form-control" name="profecion" id="profecion" required  placeholder="Rodriguez Perez">
                                        </div>
                                    </div>  
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputCity" class="col-form-label">Ingresos Mensuales ($)</label>
                                            <input type="number" class="form-control" name="salario" id="salario" required  placeholder="0.00">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Tipo de ingreso</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                <option selected >Seleccione</option>
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputZip" class="col-form-label">Egreso Promedio Mensual ($)</label>
                                            <input type="number" class="form-control" name="egreso" id="egreso" placeholder="0.00" >
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
        $apellido   = $_POST['apellido'];
        $direccion   = $_POST['direc'];
        $dui  = $_POST['dui'];
        $nit   = $_POST['nit'];
        $email   = $_POST['email'];
        $tel   = $_POST['telefono'];
        $cel  = $_POST['celular'];
        $tipo = $_POST['tipo'];
        $prof=$_POST['profecion'];
        $salario=$_POST['salario'];
        //$egreso = $_POST['egreso'];
        //$observ  = $_POST['observ'];
        msgI($egreso);
        $consulta  = "INSERT INTO tfiador VALUES('null','" .$nombre. "','" .$apellido. "','" .$direccion. "','" .$dui. "','" .$nit. "','" .$prof. "','" .$tipo. "','" .$salario. "','" .$tel. "','" .$cel. "','" .$email. "','" .$observ. "','" .$egreso. "')";
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
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
    function notify(titulo, texto, from, align, icon, type, animIn, animOut) {
        $.growl({
            icon: icon,
            title: titulo + " ",
            message: texto,
            url: ''
        }, {
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 20,
                y: 85
            },
            spacing: 10,
            z_index: 1031,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
                '<button type="button" class="close" data-growl="dismiss">' +
                '<span aria-hidden="true">&times;</span>' +
                '<span class="sr-only">Close</span>' +
                '</button>' +
                '<span data-growl="icon"></span>' +
                '<span data-growl="title"></span>' +
                '<span data-growl="message"></span>' +
                '<a href="#" data-growl="url"></a>' +
                '</div>'
        });
    }

    function alert(str, icono) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: icono,
            title: str
        });
    }

    function go() {

        
        //Validaciones
        
        if (document.getElementById('nombre').value == "") {
            notify(' Advertencia:', 'El campo Nombre es obligatorio.', 'top', 'right', 'any', 'warning');
            document.getElementById("nombre").focus();
        } else if (document.getElementById('apellido').value == "") {
            notify(' Advertencia:', 'El campo Apellido es obligatorio,', 'top', 'right', 'any', 'warning');
            document.getElementById("apellido").focus();
        } else if (document.getElementById('dui').value == "") {
            notify(' Advertencia:', 'El campo DUI es obligatorio', 'top', 'right', 'any', 'warning');
            document.getElementById("dui").focus();
        } else if (document.getElementById('direc').value == "") {
            notify(' Advertencia:', 'El campo Direccion es obligatorio', 'top', 'right', 'any', 'warning');
            document.getElementById("direc").focus();
        } else if (document.getElementById('tipo').value == "Seleccione") {
            notify(' Advertencia:', 'Seleccione un tipo de Ingreso', 'top', 'right', 'any', 'warning');
            document.getElementById("tipo").focus();
        } else if (document.getElementById('usuario').value == "") {
            notify(' Advertencia:', 'El campo Usuario obligatorio', 'top', 'right', 'any', 'warning');
            document.getElementById("usuario").focus();
        } else if (document.getElementById('contra').value == "") {
            notify(' Advertencia:', 'El campo Contraseña es obligatorio', 'top', 'right', 'any', 'warning');
            document.getElementById("contra").focus();
        } else if (document.getElementById('contra1').value == "") {
            notify(' Advertencia:', 'El campo Repetir Contraseña es obligatorio', 'top', 'right', 'any', 'warning');
            document.getElementById("contra1").focus();
        } else if (document.getElementById('contra').value.localeCompare(document.getElementById('contra1').value)!=0) {
            document.getElementById("contra1").focus();
            document.getElementById("contra").focus();
        } else{  
            document.form.submit();
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
                                <h4 class="page-title">Registro de Empleado</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div align="right">
                                </div>
                                <br>
                                <h4 class="header-title">Ingreso de datos generales del empleado</h4>
                                <form name="form" method="post" action="ingresoEmpleado.php?bandera=1"
                                    class="parsley-examples">
                                    <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required
                                                placeholder="Jose Alfredo">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido"
                                                required placeholder="Rodriguez Perez">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Dui</label>
                                            <input type="text" class="form-control" name="dui" id="dui" required
                                                data-mask="99999999-9" placeholder="99999999-9">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState" class="col-form-label">Rol</label>
                                            <select class="form-control" name="tipo" id="tipo" required>
                                                <option selected>Seleccione</option>
                                                <option>Administrador</option>
                                                <option>Vendedor</option>
                                                <option>Activo Fijo</option>
                                                <option>Inventario</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Direccion</label>
                                        <input type="text" class="form-control" name="direc" id="direc" required
                                            placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4" class="col-form-label">Usuario</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario" required
                                                placeholder="Usuario">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4" class="col-form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="contra" id="contra"
                                                required >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4" class="col-form-label">Repetir
                                                Contraseña</label>
                                            <input type="password" data-parsley-equalto="#contra" placeholder="Password" class="form-control"  name="contra1" id="contra1"
                                                required >
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <button type="buttom" onclick="go();"
                                            class="btn  btn-primary waves-effect">Registrar</button>
                                            <button type="reset"
                                            class="btn btn-light waves-effect">Cancelar</button>
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
        $dui  = $_POST['dui'];
        $tipo = $_POST['tipo'];
        $direccion   = $_POST['direc'];
        $usuario=$_POST['usuario'];
        $contra=$_POST['contra'];

        $consulta  = "INSERT INTO templeados VALUES('null','" .$nombre. "','" .$apellido. "','" .$direccion. "','" .$dui. "','" .$usuario. "','" .$contra. "','" .$tipo. "')";
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
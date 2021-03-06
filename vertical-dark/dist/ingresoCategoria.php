<!DOCTYPE html>
<html lang="en">

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

<?php include_once 'Cabecera.php';?>


<SCRIPT language=JavaScript>

function goCate(){
    //validacion respectiva me da hueva
    //enviarDatos(2);
    $("#editarForm").submit();;      
} 
function modify(id,cate,estad){
    document.getElementById("id_categoria").value=id;
    document.getElementById("cate").value=cate;
    document.getElementById("estado").value=estad;
}

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
        } else if (document.getElementById('tipo').value == "Seleccione") {
            notify(' Advertencia:', 'Seleccione un tipo', 'top', 'right', 'any', 'warning');
            document.getElementById("tipo").focus();
        } else {
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
                                <h4 class="page-title">Categoria de Articulos</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Ingreso de Categoria</h4>
                                <form name="form" method="post" action="ingresoCategoria.php?bandera=1" required
                                    class="parsley-examples">
                                    <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Nombre Categoria</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required
                                                placeholder="Ingrese Nombre de Categoria">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState" class="col-form-label">Estado</label>
                                            <select class="form-control" name="tipo" id="tipo" required>
                                                <option selected>Seleccione</option>
                                                <?php
                                             echo "<option value='1'>Activo</option>";
                                             echo "<option value='0'>Inactivo</option>";
                                                ?>
                                            </select>
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"></h4>
                                <p class="sub-header">
                                    <h4 class="header-title">Listado de Categoria</h4>
                                </p>
                                <div class="form-row">
                                    <table id="datatable-buttons" style="width: 1012px"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Categoria</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT * from tcategoria ORDER BY categoria");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->categoria . "</td>";
                                                if($fila->estado==1){
                                                    echo "<td style='width: 20%;' align='center'>Activo</td>";
                                                }else{
                                                    echo "<td style='width: 20%;' align='center'>Inactivo</td>";
                                                }

                                                echo "<td  style='width: 10%;' align='center'> 
                                                <span data-toggle='modal'                                                    
                                                    data-target='#editar'>
                                                    <button 
                                                    type='button' title='Modificar' data-toggle='tooltip' 
                                                    data-placement='bottom'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                    '$fila->id_categoria',
                                                    '$fila->categoria',
                                                    '$fila->estado'
                                                    )\";>                                                    
                                                        <i class='mdi mdi-pencil-outline'></i></i>
                                                    </button></span>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bootstrap Modals -->
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <!--  Modal editar -->
                                    <div id="editar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Editar datos del
                                                        fiador</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card-box">
                                                                <form name="editarForm" id="editarForm" method="post"
                                                                    action="scriptsphp/modificarCategoria.php?bandera=1"
                                                                    required class="parsley-examples">
                                                                    <div class="form-row">
                                                                        <input type="hidden" id="id_categoria"
                                                                            name="id_categoria">
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="inputEmail4"
                                                                                class="col-form-label">Categoria</label>
                                                                            <input type="text" class="form-control"
                                                                                name="cate" id="cate" required
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="inputState"
                                                                                class="col-form-label">Estado</label>
                                                                            <select class="form-control" name="estado"
                                                                                id="estado" required>
                                                                                <option selected>Seleccione</option>
                                                                                <?php
                                                                                    echo "<option value='1'>Activo</option>";
                                                                                    echo "<option value='0'>Inactivo</option>";
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
                                                    <button type="button" class="btn  btn-primary waves-effect"
                                                        id="cambios" name="cambios" onclick="goCate();">Guardar
                                                        Cambios</button>
                                                    <button type="button" class="btn btn-light waves-effect"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                        </div> <!-- /.fin bostra -->

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
        $tipo = $_POST['tipo'];
        $consulta  = "INSERT INTO tcategoria VALUES('null','" .$nombre. "','" .$tipo. "')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            msgI("Los datos fueron almacenados con exito");
        } else {
            msgE("Los datos no pudieron almacenarce");
        }  
        echo '<script>location.href="ingresoCategoria.php";</script>';     
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
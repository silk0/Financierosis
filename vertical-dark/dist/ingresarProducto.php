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
        header("Location:index.php");
    }
    ?>
    <?php
    include "config/conexion.php";
    $resultc = $conexion->query("select id_producto as id from tproducto");
    if ($resultc) {

    while ($filac = $resultc->fetch_object()) {
        $temp=$filac->id;
    
        }
    }   
    //$numero=sprintf("%03s",$temp+1);  
?>
<?php include_once 'Cabecera.php';?>
<SCRIPT  language=JavaScript> 
  
    function notify(titulo,texto,from, align, icon, type, animIn, animOut){
            $.growl({
                icon: icon,
                title: titulo+" ",
                message: texto,
                url: ''
            },{
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
    function go(){
        alert(document.getElementById('categoria').value);
    if(document.getElementById('nombre').value==""){
        notify(' Advertencia:','El campo Nombre es obligatorio.','top', 'right', 'any', 'warning');
        document.getElementById("nombre").focus();
    }else if(document.getElementById('stock').value.toString()==""){
            notify(' Advertencia:','El campo Stock es obligatorio,','top', 'right', 'any', 'warning');
        document.getElementById("stock").focus();
    }else if(document.getElementById('categoria').value.toString()==""){
            notify(' Advertencia:','El campo Categoria es obligatorio','top', 'right', 'any', 'warning');
        document.getElementById("categoria").focus();
    }else if(document.getElementById('mganancia').value.toString()==""){
            notify(' Advertencia:','El campo Margen de Ganancia es obligatorio', 'top', 'right', 'any', 'warning');
        document.getElementById("mganancia").focus();
    }else if(document.getElementById('idproveedor').value.toString()==""){
            notify(' Advertencia:','El campo Proveedor es obligatorio,','top', 'right', 'any', 'warning');
        document.getElementById("idproveedor").focus();
    }else if(document.getElementById('descrip').value.toString()==""){
            notify(' Advertencia:','El campo Descripcion es obligatorio', 'top', 'right', 'any', 'warning');
        document.getElementById("descrip").focus();
    }else{
        document.form.submit();  
    }   
    }
    function enviar(id){
        
        $.ajax({
            data:{"id":id},
            url: 'scriptsphp/recuperarProveedor.php',
            type: 'post',
            beforeSend: function(){
                alert("Por favr espere...");
            },
            success: function(response){
                alert(response);
                document.getElementById("proveedor").value=response;
                document.getElementById("idproveedor").value=id;
            }
        });
    } 
    function enviarC(id){
        
        $.ajax({
            data:{"id":id},
            url: 'scriptsphp/recuperarCategoria.php',
            type: 'post',
            beforeSend: function(){
                alert("Por favr espere...");
            },
            success: function(response){
                alert(response);
                document.getElementById("categoria").value=response;
                document.getElementById("idcat").value=id;
            }
        });
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
                            <div class="page-title-box">                                
                                <h4 class="page-title">Registro de articulos</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                            <div class="col-lg-12">
        
                                <div class="card-box">
                                    <p class="sub-header">
                                       Formulario para el ingreso de datos de articulos
                                    </p>
        
                                    <form name="form" method="post"  class="parsley-examples" required>
                                        <input type="hidden" id="bandera" name="bandera" value="1">
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="codigo" class="col-form-label">Codigo</label>
                                                <input type="text" class="form-control" name="codigo" id="codigo" required
                                                    placeholder="0000000">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="nombre" class="col-form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre"
                                                    required placeholder="Refrigeradora">
                                            </div>
                                        </div>     
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="stock" class="col-form-label">Stock minimo</label>
                                                <input type="number" class="form-control" name="stock" id="stock" required
                                                    placeholder="0">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="pcompra" class="col-form-label">Precio de compra</label>
                                                <input type="number" class="form-control" name="pcompra" id="pcompra" required
                                                    placeholder="$0.00">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="mganancia" class="col-form-label">Porcentaje de ganancia</label>
                                                <input type="number" class="form-control" name="mganancia" id="mganancia"
                                                    required placeholder="0%" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="pventa" class="col-form-label">Precio de venta</label>
                                                <input type="number" class="form-control" name="pventa" id="pventa"
                                                    required placeholder="$0.00" readonly>
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="idproveedor" class="col-form-label">Proveedor</label>
                                                <select  class="form-control" name="idproveedor" id="idproveedor" required >
                                                <option value='0' selected>Seleccione</option>
                                                <?php
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("select id_proveedor, nombre, representante,email FROM tproveedor");
                                                    if ($result) {
                                                        while ($fila = $result->fetch_object()) {
                                                          
                                                            echo '<option value="' . $fila->id_proveedor . '">' . $fila->nombre . ' - ' . $fila->representante . ' ('. $fila->email .')</opcion>';
                                                           
                                                        }
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="categoria" class="col-form-label">Categoria</label>
                                                <select  class="form-control" name="categoria" id="categoria" required >
                                                <option value='0' selected>Seleccione</option>
                                                <?php
                                                    include 'config/conexion.php';
                                                    $result = $conexion->query("select id_categoria, categoria, estado FROM tcategoria");
                                                    if ($result) {
                                                        while (($fila = $result->fetch_object() )&& ($fila->estado>0)) {
                                                          
                                                            echo '<option value="' . $fila->id_categoria . '">' . $fila->categoria . '</opcion>';
                                                           
                                                        }
                                                    }
                                                    ?> 
                                                </select>                                                
                                            </div>                                            
                                        </div>      
                                        <div class="form-row">
                                            <label for="descrip" class="col-form-label">Descripcion</label>
                                            <textarea class="form-control" id="descrip" name="descrip" rows="5"></textarea>
                                        </div>
                                        </br>
                                        <div class="form-row">
                                            <div class="form-group text-right mb-0">
                                                <button class="btn btn-success btn-rounded waves-light width-md" onclick="go();" type="button">
                                                    Registrar
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-rounded waves-light width-md">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
        
                                    </form>
                                </div> <!-- end card-box -->
                            </div>
                            <!-- end col -->        
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
    <script type="text/javascript">
        //genracion de codigo
        $(document).ready(function () {
            $("#nombre").keyup(function () {
                var value = $(this).val();
                $cod = value.substr(0, 4).toUpperCase();
                if (value != "") {
                    var numero = Math.floor(Math.random() * (9999 - 1000)) + 1000;
                    $codigo = $cod + numero;
                    $("#codigo").val($codigo);
                } else {
                    $("#codigo").val("");
                }
            });
        });
        $(document).ready(function () {    
            $("#mganancia").keyup(function () {
                var value = $(this).val();
                var pcompra = document.getElementById("pcompra").value;
                $pventa = ((value/100) * pcompra)+Number(pcompra);
                if(isNaN($pventa)){
                    $("#pventa").val("0.00");
                }else{
                    $("#pventa").val($pventa);
                }               
                
            });
        });
        $(document).ready(function () {    
            $("#pcompra").keyup(function () {
                var value = document.getElementById("mganancia").value;
                var pcompra = $(this).val();
                $pventa = ((value/100) * pcompra)+Number(pcompra);
                if(isNaN($pventa)){
                    $("#pventa").val("0.00");
                }else{
                    $("#pventa").val($pventa);
                }               
                
            });
        });
    </script>

</body>

</html>
<?php
include "config/conexion.php";
    $accion = $_POST['bandera'];
    if($accion==1){
    $codigo = $_POST['codigo'];
    $nombre   = $_POST['nombre'];
    $stock   = $_POST['stock'];
    $categoria   = $_POST['categoria'];
    $pcompra   = $_POST['pcompra'];
    $pventa  = $_POST['pventa'];
    $mganancia   = $_POST['mganancia'];
    $proveedor   = $_POST['idproveedor'];
    $descrip   = $_POST['descrip'];

        $consulta  = "INSERT INTO tproducto VALUES('null','".$proveedor."','".$categoria."','" .$nombre. "','" .$descrip. "','" .$pcompra. "','" .$pventa. "','" .$mganancia. "','" .$stock. "','0','" .$codigo. "','1')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            msgI("Se agregaron los datos correctamente");
        } else {
            msgE("Error al insertar los datos");
        }
    }

?>
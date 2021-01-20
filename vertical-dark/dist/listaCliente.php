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

    if( isset($_REQUEST["cartera"]) ){
		$cartera=($_REQUEST['cartera']);
	}else{
		$cartera=-1;
	}


?>
<?php include_once 'Cabecera.php';?>
<script>
    function filtrar() {
        id = document.getElementById("op").value;
        $("#ide").val(id);        
        $("#fCartera").submit();
    }
</script>

<SCRIPT  language=JavaScript> 
function go(){
    //validacion respectiva me da hueva
    $("#editarForm").submit();;         
} 

function edit(id,nom,ape,dui,nit,prof,direc,tel,cel,email,tipo,sal,ob,egres,cart,fia)
{
    // document.getElementById("baccion2").value=id;
    document.getElementById("nombrem").value=nom;
    document.getElementById("apellidom").value=ape;
    document.getElementById("duim").value=dui;
    document.getElementById("nitm").value=nit;
    document.getElementById("direcm").value=direc;
    document.getElementById("telm").value=tel;
    document.getElementById("celm").value=cel;
    document.getElementById("emailm").value=email;    
    document.getElementById("profeciom").value=prof;
    document.getElementById("tipom").value=tipo;
    document.getElementById("salm").value=sal;
    document.getElementById("observm").value=ob;    
    document.getElementById("egres").value=egres;
    document.getElementById("carteram").value=cart;
    document.getElementById("fiadorv").value=fia; 
}

function modify(id,nom,ape,dui,nit,prof,direc,tel,cel,email,tipo,sal,ob,egres,cart,fiad){
    document.getElementById("id_cliente").value=id;
    document.getElementById("nombre").value=nom;
    document.getElementById("apellido").value=ape;
    document.getElementById("dui").value=dui;
    document.getElementById("nit").value=nit;
    document.getElementById("direc").value=direc;
    document.getElementById("telefono").value=tel;
    document.getElementById("celular").value=cel;
    document.getElementById("email").value=email;    
    document.getElementById("profecion").value=prof;  
    document.getElementById("tipo").value=tipo;
    document.getElementById("salario").value=Number(sal);
    document.getElementById("observ").value=ob;    
    document.getElementById("egreso").value=Number(egres);    
    document.getElementById("cartera").value=cart;  
    document.getElementById("fiadorm").value=fiad;
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
                                <h4 class="page-title">Listado de Clientes</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"></h4>
                                <p class="sub-header">

                                </p>
                                <form id="fCartera" name= "fCartera" action="" method="GET"  class="parsley-examples">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" class="col-form-label">Clientes por Cartera:</label>
                                        <select class="form-control" name="op" id="op" onchange="filtrar()">
                                        <?php
                                            include "config/conexion.php";
                                            if(isset($_GET['op'])){
                                                $op=$_GET['op'];
                                            }
                                            $result = $conexion->query("SELECT id_categoria as id,nombre FROM  tcartera ");
                                            echo "<option value='0' selected>Todas las carteras</option>";
                                                if ($result) {
                                                    
                                                    while ($fila = $result->fetch_object()) {
                                                        $idcart = $fila->id;
                                                        if($op===$idcart){
                                                            echo "<option value='".$fila->id."' selected>".$fila->nombre."</option>";
                                                        }else{
                                                            echo "<option value='".$fila->id."'>".$fila->nombre."</option>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>                                            
                                    </div>
                                    
                                </div>
                                
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>DUI</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Telèfono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody> 
                                        <?php
                                        
                                        include "config/conexion.php";

                                        if(isset($_GET['op'])&&$_GET['op']>0){
                                            $ide=$_GET['op'];
                                            $result = $conexion->query("select id_cliente,nombre,apellido,dui,nit,celular, id_cartera FROM tclientes as c where c.id_cartera='".$ide."' order by nombre");
                                        }else{
                                            $result = $conexion->query("SELECT * from tclientes ORDER BY nombre");
                                        }
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->dui . "</td>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->apellido . "</td>"; 
                                                echo "<td>" . $fila->telefono . "</td>";
                                                echo "<td style='width: 10%;' align='center'>    
                                                <span data-toggle='modal'                                                    
                                                data-target='#mostrarCliente'>                                             
                                                    <button 
                                                    button type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                            
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                    '$fila->id_cliente',
                                                    '$fila->nombre',
                                                    '$fila->apellido',
                                                    '$fila->dui',
                                                    '$fila->nit',
                                                    '$fila->profecion',
                                                    '$fila->direccion',
                                                    '$fila->telefono',
                                                    '$fila->celular',
                                                    '$fila->correo',
                                                    '$fila->tipo_ingreso',                                                    
                                                    '$fila->salario',
                                                    '$fila->observaciones',
                                                    '$fila->egreso',
                                                    '$fila->id_cartera',
                                                    '$fila->id_fiador'
                                                    )\";>
                                                        <i class='mdi mdi-eye'></i> 
                                                    </button></span>
                                                    <span data-toggle='modal'                                                    
                                                    data-target='#editarCliente'>
                                                    <button 
                                                    type='button' title='Modificar' data-toggle='tooltip' 
                                                    data-placement='bottom'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                    '$fila->id_cliente',
                                                    '$fila->nombre',
                                                    '$fila->apellido',
                                                    '$fila->dui',
                                                    '$fila->nit',
                                                    '$fila->profecion',
                                                    '$fila->direccion',
                                                    '$fila->telefono',
                                                    '$fila->celular',
                                                    '$fila->correo',
                                                    '$fila->tipo_ingreso',                                                    
                                                    '$fila->salario',
                                                    '$fila->observaciones',
                                                    '$fila->egreso',
                                                    '$fila->id_cartera',
                                                    '$fila->id_fiador'
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
                                <!--  Modal mostrar cliente-->
                                <div id="mostrarCliente" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Datos del cliente</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="form" required class="parsley-examples">
                                                            
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Nombre</label>
                                                                    <input type="text"  class="form-control" name="nombrem" id="nombrem" required  placeholder="Jose Alfredo" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Apellido</label>
                                                                    <input type="text" class="form-control" name="apellidom" id="apellidom" required  placeholder="Rodriguez Perez" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Dui</label>
                                                                    <input type="text"  class="form-control" name="duim" id="duim" required  data-mask="99999999-9" placeholder="99999999-9" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Nit</label>
                                                                    <input type="text" class="form-control" name="nitm" id="nitm" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Telefono fijo</label>
                                                                    <input type="text"  class="form-control" name="telm" id="telm" required  data-mask="9999-9999" placeholder="9999-9999" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Telefono Movil</label>
                                                                    <input type="text" class="form-control" name="celm" id="celm" required data-mask="9999-9999" placeholder="9999-9999" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <label for="inputAddress" class="col-form-label">Direccion</label>
                                                                <input type="text" class="form-control"  name="direcm" id="direcm" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23" readonly>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Email</label>
                                                                    <input type="email"  class="form-control" name="emailm" id="emailm"  required  placeholder="Correo@correo.com" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Profesion u oficio</label>
                                                                    <input type="text"  class="form-control" name="profeciom" id="profeciom" required  placeholder="Ing. Civil" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputCity" class="col-form-label">Ingresos Mensuales</label>
                                                                    <input type="text" class="form-control" name="salm" id="salm" required  placeholder="0.00" readonly>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState" class="col-form-label">Tipo de ingreso</label>
                                                                    <input type="text" class="form-control" name="tipom" id="tipom" placeholder="0.00" readonly>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputZip" class="col-form-label">Egreso Promedio Mensual</label>
                                                                    <input type="text" class="form-control" name="egres" id="egres" placeholder="0.00" readonly>
                                                                </div>
                                                            </div> 

                                                            <div class="form-row">                                        
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputState" class="col-form-label">Agregar a la cartera</label>
                                                                    <select class="form-control" name="carteram" id="carteram" >                                                                        
                                                                        <?php
                                                                        include 'config/conexion.php';
                                                                        $result = $conexion->query("select id_categoria as id,nombre FROM tcartera");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                                                                
                                                                                echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                                            }
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputZip" class="col-form-label">Fiador</label>
                                                                    <select class="form-control" name="fiadorv" id="fiadorv" disabled>
                                                                    <option value='0' selected>Seleccione</option>
                                                                        <?php
                                                                        include 'config/conexion.php';
                                                                            $result = $conexion->query("select id_fiador as id,nombre FROM tfiador;");
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
                                                                <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                                                <textarea class="form-control" id="observm" name="observm" rows="5" readonly></textarea>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->   
                                <!--  Modal editar cliente-->
                                <div id="editarCliente" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Editar datos del cliente</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarCliente.php?bandera=1" required class="parsley-examples">
                                                            
                                                            <div class="form-row">
                                                                <input type="hidden" id="idfiador" name="idfiador">
                                                                <input type="hidden" id="id_cliente" name="id_cliente">
                                                            </div>

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
                                                                    <input type="text"  class="form-control" name="dui" id="dui" required  data-mask="99999999-9" placeholder="99999999-9" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Nit</label>
                                                                    <input type="text" class="form-control" name="nit" id="nit" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Telefono fijo</label>
                                                                    <input type="text"  class="form-control" name="telefono" id="telefono" required  data-mask="9999-9999" placeholder="9999-9999" >
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Telefono Movil</label>
                                                                    <input type="text" class="form-control" name="celular" id="celular" required data-mask="9999-9999" placeholder="9999-9999">
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <label for="inputAddress" class="col-form-label">Direccion</label>
                                                                <input type="text" class="form-control"  name="direc" id="direc" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23">
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Correo</label>
                                                                    <input type="email"  class="form-control" name="email" id="email"  required  placeholder="Correo@correo.com">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Profesion u oficio</label>
                                                                    <input type="text"  class="form-control" name="profecion" id="profecion" required  placeholder="Ing. Civil">
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputCity" class="col-form-label">Ingresos Mensuales</label>
                                                                    <input type="number" class="form-control" name="salario" id="salario" required  placeholder="0.00">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState" class="col-form-label">Tipo de ingreso</label>
                                                                    <select class="form-control" name="tipo" id="tipo" required >
                                                                        <option>Salario</option>
                                                                        <option>Remesa</option>
                                                                        <option>Salario Informal</option>
                                                                    </select>                                                                   
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputZip" class="col-form-label">Egreso Promedio Mensual</label>
                                                                    <input type="number" class="form-control" name="egreso" id="egreso" placeholder="0.00">
                                                                </div>
                                                            </div> 

                                                            <div class="form-row">                                        
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState" class="col-form-label">Agregar a la cartera</label>
                                                                    <select class="form-control" name="cartera" id="cartera" required >                                                                        
                                                                        <?php
                                                                        include 'config/conexion.php';
                                                                        $result = $conexion->query("select id_categoria as id,nombre FROM tcartera");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                                                                
                                                                                echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                                            }
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputState" class="col-form-label">Agregar Fiador</label>
                                                                    <select class="form-control" >
                                                                    <option value='0' selected>Seleccione</option>
                                                                        <?php
                                                                        include 'config/conexion.php';
                                                                            $result = $conexion->query("select id_fiador as id,nombre FROM tfiador;");
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
                                                                <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                                                <textarea class="form-control" id="observ" name="observ" rows="5"></textarea>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-primary waves-effect" id ="cambios" name = "cambios"  onclick="go();" >Guardar Cambios</button>
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->                              
                            
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
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

function edit(id,nom,tel,direc,repre,dui,nit,cel,email)
{
    // document.getElementById("baccion2").value=id;
    document.getElementById("nombrem").value=nom;
    document.getElementById("telm").value=tel;
    document.getElementById("direcm").value=direc;
    document.getElementById("reprem").value=repre;
    document.getElementById("duim").value=dui;
    document.getElementById("nitm").value=nit;
    document.getElementById("celm").value=cel;
    document.getElementById("emailm").value=email; 
}

function modify(id,nom,tel,direc,repre,dui,nit,cel,email){
    document.getElementById("id_proveedor").value=id;
    document.getElementById("nombre").value=nom;
    document.getElementById("telefono").value=tel;
    document.getElementById("direc").value=direc;
    document.getElementById("represen").value=repre;
    document.getElementById("dui").value=dui;
    document.getElementById("nit").value=nit;
    document.getElementById("celu").value=cel;
    document.getElementById("email").value=email; 
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
                                <h4 class="page-title">Listado de Proveedores</h4>
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
                                <div  class="form-group row">
                                    <label class="col-sm-2 col-form-label">Proveedores:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="op" id="op" onchange="filtrar()">
                                            <?php
                                                  include "config/conexion.php";
                                                  if(isset($_GET['op'])){
                                                      $op=$_GET['op'];
                                                  }
                                                  $result = $conexion->query("SELECT id_proveedor as id,nombre FROM  tproveedor ");
                                                  echo "<option value='0' selected>Seleccione</option>";
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
                                            <th>Nombre</th>
                                            <th>Telefono</th>
                                            <th>Representante</th>
                                            <th>Celular</th>
                                            <th>E-mail</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody> 
                                        <?php
                                        
                                        include "config/conexion.php";

                                        if(isset($_GET['op'])&&$_GET['op']>0){
                                            $ide=$_GET['op'];
                                            $result = $conexion->query("select id_proveedor,nombre,telefono,direccion,representante,dui,nit,celular,email, FROM tproveedor as c where c.id_proveedor='".$ide."' order by nombre");
                                        }else{
                                            $result = $conexion->query("SELECT * from tproveedor ORDER BY nombre");
                                        }
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->telefono . "</td>";
                                                echo "<td>" . $fila->representante . "</td>"; 
                                                echo "<td>" . $fila->celular . "</td>";
                                                echo "<td>" . $fila->email . "</td>";
                                                echo "<td>                                                 
                                                    <button 
                                                    button type='button'
                                                    data-toggle='modal'                                                    
                                                    data-target='#mostrarProveedor'                                                    
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                    '$fila->id_proveedor',
                                                    '$fila->nombre',
                                                    '$fila->telefono',
                                                    '$fila->direccion',
                                                    '$fila->representante',
                                                    '$fila->dui',
                                                    '$fila->nit',
                                                    '$fila->celular',
                                                    '$fila->email'
                                        
                                                    )\";>
                                                        <i class='mdi mdi-eye'></i> 
                                                    </button>
                                                    <button 
                                                    type='button'
                                                    data-toggle='modal'                                                    
                                                    data-target='#editarProveedor'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                        '$fila->id_proveedor',
                                                        '$fila->nombre',
                                                        '$fila->telefono',
                                                        '$fila->direccion',
                                                        '$fila->representante',
                                                        '$fila->dui',
                                                        '$fila->nit',
                                                        '$fila->celular',
                                                        '$fila->email'
                                                    )\";>                                                    
                                                        <i class='mdi mdi-pencil-outline'></i></i>
                                                    </button>
                                                  
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
                            <div class="card-box">                                
                                <!--  Modal mostrar Proveedor-->
                                <div id="mostrarProveedor" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Datos del proveedor</h4>
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
                                            <label for="inputPassword4" class="col-form-label">Telefono</label>
                                            <input type="text" class="form-control" name="telm" id="telm" required data-mask="9999-9999"  placeholder="9999-9999" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="inputAddress" class="col-form-label">Direccion</label>
                                        <input type="text" class="form-control"  name="direcm" id="direcm" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23" readonly>
                                    </div>
                                    </div>
                                    <div class="page-title-box" >                                
                                <h4 class="page-title" align="center">Datos del representante del proveedor</h4>
                            </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Representante</label>
                                            <input type="text"  class="form-control" name="reprem" id="reprem" required  placeholder="Jose Alfredo" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Dui</label>
                                            <input type="text"  class="form-control" name="duim" id="duim" required  data-mask="99999999-9" placeholder="99999999-9" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row"> 
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Nit</label>
                                            <input type="text" class="form-control" name="nitm" id="nitm" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9" readonly> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Celular</label>
                                            <input type="text" class="form-control" name="celm" id="celm" required data-mask="9999-9999"  placeholder="9999-9999" readonly>
                                        </div>
                                        
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Email</label>
                                            <input type="email"  class="form-control" name="emailm" id="emailm"  required  placeholder="Correo@correo.com" readonly>
                                        </div>
                                     
                                    </div> 
                                    </div>   
                                   </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->   
                                <!--  Modal editar proveedor-->
                                <div id="editarProveedor" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Editar datos del proveedor</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarProveedor.php?bandera=1" required class="parsley-examples">
                                                            
                                                            <div class="form-row">
                                                                
                                                                <input type="hidden" id="id_proveedor" name="id_proveedor">
                                                            </div>

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
                                                             <div class="page-title-box" >                                
                                                            <h4 class="page-title" align="center">Datos del representante del proveedor</h4>
                                                             </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Representante</label>
                                            <input type="text"  class="form-control" name="represen" id="represen" required  placeholder="Jose Alfredo">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Dui</label>
                                            <input type="text"  class="form-control" name="dui" id="dui" required  data-mask="99999999-9" placeholder="99999999-9">
                                        </div>
                                    </div>
                                                            <div class="form-row">
                                                             <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Nit</label>
                                                                    <input type="text" class="form-control" name="nit" id="nit" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Celular</label>
                                                                    <input type="text" class="form-control" name="celu" id="celu" required data-mask="9999-9999" placeholder="9999-9999">
                                                                </div>
                                                            </div>
                                                             <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">E-mail</label>
                                                                    <input type="email"  class="form-control" name="email" id="email"  required  placeholder="Correo@correo.com">
                                                                </div>
                                                            
                                                            </div>
                                                             </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-primary waves-effect" id ="cambios" name = "cambios" onclick="go();" >Guardar Cambios</button>
                                                <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal">Cerrar</button>
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
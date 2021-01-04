<!DOCTYPE html>
<html lang="en"
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
?>>
<?php include_once 'Cabecera.php';?>
<script>
    function filtrar() {
        id = document.getElementById("op").value;
        $("#ide").val(id);
        document.form.submit();
    }
</script>

<SCRIPT  language=JavaScript> 
function go(){
    //validacion respectiva me da hueva
        document.form.submit();  
} 
function edit(id,nom,ape,dui,nit,prof,direc,tel,cel,email,tipo,sal,ob,egres)
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
    document.getElementById("profecion").value=prof;
    document.getElementById("tipom").value=tipo;
    document.getElementById("salm").value=sal;
    //document.getElementById("observm").value=ob;    
    document.getElementById("egres").value=egres;
    $("#custom-modal").modal();
  }
function modify(id){
  document.location.href="editarCliente.php?id="+id;
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

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Listado de Cliente por Cartera:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="op" id="op" onchange="filtrar()">
                                            <?php
                                                  include "config/conexion.php";
                                                  $result = $conexion->query("SELECT id_categoria as id ,nombre FROM  tcartera ");
                                                            if ($result) {
                                                             echo "<option value='".$fila->id."'>Seleccione</option>";
                                                                 while ($fila = $result->fetch_object()) {
                                                                        echo "<option value='".$fila->id."'>".$fila->nombre."</option>";
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
                                        $result = $conexion->query("SELECT * from tclientes ORDER BY id_cliente");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->dui . "</td>";
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->apellido . "</td>"; 
                                                echo "<td>" . $fila->telefono . "</td>";
                                                echo "<td>
                                                <div class='container' align='center'>  
                                                    <button href='#custom-modal'
                                                    data-animation='contentscale' data-plugin='custommodal'
                                                    data-overlaySpeed='100'
                                                    data-overlayColor='#36404a'
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit('$fila->id_cliente',
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
                                                    '$fila->egreso')\";>
                                                        <i class='mdi mdi-eye'></i> 
                                                    </button>
                                                    <button class='btn btn-warning waves-effect waves-light' onclick='modify(" . $fila->id_cliente. ")'>
                                                        <i class='mdi mdi-pencil-outline'></i> 
                                                    </i></button>
                                                </div>
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
    
    <!-- Custom Modal -->
    <div id="custom-modal" class="modal-demo containeR" aria-labelledby="myLargeModalLabel" >
        <div class="container-flui">
        <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">Datos del cliente</h4>
            <!-- Form row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">   
                        <form name="form" method="post" action="ingresoCliente.php?bandera=1" required class="parsley-examples">
                        
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
                                    <input type="text"  class="form-control" name="profecion" id="profecion" required  placeholder="Ing. Civil" readonly>
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
                            </br>                            
                        </form>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
       </div>
    </div>                             

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php include_once 'Pie.php';?>

</body>

</html>
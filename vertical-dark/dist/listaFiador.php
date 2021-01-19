<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>

<SCRIPT language=JavaScript>

function go(){
    //validacion respectiva me da hueva
    //enviarDatos(2);
    $("#editarForm").submit();;      
} 
    function edit(id,nom,ape,dui,nit,tel,cel,direc,email,prof,sal)
{
    // document.getElementById("baccion2").value=id;
    document.getElementById("nombrem").value=nom;
    document.getElementById("apellidom").value=ape;
    document.getElementById("duim").value=dui;
    document.getElementById("nitm").value=nit;
    document.getElementById("telm").value=tel;
    document.getElementById("celm").value=cel;
    document.getElementById("direcm").value=direc;
    document.getElementById("emailm").value=email;    
    document.getElementById("profeciom").value=prof;
    document.getElementById("salm").value=sal;
}

function modify(id,nom,ape,dui,nit,tel,cel,direc,email,prof,sal){
    document.getElementById("id_fiador").value=id;
    document.getElementById("nombre").value=nom;
    document.getElementById("apellido").value=ape;
    document.getElementById("dui").value=dui;
    document.getElementById("nit").value=nit;
    document.getElementById("telefono").value=tel;
    document.getElementById("celular").value=cel;
    document.getElementById("direc").value=direc;
    document.getElementById("email").value=email;    
    document.getElementById("profecion").value=prof;  
    document.getElementById("salario").value=Number(sal);
}
</script>

<body >

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
                                <h4 class="page-title">Listado de Fiadores</h4>
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
                                                              
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Direcciòn</th>
                                            <th>Telèfono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody> 
                                        <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT * from tfiador ORDER BY nombre");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                
                                                echo "<td>" . $fila->nombre . "</td>";
                                                echo "<td>" . $fila->apellido . "</td>";
                                                echo "<td>" . $fila->direccion . "</td>"; 
                                                echo "<td>" . $fila->telefono . "</td>";
                                                echo "<td style='width: 10%;' align='center'> 
                                                <span data-toggle='modal'                                                    
                                                data-target='#mostrarFiador'>                                                
                                                    <button 
                                                    type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                          
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                    '$fila->id_fiador',
                                                    '$fila->nombre',
                                                    '$fila->apellido',
                                                    '$fila->dui',
                                                    '$fila->nit',
                                                    '$fila->telefono',
                                                    '$fila->celular',
                                                    '$fila->direccion',
                                                    '$fila->correo',
                                                    '$fila->profecion',
                                                    '$fila->salario',
                                                    )\";><i class='mdi mdi-eye'></i> 
                                                    </button></span>
                                                    <span data-toggle='modal'                                                    
                                                    data-target='#editarFiador'>
                                                    <button 
                                                    type='button' title='Modificar' data-toggle='tooltip' 
                                                    data-placement='bottom'
                                                    class='btn btn-warning waves-effect waves-light' onclick=\"
                                                    modify(
                                                        '$fila->id_fiador',
                                                        '$fila->nombre',
                                                        '$fila->apellido',
                                                        '$fila->dui',
                                                        '$fila->nit',
                                                        '$fila->telefono',
                                                        '$fila->celular',
                                                        '$fila->direccion',
                                                        '$fila->correo',
                                                        '$fila->profecion',
                                                        '$fila->salario',
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
                            <div class="">                                
                                <!--  Modal mostrar fiador-->
                                <div id="mostrarFiador" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Datos del Fiador</h4>
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
                                <!--  Modal editar fiador-->
                                <div id="editarFiador" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Editar datos del fiador</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarFiador.php?bandera=1" required class="parsley-examples">
                                                            
                                                            <div class="form-row">
                                                                <input type="hidden" id="idfiador" name="idfiador">
                                                                <input type="hidden" id="id_fiador" name="id_fiador">
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
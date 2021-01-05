<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>

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
                                    <label class="col-sm-2 col-form-label">Proveedores :</label>
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
                                
                                            <th>Nombre</th>
                                            <th>Telefono</th>
                                            <th>Representante</th>
                                            <th>Celular</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </thead>

                                    <tbody> 
                                        <?php
                                             include "config/conexion.php";
                                        $result = $conexion->query("SELECT * from tproveedor ORDER BY id_proveedor");
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
                                                    '$fila->celular',
                                                    '$fila->direccion',
                                                    '$fila->dui',
                                                    '$fila->email',
                                                    '$fila->nit',
                                                    '$fila->nombre',
                                                    '$fila->representante',
                                                    '$fila->telefono'
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
                                                        '$fila->celular',
                                                        '$fila->direccion',
                                                        '$fila->dui',
                                                        '$fila->email',
                                                        '$fila->nit',
                                                        '$fila->nombre',
                                                        '$fila->representante',
                                                        '$fila->telefono'
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
                            </div>
                        </div>
                    </div>
                    <!-- end row --> 

                    <!-- Bootstrap Modals -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">                                
                                <!--  Modal mostrar cliente-->
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
                                            <input type="text"  class="form-control" name="nombre" id="nombre" required  placeholder="Jose Alfredo">
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
                                            <label for="inputEmail4" class="col-form-label">Email</label>
                                            <input type="email"  class="form-control" name="email" id="email"  required  placeholder="Correo@correo.com">
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
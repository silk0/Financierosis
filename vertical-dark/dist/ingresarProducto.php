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
                                <h4 class="page-title">Registro de articulos</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                            <div class="col-lg-12">
        
                                <div class="card-box">
                                    <h4 class="header-title">Basic Form</h4>
                                    <p class="sub-header">
                                        Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.
                                    </p>
        
                                    <form action="#" class="parsley-examples">
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="nombre" class="col-form-label">Codigo</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" required
                                                    placeholder="0000000">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="inputPassword4" class="col-form-label">Nombre</label>
                                                <input type="text" class="form-control" name="apellido" id="apellido"
                                                    required placeholder="Refrigeradora">
                                            </div>
                                        </div>     
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="nombre" class="col-form-label">Precio de compra</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" required
                                                    placeholder="$0.00">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Porcentaje de ganancia</label>
                                                <input type="text" class="form-control" name="apellido" id="apellido"
                                                    required placeholder="0%" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Precio de venta</label>
                                                <input type="text" class="form-control" name="apellido" id="apellido"
                                                    required placeholder="$0.00" readonly>
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre" class="col-form-label">Proveedor</label>
                                                <select  class="form-control" name="cartera" id="cartera" required >
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
                                                <label for="inputPassword4" class="col-form-label">Categoria</label>
                                                <select  class="form-control" name="cartera" id="cartera" required >
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
                                            <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                            <textarea class="form-control" id="observ" name="observ" rows="5"></textarea>
                                        </div>
                                        </br>
                                        <div class="form-row">
                                            <div class="form-group text-right mb-0">
                                                <button class="btn btn-primary waves-effect waves-light mr-1" type="button">
                                                    Registrar
                                                </button>
                                                <button type="reset" class="btn btn-light waves-effect">
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

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>
<script>
    function filtrar() {
        id = document.getElementById("op").value;
        $("#ide").val(id);
        document.form.submit();
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
                                                <div class='button-icon-btn'>
                                                <button class='btn btn-info info-icon-notika btn-reco-mg btn-button-mg' onclick=\"edit('$fila->id_cliente','$fila->nombre','$fila->apellido','$fila->dui','$fila->nit','$fila->direccion','$fila->telefono','$fila->celular','$fila->correo','$fila->tipo_ingreso','$fila->profecion','$fila->salario','$fila->observaciones')\";><i class='notika-icon notika-search'></i></button>
                                                <button class='btn btn-lightgreen lightgreen-icon-notika btn-reco-mg btn-button-mg' onclick='modify(" . $fila->id_cliente. ")'><i class='notika-icon notika-menus'></i></button>
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



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php include_once 'Pie.php';?>

</body>

</html>
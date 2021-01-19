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
<!DOCTYPE html>
<html lang="en">
<script>
    function go() {
        //validacion respectiva me da hueva
        $("#editarForm").submit();;
    }

    function edit(id, nom, ape, dui, rol, usu, contra, dir) {
        // document.getElementById("baccion2").value=id;
        document.getElementById("nombrev").value = nom;
        document.getElementById("apellidov").value = ape;
        document.getElementById("duiv").value = dui;
        document.getElementById("rolv").value = rol;
        document.getElementById("usuariov").value = usu;
        document.getElementById("contrav").value = contra;
        document.getElementById("direcv").value = dir;
    }

    function modify(id, nom, ape, dui, rol, usu, contra, dir) {
        // document.getElementById("baccion2").value=id;
        document.getElementById("id_empleado").value = id;
        document.getElementById("nombrem").value = nom;
        document.getElementById("apellidom").value = ape;
        document.getElementById("duim").value = dui;
        document.getElementById("rolm").value = rol;
        document.getElementById("usuariom").value = usu;
        document.getElementById("contram").value = contra;
        document.getElementById("direcm").value = dir;
    }
</script>
<?php include_once 'Cabecera.php';?>

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
                                <h4 class="page-title">Registro ventas y pago de cuotas</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- //////////////////////////////////// -->
                    <div class="row">
                        <div class="col-12">
                        <?php
                        include "config/conexion.php";
                        $result = $conexion->query("
                        select contado,credito,contado+credito as suma from(select (select  round(sum(b.cantidad),2) as contadoAcum
                        from tdetalle_venta as dv inner join tventas v on dv.id_venta = v.id_venta and dv.tipo = 0
                        inner join tbanco b on v.id_venta = b.id_venta order by v.codigo desc) as contado,
                        (select  round(sum(b.cantidad),2) as creditoAcum
                        from tdetalle_venta as dv inner join tventas v on dv.id_venta = v.id_venta and dv.tipo = 1
                        inner join tbanco b on v.id_venta = b.id_venta order by v.codigo desc) as credito) a;");
                        
                        if ($result) {
                            while ($fila = $result->fetch_object()) {
                                echo "<div class='card-box'>
                                    <div class='form-row' align='center'>
                                    <div class='form-group col-md-3'>                                
                                        <label for='inputEmail4' class='col-form-label'>Total ventas contado <span class='list-group-item border-0 text-success'>$".$fila->contado."</span></label><br>
                                        
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label for='inputEmail4' class='col-form-label'>Total ventas credito <span class='list-group-item border-0 text-success'>$". $fila->credito."</span></label><br>
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label for='inputEmail4' class='col-form-label'>Total ventas <span class='list-group-item border-0 text-success'>$".$fila->suma."</span></label><br>
                                    </div>
                                </div>
                                </div>";
                                }
                            }
                        ?>
                        </div>
                    </div>
                    <!-- end /////////////////// -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <form id="fCartera" name="fCartera" action="" method="GET" class="parsley-examples">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Concepto</th>
                                                <th>Precio</th>
                                                <th>Venta</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("select  v.fecha, b.descripcion, concat('$ ',b.cantidad) as precio,dv.tipo
                                                    from tdetalle_venta as dv inner join tventas v on dv.id_venta = v.id_venta
                                                    inner join tbanco b on v.id_venta = b.id_venta order by v.codigo desc ;
                                            ");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->descripcion . "</td>";
                                                echo "<td>" . $fila->precio . "</td>";
                                                if($fila->tipo == 0 )
                                                    echo "<td align='center'> <h5><span class='list-group-item border-3 text-success'>Contado</span></h5></td>";
                                                if($fila->tipo == 1 )
                                                echo "<td align='center'> <h5><span class='list-group-item border-3 text-warning'>Credito</span><h5></td>";
                                                
                                                echo "</tr>";
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
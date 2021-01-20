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
        header("Location:../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
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
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Line Charts</h4>

                            <div class="mt-4">
                                <div id="sparkline1"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Bar Chart</h4>

                            <div class="mt-4">
                                <div id="sparkline2" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-12 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Articulos en el inventario</h4>

                            <div class="mt-4">
                                <div id="piechart" class="text-left"></div>
                                <div id="sparkline4" class="text-right"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Custom Line Chart</h4>

                            <div class="mt-4">
                                <div id="sparkline4" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    
                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Composite bar Chart</h4>

                            <div class="text-center mt-4">
                                <div id="sparkline6" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Discrete Chart</h4>

                            <div class="text-center mt-4">
                                <div id="sparkline7" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Bullet Chart</h4>

                            <div class="text-center mt-4" style="min-height: 164px;">
                                <div id="sparkline8" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Box Plot Chart</h4>

                            <div class="text-center mt-4" style="min-height: 164px;">
                                <div id="sparkline9" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Tristate Charts</h4>

                            <div class="text-center mt-4" style="min-height: 164px;">
                                <div id="sparkline10" class="text-center"></div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

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
    <script type="text/javascript">  
       
        $("#piechart").sparkline([80,5,5,10],
            {   type:"pie",
                width:"165",
                height:"165",
                sliceColors:["#35b8e0","#3b3e47","#e3eaef","#f34943"]
            }
        )        
    
    </script>
</body>

</html>
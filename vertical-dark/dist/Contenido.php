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
                        <div class="col-xl-4 col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Line Chart</h4>
                                <div class="row text-center">
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">4,335</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">874</h3>
                                        <p class="text-muted text-overflow">Open Compaign</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">2,548</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                </div>
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="line-chart-example"></canvas>    
                                </div>            
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
    
                        <div class="col-xl-4 col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Bar Chart</h4>
                                <div class="row text-center">
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">2,548</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">1,254</h3>
                                        <p class="text-muted text-overflow">Open Compaign</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">8,954</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                </div>
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="bar-chart-example"></canvas>    
                                </div>            
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
    
                        <div class="col-xl-4 col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Area Chart</h4>
                                <div class="row text-center">
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">3,365</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">952</h3>
                                        <p class="text-muted text-overflow">Open Compaign</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">1,880</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                </div>
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="area-chart-example"></canvas>    
                                </div>            
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Doughnut Chart</h4>
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="doughnut1" width="400" height="400"></canvas>    
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">5,548</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">2,289</h3>
                                        <p class="text-muted text-overflow">Open Compaign</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">9,847</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                </div>
                                            
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
    
                        <div class="col-xl-4 col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Polar Area Chart</h4>
                                <div class="row text-center">
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">8,941</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">4,251</h3>
                                        <p class="text-muted text-overflow">Open Compaign</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">1,008</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                </div>
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="barra"></canvas>    
                                </div>            
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
    
                        <div class="col-xl-4 col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Filled Line Chart</h4>
                                <div class="row text-center">
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">2,840</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">10,584</h3>
                                        <p class="text-muted text-overflow">Open Compaign</p>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <h3 class="font-weight-light">821</h3>
                                        <p class="text-muted text-overflow">Total Sales</p>
                                    </div>
                                </div>
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="filled-line-chart"></canvas>    
                                </div>            
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
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
       
        new Chart($("#doughnut1"), {
            type: 'doughnut',
            data: {
                labels: ["Wallet Balance","Travels","Food & Drinks","Nuevo"],
                datasets:[{
                        data:[300,50,100,333],
                            backgroundColor:["#02a8b5","#fa5c7c","#ebeff2","#ef84f6"],
                            borderColor:"transparent",
                            borderWidth:"1"}
                        ]         
            }
                        
        });      

    </script>
    <script type="text/javascript">
        new Chart($("#barra"), {
            type: 'bar',
            data: {
                labels: ["Wallet Balance","Travels","Food & Drinks","Nuevo"],
                datasets:[{
                        data:[300,50,100,333],
                            backgroundColor:["#02a8b5","#fa5c7c","#ebeff2","#ef84f6"],
                            borderColor:"transparent",
                            borderWidth:"1"}
                        ]         
            }
                        
        });    
    </script>
</body>

</html>
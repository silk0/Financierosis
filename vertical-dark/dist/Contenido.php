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
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title mb-3">Articulos en inventario</h4>                                
                            
                            <div class="chartjs-chart-example chartjs-chart">
                                <canvas id="doughnut1" width="100" height="100"></canvas>    
                            </div>
                            </br></br></br></br></br></br>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card-box">
                        
                            <h4 class="header-title mb-3">Registros en el sistema financiero</h4>
                            <?php include "config/conexion.php";
                                $usado = $conexion->query("select
                                    (select count(*) from tclientes) as c,
                                    (select count(*) from tproveedor) as p,
                                    (select count(*) from tfiador) as f,
                                    (select count(*) from templeados) as e;");
                                if($usado){
                                    while($filo = $usado->fetch_object()){       
                                    
                                        echo    "<div class='row text-center'>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->c."</h3>
                                                        <p class='text-muted text-overflow'>Clientes</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->p."</h3>
                                                        <p class='text-muted text-overflow'>Proveedores</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->f."</h3>
                                                        <p class='text-muted text-overflow'>Fiadores</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->e."</h3>
                                                        <p class='text-muted text-overflow'>Empleados</p>
                                                    </div>                                   
                                                </div>";
                                    }
                                }
                            ?>
                            
                            <div class="chartjs-chart-example chartjs-chart">
                            
                                <div id="barra" style="width=800px; height=600px" class="ct-chart ct-golden-section"></div>    
                            </div>            
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->                  
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title">Articulos Bajos el minimos</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th> 
                                            <th>Articulo</th> 
                                            <th>Stock</th> 
                                            <th>Stock minimo</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $usado = $conexion->query("select codigo,nombre,stock,stock_minimo from 
                                        tproducto p where p.stock_minimo>=p.stock");
                                        if($usado){
                                            while($filo = $usado->fetch_object()){
                                        echo "
                                        <tr>
                                            <th scope='row'>".$filo->codigo."</th>
                                            <td>".$filo->nombre."</td>
                                            <td>".$filo->stock."</td>
                                            <td>".$filo->stock_minimo."</td>                                            
                                        </tr>
                                        ";
                                        }}
                                    ?>                                        
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end card-box -->
                    </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                        <div class="card-box">                        
                            <h4 class="header-title mb-3">Ventas al credito</h4>
                            <?php include "config/conexion.php";
                                $usado = $conexion->query("select
                                (select count(*) from tventas where estado='Incobrable') i,
                                (select count(*) from tventas where estado='Cancelado') c,
                                (select count(*) from tventas where estado='Moroso') m,
                                (select count(*) from tventas where estado='Pendiente') p;");
                                if($usado){
                                    while($filo = $usado->fetch_object()){       
                                    
                                        echo    "<div class='row text-center'>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->p."</h3>
                                                        <p class='text-muted text-overflow'>Pendiente</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->c."</h3>
                                                        <p class='text-muted text-overflow'>Canceladas</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->i."</h3>
                                                        <p class='text-muted text-overflow'>Incobrable</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->m."</h3>
                                                        <p class='text-muted text-overflow'>Morosa</p>
                                                    </div>                                   
                                                </div>";
                                    }
                                }
                            ?>
                            
                            <div class="chartjs-chart-example chartjs-chart">
                            
                                <div id="barra2" style="width=800px; height=600px" class="ct-chart ct-golden-section"></div>    
                            </div>            
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->  
                    <div class="col-lg-6">
                        <div class="card-box">                        
                            <h4 class="header-title mb-3">Registro de Ventas Realizadas</h4>
                            <?php include "config/conexion.php";
                                $usado = $conexion->query("select
                                (select count(*) from tdetalle_venta where tipo=1) cre,
                                (select count(*) from tdetalle_venta where tipo=0) con;");
                                if($usado){
                                    while($filo = $usado->fetch_object()){       
                                    
                                        echo    "<div class='row text-center'>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->cre."</h3>
                                                        <p class='text-muted text-overflow'>Ventas al credito</p>
                                                    </div>
                                                    <div class='col-sm-3 mb-3'>
                                                        <h3 class='font-weight-light'>".$filo->con."</h3>
                                                        <p class='text-muted text-overflow'>Ventas al contado</p>
                                                    </div>
                                                                                  
                                                </div>";
                                    }
                                }
                            ?>
                            
                            <div class="chartjs-chart-example chartjs-chart">
                            
                                <div id="barra1" style="width=800px; height=600px" class="ct-chart ct-golden-section"></div>    
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
       
             

    </script>
    <?php include "config/conexion.php";
        $usado = $conexion->query("select
            (select count(*) from tclientes) as c,
            (select count(*) from tproveedor) as p,
            (select count(*) from tfiador) as f,
            (select count(*) from templeados) as e;");
        if($usado){
            while($filo = $usado->fetch_object()){        
            echo "<script type='text/javascript'>
                    var depre = new Chartist.Bar('#barra', {
                        labels: ['Clientes', 'Proveedores', 'Fiadiores','Empleados'],
                        series: [".$filo->c.", ".$filo->p.", ".$filo->f.",".$filo->e."]
                    }, {
                        distributeSeries: true,
                        fullWidth: true,
                        chartPadding: {
                            right: 40
                        }
                    });
                </script>";
            }
        }
    ?>
    <?php include "config/conexion.php";
        $usado = $conexion->query("select
        (select count(*) from tdetalle_venta where tipo=1) cre,
        (select count(*) from tdetalle_venta where tipo=0) con;");
        if($usado){
            while($filo = $usado->fetch_object()){        
            echo "<script type='text/javascript'>
                    var depre = new Chartist.Bar('#barra1', {
                        labels: ['Ventas al credito', 'Ventas al contado'],
                        series: [".$filo->cre.", ".$filo->con."]
                    }, {
                        distributeSeries: true,
                        fullWidth: true,
                        chartPadding: {
                            right: 40
                        }
                    });
                </script>";
            }
        }
    ?>
    <?php include "config/conexion.php";
        $usado = $conexion->query("select
        (select count(*) from tventas where estado='Incobrable') i,
        (select count(*) from tventas where estado='Cancelado') c,
        (select count(*) from tventas where estado='Moroso') m,
        (select count(*) from tventas where estado='Pendiente') p;");
        if($usado){
            while($filo = $usado->fetch_object()){        
            echo "<script type='text/javascript'>
                    var depre = new Chartist.Bar('#barra2', {
                        labels: ['Pendiente', 'Cancelado','Moroso','Incobrable'],
                        series: [".$filo->p.", ".$filo->c.",".$filo->m.",".$filo->i."]
                    }, {
                        distributeSeries: true,
                        fullWidth: true,
                        chartPadding: {
                            right: 40
                        }
                    });
                </script>";
            }
        }
    ?>    
    <?php include "config/conexion.php";
        $usado = $conexion->query("select 
        (select count(*) from tproducto p where p.stock_minimo<p.stock) n,
        (select count(*) from tproducto p where p.stock_minimo>=p.stock) m;");

        if($usado){
            while($filo = $usado->fetch_object()){        
            echo "<script type='text/javascript'>
                new Chart($('#doughnut1'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Articulos sobre el minimo','Articulos bajo el minimo'],
                        datasets:[{
                                data:[".$filo->n.",".$filo->m."],
                                    backgroundColor:['#02a8b5','#fa5c7c'],
                                    borderColor:'transparent',
                                    borderWidth:'200'}
                                ]         
                    }
                            
                 }); 
                </script>";
            }
        }
    ?>
</body>

</html>
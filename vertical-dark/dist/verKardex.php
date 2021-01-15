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
?>
<?php
    $id = $_REQUEST["id"];
    include "config/conexion.php";
    $result = $conexion->query("select p.id_producto as idp, 
     p.nombre as namep,prov.id_proveedor as idprov,prov.nombre as nameprov,
     p.stock as stock, stock_minimo as stockm,p.codigo as cod, concat('$ ',precio_compra*stock) as total
     from tproducto as p,tproveedor as prov  
     where p.id_proveedor=prov.id_proveedor and id_producto=" . $id);
    if ($result) {
        while ($fila = $result->fetch_object()) {
            $idR            = $fila->idp;
            $nombreprod     = $fila->namep;
            $idprov         = $fila->idprov;
            $nombreprov      = $fila->nameprov;   
            $stock      = $fila->stock;   
            $codigo      = $fila->cod;  
            $stockm      = $fila->stockm;   
            $total      = $fila->total;       
        }
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
                    
                    <!-- end page title -->
                    <div class="row">        
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Kardex</h4>
                                    <p class="sub-header">
                                        Se lleva el control de los articulos en el inventario sus entradas y salidas de producto.
                                    </p>
                                    <div class="row ">
                                        <div class="col-md-3">
                                            <div class="text-md-right">
                                                <div class="line-h-24" align="left">
                                                    <label>Articulo: <?php  echo $nombreprod;?></label>
                                                    <br>
                                                    <label>Proveedor: <?php  echo $nombreprov;?></label><br>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-3">
                                            <div class="text-md-right">
                                                <div class="line-h-24" align="left">
                                                    <label>Stock Minimo: <?php  echo $stockm;?></label>
                                                    <br>
                                                    <label>Cantidad en stock: <?php  echo $stock;?></label><br>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-3">
                                            <div class="text-md-right">
                                                <div class="line-h-24" align="left">
                                                    <label>Codigo articulo: <?php  echo $codigo;?></label>
                                                    <br>
                                                    <label>Valor total: <?php  echo $total;?></label><br>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-3" >
                                            
                                        </div> <!-- end col -->
                                    </div>
                                    </br>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr class="table-info text-info">                                                
                                                    <th style="width: 10%;">Fecha</th>
                                                    <th style="width: 30%;">Descripción</th>
                                                    <th colspan="3" style="width: 12%;">Entradas</th>
                                                    <th colspan="3" style="width: 10%;">Salidas</th>
                                                    <th colspan="3" style="width: 10%;">Saldo</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-info text-info">
                                                    <td></td>
                                                    <td></td>
                                                    <td >Cant.</td>
                                                    <td >P.Unitario</td>
                                                    <td >Total</td>
                                                    <td >Cant.</td>
                                                    <td >P.Unitario</td>
                                                    <td >Total</td>
                                                    <td >Cant.</td>
                                                    <td >P.Unitario</td>
                                                    <td >Total</td>                       
                                                </tr>
                                                <?php
                                                include 'config/conexion.php';
                                                $result = $conexion->query("select *, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha from kardex where id_producto=".$id);
                                                if ($result) {
                                                    while ($fila = $result->fetch_object()) {
                                                    if ($fila->movimiento==1){
                                                        echo "<tr class='table-success text-success'>";
                                                        echo "<td>".$fila->fecha."</td>";
                                                        echo "<td>".$fila->descripcion."</td>";
                                                        echo "<td class='warning'>".$fila->cantidad."</td>";
                                                        echo "<td class='danger'>".$fila->vunitario."</td>";
                                                        $total=($fila->cantidad)*$fila->vunitario;
                                                        echo "<td class='info'>".$total."</td>";
                                                        echo "<td class='warning'></td>";
                                                        echo "<td class='danger'></td>";
                                                        echo "<td class='info'></td>";
                                                    }else {
                                                        echo "<tr class='table-danger text-danger'>";
                                                        echo "<td>".$fila->fecha."</td>";
                                                        echo "<td>".$fila->descripcion."</td>";
                                                        echo "<td class='warning'></td>";
                                                        echo "<td class='danger'></td>";
                                                        echo "<td class='info'></td>";
                                                        echo "<td class='warning'>".$fila->cantidad."</td>";
                                                        echo "<td class='danger'>".$fila->vunitario."</td>";
                                                        $total=($fila->cantidad)*$fila->vunitario;
                                                        echo "<td class='info'>".$total."</td>";
                                                    }
                                                    echo "<td class='warning'>".$fila->cantidads."</td>";
                                                    echo "<td class='danger'>".$fila->vunitarios."</td>";
                                                    echo "<td class='info'>".$fila->vtotals."</td>";

                                                    echo "</tr>";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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

</body>

</html>
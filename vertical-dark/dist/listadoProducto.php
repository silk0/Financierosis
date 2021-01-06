<!DOCTYPE html>
<html lang="en">
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
<?php include_once 'Cabecera.php';?>
<SCRIPT  language=JavaScript> 
    function go(){
        //validacion respectiva me da hueva
        $("#editarForm").submit();;         
    } 

    function ver(id_prod,id_prov,id_cat,nomb,desc,pc,mg,pv,st,cod,esta)
    {
        document.getElementById("codigo").value=cod;
        document.getElementById("nombre").value=nomb;
        document.getElementById("stock").value=Number(st);
        document.getElementById("mganancia").value=Number(mg);
        document.getElementById("pcompra").value=Number(pc);
        document.getElementById("pventa").value=Number(pv);
        document.getElementById("idproveedor").value=id_prov;
        document.getElementById("categoria").value=id_cat;
        document.getElementById("descrip").value=desc;
    }
</script>

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
                                <h4 class="page-title">Contenido</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title">Buttons example</h4>
                                <p class="sub-header">
                                    The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                                </p>        
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Precio compra</th>
                                            <th>Precio venta</th>
                                            <th>Stock</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                    <?php
                                    
                                    include "config/conexion.php";
                                
                                    $result = $conexion->query("SELECT * from tproducto ORDER BY stock,stock_minimo ASC");
                                    
                                    if ($result) {
                                        while ($fila = $result->fetch_object()) {
                                            echo "<tr>";                                                
                                            echo "<td>" . $fila->codigo . "</td>";
                                            echo "<td>" . $fila->nombre . "</td>";
                                            echo "<td>" . $fila->precio_compra. "</td>"; 
                                            echo "<td>" . $fila->precio_venta . "</td>";
                                            echo "<td>" . $fila->stock . "</td>"; 
                                            if(($fila->estado)>0)                                               
                                                echo "<td> Activo </td>";
                                            else{ echo "<td> Inactivo </td>";}
                                            
                                                echo "<td align='center'>                                                 
                                                <button
                                                button type='button'
                                                data-toggle='modal'                                                    
                                                data-target='#verProducto'    
                                                title='Ver tarjeta kardex.'
                                                data-toggle='tooltip'                                                
                                                class='btn btn-primary waves-effect waves-light' onclick=\"
                                                ver(
                                                '$fila->id_producto',
                                                '$fila->id_proveedor',
                                                '$fila->id_categoria',
                                                '$fila->nombre',
                                                '$fila->descripcion',
                                                '$fila->precio_compra',
                                                '$fila->margen',
                                                '$fila->precio_venta',
                                                '$fila->stock_minimo',
                                                '$fila->codigo',
                                                '$fila->estado'
                                                )\";>
                                                    <i class='mdi mdi-eye'></i> 
                                                </button>  
                                                <button 
                                                type='button'
                                                data-toggle='modal'                                                    
                                                data-target='#editarCliente'
                                                class='btn btn-pink waves-effect waves-light' onclick=\"
                                                modify(
                                                '$fila->id_cliente',
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
                                                '$fila->egreso',
                                                '$fila->id_cartera'
                                                )\";>                                                    
                                                    <i class='mdi mdi-pencil-outline'></i></i>
                                                </button>
                                                <button 
                                                button type='button'
                                                data-toggle='modal'                                                    
                                                data-target='#mostrarCliente'                                                    
                                                class='btn btn-success waves-effect waves-light' onclick=\"
                                                edit(
                                                '$fila->id_cliente',
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
                                                '$fila->egreso',
                                                '$fila->id_cartera'
                                                )\";>
                                                    <i class='dripicons-enter'></i> 
                                                </button>  
                                                <button 
                                                button type='button'
                                                data-toggle='modal'                                                    
                                                data-target='#mostrarCliente'                                                    
                                                class='btn btn-info waves-effect waves-light' onclick=\"
                                                edit(
                                                '$fila->id_cliente',
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
                                                '$fila->egreso',
                                                '$fila->id_cartera'
                                                )\";>
                                                    <i class='dripicons-exit'></i> 
                                                </button>  
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
                                <div id="verProducto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Datos del cliente</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form id="verProducto" name="verProducto" method="post"  class="parsley-examples" readonly>
                                                                <input type="hidden" id="bandera" name="bandera" value="1">
                                                                
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="codigo" class="col-form-label">Codigo</label>
                                                                        <input type="text" class="form-control" name="codigo" id="codigo" readonly
                                                                            placeholder="0000000">
                                                                    </div>
                                                                    <div class="form-group col-md-8">
                                                                        <label for="nombre" class="col-form-label">Nombre</label>
                                                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                                                        readonly placeholder="Refrigeradora">
                                                                    </div>
                                                                </div>     
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-3">
                                                                        <label for="stock" class="col-form-label">Stock minimo</label>
                                                                        <input type="number" class="form-control" name="stock" id="stock" readonly
                                                                            placeholder="0">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="pcompra" class="col-form-label">Precio de compra</label>
                                                                        <input type="number" class="form-control" name="pcompra" id="pcompra" readonly
                                                                            placeholder="$0.00">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="mganancia" class="col-form-label">Porcentaje de ganancia</label>
                                                                        <input type="number" class="form-control" name="mganancia" id="mganancia"
                                                                            required placeholder="0%" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="pventa" class="col-form-label">Precio de venta</label>
                                                                        <input type="number" class="form-control" name="pventa" id="pventa"
                                                                            required placeholder="$0.00" readonly>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="idproveedor" class="col-form-label">Proveedor</label>
                                                                        <select  class="form-control" name="idproveedor" id="idproveedor"  disabled>
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
                                                                        <label for="categoria" class="col-form-label">Categoria</label>
                                                                        <select  class="form-control" name="categoria" id="categoria" disabled>
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
                                                                    <label for="descrip" class="col-form-label">Descripcion</label>
                                                                    <textarea class="form-control" id="descrip" name="descrip" rows="5" readonly></textarea>
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
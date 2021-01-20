<!DOCTYPE html>
<html lang="en">
<?php include_once 'Cabecera.php';?>
<SCRIPT language=JavaScript>
    function edi() {
        $("#editarForm").submit();;
    }

    function kardex() {
        var id = document.getElementById("id_producto").value;
        document.location.href = "verKardex.php?id=" + id;
    }

    function añadircarrito() {
        var cantidadDeseada = document.getElementById("carritoA").value;
        var id = document.getElementById("id_producto").value;
        var stock = document.getElementById("cantidadI").value;
        if (cantidadDeseada == "") {
            Swal.fire(
                'Error',
                'La cantidad deseada supera a la cantidad disponible',
                'error'
            );
        } else if (parseInt(cantidadDeseada) > parseInt(stock)) {
            Swal.fire(
                'Error',
                'La cantidad deseada supera a la cantidad disponible',
                'error'
            );

        } else {

            $("#carritoForm").submit();

        }
    }

    function añadirCompra() {
        
        $("#comprarProduct").submit();
    }

    function añadirDevolucion() {

        $("#devolverProducto").submit();
    }

    function ver(id_prod, id_prov, id_cat, nomb, desc, pc, mg, pv, st, cod, esta) {
       
        document.getElementById("id_produc").value = id_prod;
        document.getElementById("codigo").value = cod;
        document.getElementById("nombre").value = nomb;
        document.getElementById("stock").value = Number(st);
        document.getElementById("mganancia").value = Number(mg);
        document.getElementById("pcompra").value = Number(pc);        
        document.getElementById("idproveedor").value = id_prov;
        document.getElementById("descri").value = desc;
        document.getElementById("categoria").value = Number(id_cat);
        document.getElementById("estado").value = Number(esta);
    }

    function compra(id_prod, cod, id_prov, nomb) {
        document.getElementById("idC").value = Number(id_prod);
        document.getElementById("codigoC").value = cod;
        document.getElementById("nombreC").value = nomb;
        document.getElementById("idproveedorC").value = Number(id_prov);
    }

    function carrit(id, nom, cod, stock, cant) {
        document.getElementById("id_producto").value = id;
        document.getElementById("codigoA").value = cod;
        document.getElementById("nombreA").value = nom;
        document.getElementById("cantidadI").value = Number(stock);
        if (isNaN(cant)) {
            document.getElementById("carritoC").value = Number(0);
        } else {
            document.getElementById("carritoC").value = Number(cant);
        }
    }

    function devolucion(id_prod, cod, id_prov, nomb) {
        document.getElementById("idD").value = id_prod;
        document.getElementById("codigoD").value = cod;
        document.getElementById("nombreD").value = nomb;
        document.getElementById("idproveedorD").value = Number(id_prov);
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
                                <h4 class="page-title">Inventario de articulos</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <p>En la siguiente tabla se puede realizar la compras, ventas, edicion de datos de los
                                    articulos registrados en el inventario.</p>
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap">
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
                                
                                    $result = $conexion->query("Select *,(select sum(cantidad)
                                    from tcarrito t
                                    where t.id_producto=p.id_producto) as cantidad from tproducto p
                                    order by stock desc;");
                                    
                                    if ($result) {
                                        while ($fila = $result->fetch_object()) {
                                            echo "<tr>";                                                
                                            echo "<td>" . $fila->codigo . "</td>";
                                            echo "<td>" . $fila->nombre . "</td>";
                                            echo "<td>$ " . $fila->precio_compra. "</td>"; 
                                            echo "<td>$ " . $fila->precio_venta . "</td>";
                                            echo "<td>" . $fila->stock . "</td>"; 
                                            if(($fila->estado)>0)                                         
                                             echo "<td> Activo </td>";
                                            else{ echo "<td> Inactivo </td>";}
                                            
                                                $a = "<td style='width: 15%;' align='center'> 
                                                <span  data-toggle='modal' data-target='#verProducto' >                                                                                                                          
                                                    <button
                                                        button type='button'
                                                        title='Informacion'
                                                        data-toggle='tooltip' 
                                                        data-placement='bottom'                                                                     
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
                                                            '$fila->estado',
                                                        )\";>
                                                            <i class='mdi mdi-eye'></i> 
                                                    </button>  
                                                </span>";

                                                if((($fila->estado)>0)&&(($fila->stock)>0))
                                                    $a .="<span  data-toggle='modal' data-target='#carrito' >
                                                        <button 
                                                        type='button'
                                                        title='Añadir al carrito'
                                                        data-toggle='tooltip' 
                                                        data-placement='bottom'     
                                                        class='btn btn-pink waves-effect waves-light' onclick=\"
                                                        carrit(
                                                            '$fila->id_producto',
                                                            '$fila->nombre',
                                                            '$fila->codigo',
                                                            '$fila->stock',
                                                            '$fila->cantidad'
                                                        )\";>                                                    
                                                            <i class='mdi mdi-cart'></i></i>
                                                        </button>
                                                    </span>";


                                                $a .="<span  data-toggle='modal' data-target='#comprar' >
                                                <button 
                                                button type='button'
                                                title='Compra'
                                                data-toggle='tooltip' 
                                                data-placement='bottom'                                                    
                                                class='btn btn-success waves-effect waves-light' onclick=\"
                                                compra(                                                
                                                    '$fila->id_producto',                                                    
                                                    '$fila->codigo',
                                                    '$fila->id_proveedor',
                                                    '$fila->nombre'
                                                )\";>
                                                    <i class='dripicons-enter'></i> 
                                                </button>
                                                </span>";

                                                if(($fila->stock)>0)
                                                    $a .="<span  data-toggle='modal' data-target='#devolucion' >  
                                                    <button 
                                                    button type='button'
                                                    title='Devolucion'
                                                    data-toggle='tooltip' 
                                                    data-placement='bottom'                                                              
                                                    class='btn btn-info waves-effect waves-light' onclick=\"
                                                    devolucion(
                                                        '$fila->id_producto',                                                    
                                                        '$fila->codigo',
                                                        '$fila->id_proveedor',
                                                        '$fila->nombre'
                                                    )\";>
                                                        <i class='dripicons-exit'></i> 
                                                    </button> 
                                                    </span> 
                                                    </td>";
                                            echo $a;
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
                            <!--  Modal mostrar VerProductos-->
                            <div id="verProducto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">Datos del Producto</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-box">
                                                        <form name="editarForm" id="editarForm" method="post"
                                                            action="scriptsphp/modificarProducto.php?bandera=1" required
                                                            class="parsley-examples">
                                                            <div class="form-row">
                                                                <input type="hidden" id="id_produc" name="id_produc">
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="codigo"
                                                                        class="col-form-label">Codigo</label>
                                                                    <input type="text" class="form-control"
                                                                        name="codigo" id="codigo" readonly
                                                                        placeholder="0000000">
                                                                </div>
                                                                <div class="form-group col-md-8">
                                                                    <label for="nombre"
                                                                        class="col-form-label">Nombre</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nombre" id="nombre"
                                                                        placeholder="Refrigeradora">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="stock" class="col-form-label">Stock
                                                                        minimo</label>
                                                                    <input type="number" class="form-control"
                                                                        name="stock" id="stock" placeholder="0">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="pcompra" class="col-form-label">Precio
                                                                        de compra</label>
                                                                    <input type="number" class="form-control"
                                                                        name="pcompra" id="pcompra" placeholder="$0.00">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="mganancia"
                                                                        class="col-form-label">Porcentaje de
                                                                        ganancia</label>
                                                                    <input type="number" class="form-control"
                                                                        name="mganancia" id="mganancia" required
                                                                        placeholder="0%">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="idproveedor"
                                                                        class="col-form-label">Proveedor</label>
                                                                    <select class="form-control" name="idproveedor"
                                                                        id="idproveedor" >
                                                                        </option>
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
                                                                    <label for="categoria"
                                                                        class="col-form-label">Categoria</label>
                                                                    <select class="form-control" name="categoria"
                                                                        id="categoria">
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
                                                                <label for="descrip"
                                                                    class="col-form-label">Descripcion</label>
                                                                <textarea class="form-control" id="descri"
                                                                    name="descri" rows="5"></textarea>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputState"
                                                                        class="col-form-label">Estado</label>
                                                                    <select class="form-control" name="estado"
                                                                        id="estado" >
                                                                        <?php
                                                                                    echo "<option value='1'>Activo</option>";
                                                                                    echo "<option value='0'>Inactivo</option>";
                                                                                ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"
                                            onclick="kardex();"><span>Kardex</span><i
                                                class="icon-doc ml-1"></i></button>
                                        <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"
                                            id="cambios" name="cambios" onclick="edi();"><span>Guardar Cambios</span><i
                                                class="mdi mdi-content-save ml-1"></i></button>
                                        <button type="button" class="btn btn-light waves-effect"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->



                        <!--  Modal -->
                        <div id="devolucion" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="tituloC" name="tituloC">Devolver producto</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-box">
                                                    <form id="devolverProducto" name="devolverProducto"
                                                        action="scriptsphp/addCompraVenta.php?bandera=2" method="post"
                                                        class="parsley-examples" readonly>
                                                        <input type="hidden" id="idD" name="idD">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="codigoC"
                                                                    class="col-form-label">Codigo</label>
                                                                <input type="text" class="form-control" name="codigoD"
                                                                    id="codigoD" readonly placeholder="0000000">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="nombreC"
                                                                    class="col-form-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombreD"
                                                                    id="nombreD" readonly placeholder="Nombre">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="idproveedorD"
                                                                    class="col-form-label">Proveedor</label>
                                                                <select class="form-control" name="idproveedorD"
                                                                    id="idproveedorD" disabled>
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
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="stock"
                                                                    class="col-form-label">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                    name="cantidadD" id="cantidadD" placeholder="0">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer form-group">
                                        <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"
                                            onclick="kardex();"><span>Kardex</span><i
                                                class="icon-doc ml-1"></i></button>
                                        <button type="button" onclick="añadirDevolucion();"
                                            class="btn  btn-primary waves-effect"
                                            data-dismiss="modal">Registrar</button>
                                        <button type="button" class="btn btn-light waves-effect"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!--  Modal comprar ComprarProductos-->
                        <div id="comprar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="tituloC" name="tituloC">Comprar producto</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-box">
                                                    <form id="comprarProduct" name="comprarProduct" method="post"
                                                        action="scriptsphp/addCompraVenta.php?bandera=1"
                                                        class="parsley-examples">
                                                        <input type="hidden" id="idC" name="idC">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="codigoC"
                                                                    class="col-form-label">Codigo</label>
                                                                <input type="text" class="form-control" name="codigoC"
                                                                    id="codigoC" readonly placeholder="0000000">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="nombreC"
                                                                    class="col-form-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombreC"
                                                                    id="nombreC" readonly placeholder="Nombre">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="idproveedorC"
                                                                    class="col-form-label">Proveedor</label>
                                                                <select class="form-control" name="idproveedorC"
                                                                    id="idproveedorC" disabled>
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
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="stock" class="col-form-label">Factura
                                                                    No.</label>
                                                                <input type="text" class="form-control" name="facturaC"
                                                                    id="facturaD" placeholder="No.3456789">
                                                            </div>
                                                        </div>


                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="stock" class="col-form-label">Precio</label>
                                                                <input type="number" class="form-control" name="precioC"
                                                                    id="precioC" placeholder="$0.00">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="stock"
                                                                    class="col-form-label">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                    name="cantidadC" id="cantidadC" placeholder="$0.00">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="stock" class="col-form-label">Precio
                                                                    Total</label>
                                                                <input type="text" class="form-control" name="precioTC"
                                                                    id="precioTC" placeholder="$0.00" readonly>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer form-group">
                                        <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"
                                            onclick="kardex();"><span>Kardex</span><i
                                                class="icon-doc ml-1"></i></button>
                                        <button type="button" onclick="añadirCompra();"
                                            class="btn  btn-primary waves-effect"
                                            data-dismiss="modal">Registrar</button>
                                        <button type="button" class="btn btn-light waves-effect"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!--  Modal mostrar añadir carrito-->
                        <div id="carrito" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Añadir al carrito</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-box">
                                                    <form id="carritoForm" name="carritoForm" method="post"
                                                        action="scriptsphp/ajaxCarrito.php?op=1"
                                                        class="parsley-examples">

                                                        <div class="form-row">
                                                            <input type="hidden" class="form-control" name="id_producto"
                                                                id="id_producto" readonly>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="codigoC"
                                                                    class="col-form-label">Codigo</label>
                                                                <input type="text" class="form-control" name="codigoA"
                                                                    id="codigoA" readonly placeholder="0000000">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="nombreC"
                                                                    class="col-form-label">Articulo</label>
                                                                <input type="text" class="form-control" name="nombreA"
                                                                    id="nombreA" readonly placeholder="Nombre">
                                                            </div>
                                                        </div>


                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="stock"
                                                                    class="col-form-label">Inventario</label>
                                                                <input type="number" class="form-control"
                                                                    name="cantidadI" id="cantidadI" placeholder="0"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="stock"
                                                                    class="col-form-label">Carrito</label>
                                                                <input type="number" class="form-control"
                                                                    name="carritoC" id="carritoC" placeholder="0"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="stock" class="col-form-label">Añadir
                                                                    articulo</label>
                                                                <input type="number" class="form-control"
                                                                    name="carritoA" id="carritoA" placeholder="0">
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"
                                            onclick="kardex();"><span>Kardex</span><i
                                                class="icon-doc ml-1"></i></button>
                                        <button type="button" class="btn  btn-primary waves-effect" data-dismiss="modal"
                                            onclick="añadircarrito();">Añadir al
                                            carrito</button>
                                        <button type="button" class="btn btn-light waves-effect"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
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
    <script type="text/javascript">
        //genracion de codigo
        $(document).ready(function () {
            $("#cantidadC").keyup(function () {
                var cantidad = $(this).val();
                var precio = document.getElementById("precioC").value;
                var precioTotal = cantidad * precio;
                if (isNaN(precioTotal)) {
                    $("#precioTC").val("$0.00");
                } else {
                    $("#precioTC").val("$ " + precioTotal);
                }

            });
        });
        $(document).ready(function () {
            $("#precioC").keyup(function () {
                var cantidad = document.getElementById("cantidadC").value;
                var precio = $(this).val();
                var precioTotal = Number(cantidad) * Number(precio);
                if (isNaN(precioTotal)) {
                    $("#precioTC").val("$0.00");
                } else {
                    $("#precioTC").val("$ " + precioTotal);
                }

            });
        });
    </script>
</body>

</html>
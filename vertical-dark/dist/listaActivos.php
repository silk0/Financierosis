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
        header("Location:index.php");
    }

    if( isset($_REQUEST["cartera"]) ){
		$cartera=($_REQUEST['cartera']);
	}else{
		$cartera=-1;
	}


?>
<?php include_once 'Cabecera.php';?>

<SCRIPT language=JavaScript>
    function go() {
        //validacion respectiva me da hueva
        $("#editarForm").submit();

    }

    function grafica(dDia, dMes, dAno) {
        $dia = Number(dDia);
        $mes = Number(dMes);
        $ano = Number(dAno);
        document.getElementById("id_depreciacion").innerHTML = 
        "Depreciacion Actual</br>Dia: &nbsp;&nbsp;$" + $dia + "&nbsp;&nbsp;Mes: &nbsp;&nbsp;$" + $mes + "&nbsp;&nbsp;Año: $" +$ano;
        depre = new Chartist.Bar('#distributed-series', {
            labels: ['Dias', 'Meses', 'Años'],
            series: [dDia, dMes, dAno]
        }, {
            distributeSeries: true,
            ticks: ['One', 'Two', 'Three'],
            fullWidth: true,
            width: '300px',
            chartPadding: {
                right: 40
            }
        });

    }
    function edit(id, cor, vid, inst, uni, tip, aad, fec, enca, mar, pre, va, des) {
        // document.getElementById("baccion2").value=id;
        //document.getElementById("id_activo").value = id;
        document.getElementById("correv").value = cor;
        document.getElementById("vidav").value = vid;
        document.getElementById("instiv").value = inst;
        document.getElementById("unidav").value = uni;
        document.getElementById("tipov").value = tip;
        document.getElementById("adquiv").value = aad;
        document.getElementById("fechav").value = fec;
        document.getElementById("encarv").value = enca;
        document.getElementById("marcav").value = mar;
        document.getElementById("provev").value = pre;
        document.getElementById("valor").value = va;
        document.getElementById("desv").value = des;
    }

    function darba(id, corred, est) {
        document.getElementById("id_activo").value = id;
        document.getElementById("corred").value = corred;
        document.getElementById("estado").value = est;
    }

    function edi(){
    //validacion respectiva me da hueva
    //enviarDatos(2);
    $("#editarForm").submit();;      
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
                                <h4 class="page-title">Listado de Activo Fijo</h4>
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
                                <form id="fCartera" name="fCartera" action="" method="GET" class="parsley-examples">

                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Fecha de Adquisicion</th>
                                                <th>Correlativo</th>
                                                <th>Descripcion</th>
                                                <th>Tipo</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT tactivo.vidaUtil,tactivo.estado, tactivo.descripcion, tactivo.correlativo, tactivo.fecha_adquisicion, tactivo.id_activo, tactivo.marca, tactivo.precio, tactivo.tipo_adquicicion, tproveedor.nombre as pro, templeados.nombre as emp, ttipo_activo.nombre as tipoa, tinstitucion.nombre as insti, tdepartamento.nombre as dpto, tclasificacion.nombre as clasificacion FROM tactivo INNER JOIN tdepartamento ON tactivo.id_departamento = tdepartamento.id_departamento INNER JOIN ttipo_activo ON tactivo.id_tipo = ttipo_activo.id_tipo INNER JOIN tclasificacion ON ttipo_activo.id_clasificacion = tclasificacion.id_clasificaion INNER JOIN tinstitucion ON tdepartamento.id_institucion = tinstitucion.id_institucion INNER JOIN templeados ON tactivo.id_encargado = templeados.id_empleado INNER JOIN tproveedor ON tactivo.id_proveedor = tproveedor.id_proveedor");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->fecha_adquisicion . "</td>";
                                                echo "<td>" . $fila->correlativo . "</td>";
                                                echo "<td>" . $fila->descripcion . "</td>"; 
                                                echo "<td>" . $fila->tipo_adquicicion . "</td>";
                                                if($fila->estado==1){
                                                    echo "<td style='width: 20%;' align='center'>Activo</td>";
                                                }else{
                                                    echo "<td style='width: 20%;' align='center'>Inactivo</td>";
                                                }
                                                echo "<td>
                                                <span data-toggle='modal'data-target='#mostrar'> 
                                                    <button 
                                                    button type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                            
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                        '$fila->id_activo',
                                                        '$fila->correlativo',
                                                        '$fila->vidaUtil',
                                                        '$fila->insti',
                                                        '$fila->dpto',
                                                        '$fila->tipoa',
                                                        '$fila->tipo_adquicicion',
                                                        '$fila->fecha_adquisicion',
                                                        '$fila->emp',
                                                        '$fila->marca',
                                                        '$fila->pro',
                                                        '$fila->precio',
                                                        '$fila->descripcion'
                                                    )\";><i class='mdi mdi-18px mdi-eye'></i> 
                                                    </button></span>
                                                    <span data-toggle='modal'data-target='#dar'> 
                                                    <button 
                                                    button type='button' title='Estado' data-toggle='tooltip' 
                                                    data-placement='bottom'                            
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    darba(
                                                        '$fila->id_activo',
                                                        '$fila->correlativo',
                                                        '$fila->estado'
                                                    )\";><i class=' mdi mdi-18px mdi-pencil-off-outline'></i> 
                                                    </button></span>";
                                                $nuevo = $conexion->query("select round(if((dias/365)<=vida,d.depreA*ano,d.depreA*vida),2) depreA,
                                                            round(if((dias/365)<=vida,(d.depreA/12)*meses,d.depreA*vida),2) depreM,
                                                            round(if((dias/365)<=vida,(d.depreA/365)*dias,d.depreA*vida),2) depreD
                                                    from (
                                                        select
                                                            ((a.precio/a.vidaUtil)*(c.tiempo_depreciacion/100)) depreA
                                                            ,a.vidaUtil as vida,
                                                            TIMESTAMPDIFF(day , a.fecha_adquisicion,curdate()) AS dias,
                                                            TIMESTAMPDIFF(month , a.fecha_adquisicion,curdate()) AS meses,
                                                            TIMESTAMPDIFF(year , a.fecha_adquisicion,curdate()) AS ano
                                                    from tactivo  a
                                                    inner join ttipo_activo ta on a.id_tipo = ta.id_tipo
                                                    inner join tclasificacion c on ta.id_clasificacion = c.id_clasificaion
                                                    where a.tipo_adquicicion='Nuevo' and a.id_activo='".$fila->id_activo."') as d;");
                                                if($nuevo){
                                                    while ($filo = $nuevo->fetch_object()){
                                                        echo "<span data-toggle='modal' data-target='#depreciacion'>
                                                            <button 
                                                            type='button' title='Depreciacion' data-toggle='tooltip' 
                                                            data-placement='bottom'
                                                            class='btn btn-success waves-effect waves-light' onclick=\"
                                                            grafica(
                                                                '".$filo-> depreD."',
                                                                '".$filo-> depreM."',
                                                                '".$filo-> depreA."'
                                                            )\";>                                                    
                                                                <i class='mdi mdi-18px mdi-chart-bar'></i></i>
                                                            </button></span>";
                                                        }
                                                    }
                                                $usado = $conexion->query("select round(if((dias/365)<=vida,(d.depreA*ano),d.depreA*vida),2) depreA,
                                                    round(if((dias/365)<=vida,((d.depreA/12)*meses),d.depreA*vida),2) depreM,
                                                    round(if((dias/365)<=vida,((d.depreA/365)*d.dias),d.depreA*vida),2) depreD
                                                    from (
                                                        select
                                                            if(a.vidaUtil=1, (a.precio/a.vidaUtil)*0.8,
                                                                if(a.vidaUtil=2,(a.precio/a.vidaUtil)*0.6,
                                                                    if(a.vidaUtil=3,(a.precio/a.vidaUtil)*0.4,
                                                                        if(a.vidaUtil>=4,(a.precio/a.vidaUtil)*0.2,
                                                                            0.0)
                                                                    )
                                                                )
                                                            ) depreA,a.vidaUtil as vida,
                                                            TIMESTAMPDIFF(day , a.fecha_adquisicion,curdate()) AS dias,
                                                            TIMESTAMPDIFF(month , a.fecha_adquisicion,curdate()) AS meses,
                                                            TIMESTAMPDIFF(year , a.fecha_adquisicion,curdate()) AS ano
                                                    from tactivo  a
                                                    inner join ttipo_activo ta on a.id_tipo = ta.id_tipo
                                                    inner join tclasificacion c on ta.id_clasificacion = c.id_clasificaion
                                                    where a.tipo_adquicicion='Usado' and (c.nombre='Otros bienes muebles' or c.nombre='Maquinaria')
                                                    and a.id_activo='".$fila->id_activo."') as d;");
                                                if($usado){
                                                    while($filo = $usado->fetch_object()){
                                                        echo "<span data-toggle='modal' data-target='#depreciacion'>
                                                            <button 
                                                            type='button' title='Depreciacion' data-toggle='tooltip' 
                                                            data-placement='bottom'
                                                            class='btn btn-success waves-effect waves-light' onclick=\"
                                                            grafica(
                                                                '".$filo-> depreD."',
                                                                '".$filo-> depreM."',
                                                                '".$filo-> depreA."'
                                                            )\";>                                                    
                                                                <i class='mdi mdi-18px mdi-chart-bar'></i></i>
                                                            </button></span>";
                                                        }
                                                    }

                                                echo "</div>
                                                </td>";
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

                    <!-- Bootstrap Modals -->
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <!--  Modal mostrar -->
                                <div id="mostrar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Datos del cliente</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="form" id="form" method="post" action=""
                                                                class="parsley-examples">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Correlativo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="correv" id="correv" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Vida Util</label>
                                                                        <input type="text" class="form-control"
                                                                            name="vidav" id="vidav" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Institucion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="instiv" id="instiv" required readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Unidad</label>
                                                                        <input type="text" class="form-control"
                                                                            name="unidav" id="unidav" required readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Tipo
                                                                            de Activo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tipov" id="tipov" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Tipo
                                                                            de Adquisicion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="adquiv" id="adquiv" required readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Fecha de
                                                                            Adquisicion</label>
                                                                        <input type="text" class="form-control"
                                                                            name="fechav" id="fechav" required
                                                                            placeholder="" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Encargado</label>
                                                                        <input type="text" class="form-control"
                                                                            name="encarv" id="encarv" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Marca</label>
                                                                        <input type="text" class="form-control"
                                                                            name="marcav" id="marcav" required
                                                                            placeholder="" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4"
                                                                            class="col-form-label">Proveedor</label>
                                                                        <input type="text" class="form-control"
                                                                            name="provev" id="provev" required
                                                                            placeholder="" readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Valor del Activo
                                                                            $</label>
                                                                        <input type="text" class="form-control"
                                                                            name="valor" id="valor" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <label for="inputEmail4"
                                                                        class="col-form-label">Descripcion</label>
                                                                    <textarea class="form-control" id="desv" name="desv"
                                                                        rows="5" readonly></textarea>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!--  Modal baja alta-->
                                <div id="dar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Estado del Activo</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-box">
                                                            <form name="editarForm" id="editarForm" method="post" action="scriptsphp/modificarAF.php?bandera=1"
                                                                class="parsley-examples">
                                                                <input type="hidden" id="id_activo" name="id_activo">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4"
                                                                            class="col-form-label">Correlativo</label>
                                                                        <input type="text" class="form-control"
                                                                            name="corred" id="corred" required readonly>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                            <label for="inputState"
                                                                                class="col-form-label">Estado</label>
                                                                            <select class="form-control" name="estado"
                                                                                id="estado" required>
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
                                            <button type="button" class="btn  btn-primary waves-effect" id="cambios"
                                                    name="cambios" onclick="edi();">Guardar Cambios</button>
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!--  Modal editar cliente-->
                                <div id="depreciacion" class="modal fade bs-example-modal-lg" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Depreciacion Acumulada
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>

                                            <div class="card-box">
                                                <p class="header-title" id="id_depreciacion">depreciacion</p>
                                                <div class="mt-4">
                                                    <div id="distributed-series" class="ct-chart ct-golden-section">
                                                    </div>
                                                </div>
                                            </div> <!-- end card-box-->

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                        </div>
                    </div><!-- FIN Bootstrap Modals -->
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
        var depre = new Chartist.Bar('#distributed-series', {
            labels: ['D', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'],
            series: [20, 60, 120, 200, 180, 20, 10]
        }, {
            distributeSeries: true,
            fullWidth: true,
            chartPadding: {
                right: 40
            }
        });


        $('#depreciacion').on('shown.bs.modal', function (e) {
            depre.update();
        });
    </script>

</body>

</html>
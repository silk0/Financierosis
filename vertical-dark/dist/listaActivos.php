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

<SCRIPT  language=JavaScript> 
    function go(){
        //validacion respectiva me da hueva
        $("#editarForm").submit();
            
    } 

    function grafica(dDia,dMes,dAno)
    {
        $dia=Number(dDia);
        $mes=Number(dMes);
        $ano=Number(dAno);
        document.getElementById("id_depreciacion").innerHTML="Dia: $"+$dia+"    Mes: $"+$mes+"    Año: $"+$ano;
        depre = new Chartist.Bar('#distributed-series', {
        labels: ['Dias', 'Meses', 'Años'],
        series: [dDia,dMes,dAno]
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
                                <form id="fCartera" name= "fCartera" action="" method="GET"  class="parsley-examples">
                                
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Correlativo</th>
                                            <th>Clasificacion</th>
                                            <th>Descripcion</th>
                                            <th>Tipo Adquisicion</th>
                                            <th>Fecha de Adquisicion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody> 
                                        <?php
                                        
                                        include "config/conexion.php";
                                            $result = $conexion->query("SELECT tactivo.id_activo,tactivo.correlativo, 
                                            ttipo_activo.nombre as tipoa, tactivo.descripcion, 
                                            tactivo.tipo_adquicicion, tactivo.fecha_adquisicion FROM tactivo
                                             INNER JOIN tdepartamento ON tactivo.id_departamento = tdepartamento.id_departamento 
                                             INNER JOIN ttipo_activo ON tactivo.id_tipo = ttipo_activo.id_tipo 
                                             INNER JOIN tclasificacion ON ttipo_activo.id_clasificacion = tclasificacion.id_clasificaion");
                                        if ($result) {
                                            while ($fila = $result->fetch_object()) {
                                                echo "<tr>";
                                                echo "<td>" . $fila->correlativo . "</td>";
                                                echo "<td>" . $fila->tipoa . "</td>";
                                                echo "<td>" . $fila->descripcion . "</td>"; 
                                                echo "<td>" . $fila->tipo_adquicicion . "</td>";
                                                echo "<td>" . $fila->fecha_adquisicion . "</td>";
                                                echo "<td>    
                                                <span data-toggle='modal'                                                    
                                                data-target='#mostrar'>                                             
                                                    <button 
                                                    button type='button' title='Informacion' data-toggle='tooltip' 
                                                    data-placement='bottom'                            
                                                    class='btn btn-primary waves-effect waves-light' onclick=\"
                                                    edit(
                                                    )\";>
                                                        <i class='mdi mdi-18px mdi-eye'></i> 
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
                                <!--  Modal mostrar cliente-->
                                <div id="mostrarCliente" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
                                                            <form name="form" required class="parsley-examples">
                                                            
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Nombre</label>
                                                                    <input type="text"  class="form-control" name="nombrem" id="nombrem" required  placeholder="Jose Alfredo" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Apellido</label>
                                                                    <input type="text" class="form-control" name="apellidom" id="apellidom" required  placeholder="Rodriguez Perez" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Dui</label>
                                                                    <input type="text"  class="form-control" name="duim" id="duim" required  data-mask="99999999-9" placeholder="99999999-9" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Nit</label>
                                                                    <input type="text" class="form-control" name="nitm" id="nitm" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Telefono fijo</label>
                                                                    <input type="text"  class="form-control" name="telm" id="telm" required  data-mask="9999-9999" placeholder="9999-9999" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Telefono Movil</label>
                                                                    <input type="text" class="form-control" name="celm" id="celm" required data-mask="9999-9999" placeholder="9999-9999" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <label for="inputAddress" class="col-form-label">Direccion</label>
                                                                <input type="text" class="form-control"  name="direcm" id="direcm" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23" readonly>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Email</label>
                                                                    <input type="email"  class="form-control" name="emailm" id="emailm"  required  placeholder="Correo@correo.com" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4" class="col-form-label">Profesion u oficio</label>
                                                                    <input type="text"  class="form-control" name="profeciom" id="profeciom" required  placeholder="Ing. Civil" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputCity" class="col-form-label">Ingresos Mensuales</label>
                                                                    <input type="text" class="form-control" name="salm" id="salm" required  placeholder="0.00" readonly>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState" class="col-form-label">Tipo de ingreso</label>
                                                                    <input type="text" class="form-control" name="tipom" id="tipom" placeholder="0.00" readonly>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputZip" class="col-form-label">Egreso Promedio Mensual</label>
                                                                    <input type="text" class="form-control" name="egres" id="egres" placeholder="0.00" readonly>
                                                                </div>
                                                            </div> 

                                                            <div class="form-row">                                        
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState" class="col-form-label">Agregar a la cartera</label>
                                                                    <select class="form-control" name="carteram" id="carteram" disabled>                                                                        
                                                                        <?php
                                                                        include 'config/conexion.php';
                                                                        $result = $conexion->query("select id_categoria as id,nombre FROM tcartera");
                                                                        if ($result) {
                                                                            while ($fila = $result->fetch_object()) {                                                                                
                                                                                echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';                                                                                
                                                                            }
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                            </div>    

                                                            <div class="form-row">
                                                                <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                                                <textarea class="form-control" id="observm" name="observm" rows="5" readonly></textarea>
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
                                <!--  Modal editar cliente-->
                                <div id="depreciacion" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Depreciacion Acumulada</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            
                                            <div class="card-box">
                                                <p class="header-title" id="id_depreciacion">depreciacion</p>
                                                <div class="mt-4">
                                                    <div id="distributed-series" class="ct-chart ct-golden-section"></div>
                                                </div>
                                            </div> <!-- end card-box-->                                   
                                                                                     
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
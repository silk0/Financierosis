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
function notify(titulo,texto,from, align, icon, type, animIn, animOut){
		$.growl({
			icon: icon,
			title: titulo+" ",
			message: texto,
			url: ''
		},{
				element: 'body',
				type: type,
				allow_dismiss: true,
				placement: {
						from: from,
						align: align
				},
				offset: {
					x: 20,
					y: 85
				},
				spacing: 10,
				z_index: 1031,
				delay: 2500,
				timer: 1000,
				url_target: '_blank',
				mouse_over: false,
				animate: {
						enter: animIn,
						exit: animOut
				},
				icon_type: 'class',
				template: '<div data-growl="container" class="alert" role="alert">' +
								'<button type="button" class="close" data-growl="dismiss">' +
									'<span aria-hidden="true">&times;</span>' +
									'<span class="sr-only">Close</span>' +
								'</button>' +
								'<span data-growl="icon"></span>' +
								'<span data-growl="title"></span>' +
								'<span data-growl="message"></span>' +
								'<a href="#" data-growl="url"></a>' +
							'</div>'
		});
    }
    function alert(str, icono){
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });

        Toast.fire({icon: icono, title: str});  
    }
    
	
function go(){

    //Validaciones
   if(document.getElementById('nombre').value==""){
     notify(' Advertencia:','El campo Nombre es obligatorio.','top', 'right', 'any', 'warning');
       document.getElementById("nombre").focus();
   }else if(document.getElementById('apellido').value==""){
        notify(' Advertencia:','El campo Apellido es obligatorio,','top', 'right', 'any', 'warning');
       document.getElementById("apellido").focus();
   }else if(document.getElementById('dui').value==""){
        notify(' Advertencia:','El campo DUI es obligatorio','top', 'right', 'any', 'warning');
       document.getElementById("dui").focus();
   }else if(document.getElementById('nit').value==""){
        notify(' Advertencia:','El campo NIT es obligatorio', 'top', 'right', 'any', 'warning');
       document.getElementById("nit").focus();
   }else if(document.getElementById('direc').value==""){
        notify(' Advertencia:','El campo Direccion es obligatorio', 'top', 'right', 'any', 'warning');
       document.getElementById("direc").focus();
   }else if(document.getElementById('telefono').value=="" && document.getElementById('celular').value==""){
        notify(' Advertencia:','Es necesario por lo menos un numero de telefono', 'top', 'right', 'any', 'warning');
       document.getElementById("telefono").focus();
   }else if(document.getElementById('tipo').value=="Seleccione"){
        notify(' Advertencia:','Seleccione un tipo de Ingreso', 'top', 'right', 'any', 'warning');
       document.getElementById("tipo").focus();
   }else if(document.getElementById('profecion').value==""){
        notify(' Advertencia:','El campo Profecion u Oficio es obligatorio', 'top', 'right', 'any', 'warning');
       document.getElementById("profecion").focus();
   }else if(document.getElementById('salario').value==""){
        notify(' Advertencia:','El campo Ingreso Promedio es obligatorio', 'top', 'right', 'any', 'warning');
       document.getElementById("salario").focus();
   }else if(document.getElementById('egreso').value==""){
        notify(' Advertencia:','El campo Egreso Promedio es obligatorio', 'top', 'right', 'any', 'warning');
        document.getElementById("egreso").focus();
   }else if(document.getElementById('observ').value==""){
        notify(' Advertencia:','El campo Observaciones es obligatorio', 'top', 'right', 'any', 'warning');
       document.getElementById("observ").focus();
   }else{
      document.form.submit();  
   }   
} 
function enviar(id){
    
    $.ajax({
        data:{"id":id},
        url: 'scriptsphp/recuperarFiador.php',
        type: 'post',
        beforeSend: function(){
            alert("Por favor espere...");
        },
        success: function(response){
            alert(response);
            document.getElementById("fiador").value=response;
            document.getElementById("idfiador").value=id;
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

                <div class="clearfix"></div>

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
                            <div class="page-title-box" >                                
                                <h4 class="page-title">Registro de cliente</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Ingreso de datos generales del cliente</h4>     
                                <form name="form" method="post" action="ingresoCliente.php?bandera=1" required class="parsley-examples">
                                <input type="hidden" id="idfiador" name="idfiador">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Nombre</label>
                                            <input type="text"  class="form-control" name="nombre" id="nombre" required  placeholder="Jose Alfredo">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido" required  placeholder="Rodriguez Perez">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Dui</label>
                                            <input type="text"  class="form-control" name="dui" id="dui" required  data-mask="99999999-9" placeholder="99999999-9">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Nit</label>
                                            <input type="text" class="form-control" name="nit" id="nit" required  data-mask="9999-999999-999-9" placeholder="9999-999999-999-9">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Telefono fijo</label>
                                            <input type="text"  class="form-control" name="telefono" id="telefono" required  data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Telefono Movil</label>
                                            <input type="text" class="form-control" name="celular" id="celular" required data-mask="9999-9999" placeholder="9999-9999">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Direccion</label>
                                        <input type="text" class="form-control"  name="direc" id="direc" required placeholder="Calle Juan Ulloa Canas y Avenida Crescencio Miranda Casa #23">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="col-form-label">Email</label>
                                            <input type="email"  class="form-control" name="email" id="email"  required  placeholder="Correo@correo.com">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4" class="col-form-label">Profesion u oficio</label>
                                            <input type="text" class="form-control" name="profecion" id="profecion" required  placeholder="Rodriguez Perez">
                                        </div>
                                    </div>  
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputCity" class="col-form-label">Ingresos Mensuales ($)</label>
                                            <input type="number" class="form-control" name="salario" id="salario" required  placeholder="0.00">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Tipo de ingreso</label>
                                            <select class="form-control" name="tipo" id="tipo" required >
                                                
                                                <option>Salario</option>
											    <option>Remesa</option>
											    <option>Salario Informal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputZip" class="col-form-label">Egreso Promedio Mensual ($)</label>
                                            <input type="number" class="form-control" name="egreso" id="egreso" placeholder="0.00" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="inputEmail4" class="col-form-label">Descripcion</label>
                                        <textarea class="form-control" id="observ" name="observ" rows="5"></textarea>
                                    </div>   
                                    <div class="form-row">                                        
                                        <div class="form-group col-md-4">
                                            <label for="inputState" class="col-form-label">Agregar a la cartera</label>
                                            <select  class="form-control" name="cartera" id="cartera" required >
                                                
                                                <?php
                                                include 'config/conexion.php';
                                                $result = $conexion->query("select id_categoria as id,nombre FROM tcartera");
                                                if ($result) {
                                                    while ($fila = $result->fetch_object()) {
                                                        if ($fila->id == $idcaertera ) {
                                                            echo '<option value="' . $fila->id. '" selected>' . $fila->nombre . '</opcion>';
                                                        }else {
                                                            echo '<option value="' . $fila->id . '">' . $fila->nombre . '</opcion>';
                                                        }
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div> 
                                    </br>
                                    <div class="form-row"> 
                                    <div class="form-group">
                                        <button type="buttom" onclick="go();" class="btn btn-success btn-rounded waves-light width-md">Registrar</button>                                        
                                        <button type="reset"  class="btn btn-danger btn-rounded waves-light width-md">Cancelar</button>  
                                    </div>                                      
                                    </div>
                                </form>
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

</body>

</html>

<?php
    include "config/conexion.php";
    $accion = $_REQUEST['bandera'];
        if($accion==1){
        $nombre   = $_POST['nombre'];
        $apellido   = $_POST['apellido'];
        $direccion   = $_POST['direc'];
        $dui  = $_POST['dui'];
        $nit   = $_POST['nit'];
        $email   = $_POST['email'];
        $tel   = $_POST['telefono'];
        $cel  = $_POST['celular'];
        $tipo = $_POST['tipo'];
        $cartera  = $_POST['cartera'];
        $prof=$_POST['profecion'];
        $salario=$_POST['salario'];
        $egreso = $_POST['egreso'];
        $observ  = $_POST['observ'];
        msgI($egreso);
        $consulta  = "INSERT INTO tclientes VALUES('null','" .$cartera. "','" .$nombre. "','" .$apellido. "','" .$direccion. "','" .$dui. "','" .$nit. "','" .$prof. "','" .$tipo. "','" .$salario. "','" .$tel. "','" .$cel. "','" .$email. "','" .$observ. "','" .$egreso. "')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            msgI("Los datos fueron almacenados con exito");
        } else {
            msgE("Los datos no pudieron almacenarce");
        }     
    }
function msgI($texto)
{
    echo "<script type='text/javascript'>";
    echo "notify('Exito','$texto','top', 'right', 'any', 'success');";
    echo "</script>";
}
function msgA($texto)
{
    echo "<script type='text/javascript'>";
    echo "notify('Advertencia','$texto','top', 'right', 'any', 'warning');";
    echo "</script>";
}
function msgE($texto)
{
    echo "<script type='text/javascript'>";
    echo "notify('Error','$texto','top', 'right', 'any', 'danger');";
    echo "</script>";
}
?>
<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
if($accion==1){
    $catego   = $_POST['categoria'];
    $id_prod  = $_POST['id_produc'];
    $nombre   = $_POST['nombre'];
    $desc   = $_POST['descrip'];
    $pcompra  = $_POST['pcompra'];
    $mganancia  = $_POST['mganancia'];
    $stock   = $_POST['stock'];
    $estado   = $_POST['estado']; 
    $precioV = ((floatval($mganancia)/100)*floatval($pcompra))+floatval($pcompra);

    $consulta  = "UPDATE tproducto set id_categoria='" . $catego . "',nombre='" . $nombre . "',
    descripcion='" . $desc . "', precio_compra='" . $pcompra . "',margen='" . $mganancia . "',
    stock_minimo='" . $stock . "',estado='" . $estado . "',precio_venta=truncate('" .$precioV  . "',2)
    where id_producto='".$id_prod."'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {   
        header('Location:../listadoProducto.php'); 
      } else {
        echo 'No funciona';  
      }   
}
?>
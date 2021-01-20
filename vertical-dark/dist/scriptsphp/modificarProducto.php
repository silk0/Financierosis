<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
if($accion==1){
    $catego   = $_POST['categoria'];
    $id_prod  = $_POST['id_produc'];
    $nombre   = $_POST['nombre'];
    $prov   = $_POST['idproveedor'];
    $des   = $_POST['descri'];
    $pcompra  = $_POST['pcompra'];
    $mganancia  = $_POST['mganancia'];
    $stock   = $_POST['stock'];
    $estad   = $_POST['estado']; 
    $precioV = ((floatval($mganancia)/100)*floatval($pcompra))+floatval($pcompra);

    $consulta  = "UPDATE tproducto set id_proveedor='" . $prov . "',id_categoria='" . $catego . "',nombre='" . $nombre . "',
    descripcion='" . $des . "', precio_compra='" . $pcompra . "',margen='" . $mganancia . "',
    stock_minimo='" . $stock . "',estado='" . $estad . "',precio_venta=truncate('" .$precioV  . "',2)
    where id_producto='".$id_prod."'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {   
        header('Location:../listadoProducto.php'); 
      } else {
        echo 'No funciona';  
      }   
}
?>
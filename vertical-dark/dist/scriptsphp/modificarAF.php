<?php
include "../config/conexion.php";
$bandera = $_REQUEST['bandera'];
if ($bandera==1) {
$baccion  = $_REQUEST["idaf"];
$tipo    = $_REQUEST["tipo"];
$dpto     = $_REQUEST["dpto"];
$prov     = $_REQUEST["prov"];
$emp    = $_REQUEST["emp"];
$fech     = $_REQUEST["fech"];
$estado    = $_REQUEST["estado"];
$deprec     = $_REQUEST["deprec"];
$fechaBD = date("Y-m-d", strtotime($fech));
$tipo_adq     = $_REQUEST["tipo_adq"];
if($tipo_adq==1){
    $tipo_adquicicion="Nuevo";
}else if($tipo_adq==2){
    $tipo_adquicicion="Usado";
}else if($tipo_adq==3){
    $tipo_adquicicion="Donado";
}
$precio    = $_REQUEST["precio"];
$marca     = $_REQUEST["marca"];
$correlativo     = $_REQUEST["correlativo"];
$descrip     = $_REQUEST["descrip"];
    $consulta  = "UPDATE tactivo set id_tipo='" . $tipo . "',id_departamento='" . $dpto . "',id_encargado='" . $emp . "',id_proveedor='" . $prov . "',correlativo='" . $correlativo . "',fecha_adquisicion='" . $fechaBD . "',descripcion='" . $descrip . "',estado='".$estado."',precio='" . $precio . "',marca='" . $marca . "',depreciacionacum='".$deprec."',tipo_adquicicion='" . $tipo_adquicicion . "' where id_activo='" . $baccion . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../listaAF.php?bandera=1');
      } else {
        header('Location:../listaAF.php?bandera=2');
      }
    }
    ?>
<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
if($accion==1){
$id = $_POST["id_categoria"];
$cate   = $_POST['cate'];
$estado    = $_POST['estado'];
    $consulta  = "UPDATE tcategoria set categoria='" . $cate. "',
    estado='" . $estado . "'
    where id_categoria='" . $id . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../ingresoCategoria.php');  
      } else {
        echo 'No funciona';  
      }
    }
    ?>

<?php 
    $id=$_POST['id'];
    include '../config/conexion.php';
    //  Obtener la cartera a la que pertenece el cliente.
    $result = $conexion->query("select id_cartera as cartera FROM tclientes where id_cliente=".$id);
    if ($result) {
        while ($fila = $result->fetch_object()) {
             $cartera=$fila->cartera;
        }
    }
    //   $cadena=$cadena. "<option value='".$cartera."'>".$cartera."</option>";
    $result = $conexion->query("select id_plan, nombre FROM tplan_pago where nombre='Contado' and id_cartera=".$cartera);
    if ($result) {
        while ($fila = $result->fetch_object()) {
           
        }
    }

?>
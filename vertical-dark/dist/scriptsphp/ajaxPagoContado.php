<?php 
   
    include '../config/conexion.php';
    $bandera=$_REQUEST['bandera'];
    
    //  Obtener la cartera a la que pertenece el cliente.
    if($bandera==0){
        $id_cl = $_POST['cliente'];
        $cod = $_POST['venta'];
        $emp = $_POST['id_empleado'];
        $totalV = $_POST['total'];
        $result = $conexion->query("insert into
            tventas(
            id_cliente,
            codigo,
            id_plan,
            id_empleado,
            prestamo_original,
            saldo_actual,
            mora_acumulada,
            intereses_acumulados,
            estado,
            proximo_pago,
            fecha,
            interes,
            prima)
            values ('".$id_cl."', '".$cod."', null,'".$emp."',0,'total',0,0,'Cancelado',now(),now(),0,0 );");
        if ($result) {
            
            $result = $conexion->query("insert into tdetalle_venta(
                id_venta,
                id_producto,
                cantidad,
                preciovendido,
                tipo)
               select '".$cod."',t.id_producto,
                      t.cantidad,
                      (select p.precio_venta from tproducto p where t.id_producto = p.id_producto),
                      0
               from tcarrito t;
               ");
            if ($result) {
                $result = $conexion->query("TRUNCATE TABLE tcarrito;");
                if ($result) {
                    $result = $conexion->query("TRUNCATE TABLE tcarrito;");
                    if ($result) {

                    }
                    
                    header('Location:../venderContado.php?bandera=1');
                }
            }
        }       

    }

?>
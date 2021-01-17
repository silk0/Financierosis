<?php
    include "../config/conexion.php";
    $bandera = $_REQUEST["bandera"];
    if($bandera==1){
        $id  = $_POST["id"];       

        $resultado = $conexion->query("update tpago as p set p.estado=1, p.mora=0 where id_pago='".$id."';");

        if ($resultado) {
            $resultado = $conexion->query(" insert into tbanco (descripcion, cantidad, id_venta)
                    select concat('Pago de cuota No.',LPAD(p.id_pago,5,'0'),' de la venta No.',v.codigo,' al credito.'),
                    p.monto+p.mora,p.id_venta 
                    from tpago p inner join tventas v on p.id_venta = v.id_venta
                    where p.id_pago='".$id."';");
            if ($resultado){
                
                $result= $conexion->query("select d.id_detalleventa from tpago p
                inner join tdetalle_venta d join tproducto t on d.id_venta=p.id_venta
                where id_pago='".$id."';");
                
                while ($fila = $result->fetch_object()) {
                    $id_v = $fila->id_detalleventa;
                    $url='Location:../coutasCredito.php?id='.$id_v;
                }
                header($url);
            }else
                echo 'No se deposito en el banco';  
        } else {
            echo 'No realiza el pago de la cuota';  
        }        
    
    }
?>
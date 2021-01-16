<?php 
   
    include '../config/conexion.php';
    $bandera=$_REQUEST['bandera'];
    
    //  Obtener la cartera a la que pertenece el cliente.
    if($bandera==0){
        $id_cl = $_POST['id_cliente'];
        $codI = $_POST['ventaId'];
        $codC = $_POST['ventaCod'];
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
            values ('".$id_cl."', 
            '".$codC."', 
            null,
            '".$emp."',
            0,'total',0,0,'Cancelado',now(),now(),0,0 );");
        if ($result) {            
            $result = $conexion->query("insert into tdetalle_venta(
            id_venta,
            id_producto,
            cantidad,
            preciovendido,
            tipo)
            select '".$codI."',t.id_producto,
            t.cantidad,
            (select p.precio_venta from tproducto p where t.id_producto = p.id_producto),0
            from tcarrito t;
               ");
            if ($result) {
                $result = $conexion->query("update tproducto  as p
                    join tcarrito c
                    on p.id_producto = c.id_producto
                    set p.stock = (p.stock-c.cantidad);");
                if ($result) {
                    $result = $conexion->query("TRUNCATE TABLE tcarrito;");
                    if ($result) {
                        $result = $conexion->query("insert into tbanco(descripcion, cantidad, id_venta)  
                        values(concat('Venta al contado el ',DATE_FORMAT(now(), '%d/%m/%Y'),' Factura No.',
                        (select codigo from tventas where id_venta=20)),'".$totalV."','".$codI."');");
                        if ($result) {
                            
                        }else
                        echo "no se guardo dinero en el la tabla banco";      
                    }else
                         echo "no se elimino los datos del carrito";      
                }else{
                    echo "no se elimino el carrito con el stock";      
                }            
            }else
                echo "error no se realizo el detalle de venta";      
        }else
            echo "error no se realizo la venta al contado";      

    }header('Location:../venderContado.php?bandera=1');

?>
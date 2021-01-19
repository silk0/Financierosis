
<?php
    include "config/conexion.php";

    $resultado = $conexion->query("update tpago as p inner join tventas v on p.id_venta = v.id_venta
            set p.estado= if(curdate()>p.fecha, 2, p.estado),
            p.mora=((v.interes/100)*p.monto*(DATEDIFF(p.fecha,curdate())*-1))
            where curdate()>p.fecha and p.estado!=1;");

    if ($resultado) {
        $resultado = $conexion->query("
            update tventas v inner join tdetalle_venta tv on v.id_venta = tv.id_venta
                set v.saldo_actual = v.prestamo_original-if((select truncate(sum(monto),2)+truncate(sum(mora),2)
                        from tpago where id_venta=tv.id_venta and estado=1) is null,0.0,
                        (select sum(monto)+sum(mora)
                        from tpago where id_venta=tv.id_venta and estado=1)),
                v.mora_acumulada =  (select if(truncate(sum(mora),2) is null ,0.0,sum(mora))
                                    from tpago where id_venta=tv.id_venta and estado=2)
            where v.id_venta = tv.id_venta and tv.tipo=1;
        ");
        if ($resultado){                
            $resultado = $conexion->query("update tventas v inner join tdetalle_venta dv on v.id_venta = dv.id_venta
            inner join tpago p on p.id_venta = v.id_venta
            set v.estado=if(truncate(v.saldo_actual,2)<=0,'Cancelado',
                        if((select count(*) from tpago where id_venta=v.id_venta and estado=2)
                            >=4,'Incobrable',
                            if((select count(*) from tpago where id_venta=v.id_venta and estado=2)
                            >0,'Moroso','Pendiente')))
            where v.estado!='Cancelado' and dv.tipo=1;");
                
        }
        
            
    } else {
        
    }       
?>
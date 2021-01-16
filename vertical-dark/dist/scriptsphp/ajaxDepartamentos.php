<?php
    $id = $_POST["id"];
    include "../config/conexion.php";
    $result = $conexion->query("select d.correlativo as co,d.nombre as no
            from finanzadb.tdepartamento as d
            inner join finanzadb.tinstitucion t
                on d.id_institucion = t.id_institucion
            where t.correlativo='".$id."';");
        echo "<option value='0' selected>Seleccione</option>";
        if ($result) {
            while ($fila = $result->fetch_object()) {        
                echo '<option value="'.$fila->co.'">'.$fila->no.'</option>';                                                                                     
            }
        }
?>
	

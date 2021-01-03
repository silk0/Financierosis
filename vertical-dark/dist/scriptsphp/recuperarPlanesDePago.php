<?php 
$id=$_POST['id'];
$cadena='  
                                <div class="bootstrap-select fm-cmp-mg">
                                    <select class="selectpicker" data-live-search="true" name="prov" id="prov">
                                    <option value="Seleccione">Seleccione</option>
';
                                   
                                     include '../config/conexion.php';
                                    //  Obtener la cartera a la que pertenece el cliente.
                                     $result = $conexion->query("select id_cartera as cartera FROM tclientes where id_cliente=".$id);
                                     if ($result) {
                                         while ($fila = $result->fetch_object()) {
                                            $cartera=$fila->cartera;
                                         }
                                        }
                                        //   $cadena=$cadena. "<option value='".$cartera."'>".$cartera."</option>";
                                     $result = $conexion->query("select id_plan, nombre FROM tplan_pago where id_cartera=".$cartera);
                                     if ($result) {
                                         while ($fila = $result->fetch_object()) {
                                             $cadena=$cadena. "<option value='".$fila->id_plan."'>".$fila->nombre."</option>";
                                            }
                                        }
                                    
                                   $cadena=$cadena. "</select></div>";
                                   echo $cadena;

?>
<?php
error_reporting(E_ALL ^ E_NOTICE);
$accion=$_POST['id'];
$idaf=$_POST['idaf'];
$idi=$_POST['idi'];
$idt=$_POST['idt'];
$idd=$_POST['idd'];

if($accion==1){
    include "../config/conexion.php";
    $resultc = $conexion->query("select id_tipo as idr from ttipo_activo order by id_tipo");
                         if ($resultc) {
    
                           while ($filac = $resultc->fetch_object()) {
                             $temp=$filac->idr;
                            
                              }
                         } 
                         $resultc1 = $conexion->query("select id_clasificaion as idi from tclasificacion where id_clasificaion='".$idi."' order by id_clasificaion");
                         if ($resultc1) {
    
                           while ($filac1 = $resultc1->fetch_object()) {
                             $temp1=$filac1->idi;
                            
                              }
                         }                       
                          
                         if($temp<10){
                          $codigo=sprintf("4%02s",$temp+1); 
                          $codigo1=sprintf("3%02s",$temp1); 
                          echo $codigo1."-".$codigo;
                         }else if($temp>=10&&$temp<=99){
                          $codigo=sprintf("4%02s",$temp+1); 
                          $codigo1=sprintf("3%02s",$temp1); 
                          echo $codigo1."-".$codigo;
                         }else if($temp>99&&$temp<=999){
                          $codigo=sprintf("4%02s",$temp+1); 
                          $codigo1=sprintf("3%02s",$temp1); 
                          echo $codigo1."-".$codigo;
                          echo $codigo;
                         }
                          
                          
    
}
if($accion==2){
  include "../config/conexion.php";
  $resultc = $conexion->query("select id_institucion as id from tinstitucion order by id_institucion");
                       if ($resultc) {
  
                         while ($filac = $resultc->fetch_object()) {
                           $temp=$filac->id;
                          
                            }
                       }   
                        
                       if($temp<10){
                          $codigo=sprintf("1%02s",$temp+1);
                          echo $codigo;
                       }else if($temp>=10&&$temp<=99){
                          $codigo=sprintf("1%02s",$temp+1); 
                          echo $codigo;
                       }else if($temp>99&&$temp<=999){
                          $codigo=sprintf("1%02s",$temp+1); 
                          echo $codigo;
                       }
                        
                        
  
}
if($accion==3){
  include "../config/conexion.php";
$resultc = $conexion->query("select id_departamento as id from tdepartamento order by id_departamento");
                     if ($resultc) {

                       while ($filac = $resultc->fetch_object()) {
                         $temp=$filac->id;
                        
                          }
                     } 
                     $resultc1 = $conexion->query("select id_institucion as idi from tinstitucion where id_institucion='".$idi."' order by id_institucion");
                       if ($resultc1) {
  
                         while ($filac1 = $resultc1->fetch_object()) {
                           $temp1=$filac1->idi;
                          
                            }
                       }        
                       if($temp<10){
                        $codigo=sprintf("2%02s",$temp+1); 
                        $codigo1=sprintf("1%02s",$temp1); 
                        echo $codigo1."-".$codigo;
                       }else if($temp>=10&&$temp<=99){
                        $codigo=sprintf("2%02s",$temp+1); 
                        $codigo1=sprintf("1%02s",$temp1); 
                        echo $codigo1."-".$codigo;
                       }else if($temp>99&&$temp<=999){
                        $codigo=sprintf("2%02s",$temp+1); 
                        $codigo1=sprintf("1%02s",$temp1); 
                        echo $codigo1."-".$codigo;
                        echo $codigo;
                       }
                        
                        
  
}
if($accion==4){
  include "../config/conexion.php";
$resultc = $conexion->query("select id_clasificaion as id from tclasificacion order by id_clasificaion");
                     if ($resultc) {

                       while ($filac = $resultc->fetch_object()) {
                         $temp=$filac->id;
                        
                          }
                     }      
                       if($temp<10){
                        $codigo=sprintf("3%02s",$temp+1); 
                          echo $codigo;
                       }else if($temp>=10&&$temp<=99){
                        $codigo=sprintf("3%02s",$temp+1); 
                          echo $codigo;
                       }else if($temp>99&&$temp<=999){
                        $codigo=sprintf("3%02s",$temp+1); 
                          echo $codigo;
                       }
                        
                        
  
}
if($accion==5){
include "../config/conexion.php";
$resultc = $conexion->query("select id_activo as id from tactivo order by id_activo");
                     if ($resultc) {
                       while ($filac = $resultc->fetch_object()) {
                         $temp=$filac->id;
                          }
                     }      
                     $resultc1 = $conexion->query("SELECT
                     ttipo_activo.id_tipo,
                     ttipo_activo.correlativo
                     FROM
                     ttipo_activo where id_tipo='".$idt."' order by id_tipo");
                     if ($resultc1) {

                       while ($filac1 = $resultc1->fetch_object()) {
                         $temp1=$filac1->correlativo;
                        
                          }
                     } 
                     $resultc2 = $conexion->query("SELECT
                     tdepartamento.id_departamento,
                     tdepartamento.correlativo as corr
                     FROM
                     tdepartamento where id_departamento='".$idd."'");
                     if ($resultc2) {
                       while ($filac2 = $resultc2->fetch_object()) {
                         $temp2=$filac2->corr;
                        
                          }
                     } 

                       

                       if($temp<10){
                        $codigo=sprintf("%004s",$temp+1); 
                        echo $temp2."-".$temp1."-".$codigo;
                     
                       }else if($temp>=10&&$temp<=99){
                        $codigo=sprintf("%004s",$temp+1); 
                        echo $temp2."-".$temp1."-".$codigo;
                       }else if($temp>99&&$temp<=999){
                        $codigo=sprintf("%004s",$temp+1); 
                        echo $temp2."-".$temp1."-".$codigo;
                       }
                        
                        
  
}if($accion==6){
  include "../config/conexion.php";
  $resultc = $conexion->query("select id_activo as id from tactivo where id_activo='".$idaf."' order by id_activo");
                       if ($resultc) {
                         while ($filac = $resultc->fetch_object()) {
                           $temp=$filac->id;
                            }
                       }      
                       $resultc1 = $conexion->query("SELECT
                       ttipo_activo.id_tipo,
                       ttipo_activo.correlativo
                       FROM
                       ttipo_activo where id_tipo='".$idt."' order by id_tipo");
                       if ($resultc1) {
  
                         while ($filac1 = $resultc1->fetch_object()) {
                           $temp1=$filac1->correlativo;
                          
                            }
                       } 
                       $resultc2 = $conexion->query("SELECT
                       tdepartamento.id_departamento,
                       tdepartamento.correlativo as corr
                       FROM
                       tdepartamento where id_departamento='".$idd."'");
                       if ($resultc2) {
                         while ($filac2 = $resultc2->fetch_object()) {
                           $temp2=$filac2->corr;
                          
                            }
                       } 
  
                         if($temp<10){
                            $codigo=sprintf("%004s",$temp); 
                          echo $temp2."-".$temp1."-".$codigo;
                       
                         }else if($temp>=10&&$temp<=99){
                          $codigo=sprintf("%004s",$temp+1); 
                          echo $temp2."-".$temp1."-".$codigo;
                         }else if($temp>99&&$temp<=999){
                          $codigo=sprintf("%004s",$temp+1); 
                          echo $temp2."-".$temp1."-".$codigo;
                         }
                          
                          
    
  }


?>
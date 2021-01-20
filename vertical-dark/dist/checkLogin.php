 <?php
    include "config/conexion.php";
    $loginNombre = $_GET["usuario"];
    $loginPassword =$_GET["pass"];
    $result = $conexion->query("SELECT
    templeados.rol,
    templeados.nombre,
    templeados.apellido,
    templeados.id_empleado,
    templeados.usuario,
    templeados.pass
    FROM
    templeados where templeados.usuario='$loginNombre' AND templeados.pass='$loginPassword'");
    if ($result) {
        Header("Location:../../index.php?error=login2");
        while ($fila = $result->fetch_object()) {
            $passR = $fila->pass;
            $Nombre=$fila->nombre;
            $tipo=$fila->rol;	
            $usuario=$fila->usuario;
            $id=$fila->id_empleado;
            $apellido=$fila->apellido;
            if($passR==$loginPassword){
                $correcto=true;
            }
        }
    }         
    if(isset($loginNombre) && isset($loginPassword)) {
        if($correcto==true) {
                session_start();
                
                $_SESSION["logueado"] = TRUE;
                $_SESSION["nombre"] = $Nombre;
                $_SESSION["usuario"] = $usuario;
                $_SESSION["id"] = $id;
                $_SESSION["tipo"] = $tipo;                
                
                header("Location:Contenido.php");
                
                    
                }
        }else{
        
            Header("Location:../../index.php?error=login");
        }
        function msg($texto){
            echo "<script type='text/javascript'>";
            echo "alert('$texto');";
            //echo "document.location.href='materias.php';";
            echo "</script>";
    }         
          ?>
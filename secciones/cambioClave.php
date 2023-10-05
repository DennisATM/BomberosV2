<?php 
    if($_SESSION['rol']==""){
        session_start();
    }

    $alert="";

    include_once('../conexion/database.php');
    
    //si en la url se digita cerrar sesion
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    $rutUsuario=$_SESSION['rut'];
    
    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE rut=:rut');
    $query->bindParam(':rut',$rutUsuario);
    $query->execute();
    $usuarioActual=$query->fetch(PDO::FETCH_ASSOC);

    $claveActual=isset($_POST['claveActual'])?$_POST['claveActual']:"";
    $claveNueva=isset($_POST['claveNueva'])?$_POST['claveNueva']:"";
    $confirmarClaveNueva=isset($_POST['confirmarClaveNueva'])?$_POST['confirmarClaveNueva']:"";

    if ($claveNueva!= ""){

        if ($usuarioActual['clave'] != $claveActual){
            $alert="Clave actual no es la correcta..";
        }
        else{
            if ($claveNueva!=$confirmarClaveNueva){
                $alert="Clave nueva no coincide con la confirmación";
            }
            else{
                    $sql="UPDATE usuarios SET clave=:clave WHERE rut=:rut";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':rut',$rutUsuario);
                    $consulta->bindParam(':clave',$claveNueva);
                    $consulta->execute();
                    $alert="Cambio de clave exitoso..";
            }
        }  
    }
?>
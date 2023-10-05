<?php session_start();
    include_once('../conexion/database.php');
    //si en la url se digita cerrar sesion
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }
    $rutSession=$_SESSION['rut'];

    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE rut=:rut');
    $query->bindParam(':rut',$rutSession);
    $query->execute();
    $usuarioActual=$query->fetch(PDO::FETCH_ASSOC);
    $nombreSession=$usuarioActual['nombre'];
    $estado=$usuarioActual['estado'];
    $urlFoto=$usuarioActual['urlFoto'];
    $rol=$usuarioActual['idRol'];
    $perfil=$usuarioActual['idPerfil'];
    

    if(isset($_POST['estado'])){
        $rutEstado=isset($_POST['rutEstado'])?$_POST['rutEstado']:"";
        $estado=isset($_POST['estado'])?$_POST['estado']:"";
        
        if($estado!=''){
            switch($estado){
                case "disponible":
                    
                    date_default_timezone_set('America/Santiago');

                    $hoy= date("y-m-d H:i:s");
                    
                    $textEstado="Disponible";
                    $sql="UPDATE usuarios SET estado=:estado, fechaDisponible=:fechaDisponible WHERE rut=:rutEstado";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':rutEstado',$rutEstado);
                    $consulta->bindParam(':fechaDisponible',$hoy);
                    $consulta->bindParam(':estado',$textEstado);
                    $consulta->execute();
                    
                    header('location:vista_disponibilidad.php');
                break;
                case "enEmergencia":
                    $textEstado="En Emergencia";
                    $sql="UPDATE usuarios SET estado=:estado, fechaDisponible=:fechaDisponible WHERE rut=:rutEstado";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':rutEstado',$rutEstado);
                    $consulta->bindParam(':fechaDisponible',date('0000-00-00'));
                    $consulta->bindParam(':estado',$textEstado);
                    $consulta->execute();
                    
                    header('location:vista_disponibilidad.php');
                break;
                
                case "noDisponible":
                    $textEstado="No Disponible";
                    $sql="UPDATE usuarios SET estado=:estado, fechaDisponible=:fechaDisponible WHERE rut=:rutEstado";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':rutEstado',$rutEstado);
                    $consulta->bindParam(':fechaDisponible',date('0000-00-00'));
                    $consulta->bindParam(':estado',$textEstado);
                    $consulta->execute();
                    
                    header('location:vista_disponibilidad.php');
                break;
            }
        }
    }
?>
<?php 
    if($_SESSION['rol']==""){
        session_start();
    }

    include_once('../conexion/database.php');
    
    //si en la url se digita cerrar sesion
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if($_SESSION['rol'] != 1){
        header('location: ../vistas/template.php');
    }    

    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE idPerfil=2');
    $query->execute();
    $listaConductores=$query->fetchAll();
    
    foreach($listaConductores as $clave=>$conductor){
        $sql="SELECT * FROM vehiculos WHERE idVehiculo IN (SELECT idVehiculo FROM usuarios_vehiculos WHERE rutUsuario=:rutUsuario)";
            $consulta=$db->connect()->prepare($sql);
            $consulta->bindParam(':rutUsuario',$conductor['rut']);
            $consulta->execute();
            $vehiculosUsuario=$consulta->fetchAll();
            $listaConductores[$clave]['vehiculos']=$vehiculosUsuario;
    }

    $idAsignar=isset($_POST['idAsignar'])?$_POST['idAsignar']:"";
    $accion=isset($_POST['accion'])?$_POST['accion']:"";
    $vehiculos=isset($_POST['vehiculos'])?$_POST['vehiculos']:"";
    $rut=isset($_POST['rut'])?$_POST['rut']:"";
    $nombre=isset($_POST['nombre'])?$_POST['nombre']:"";

    $query3=$db->connect()->prepare('SELECT * FROM usuarios_vehiculos WHERE rutUsuario=:rutUsuario');
    $query3->bindParam(':rutUsuario',$rut);
    $query3->execute();
    $listaVehiculosUsuario=$query3->fetchAll();

    switch($accion){
        case "seleccionar":

            $sql="SELECT * FROM usuarios WHERE rut=:rut";
            $consulta=$db->connect()->prepare($sql);
            $consulta->bindParam(':rut',$idAsignar);
            $consulta->execute();
            $usuarioEditar=$consulta->fetch(PDO::FETCH_ASSOC);

            $rut=$usuarioEditar['rut'];
            $nombre=$usuarioEditar['nombre'];
            $idCompania=$usuarioEditar['idCompania'];
            
            $query2=$db->connect()->prepare('SELECT * FROM vehiculos WHERE idCompania=:idCompania');
            $query2->bindParam(':idCompania',$idCompania);
            $query2->execute();
            $listaVehiculos=$query2->fetchAll();
            
        break;

        case "asignar":
            foreach($listaVehiculosUsuario as $vehiculosUsuario){
                $sql="DELETE FROM usuarios_vehiculos WHERE rutUsuario=:rut";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':rut',$vehiculosUsuario['rutUsuario']);
                $consulta->execute();
            };
            if($vehiculos!=""){
                foreach ($vehiculos as $vehiculo){
                    $sql="INSERT INTO usuarios_vehiculos (id, rutUsuario, idVehiculo) VALUES (NULL, :rutUsuario, :idVehiculo)";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':rutUsuario',$rut);
                    $consulta->bindParam(':idVehiculo',$vehiculo);
                    $consulta->execute();
                };
            }
            $rut="";
            foreach($listaConductores as $clave=>$conductor){
                $sql="SELECT * FROM vehiculos WHERE idVehiculo IN (SELECT idVehiculo FROM usuarios_vehiculos WHERE rutUsuario=:rutUsuario)";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':rutUsuario',$conductor['rut']);
                $consulta->execute();
                $vehiculosUsuario=$consulta->fetchAll();
                $listaConductores[$clave]['vehiculos']=$vehiculosUsuario;
                
            }
        break;
    }
?>
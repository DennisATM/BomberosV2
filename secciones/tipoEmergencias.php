<?php session_start();
    include_once('../conexion/database.php');
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if($_SESSION['rol']== 3){
        header('location: ../vistas/template.php');
    }

    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM tipoEmergencias');
    $query->execute();
    $listaTipoEmergencias=$query->fetchAll();

    $idEmergencia=isset($_POST['idEmergencia'])?$_POST['idEmergencia']:"";
    $nombreEmergencia=isset($_POST['nombreEmergencia'])?$_POST['nombreEmergencia']:"";
    $accion=isset($_POST['accion'])?$_POST['accion']:"";
    $idSeleccion=isset($_POST['idSeleccion'])?$_POST['idSeleccion']:"";

    if($accion!=""){
        switch($accion){
            case "agregar":
                foreach($listaTipoEmergencias as $tipoEmergencia){
                    if($tipoEmergencia['idEmergencia'] == $idEmergencia){
                        $alert="El codigo ingresado ya ha sido registrado";
                        return;
                    }
                }
                $sql="INSERT INTO tipoEmergencias (idTipoEmergencia, nombreTipoEmergencia) VALUES (:idTipoEmergencia, :nombreTipoEmergencia)";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':idTipoEmergencia',$idEmergencia);
                $consulta->bindParam(':nombreTipoEmergencia',$nombreEmergencia);
                $consulta->execute();
                header('location: ./vista_tipoEmergencia.php');
            break;
            case "seleccionar":
                $sql="SELECT * FROM tipoEmergencias WHERE idTipoEmergencia=:idTipoEmergencia";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':idTipoEmergencia',$idSeleccion);
                $consulta->execute();
                $tipoEmergencia=$consulta->fetch(PDO::FETCH_ASSOC);
                $idEmergencia=$tipoEmergencia['idTipoEmergencia'];
                $nombreEmergencia=$tipoEmergencia['nombreTipoEmergencia'];
            break;
            case "editar":
                $sql="UPDATE tipoEmergencias SET nombreTipoEmergencia=:nombreTipoEmergencia WHERE idTipoEmergencia=:idTipoEmergencia";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':idTipoEmergencia',$idEmergencia);
                $consulta->bindParam(':nombreTipoEmergencia',$nombreEmergencia);
                $consulta->execute();
                header('location: ./vista_tipoEmergencia.php');
            break;
            case "eliminar":
                $sql="DELETE FROM tipoEmergencias WHERE idTipoEmergencia=:idTipoEmergencia";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':idTipoEmergencia',$idEmergencia);
                $consulta->execute();
                header('location: ./vista_tipoEmergencia.php');
            break;
        }
    }
?>
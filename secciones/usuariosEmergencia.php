<?php 

    include_once('../conexion/database.php');
    
    if($_SESSION['rol']==""){
        session_start();
    }

    //si en la url se digita cerrar sesion
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }    
    $idC=$_SESSION['userCompany'];
    $db= new Database();
    $emergencias=$db->connect()->prepare('SELECT * FROM emergencias WHERE estadoEmergencia="Asignada" AND idCompania=:idCompania');
    $emergencias->bindParam('idCompania',$idC);
    $emergencias->execute();
    $listaEmergenciasAsignadas=$emergencias->fetchAll();
    
    foreach($listaEmergenciasAsignadas as $clave=>$emergencia){
        $sql="SELECT * FROM usuarios  WHERE rut IN (SELECT rutUsuario FROM usuarios_emergencia WHERE idEmergencia=:idEmergencia)";
            $consulta=$db->connect()->prepare($sql);
            $consulta->bindParam(':idEmergencia',$emergencia['idEmergencia']);
            $consulta->execute();
            $usuariosEmergencia=$consulta->fetchAll();
            $listaEmergenciasAsignadas[$clave]['usuarios']=$usuariosEmergencia;
    }

    $idAsignar=isset($_POST['idAsignar'])?$_POST['idAsignar']:"";
    $accion=isset($_POST['accion'])?$_POST['accion']:"";
    $operarios=isset($_POST['operarios'])?$_POST['operarios']:"";
    $idEmergencia=isset($_POST['idEmergencia'])?$_POST['idEmergencia']:"";
    $fecha=isset($_POST['fecha'])?$_POST['fecha']:"";
    $tipo=isset($_POST['tipo'])?$_POST['tipo']:"";
    $ubicacion=isset($_POST['ubicacion'])?$_POST['ubicacion']:"";

    $query3=$db->connect()->prepare('SELECT * FROM usuarios_emergencia WHERE idEmergencia=:idEmergencia');
    $query3->bindParam(':idEmergencia',$idEmergencia);
    $query3->execute();
    $listaUsuariosEmergencia=$query3->fetchAll();

    switch($accion){
        case "seleccionar":

            $sql="SELECT * FROM emergencias WHERE idEmergencia=:idEmergencia";
            $consulta=$db->connect()->prepare($sql);
            $consulta->bindParam(':idEmergencia',$idAsignar);
            $consulta->execute();
            $listaEmergenciaEditar=$consulta->fetch(PDO::FETCH_ASSOC);

            $idEmergencia=$listaEmergenciaEditar['idEmergencia'];
            $fecha=$listaEmergenciaEditar['fechaReporte'];
            $tipo=$listaEmergenciaEditar['tipoEmergencia'];
            $ubicacion=$listaEmergenciaEditar['ubicacionEmergencia'];
            
            $query2=$db->connect()->prepare('SELECT * FROM usuarios WHERE idCompania=:idCompania AND estado="Disponible"');
            $query2->bindParam(':idCompania',$idC);
            $query2->execute();
            $listaUsuarios=$query2->fetchAll();
            
        break;

        case "asignar":
            foreach($listaUsuariosEmergencia as $usuariosEmergencia){

                $textEstadoD="Disponible";
                $sqlEstadoD="UPDATE usuarios SET estado=:estado WHERE rut=:rutEstado";
                $consultaEstadoD=$db->connect()->prepare($sqlEstadoD);
                $consultaEstadoD->bindParam(':rutEstado',$usuariosEmergencia['rutUsuario']);
                $consultaEstadoD->bindParam(':estado',$textEstadoD);
                $consultaEstadoD->execute();

                $sql="DELETE FROM usuarios_emergencia WHERE idEmergencia=:idEmergencia";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':idEmergencia',$usuariosEmergencia['idEmergencia']);
                $consulta->execute();
            };
            if($operarios!=""){
                foreach ($operarios as $operario){
                    $sql="INSERT INTO usuarios_emergencia (id, idEmergencia, rutUsuario) VALUES (NULL, :idEmergencia, :rutUsuario)";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idEmergencia',$idEmergencia);
                    $consulta->bindParam(':rutUsuario',$operario);
                    $consulta->execute();

                    $textEstado="En Emergencia";
                    $sqlEstado="UPDATE usuarios SET estado=:estado WHERE rut=:rutEstado";
                    $consultaEstado=$db->connect()->prepare($sqlEstado);
                    $consultaEstado->bindParam(':rutEstado',$operario);
                    $consultaEstado->bindParam(':estado',$textEstado);
                    $consultaEstado->execute();

                };
            }
            $rut="";
            foreach($listaEmergenciasAsignadas as $clave=>$emergencia){
                $sql="SELECT * FROM usuarios  WHERE rut IN (SELECT rutUsuario FROM usuarios_emergencia WHERE idEmergencia=:idEmergencia)";
                $consulta=$db->connect()->prepare($sql);
                $consulta->bindParam(':idEmergencia',$emergencia['idEmergencia']);
                $consulta->execute();
                $usuariosEmergencia=$consulta->fetchAll();
                $listaEmergenciasAsignadas[$clave]['usuarios']=$usuariosEmergencia;
            }
        break;
    }
?>
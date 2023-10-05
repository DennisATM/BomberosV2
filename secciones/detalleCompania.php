<?php 
    
    include('../conexion/database.php');
    //si en la url se digita cerrar sesion
    
    if(!isset($_SESSION['rol'])){
        session_start();
    }
    
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if($_SESSION['rol']==""){
        header('location: ../index.php');
    }


    $db=new Database();
    $queryEmpresa=$db->connect()->prepare('SELECT * FROM empresa');
    $queryEmpresa->execute();
    $empresa=$queryEmpresa->fetch(PDO::FETCH_NUM);
    
    $idCompania=isset($_GET['idc'])?$_GET['idc']:"";

    date_default_timezone_set('America/Santiago');

    $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
    $fechaC=$diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
    
    $horaC=date("H:i:s");


    $_SESSION['idCompania']=$idCompania;
   
    $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE idCompania=:idCompania AND estado="Disponible"');
    $query->bindParam(':idCompania',$idCompania);
    $query->execute();
    $usuariosCompaniaUno=$query->fetchAll();

    $total=$db->connect()->prepare('SELECT count(rut) FROM usuarios WHERE idCompania=:idCompania');
    $total->bindParam(':idCompania',$idCompania);
    $total->execute();
    $totalUsuarios=$total->fetchColumn();

    $queryConductoresSi=$db->connect()->prepare('SELECT * FROM usuarios WHERE idCompania=:idCompania AND idPerfil=2 AND estado="Disponible"');
    $queryConductoresSi->bindParam(':idCompania',$idCompania);
    $queryConductoresSi->execute();
    $listaConductoresSi=$queryConductoresSi->fetchAll();

    foreach($listaConductoresSi as $clave=>$conductor){
        $sql="SELECT DISTINCT * FROM vehiculos WHERE idVehiculo IN (SELECT idVehiculo FROM usuarios_vehiculos WHERE rutUsuario=:rutUsuario) AND estadoVehiculo='Disponible'";
            $consulta=$db->connect()->prepare($sql);
            $consulta->bindParam(':rutUsuario',$conductor['rut']);
            $consulta->execute();
            $vehiculosUsuario=$consulta->fetchAll();
            $listaConductoresSi[$clave]['vehiculos']=$vehiculosUsuario;
    }
    
    $queryEmergenciasUno=$db->connect()->prepare('SELECT * FROM emergencias WHERE idCompania=:idCompania ORDER BY idEmergencia DESC LIMIT 4');
    $queryEmergenciasUno->bindParam(':idCompania',$idCompania);
    $queryEmergenciasUno->execute();
    $emergenciasUno=$queryEmergenciasUno->fetchAll();

    // $queryEmergenciasUno=$db->connect()->prepare('SELECT * FROM emergencias WHERE idCompania=:idCompania AND estadoEmergencia="Asignada"');
    // $queryEmergenciasUno->bindParam(':idCompania',$idCompania);
    // $queryEmergenciasUno->execute();
    // $emergenciasUno=$queryEmergenciasUno->fetchAll();
    
    foreach($emergenciasUno as $clave=>$emergencias){
        $sql2="SELECT * FROM usuarios WHERE rut IN (SELECT rutConductor FROM vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
            $consulta2=$db->connect()->prepare($sql2);
            $consulta2->bindParam(':idEmergencia',$emergencias['idEmergencia']);
            $consulta2->execute();
            $usuarioEmergencia=$consulta2->fetchAll();
            $emergenciasUno[$clave]['usuario']=$usuarioEmergencia;
        
            $sql3="SELECT * FROM vehiculos WHERE idVehiculo IN (SELECT idVehiculo FROM vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
            $consulta3=$db->connect()->prepare($sql3);
            $consulta3->bindParam(':idEmergencia',$emergencias['idEmergencia']);
            $consulta3->execute();
            $vehiculoEmergencia=$consulta3->fetchAll();
            $emergenciasUno[$clave]['vehiculo']=$vehiculoEmergencia;
    }
    
?>
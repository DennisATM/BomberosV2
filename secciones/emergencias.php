<?php 
    if(!isset($_SESSION['rol'])){
        session_start();
    }
    include_once('../conexion/database.php');
    
    // require_once('../ca-bundle-main/src/CaBundle.php'); funciona

    // require_once "../twitteroauth-main/autoload.php"; funciona
     
    // use Abraham\TwitterOAuth\TwitterOAuth; funciona
     
    //definiendo keys
    // define('CONSUMER_KEY', 'your consumer key');
    // define('CONSUMER_SECRET', 'your consumer secret');
    // define('ACCESS_TOKEN', 'your access token');
    // define('ACCESS_TOKEN_SECRET', 'your access token secret');
    

    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }
    
    if($_SESSION['rol']== 3){
        header('location: ../vistas/template.php');
    }

    date_default_timezone_set('America/Santiago');

    $hoy = date("d.m.y");
    $ahora=date("H:i:s");

    $alertEmergencia="";
    $mensajeError="";

    $creado=false;
    $db= new Database();

    $query=$db->connect()->prepare('SELECT * FROM emergencias ORDER BY idEmergencia DESC');
    $query->execute();
    $listaEmergencias=$query->fetchAll();

    $query2=$db->connect()->prepare('SELECT * FROM tipoEmergencias');
    $query2->execute();
    $listaTipoEmergencias=$query2->fetchAll();

    $queryConductoresUno=$db->connect()->prepare('SELECT * FROM usuarios WHERE idPerfil=2 AND estado="Disponible" ORDER BY idCompania ASC');
    $queryConductoresUno->execute();
    $listaConductoresUno=$queryConductoresUno->fetchAll();

    foreach($listaConductoresUno as $clave=>$conductorUno){
        $sql="SELECT * FROM vehiculos WHERE idVehiculo IN (SELECT idVehiculo FROM usuarios_vehiculos WHERE rutUsuario=:rutUsuario) AND estadoVehiculo='Disponible'";
            $consulta=$db->connect()->prepare($sql);
            $consulta->bindParam(':rutUsuario',$conductorUno['rut']);
            $consulta->execute();
            $vehiculosUsuarioUno=$consulta->fetchAll();
            $listaConductoresUno[$clave]['vehiculos']=$vehiculosUsuarioUno;
    }


    $fechaEmergencia=isset($_POST['fechaEmergencia'])?$_POST['fechaEmergencia']:"";    
    $tipoEmergencia=isset($_POST['tipoEmergencia'])?$_POST['tipoEmergencia']:"";
    $direccionEmergencia=isset($_POST['direccionEmergencia'])?$_POST['direccionEmergencia']:"";
    $descripcionEmergencia=isset($_POST['descripcionEmergencia'])?$_POST['descripcionEmergencia']:"";
    $datosEmergencia=isset($_POST['datosEmergencia'])?$_POST['datosEmergencia']:"";
   
    $long=strlen($datosEmergencia);
    
    if ($long>12){ 
        $rutConductor=substr($datosEmergencia,0,9);
        $idCompania=substr($datosEmergencia,9,1);
        $idVehiculo=substr($datosEmergencia,10-$long);
    }else{
        $rutConductor=substr($datosEmergencia,0,8);
        $idCompania=substr($datosEmergencia,8,1);
        $idVehiculo=substr($datosEmergencia,9-$long);
    }
    
    $crear=isset($_POST['crear'])?$_POST['crear']:"";

    $idCerrar=isset($_POST['idEmergenciaCerrar'])?$_POST['idEmergenciaCerrar']:"";
    $idConfirmarCerrar=isset($_POST['idCerrar'])?$_POST['idCerrar']:"";
    $idBorrar=isset($_POST['idEmergenciaBorrar'])?$_POST['idEmergenciaBorrar']:"";
    $fechaCierre=isset($_POST['fechaCierre'])?$_POST['fechaCierre']:"";
    $comentarioCierre=isset($_POST['comentarioCierre'])?$_POST['comentarioCierre']:"";
    $accion=isset($_POST['accion'])?$_POST['accion']:"";

    if ($accion!=""){
        switch($accion){
            
            case "crear":
                if($datosEmergencia!=""){                
                $estado="Asignada";
               
                global $idEmergencia;
                
                $mensaje="Se asigno nueva emergencia a Compañia: ".$idCompania;
                
                $sql="INSERT INTO emergencias (idEmergencia, fechaReporte, tipoEmergencia, ubicacionEmergencia, descripcionEmergencia, idCompania, estadoEmergencia) VALUES (NULL, :fechaReporte, :tipoEmergencia, :ubicacionEmergencia, :descripcionEmergencia, :idCompania, :estadoEmergencia)";
                        $consulta=$db->connect()->prepare($sql);
                        $consulta->bindParam(':fechaReporte',$fechaEmergencia);
                        $consulta->bindParam(':tipoEmergencia',$tipoEmergencia);
                        $consulta->bindParam(':ubicacionEmergencia',$direccionEmergencia);
                        $consulta->bindParam(':descripcionEmergencia',$descripcionEmergencia);
                        $consulta->bindParam(':idCompania',$idCompania);
                        $consulta->bindParam(':estadoEmergencia',$estado);
                        $consulta->execute();
        
                        $consul = $db->connect()->query('SELECT MAX(idEmergencia) FROM emergencias');
                        $consul->execute();
                        $id=$consul->fetch();
                        $idEmergencia=$id[0];
        
                        $sql3="INSERT INTO vehiculos_emergencia (id, idEmergencia, idVehiculo, rutConductor) VALUES (NULL, :idEmergencia, :idVehiculo, :rutConductor)";
                        $consulta3=$db->connect()->prepare($sql3);
                        $consulta3->bindParam(':idEmergencia',$idEmergencia);
                        $consulta3->bindParam(':idVehiculo',$idVehiculo);
                        $consulta3->bindParam(':rutConductor',$rutConductor);
                        $consulta3->execute();
        
                        $textEstado="En Emergencia";
                        $sql2="UPDATE usuarios SET estado=:estado WHERE rut=:rutEstado";
                        $consulta2=$db->connect()->prepare($sql2);
                        $consulta2->bindParam(':rutEstado',$rutConductor);
                        $consulta2->bindParam(':estado',$textEstado);
                        $consulta2->execute();
        
                        $sql4="UPDATE vehiculos SET estadoVehiculo=:estado WHERE idVehiculo=:idVehiculo";
                        $consulta4=$db->connect()->prepare($sql4);
                        $consulta4->bindParam(':idVehiculo',$idVehiculo);
                        $consulta4->bindParam(':estado',$textEstado);
                        $consulta4->execute();
                        
                        $sqlCond="SELECT * FROM usuarios WHERE rut=:rutCond";
                        $consultaCond=$db->connect()->prepare($sqlCond);
                        $consultaCond->bindParam(':rutCond',$rutConductor);
                        $consultaCond->execute();
                        $userCond=$consultaCond->fetch(PDO::FETCH_ASSOC);
                        
                        //Seteando para posteo del tweet
                        // $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
                        // $connection->setApiVersion('2');
                        
                        // $newTweet="Nueva Emergencia Registrada"."\n Direccion: ".$direccionEmergencia."\n Tipo: ".$tipoEmergencia. " - ".$descripcionEmergencia. "\n Asignado a: Compañia ".$idCompania."\n Vehiculo/Conductor: ".$idVehiculo." - ".$userCond['nombre'];
                        // $queryParams['text'] = $newTweet;

                        // $resultado=$connection->post("tweets", $queryParams, true);
                       
                        echo "<script>location.href = './vista_Emergencia.php';</script>";
                }else{
                    $mensajeError="No haz seleccionado conductor/vehiculo.";
                    break;
                }

            break;
            case "seleccionar":
                $query3=$db->connect()->prepare('SELECT * FROM emergencias WHERE idEmergencia=:idEmergencia');
                $query3->bindParam(':idEmergencia',$idCerrar);
                $query3->execute();
                $emergenciaElegida=$query3->fetch(PDO::FETCH_ASSOC);
                $fechaEmergencia=$emergenciaElegida['fechaReporte'];
                $estadoEmergencia=$emergenciaElegida['estadoEmergencia'];
                $idTipoEmergencia=$emergenciaElegida['tipoEmergencia'];
                $direccionEmergencia=$emergenciaElegida['ubicacionEmergencia'];
                $descripcionEmergencia=$emergenciaElegida['descripcionEmergencia'];
                $fechaCierre=$emergenciaElegida['fechaCierre'];
  
                $sql5="SELECT * FROM vehiculos WHERE idVehiculo IN (SELECT idVehiculo FROM vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
                $consulta5=$db->connect()->prepare($sql5);
                $consulta5->bindParam(':idEmergencia',$idCerrar);
                $consulta5->execute();
                $vehiculoEmergencia=$consulta5->fetchAll();
                
                $sql6="SELECT * FROM usuarios WHERE rut IN (SELECT rutConductor FROM vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
                $consulta6=$db->connect()->prepare($sql6);
                $consulta6->bindParam(':idEmergencia',$idCerrar);
                $consulta6->execute();
                $conductorEmergencia=$consulta6->fetchAll();
                
            break;
            case "cerrar":
                $sql7="UPDATE emergencias SET estadoEmergencia='Cerrada', fechaCierre=:fechaCierre, descripcionCierre=:comentarioCierre WHERE idEmergencia=:idEmergencia";
                    $consulta7=$db->connect()->prepare($sql7);
                    $consulta7->bindParam(':idEmergencia',$idConfirmarCerrar);
                    $consulta7->bindParam(':fechaCierre',$fechaCierre);
                    $consulta7->bindParam(':comentarioCierre',$comentarioCierre);
                    $consulta7->execute();

                $sql8="UPDATE vehiculos SET estadoVehiculo ='Disponible' WHERE idVehiculo IN (SELECT idVehiculo from vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
                    $consulta8=$db->connect()->prepare($sql8);
                    $consulta8->bindParam(':idEmergencia',$idConfirmarCerrar);
                    $consulta8->execute();

                $sql9="UPDATE usuarios SET estado ='Disponible' WHERE rut IN (SELECT rutConductor from vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
                    $consulta9=$db->connect()->prepare($sql9);
                    $consulta9->bindParam(':idEmergencia',$idConfirmarCerrar);
                    $consulta9->execute();
                
                $sql10="UPDATE usuarios SET estado ='Disponible' WHERE rut IN (SELECT rutUsuario from usuarios_emergencia WHERE idEmergencia=:idEmergencia)";
                    $consulta10=$db->connect()->prepare($sql10);
                    $consulta10->bindParam(':idEmergencia',$idConfirmarCerrar);
                    $consulta10->execute();

                    echo "<script>location.href = './vista_Emergencia.php';</script>";

            break;
            case "borrar":

                $sql10="UPDATE vehiculos SET estadoVehiculo ='Disponible' WHERE idVehiculo IN (SELECT idVehiculo from vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
                    $consulta10=$db->connect()->prepare($sql10);
                    $consulta10->bindParam(':idEmergencia',$idBorrar);
                    $consulta10->execute();

                $sql11="UPDATE usuarios SET estado ='Disponible' WHERE rut IN (SELECT rutConductor from vehiculos_emergencia WHERE idEmergencia=:idEmergencia)";
                    $consulta11=$db->connect()->prepare($sql11);
                    $consulta11->bindParam(':idEmergencia',$idBorrar);
                    $consulta11->execute();

                $sql12="DELETE FROM emergencias WHERE idEmergencia=:idEmergencia";
                    $consulta12=$db->connect()->prepare($sql12);
                    $consulta12->bindParam(':idEmergencia',$idBorrar);
                    $consulta12->execute();

                $sql13="DELETE FROM vehiculos_emergencia WHERE idEmergencia=:idEmergencia";
                    $consulta13=$db->connect()->prepare($sql13);
                    $consulta13->bindParam(':idEmergencia',$idBorrar);
                    $consulta13->execute();

                    echo "<script>location.href = './vista_Emergencia.php';</script>";

            break;
        }

    }
?>

      

<?php session_start();
    include_once('../conexion/database.php');
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if($_SESSION['rol']!= 1){
        header('location: ../vistas/template.php');
    }

    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM vehiculos');
    $query->execute();
    $listaVehiculos=$query->fetchAll();

    $idVehiculo=isset($_POST['idVehiculo'])?$_POST['idVehiculo']:"";
    $marcaVehiculo=isset($_POST['marcaVehiculo'])?$_POST['marcaVehiculo']:"";
    $modeloVehiculo=isset($_POST['modeloVehiculo'])?$_POST['modeloVehiculo']:"";
    $patenteVehiculo=isset($_POST['patenteVehiculo'])?$_POST['patenteVehiculo']:"";
    $idCompania=isset($_POST['idCompania'])?$_POST['idCompania']:"";
    $urlFotoVehiculo=isset($_POST['fotoVehiculo'])?"../src/img/photos/vehiculos/".$_POST['fotoVehiculo']:"";
    $estadoVehiculo=isset($_POST['estadoVehiculo'])?$_POST['estadoVehiculo']:"";
    $accion=isset($_POST['accion'])?$_POST['accion']:"";
    $idSeleccion=isset($_POST['idSeleccion'])?$_POST['idSeleccion']:"";
    $ruta=isset($_POST['rutatmp'])?$_POST['rutatmp']:"";

    if(isset($_POST['accion'])){
        
        $idVehiculo=isset($_POST['idVehiculo'])?$_POST['idVehiculo']:"";
        $marcaVehiculo=isset($_POST['marcaVehiculo'])?$_POST['marcaVehiculo']:"";
        $modeloVehiculo=isset($_POST['modeloVehiculo'])?$_POST['modeloVehiculo']:"";
        $patenteVehiculo=isset($_POST['patenteVehiculo'])?$_POST['patenteVehiculo']:"";
        $idCompania=isset($_POST['idCompania'])?$_POST['idCompania']:"";
        $urlFotoVehiculo=isset($_POST['fotoVehiculo'])?"../src/img/photos/vehiculos/".$_POST['fotoVehiculo']:"";
        $estadoVehiculo=isset($_POST['estadoVehiculo'])?$_POST['estadoVehiculo']:"";
        $accion=isset($_POST['accion'])?$_POST['accion']:"";
        $idSeleccion=isset($_POST['idSeleccion'])?$_POST['idSeleccion']:"";
        $ruta=isset($_POST['rutatmp'])?$_POST['rutatmp']:"";
        
        if(isset($_FILES['fotoVehiculo'])){ 
            if($_FILES["fotoVehiculo"]){
                $nombre_base = basename($_FILES["fotoVehiculo"]["name"]);
                $urlFotoVehiculo="../src/img/photos/vehiculos/".$nombre_base;
                $subirarchivo = move_uploaded_file($_FILES["fotoVehiculo"]["tmp_name"], $urlFotoVehiculo);
            }
        }
        if($urlFotoVehiculo=="../src/img/photos/vehiculos/" || $urlFotoVehiculo==""){
            $urlFotoVehiculo="../src/img/photos/vehiculos/sinFotoV.jpeg";
        }
        
        if($accion!=""){
            switch($accion){
                case "agregar":
                    foreach($listaVehiculos as $vehiculos){
                        if($vehiculos['idVehiculo'] == $idVehiculo){
                            $alert="El codigo ingresado ya ha sido registrado";
                            return;
                        }
                    }
                    
                    $sql="INSERT INTO vehiculos (idVehiculo, marcaVehiculo, modeloVehiculo, patenteVehiculo, urlFotoVehiculo, idCompania, estadoVehiculo) VALUES (:idVehiculo, :marcaVehiculo, :modeloVehiculo, :patenteVehiculo, :urlFotoVehiculo, :idCompania, :estadoVehiculo)";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idVehiculo',$idVehiculo);
                    $consulta->bindParam(':marcaVehiculo',$marcaVehiculo);
                    $consulta->bindParam(':modeloVehiculo',$modeloVehiculo);
                    $consulta->bindParam(':patenteVehiculo',$patenteVehiculo);
                    $consulta->bindParam(':urlFotoVehiculo',$urlFotoVehiculo);
                    $consulta->bindParam(':idCompania',$idCompania);
                    $consulta->bindParam(':estadoVehiculo',$estadoVehiculo);
                    $consulta->execute();
                    header('location: ./vista_vehiculos.php');
                break;
                case "seleccionar":
                    $sql="SELECT * FROM vehiculos WHERE idVehiculo=:idVehiculo";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idVehiculo',$idSeleccion);
                    $consulta->execute();
                    $vehiculo=$consulta->fetch(PDO::FETCH_ASSOC);
                    $idVehiculo=$vehiculo['idVehiculo'];
                    $marcaVehiculo=$vehiculo['marcaVehiculo'];
                    $modeloVehiculo=$vehiculo['modeloVehiculo'];
                    $patenteVehiculo=$vehiculo['patenteVehiculo'];
                    $urlFotoVehiculo=$vehiculo['urlFotoVehiculo'];
                    $idCompania=$vehiculo['idCompania'];
                    $estadoVehiculo=$vehiculo['estadoVehiculo'];
                break;
                case "editar":
                    $sql="UPDATE vehiculos SET marcaVehiculo=:marcaVehiculo, modeloVehiculo=:modeloVehiculo,patenteVehiculo=:patenteVehiculo, urlFotoVehiculo=:urlFotoVehiculo, idCompania=:idCompania, estadoVehiculo=:estadoVehiculo WHERE idVehiculo=:idVehiculo";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idVehiculo',$idVehiculo);
                    $consulta->bindParam(':marcaVehiculo',$marcaVehiculo);
                    $consulta->bindParam(':modeloVehiculo',$modeloVehiculo);
                    $consulta->bindParam(':patenteVehiculo',$patenteVehiculo);
                    $consulta->bindParam(':urlFotoVehiculo',$urlFotoVehiculo);
                    $consulta->bindParam(':idCompania',$idCompania);
                    $consulta->bindParam(':estadoVehiculo',$estadoVehiculo);
                    $consulta->execute();
                    header('location: ./vista_vehiculos.php');
                break;
                case "eliminar":
                    $sql="DELETE FROM vehiculos WHERE idVehiculo=:idVehiculo";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idVehiculo',$idVehiculo);
                    $consulta->execute();
                    header('location: ./vista_vehiculos.php');
                break;
                
            }
        }
    
    }
?>
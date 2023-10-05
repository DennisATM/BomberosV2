<?php
    include_once('../conexion/database.php');
    
    if(!isset($_SESSION['rol'])){
        session_start();
    }
    
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM compania ORDER BY idCompania ASC');
    $query->execute();
    $detalleCompania=$query->fetchAll();

    $idCompania = "";
    $nombreCompania =  "";
    $direccionCompania = "";
    $telefonoCompania ="";
    $urlLogoCompania = "";

    if(isset($_POST['accion'])){
        $idCompania= isset($_POST['idCompania']) ? $_POST['idCompania'] : "";
        $nombreCompania = isset($_POST['nombreCompania']) ? $_POST['nombreCompania'] : "";
        $direccionCompania = isset($_POST['direccionCompania']) ? $_POST['direccionCompania'] : "";
        $telefonoCompania = isset($_POST['telefonoCompania']) ? $_POST['telefonoCompania'] : "";
        $urlLogoCompania = isset($_POST['urlLogoCompania']) ? "../src/img/logos/".$_POST['urlLogoCompania'] : "";
        
        $accion=isset($_POST['accion'])?$_POST['accion']:"";
        $idSeleccion=isset($_POST['idSeleccion']) ? $_POST['idSeleccion'] : "";
        $ruta=isset($_POST['rutatmp'])?$_POST['rutatmp']:"";
        // $idEditar=isset($_POST['idEditar'])?$_POST['idEditar']:"";
        
        if(isset($_FILES['urlLogoCompania'])){ 
            if($_FILES['urlLogoCompania']){
                $nombre_base = basename($_FILES["urlLogoCompania"]["name"]);
                $urlLogoCompania="../src/img/logos/".$nombre_base;
                $subirarchivo = move_uploaded_file($_FILES["urlLogoCompania"]["tmp_name"], $urlLogoCompania);
            }
        }
        
        if($urlLogoCompania == "../src/img/logos/" || $urlLogoCompania==""){
            $urlLogoCompania="../src/img/logos/sinLogo.jpg";
        }
        
        if($accion!=""){
            switch($accion){
                case "agregar":
                    foreach($detalleCompania as $compania){
                        if($compania['nombreCompania'] == $nombreCompania){
                            $alert="La compañia ya se encuentra registrada.";
                            return;
                        }
                    }
                    
                    $sql="INSERT INTO compania (idCompania, nombreCompania, direccionCompania, telefonoCompania, urlLogoCompania) VALUES (:idCompania, :nombreCompania, :direccionCompania, :telefonoCompania, :urlLogoCompania)";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idCompania',$idCompania);
                    $consulta->bindParam(':nombreCompania',$nombreCompania);
                    $consulta->bindParam(':direccionCompania',$direccionCompania);
                    $consulta->bindParam(':telefonoCompania',$telefonoCompania);
                    $consulta->bindParam(':urlLogoCompania',$urlLogoCompania);
                    $consulta->execute();
                    
                    $query=$db->connect()->prepare('SELECT * FROM compania ORDER BY idCompania ASC');
                    $query->execute();
                    $detalleCompania=$query->fetchAll();
                
                    $idCompania = "";
                    $nombreCompania =  "";
                    $direccionCompania = "";
                    $telefonoCompania ="";
                    $urlLogoCompania = "";

                break;
                case "seleccionar":
                    $sql="SELECT * FROM compania WHERE idCompania=:idCompania";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idCompania',$idSeleccion);
                    $consulta->execute();
                    $compania=$consulta->fetch(PDO::FETCH_ASSOC);
                    
                    $idCompania=$compania['idCompania']; 
                    $nombreCompania=$compania['nombreCompania'];
                    $direccionCompania=$compania['direccionCompania'];
                    $telefonoCompania=$compania['telefonoCompania'];
                    $urlLogoCompania=$compania['urlLogoCompania'];
                break;
                case "editar":
                    $sql="UPDATE compania SET nombreCompania=:nombreCompania, direccionCompania=:direccionCompania, telefonoCompania=:telefonoCompania, urlLogoCompania=:urlLogoCompania WHERE idCompania=:idCompania";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idCompania',$idCompania);
                    $consulta->bindParam(':nombreCompania',$nombreCompania);
                    $consulta->bindParam(':direccionCompania',$direccionCompania);
                    $consulta->bindParam(':telefonoCompania',$telefonoCompania);
                    $consulta->bindParam(':urlLogoCompania',$urlLogoCompania);
                    $consulta->execute();
                    
                    $query=$db->connect()->prepare('SELECT * FROM compania ORDER BY idCompania ASC');
                    $query->execute();
                    $detalleCompania=$query->fetchAll();
                
                    $idCompania = "";
                    $nombreCompania =  "";
                    $direccionCompania = "";
                    $telefonoCompania ="";
                    $urlLogoCompania = "";
                break;
                case "eliminar":
                    $sql="DELETE FROM compania WHERE idCompania=:idCompania";
                    $consulta=$db->connect()->prepare($sql);
                    $consulta->bindParam(':idCompania',$idCompania);
                    $consulta->execute();
                    
                    $query=$db->connect()->prepare('SELECT * FROM compania ORDER BY idCompania ASC');
                    $query->execute();
                    $detalleCompania=$query->fetchAll();

                    $idCompania = "";
                    $nombreCompania =  "";
                    $direccionCompania = "";
                    $telefonoCompania ="";
                    $urlLogoCompania = "";
                break;
                
            }
        }
    
    }
?>
<?php 
    if(!isset($_SESSION['rol'])){
        session_start();
    }
                    
    include_once('../conexion/database.php');
    //si en la url se digita cerrar sesion
    
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if($_SESSION['rol']== 3){
        header('location: ../vistas/template.php');
    }
    
    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM empresa');
    $query->execute();
    $detalleEmpresa=$query->fetch(PDO::FETCH_ASSOC);

    $fotoActual=$detalleEmpresa['urlLogoEmpresa'];

    if (isset($_POST['accion'])){
        $rutEmpresa=isset($_POST['rutEmpresa']) ? $_POST['rutEmpresa'] : "";
        $nombreEmpresa=isset($_POST['nombreEmpresa']) ? $_POST['nombreEmpresa'] : "";
        $urlLogoEmpresa=isset($_POST['urlLogo']) ? "../src/img/layouts/".$_POST['urlLogo'] : "";
        
        if($_FILES["urlLogo"]){
            $nombre_base = basename($_FILES["urlLogo"]["name"]);
            $urlLogoEmpresa="../src/img/layouts/".$nombre_base;
            $subirarchivo = move_uploaded_file($_FILES["urlLogo"]["tmp_name"], $urlLogoEmpresa);
        }

        if ($urlLogoEmpresa=="../src/img/layouts/"){
            $urlLogoEmpresa=$fotoActual;
        }

        $sql="UPDATE empresa SET rut=:rut, nombreEmpresa=:nombreEmpresa, urlLogoEmpresa=:urlLogoEmpresa";
        $consulta=$db->connect()->prepare($sql);
        $consulta->bindParam(':rut',$rutEmpresa);
        $consulta->bindParam(':nombreEmpresa',$nombreEmpresa);
        $consulta->bindParam(':urlLogoEmpresa',$urlLogoEmpresa);
        $consulta->execute();
        
        $query=$db->connect()->prepare('SELECT * FROM empresa');
        $query->execute();
        $detalleEmpresa=$query->fetch(PDO::FETCH_ASSOC);

        $fotoActual=$detalleEmpresa['urlLogoEmpresa'];
        header('location: ../vistas/config_general.php');
    }
?>
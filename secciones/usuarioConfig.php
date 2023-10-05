<?php include_once('../conexion/database.php');
    if($_SESSION['rol']==""){
        session_start();
    }
    //si en la url se digita cerrar sesion
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }
    $rut=$_SESSION['rut'];
    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE rut=:rut');
    $query->bindParam(':rut',$rut);
    $query->execute();
    $listaUsuarios=$query->fetch(PDO::FETCH_ASSOC);
    $ruta=$listaUsuarios['urlFoto'];
  
    //Asignacion de variables
    $alert="";

    $accion=isset($_POST['accion'])?$_POST['accion']:"";
    $urlFoto=isset($_POST['foto'])?"../src/img/photos/usuarios/".$_POST['foto']:"";
    
    // if($_POST['accion']){
        
        if($urlFoto==""){
            if(isset($_FILES['foto'])){
                if($_FILES['foto']){
                    $nombre_base = basename($_FILES['foto']["name"]);
                    $urlFoto='../src/img/photos/usuarios/'.$nombre_base;
                    $subirarchivo = move_uploaded_file($_FILES['foto']["tmp_name"], $urlFoto);
                }
            }
  
            if($urlFoto=="../src/img/photos/usuarios/" || $urlFoto==""){
                $urlFoto="../src/img/photos/usuarios/sinFoto.png";
            }

            if($accion!=''){
  
                switch($accion){
  
                    case "subirFoto":
                        $sql="UPDATE usuarios SET urlFoto=:urlFoto WHERE rut=:rut";
                        $consulta=$db->connect()->prepare($sql);
                        $consulta->bindParam(':rut',$rut);
                        
                        if ($urlFoto != $ruta){
                            $consulta->bindParam(':urlFoto',$urlFoto);
                        }else{
                            $consulta->bindParam(':urlFoto',$ruta);
                        }

                        $consulta->execute();

                        $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE rut=:rut');
                        $query->bindParam(':rut',$rut);
                        $query->execute();
                        $listaUsuarios=$query->fetch(PDO::FETCH_ASSOC);
                        $ruta=$listaUsuarios['urlFoto'];
                        
                        break;
                }
            }
        }
    
?>
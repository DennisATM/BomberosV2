<?php session_start();
include_once('../conexion/database.php');
if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if($_SESSION['rol'] != 1){
        header('location: ../vistas/template.php');
    }

    $db= new Database();
    $query=$db->connect()->prepare('SELECT * FROM usuarios');
    $query->execute();
    $listaUsuarios=$query->fetchAll();

    $query2=$db->connect()->prepare('SELECT * FROM perfiles');
    $query2->execute();
    $listaPerfiles=$query2->fetchAll();
    
    $query3=$db->connect()->prepare('SELECT * FROM roles');
    $query3->execute();
    $listaRoles=$query3->fetchAll();
    
    $query4=$db->connect()->prepare('SELECT * FROM compania');
    $query4->execute();
    $listaCompania=$query4->fetchAll();
    
    //Asignacion de variables
    $alert="";
    if(isset($_POST['accion'])){
        $rut=isset($_POST['rut'])?$_POST['rut']:"";
        $nombre=isset($_POST['nombre'])?$_POST['nombre']:"";
        $cargo=isset($_POST['cargo'])?$_POST['cargo']:"";
        $direccion=isset($_POST['direccion'])?$_POST['direccion']:"";
        $telefono=isset($_POST['telefono'])?$_POST['telefono']:"";
        $urlFoto=isset($_POST['foto'])?"../src/img/photos/usuarios/".$_POST['foto']:"";
        $skills=isset($_POST['entrenamiento'])?$_POST['entrenamiento']:"";
        $ruta=isset($_POST['rutatmp'])?$_POST['rutatmp']:"";
        if($urlFoto==""){
            if(isset($_FILES['foto'])){
                if($_FILES["foto"]){
                    $nombre_base = basename($_FILES["foto"]["name"]);
                    $urlFoto="../src/img/photos/usuarios/".$nombre_base;
                    $subirarchivo = move_uploaded_file($_FILES["foto"]["tmp_name"], $urlFoto);
                }
            }
            if($urlFoto=="../src/img/photos/usuarios/" || $urlFoto==""){
                $urlFoto="../src/img/photos/usuarios/sinFoto.png";
            }
            $clave=isset($_POST['clave'])?$_POST['clave']:"";
            $idRol=isset($_POST['rol'])?$_POST['rol']:"";
            $idCompania=isset($_POST['compania'])?$_POST['compania']:"";
            $idPerfil=isset($_POST['perfil'])?$_POST['perfil']:"";
            $estado="No Disponible";    

            $accion=isset($_POST['accion'])?$_POST['accion']:"";
            $idBorrar=isset($_POST['idBorrar'])?$_POST['idBorrar']:"";
            $idEditar=isset($_POST['idEditar'])?$_POST['idEditar']:"";
    
            if($accion!=''){
                switch($accion){
                    case "guardar":
                        //Validar que rut no exista en la BD
                        foreach($listaUsuarios as $usuarios){
                            if($usuarios['rut'] == $rut){
                                $alert="El rut ingresado ya ha sido registrado";
                                return;
                            }
                        }
                        $sql="INSERT INTO usuarios (rut, nombre, cargo, direccion, telefono, urlFoto, skills, idRol, idPerfil, idCompania, clave, estado) VALUES (:rut, :nombre, :cargo, :direccion, :telefono, :urlFoto, :skills, :idRol, :idPerfil, :idCompania,:clave,:estado)";
                        $consulta=$db->connect()->prepare($sql);
                        $consulta->bindParam(':rut',$rut);
                        $consulta->bindParam(':nombre',$nombre);
                        $consulta->bindParam(':cargo',$cargo);
                        $consulta->bindParam(':direccion',$direccion);
                        $consulta->bindParam(':telefono',$telefono);
                        $consulta->bindParam(':urlFoto',$urlFoto);
                        $consulta->bindParam(':skills', $skills);
                        $consulta->bindParam(':idRol',$idRol);
                        $consulta->bindParam(':idPerfil',$idPerfil);
                        $consulta->bindParam(':idCompania',$idCompania);
                        $consulta->bindParam(':clave',$clave);
                        $consulta->bindParam(':estado',$estado);
                        $consulta->execute();
                    break;
                    case "borrar":
                        $sql="DELETE FROM usuarios WHERE rut=:rut";
                        $consulta=$db->connect()->prepare($sql);
                        $consulta->bindParam(':rut',$idBorrar);
                        $consulta->execute();
                        header('location:vista_usuarios.php');
                    break;
                    case "seleccionar":
                        $sql="SELECT * FROM usuarios WHERE rut=:rut";
                            $consulta=$db->connect()->prepare($sql);
                            $consulta->bindParam(':rut',$idEditar);
                            $consulta->execute();
                            $usuarioEditar=$consulta->fetch(PDO::FETCH_ASSOC);
                            $rut=$usuarioEditar['rut'];
                            $nombre=$usuarioEditar['nombre'];
                            $cargo=$usuarioEditar['cargo'];
                            $direccion=$usuarioEditar['direccion'];
                            $telefono=$usuarioEditar['telefono'];
                            $ruta=$usuarioEditar['urlFoto'];
                            $skills=$usuarioEditar['skills'];
                            $idRol=$usuarioEditar['idRol'];
                            $idPerfil=$usuarioEditar['idPerfil'];
                            $idCompania=$usuarioEditar['idCompania'];
                            $clave=$usuarioEditar['clave'];
                    break;
                    case "editar":
                            $sql="UPDATE usuarios SET nombre=:nombre, cargo=:cargo, direccion=:direccion, telefono=:telefono, urlFoto=:urlFoto, skills=:skills, idRol=:idRol, idPerfil=:idPerfil, idCompania=:idCompania, clave=:clave WHERE rut=:rut";
                            $consulta=$db->connect()->prepare($sql);
                            $consulta->bindParam(':rut',$rut);
                            $consulta->bindParam(':nombre',$nombre);
                            $consulta->bindParam(':cargo',$cargo);
                            $consulta->bindParam(':direccion',$direccion);
                            $consulta->bindParam(':telefono',$telefono);
                            if ($urlFoto != "../src/img/photos/usuarios/sinFoto.png"){
                                $consulta->bindParam(':urlFoto',$urlFoto);
                            }else{
                                $consulta->bindParam(':urlFoto',$ruta);
                            }
                            $consulta->bindParam(':skills',$skills);
                            $consulta->bindParam(':idRol',$idRol);
                            $consulta->bindParam(':idPerfil',$idPerfil);
                            $consulta->bindParam(':idCompania',$idCompania);
                            $consulta->bindParam(':clave',$clave);
                            $consulta->execute();
                            header('location:vista_usuarioEditar.php');
                    break;
                }
            }
        }    
    }
?>
<?php

  include_once('../conexion/database.php');
  
  $db=new Database();
  $queryEmpresa=$db->connect()->prepare('SELECT * FROM empresa');
  $queryEmpresa->execute();
  $empresa=$queryEmpresa->fetch(PDO::FETCH_NUM);

  if(!isset($_SESSION['rol'])){
    session_start();
  }
  if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
  }
  $rol=$_SESSION['rol'];
  switch($rol){
    case 1:
      $nombreRol="Administrador";
      break;
    case 2:
      $nombreRol="Central de Emergencias";
      break;
    case 3:
      $nombreRol="Bomberos" ;                                 
      break;
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> <?php echo $empresa[1];?> </title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <!-- img src="<?php echo ".".$empresa[3];?>" -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.php">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/index.js"></script>
</head>

<body>
  <header>
    <nav class="navbar mw-100 navbar-expand-sm navbar-light bg-light fixed-top">
          <div class="container">
            <a class="navbar-brand" href="./template.php"><img src="<?php echo $empresa[3];?>" class="logo_card" alt=""></a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
         
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                          <a class="nav-link" href="./template.php" aria-current="page">Inicio</a>
                      </li>
                  <?php
                  if ($_SESSION['rol']==1){?>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Configuracion
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="./config_general.php">General</a></li>
                          <li><a class="dropdown-item" href="./vista_configCompanias.php">Compañias</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Usuarios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="./vista_usuarios.php">Listado General</a></li>
                          <li><a class="dropdown-item" href="./vista_asignarVehiculos.php">Asignar Vehiculos</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="./vista_vehiculos.php" aria-current="page">Vehiculos</a>
                      </li>
                  <?php
                  }?>
                  <?php
                  if ($_SESSION['rol'] != 3){?>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Emergencias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="./vista_tipoEmergencia.php">Tipos</a></li>
                          <li><a class="dropdown-item" href="./vista_Emergencia.php">Listado General</a></li>
                        </ul>
                      </li>
                  <?php }?> 
                  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Estados
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="./vista_disponibilidad.php">Disponibilidad</a></li>
                          <li><a class="dropdown-item" href="./vista_listaAsistencia.php">Lista de Asistencia</a></li>
                        </ul>
                      </li>
                </ul>
                <div class="col text-end"><span class="text-primary"><strong><?php echo $_SESSION['user']?></strong></span>&nbsp;
                  <a href="./vista_usuarioConfig.php"><img src="../src/img/layouts/iconoConfig.png" class="img-fluid rounded-top" alt="icono Configuracion" style="width:1.5em;heignt:1.5em;"></a>
                </div>
            </div>
      </div>
    </nav>    
  </header>
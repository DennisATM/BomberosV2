<?php include('./cabecera.php');
    include('../secciones/companias.php');

    $db= new Database();
    date_default_timezone_set('America/Santiago');

    $fechaActual = date("y-m-d H:i:s");
    
    $queryDisponibles=$db->connect()->prepare('SELECT * FROM usuarios WHERE estado="Disponible" AND idRol != 2');
    $queryDisponibles->execute();
    $listaDisponibles=$queryDisponibles->fetchAll();

    foreach($listaDisponibles as $disponibles){
        
        $fechaDisponible=$disponibles['fechaDisponible'];
        $fecha1=new DateTime($fechaActual);
        $fecha2=new DateTime($fechaDisponible);
        $rut=$disponibles['rut'];
        
        $intervalo = $fecha1->diff($fecha2);
        
        if($intervalo->format('%d') > 0 ){
            $sqlDisponible="UPDATE usuarios SET fechaDisponible=:fechaBorrar, estado='No Disponible' WHERE rut=:rut";
            $consultaDis=$db->connect()->prepare($sqlDisponible);
            $consultaDis->bindParam(':fechaBorrar',date('0000-00-00'));
            $consultaDis->bindParam(':rut',$rut);
            $consultaDis->execute();
        }
    }

?>
  <main>
    <div class="bg-template mw-100"></div>
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col text-center text-white mt-2">
                <h1>Bienvenido al menu de <?php echo $nombreRol?></h1>
            </div>
            <?php if($_SESSION['rol']==2){?>
                <div class="text-end mt-3">
                    <a href="./vista_nuevaEmergencia.php"><button type="button" class="btn btn-primary">+ Nueva Emergencia</button></a>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="mt-3">
        <div class="row mw-100 w-100 mx-auto">
            <?php foreach($detalleCompania as $compania){?>
                <div class="col-md-2 m-auto mb-2">
                    <div class="card" >
                        <div class="card-header text-center text-success">
                            <strong> <?php echo"Compañia ".$compania['idCompania'];?> </strong>
                        </div>
                        <div class="card-body text-center" style="font-size:0.8em;">
                            <img src="<?php echo $compania['urlLogoCompania'];?>" class="img-fluid rounded-top logo_card text-center" alt="">
                                <i class="fa fa-user-plus" aria-hidden="true"></i><h4 class="card-title mt-2" style="font-size:1.35em;"><?php echo $compania['nombreCompania'];?></h4>
                            <p class="card-text"><?php echo $compania['direccionCompania'];?></p>
                            <p class="card-text">Tlf: <?php echo $compania['telefonoCompania'];?></p>
                            <div class="col col-md-8 m-auto">
                                <form action="./vista_detalleCompania.php" method="POST">
                                       <a href="<?php echo './vista_detalleCompania.php?idc='.$compania['idCompania'];?>"> <button type="button" name="compania" value="<?php echo $compania['idCompania']?>" class="btn btn-primary ml-1">Ir al sitio</i></button></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
  </main>
  <?php include('pie.php');?>
<?php include('../secciones/disponibilidad.php');
include('./cabecera.php');?>
<main>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-success">
                        <strong>Disponibilidad</strong>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-secondary"> <?php echo $rutSession;?> </h5>
                        <h5 class="card-title text-primary"> <?php echo $nombreSession;?> </h5>
                        <img src="<?php echo $urlFoto;?>" alt="Foto Usuario" class="img img_card m-2">
                        <h5 class="card-text text-success"> Estado Actual: <strong class="text-danger"><?php echo $estado;?></strong> </h5>
                        <form action="" method="POST">
                            <div class="btn-group" role="group" aria-label="Button group name">
                                <input type="hidden" value="<?php echo $rutSession;?>" name="rutEstado" id="rutEstado">
                                <button <?php if($estado=="Disponible"){?> hidden<?php };?> type="submit" name="estado" value="disponible" class="btn btn-primary m-1">Disponible</button>
                                <button <?php if($estado=="En Emergencia" || $perfil===2 || $rol===3){?> hidden<?php };?> type="submit" name="estado" value="enEmergencia"class="btn btn-warning m-1">En Emergencia</button>
                                <button <?php if($estado=="No Disponible" ){?> hidden<?php };?> type="submit" name="estado" value="noDisponible"class="btn btn-danger m-1">No Disponible</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('./pie.php');?>
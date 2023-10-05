<?php include('./cabecera.php');
      include('../secciones/emergencias.php');?>

<main>
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">            
            <div class="card">
                <div class="card-header fw-bold text-success">
                    Detalle de Emergencia Registrada
                </div>
                <div class="card-body">
                    <div class="container">
                        <form method="POST">
                            <div class="row justify-content-center text-center">
                                <div class="col">
                                    <div class="mb-3 row ">
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Estado:</label>
                                        <label for="inputName" class="col-5 col-md-3 col-form-label text-start text-danger fw-bold" style="font-size:1.2em;"><?php echo $estadoEmergencia;?></label>    
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Fecha Cierre:</label>
                                        <label for="inputName" class="col-5 col-md-3 col-form-label text-start text-success fw-bold" style="font-size:1.2em;"><?php echo $fechaCierre;?></label>    
                                    </div>
                                    <div class="mb-3 row ">
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Fecha/hora:</label>
                                        <div class="col-7 col-md-3">
                                            <input type="text" class="form-control" name="fechaEmergencia" value="<?php echo $fechaEmergencia;?>" id="fechaEmergencia" placeholder="" required>
                                        </div>

                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Tipo:</label>
                                        <div class="col-7 col-md-3 mt-1">
                                            <select class="form-select form-select-md" name="tipoEmergencia" id="tipoEmergencia">
                                                <?php foreach($listaTipoEmergencias as $tipo){?>
                                                <option value=<?php echo $tipo['idTipoEmergencia'];?> <?php if($idTipoEmergencia==$tipo['idTipoEmergencia']){ ?> selected <?php };?>><?php echo $tipo['idTipoEmergencia']." - ".$tipo['nombreTipoEmergencia'];?></option>
                                                <?php };?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Ubicación:</label>
                                        <div class="col-7 col-md-3">
                                            <input type="text" class="form-control" name="direccionEmergencia" id="direccionEmergencia" value="<?php echo $direccionEmergencia;?>" placeholder="Direccion" required />
                                        </div>

                                        <label for="inputName" class="col-5 col-md-2 form-label">Descripcion:</label>
                                        <div class="col-7 col-md-5 mt-1">
                                            <input class="form-control" name="descripcionEmergencia" id="descripcionEmergencia" value="<?php echo $descripcionEmergencia;?>" required></input>
                                        </div>
                                    </div> 

                                    <div class="mb-3 row justify-content-around">                                 
                                    
                                        <h6 class="fw-bold text-danger">Conductores / Unidades Asignadas</h6>
                                        <div class="col-12 col-md-4">
                                            <div class="card">
                                                <div class="card-header fw-bold text-success">
                                                    Vehiculo asignado
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title fw-bold text-danger"><?php echo $vehiculoEmergencia[0]['idVehiculo'];?></h4>
                                                    <p class="card-text">
                                                        <img src="<?php echo $vehiculoEmergencia[0]['urlFotoVehiculo'];?>" class="img-fluid logo_card rounded-top" alt="">
                                                    </p>
                                                    <h6 class="card-title text-primary"><?php echo $vehiculoEmergencia[0]['marcaVehiculo']; echo "  ".$vehiculoEmergencia[0]['modeloVehiculo']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mt-2">
                                            <div class="card">
                                                <div class="card-header fw-bold text-success">
                                                    Conductor Asignado
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title fw-bold text-danger"><?php echo $conductorEmergencia[0]['rut'];?></h6>
                                                    <p class="card-text">
                                                        <img src="<?php echo $conductorEmergencia[0]['urlFoto'];?>" class="img-fluid logo_card rounded-top" alt="">
                                                    </p>
                                                    <h6 class="card-title text-primary"><?php echo $conductorEmergencia[0]['nombre'];?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center text-center">
                                <div class="col col-md-12">
                                    <a href="./vista_Emergencia.php"><button type="button" class="btn btn-danger">Volver</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                <div class="card-footer text-muted">
                    Cuerpo de Bomberos de Retiro
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('./pie.php');?>                   
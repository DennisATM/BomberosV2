<?php include('./cabecera.php');
      include('../secciones/emergencias.php');?>

<main>
    <script src="../js/index.js"></script>
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">            
            <div class="card">
                <div class="card-header fw-bold text-success">
                    Registro de nueva Emergencia
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="alert alert-danger" role="alert">
                            Para recibir notificaciones deben seguir en twitter a @BomberosRetiro
                            <div><?php echo $mensajeError;?></div>
                        </div>
                        <form method="POST">
                            <div class="row justify-content-center text-center">
                                <div class="col">
                                    <div class="mb-3 row ">
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Fecha/hora:</label>
                                        <div class="col-7 col-md-3">
                                            <input type="text" class="form-control" name="fechaEmergencia" value="<?php if($fechaEmergencia!=""){echo $fechaEmergencia;}else{echo $hoy." - ".$ahora;}?>" id="fechaEmergencia" placeholder="" required>
                                        </div>
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Tipo:</label>
                                        <div class="col-7 col-md-3 mt-1">
                                            <select class="form-select form-select-md" name="tipoEmergencia" id="tipoEmergencia">
                                                <?php foreach($listaTipoEmergencias as $tipo){?>
                                                <option value="<?php echo $tipo['idTipoEmergencia'];?>"><?php echo $tipo['idTipoEmergencia']." - ".$tipo['nombreTipoEmergencia'];?></option>
                                                <?php };?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-5 col-md-2 col-form-label">Ubicación:</label>
                                        <div class="col-7 col-md-3">
                                            <input type="text" class="form-control" name="direccionEmergencia" id="direccionEmergencia" value="<?php echo $direccionEmergencia;?>" placeholder="Direccion" required />
                                        </div>
                                        <label for="inputName" class="col-5 col-md-2 form-label">Descripcion</label>
                                        <div class="col-7 col-md-5 mt-1">
                                            <input class="form-control" name="descripcionEmergencia" id="descripcionEmergencia" value="<?php echo $descripcionEmergencia;?>" placeholder="Breve descripcion de la emergencia" required></input>
                                        </div>
                                    </div> 
                                    <div class="mb-3 row justify-content-around">                                 
                                    
                                        <h6 class="fw-bold text-danger">Conductores / Unidades disponibles</h6>
                                        
                                        <?php foreach($listaConductoresUno as $conductoresUno){?>
                                        
                                            <?php foreach($conductoresUno['vehiculos'] as $vehiculosUno){?>
                            
                                            <div class="col-6 col-md-3 mt-1" style="font-size:0.8em;">
                                            
                                                <label>
                                                    <input type="radio" name="datosEmergencia" id="datoBoton" class="card-input-element" value="<?php echo $conductoresUno['rut']; echo $vehiculosUno['idCompania'];echo $vehiculosUno['idVehiculo'];?>" required />
                                                    
                                                    <div class="card card-input">
                                                        <div class="card-header fw-bold text-success">
                                                            <?php echo "Compañia: ";?><span class="text-danger fw-bold"><?php echo $vehiculosUno['idCompania']?></span>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title text-danger"><?php echo $vehiculosUno['idVehiculo']?></h6>
                                                            <p class="card-text text-primary"><?php echo $conductoresUno['nombre']?></p>
                                                            <p class="card-text text-primary bg-success text-warning" style="border-radius:15px;"><?php echo $conductoresUno['fechaDisponible']?></p>
                                                            
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            
                                            <?php }?>
                                            <?php }?>
                                    
                                    </div>
                               
                                </div>
                            </div>
                            
                            <div class="mb-3 row justify-content-center text-center">
                                <div class="col col-md-12">
                                    
                                        <button type="submit" <?php if(count($listaConductoresUno) == 0){?> hidden <?php }?> class="btn btn-primary" name="accion" id="submit" value="crear">Asignar</button>
                                    
                                    <a href="./vista_Emergencia.php"><button type="button" class="btn btn-danger">Volver</button></a>
                                </div>
                                <div>
                                    <h5 class="text-danger"><?php echo $mensajeError?></h5>
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
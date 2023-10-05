<?php 
    include('../secciones/vehiculos.php');
    include('./cabecera.php');
?>

<main>
    <h3 class="text-center">Registro de Vehículos</h3>
    <div class="container">
        <div class="row justify-content-around g-2">
            <div class="col-md-5">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card mt-2">
                        <div class="card-header text-success text-center">
                            <strong> Vehículos</strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="" class="col-4 col-form-label">Codigo:</label>
                                <div class="col-6">
                                    <input type="text"
                                        class="form-control m-0" 
                                        name="idVehiculo" 
                                        id="idVehiculo" 
                                        value= "<?php echo $idVehiculo;?>"
                                        placeholder="Codigo Vehiculo">
                                </div>
                            </div>  
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Marca:</label>
                                <div class="col-8">
                                    <input type="text"
                                        class="form-control col-9" 
                                        name="marcaVehiculo" 
                                        id="marcaVehiculo" 
                                        value= "<?php echo $marcaVehiculo;?>"
                                        aria-describedby="helpId" 
                                        placeholder="Marca del Vehículo">
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Modelo:</label>
                                <div class="col-8">
                                    <input type="text"
                                        class="form-control" 
                                        name="modeloVehiculo" 
                                        id="modeloVehiculo" 
                                        value= "<?php echo $modeloVehiculo;?>"
                                        aria-describedby="helpId" 
                                        placeholder="Modelo del Vehículo">
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Patente:</label>
                                <div class="col-8">
                                    <input type="text"
                                        class="form-control" 
                                        name="patenteVehiculo" 
                                        id="patenteVehiculo" 
                                        value= "<?php echo $patenteVehiculo;?>"
                                        aria-describedby="helpId" 
                                        placeholder="Patente del Vehículo">
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="fotoVehiculo" class="col-4 col-form-label">Foto:</label>
                                <div class="col-8">
                                    <input type="file" 
                                        class="form-control" 
                                        name="fotoVehiculo" id="fotoVehiculo" 
                                        placeholder="Seleccione foto"
                                        value="<?php echo $urlFotoVehiculo;?>"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3 row mt-2">
                                    <label for="" class="col-4 col-form-label">Compañía:</label>
                                    <div class="col-5">
                                        <select class="form-select form-select-md" name="idCompania" id="idCompania">
                                            <option <?php if($idCompania==1){ ?> selected <?php } ?> value="1">1</option>
                                            <option <?php if($idCompania==2){ ?> selected <?php } ?> value="2">2</option>
                                            <option <?php if($idCompania==3){ ?> selected <?php } ?> value="3">3</option>
                                            <option <?php if($idCompania==4){ ?> selected <?php } ?> value="4">4</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="mb-3 row mt-3">
                                <label for="" class="col-4 col-form-label">Estado:</label>
                                <div class="col-5">
                                    <select class="form-select form-select-md" name="estadoVehiculo" id="estadoVehiculo">
                                        <option <?php if($estadoVehiculo=="Disponible"){ ?> selected <?php } ?> value="Disponible">Disponible</option>
                                        <option <?php if($estadoVehiculo=="No Disponible"){ ?> selected <?php } ?> value="No Disponible">No Disponible</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="btn-group" role="group" aria-label="Button group name">
                                    <button type="submit" name="accion" value="agregar" class="btn btn-sm btn-primary m-1">Agregar</button>
                                    <button type="submit" name="accion" value="editar"class="btn btn-sm btn-warning m-1">Editar</button>
                                    <button type="submit" name="accion" value="eliminar"class="btn btn-sm btn-danger m-1">Eliminar</button>
                                </div>
                            </div>
                            <div class="text-danger">
                                <?php 
                                    if(isset($alert)){
                                        echo $alert;
                                    };
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-primary mt-4">
                        <thead>
                            <tr class="text-center" style="font-size:0.8em;">
                                <th scope="col">Foto</th>
                                <th scope="col">Id</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Patente</th>
                                <th scope="col">Compañía</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($listaVehiculos as $vehiculo){?>
                            <tr class="text-center" style="font-size:0.7em;">
                                <th scope="row"><img src=<?php echo $vehiculo['urlFotoVehiculo']?> style="width:2em;height:2,5em; border-radius:20px;"></th>
                                <td> <?php echo $vehiculo["idVehiculo"]?> </td>
                                <td> <?php echo $vehiculo["marcaVehiculo"]?> </td>
                                <td> <?php echo $vehiculo["modeloVehiculo"]?> </td>
                                <td> <?php echo $vehiculo["patenteVehiculo"]?> </td>
                                <td> <?php echo $vehiculo["idCompania"]?> </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="idSeleccion" id="idSeleccion" value=<?php echo $vehiculo["idVehiculo"]?>>
                                        <input type="hidden" name="rutatmp" id="rutatmp" value=<?php echo $vehiculo["urlFotoVehiculo"]?>>
                                        <button type="submit" class="btn btn-sm btn-success" name="accion" value="seleccionar">Seleccionar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('./pie.php');?>
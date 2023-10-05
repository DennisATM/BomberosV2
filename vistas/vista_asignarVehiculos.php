<?php include('./cabecera.php');
    include('../secciones/usuariosVehiculos.php');?>

<main>
    <div class="container">
        <h3 class="text-center">Asignar vehículos a conductores</h3>
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-header">
                      <strong class="text-success">Asignar Vehiculos por conductor</strong>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form class="row" method="POST">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label for="rut" class="col-4 col-form-label">Rut</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="<?php echo $rut;?>" name="rut" id="rut">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-4 col-form-label">Nombre</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="<?php echo $nombre;?>" name="nombre" id="nombre">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-8 col-form-label">Seleccione uno o más vehiculos</label>
                                        <select class=" form-control col-7" size="5" multiple name="vehiculos[]" id="listaVehiculos">
                                            <?php foreach($listaVehiculos as $vehiculos){?> 
                                                <option value="<?php echo $vehiculos['idVehiculo'];?>"><?php echo $vehiculos['idVehiculo'];?> -<?php echo $vehiculos['marcaVehiculo'];?> <?php echo $vehiculos['modeloVehiculo'];?></option>
                                            <?php };?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="offset-sm-4 col-sm-8">
                                            <input type="hidden" name="rutUsuario" id="rutUsuario" value="<?php echo $rut?>">
                                            <button type="submit" name="accion" value="asignar" class="btn btn-primary">Asignar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>    
                    </div>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-primary mt-2">
                        <thead>
                            <tr class="text-center" style="font-size:0.8em;">
                                <th scope="col">Rut</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Compañia</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">Vehiculos Autorizados</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($listaConductores as $conductor){?>
                            <tr class="text-center" style="font-size:0.7em;">
                                <td> <?php echo $conductor["rut"]?> </td>
                                <td> 
                                    <?php echo $conductor["nombre"];?> </br>
                                </td>
                                <td> <?php echo $conductor["idCompania"]?> </td>
                                <td> <?php 
                                        if($conductor['idPerfil']==2){
                                            echo "Conductor/Bombero";
                                        };
                                     ?> 
                                </td>
                                <td>
                                        <?php foreach($conductor['vehiculos'] as $vehiculo){?>
                                            &nbsp;&nbsp; <strong class="text-danger"><?php echo $vehiculo['idVehiculo']; ?></strong>
                                        <?php }?> 
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="idAsignar" id="idAsignar" value=<?php echo $conductor["rut"]?>>
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
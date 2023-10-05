<?php include('../secciones/tipoEmergencias.php');
include('./cabecera.php');?>

<main>
    <h3 class="text-center">Registro de tipos de Emergencia</h3>
    <div class="container">
        <div class="row justify-content-around g-2">
            <div class="col-md-5">
                <form action="" method="POST">
                    <div class="card mt-4">
                        <div class="card-header text-success text-center">
                            <strong> Tipos de Emergencia</strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="" class="col-4 col-form-label">Codigo:</label>
                                <div class="col-6">
                                    <input type="text"
                                        class="form-control m-0" 
                                        name="idEmergencia" 
                                        id="idEmergencia" 
                                        value= "<?php echo $idEmergencia;?>"
                                        placeholder="Codigo Emergencia">
                                </div>
                            </div>  
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Descripcion:</label>
                                <div class="col-8">
                                    <input type="text"
                                        class="form-control col-9" 
                                        name="nombreEmergencia" 
                                        id="nombreEmergencia" 
                                        value= "<?php echo $nombreEmergencia;?>"
                                        aria-describedby="helpId" 
                                        placeholder="Descripcion de Emergencia">
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
                                <th scope="col">Código</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($listaTipoEmergencias as $tipoEmergencia){?>
                            <tr class="text-center" style="font-size:0.7em;">
                                <td> <?php echo $tipoEmergencia["idTipoEmergencia"]?> </td>
                                <td> <?php echo $tipoEmergencia["nombreTipoEmergencia"]?> </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="idSeleccion" id="idSeleccion" value=<?php echo $tipoEmergencia["idTipoEmergencia"]?>>
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
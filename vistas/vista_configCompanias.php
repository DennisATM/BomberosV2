<?php 
if(!session_start()){
    session_start();
}
include('./cabecera.php');
include('../secciones/companias.php');
?>
<!-- <?php echo $_SESSION['']?> -->
<main>
    <h3 class="text-center">Registro de Compañias</h3>
    <div class="container">
        <div class="row justify-content-around g-2">
            <div class="col-md-5">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card mt-2">
                        <div class="card-header text-success text-center">
                            <strong> Compañias</strong>
                        </div>
                        <div class="card-body">
                        
                            <div class="row mb-2">
                                <label for="" class="col-4 col-form-label">Codigo:</label>
                                <div class="col-6">
                                    <input type="text"
                                        class="form-control m-0" 
                                        name="idCompania" 
                                        id="idCompania" 
                                        value= "<?php echo $idCompania;?>"
                                        placeholder="Id Compañia">
                                </div>
                            </div> 
                            <div class="row mb-2">
                                <label for="" class="col-4 col-form-label">Nombre:</label>
                                <div class="col-6">
                                    <input type="text"
                                        class="form-control m-0" 
                                        name="nombreCompania" 
                                        id="idNombreCompania"
                                        value= "<?php echo $nombreCompania;?>"
                                        placeholder="Nombre Compañia">
                                </div>
                            </div>  
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Direccion:</label>
                                <div class="col-8">
                                    <input type="text"
                                        class="form-control col-9" 
                                        name="direccionCompania" 
                                        id="idDireccionCompania" 
                                        value= "<?php echo $direccionCompania;?>"
                                        aria-describedby="helpId" 
                                        placeholder="Direccion Compañia">
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Telefono:</label>
                                <div class="col-8">
                                    <input type="text"
                                        class="form-control" 
                                        name="telefonoCompania" 
                                        id="idTelefonoCompania" 
                                        value= "<?php echo $telefonoCompania;?>"
                                        aria-describedby="helpId" 
                                        placeholder="Telefono Compañia">
                                </div>
                            </div>
                            <div class="mb-3 row justify-content-center">
                                <label for="" class="col-4 col-form-label">Logo:</label>
                                <div class="col-8">
                                    <input type="file" 
                                        class="form-control" 
                                        name="urlLogoCompania" id="idUrlLogoCompania" 
                                        placeholder="Seleccione foto"
                                        value="<?php echo $urlLogoCompania;?>"
                                        accept="image/*">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="btn-group" role="group" aria-label="Button group name">
                                    <button type="submit" name="accion" value="agregar" class="btn btn-sm btn-primary m-1">Agregar</button>
                                    <button type="submit" name="accion" value="editar" class="btn btn-sm btn-warning m-1">Guardar Cambios</button>
                                    <button type="submit" name="accion" value="eliminar"  class="btn btn-sm btn-danger m-1">Eliminar</button>
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
                    <table class="table table-primary mt-2">
                        <thead>
                            <tr class="text-center" style="font-size:0.8em;">
                                <th scope="col">Foto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($detalleCompania as $companias){?>
                            <tr class="text-center" style="font-size:0.7em;">
                                <th scope="row"><img src=<?php echo $companias['urlLogoCompania']?> style="width:2em;height:2,5em; border-radius:20px;"></th>
                                <td> <?php echo $companias["nombreCompania"]?> </td>
                                <td> <?php echo $companias["direccionCompania"]?> </td>
                                <td> <?php echo $companias["telefonoCompania"]?> </td>
                                <td>
                                    <form action="" method="POST">
                                        <input hidden name="idSeleccion" id="idSeleccion" value=<?php echo $companias["idCompania"]?>>
                                        <input type="hidden" name="rutatmp" id="rutatmp" value=<?php echo $companias["urlLogoCompania"]?>>
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
<?php 
    include('./cabecera.php');
    include('../secciones/usuariosEmergencia.php');
?>

<main>
    <div class="container-fluid">
        <h3 class="text-center">Asignar Bomberos a Emergencia</h3>
        <div class="row justify-content-center p-0 mt-2 ">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">
                      <strong class="text-success">Seleccionar Operarios para emergencia</strong>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form class="row" method="POST">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label for="rut" class="col-4 col-form-label">Id</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="<?php echo $idEmergencia;?>" name="idEmergencia" id="idEmergencia">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-4 col-form-label">Fecha</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="<?php echo $fecha;?>" name="fecha" id="fecha">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-4 col-form-label">Tipo</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="<?php echo $tipo;?>" name="tipo" id="tipo">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-4 col-form-label">Ubicacion</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="<?php echo $ubicacion;?>" name="ubicacion" id="ubicacion">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-8 col-form-label">Seleccione uno o más usuarios</label>
                                        <select class=" form-control col-7" size="5" multiple name="operarios[]" id="listaUsuarios">
                                            <?php foreach($listaUsuarios as $usuarios){?>
                                                <option value="<?php echo $usuarios['rut'];?>"><?php echo $usuarios['nombre'];?> </option>
                                             <?php };?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="offset-sm-4 col-sm-8">
                                            <input type="hidden" name="idEmergencia" id="idEmergencia" value="<?php echo $idEmergencia;?>">
                                            <button type="submit" name="accion" value="asignar" class="btn btn-primary">Asignar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>    
                    </div>
                    
                </div>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-primary mt-2">
                        <thead>
                            <tr class="text-center" style="font-size:0.8em;">
                                <th scope="col">Fecha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Ubicacion</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Asignados</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($listaEmergenciasAsignadas as $emergencia){?>
                            <tr class="text-center" style="font-size:0.7em;">
                                <td> <?php echo $emergencia['fechaReporte']?> </td>
                                <td> 
                                    <?php echo $emergencia['tipoEmergencia']?></br>
                                </td>
                                <td> <?php echo $emergencia['ubicacionEmergencia']?></td>
                                <td> <?php echo $emergencia['descripcionEmergencia']?></td>
                                <td class="fw-bold text-danger"> <?php echo $emergencia['estadoEmergencia']?></td>
                                <td>
                                        <?php foreach($emergencia['usuarios'] as $usuarios){?>
                                            <strong class="text-danger border border-primary" style="font-size:0.8em;"><?php echo"- ".strtoupper($usuarios['nombre']); ?></strong><br>
                                        <?php }?> 
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="idAsignar" id="idAsignar" value="<?php echo $emergencia['idEmergencia']?>">
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
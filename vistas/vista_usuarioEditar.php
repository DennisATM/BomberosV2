<?php include('../secciones/usuarios.php');
include('./cabecera.php');?>
  <main>
    <div class="container container-fluid">
        <div class="row justify-content-around p-2">
            <div class="card">
                <div class="card-header text-success">
                    <strong>Editar usuario</strong>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form class="row justify-content-around" method="POST" enctype="multipart/form-data">
                            <div class="col-md-5 text-center">
                                <div class="mb-3 row">
                                    <label for="rut" class="col-4 col-form-label">Rut</label>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="rut" id="rut" value="<?php echo $rut;?>">
                                    </div>
                                    <div class="text-danger col-12 fw-bold" style="font-size:0.8em">
                                        Sin puntos, ni guión
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nombre" class="col-4 col-form-label">Nombre:</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre;?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="cargo" class="col-4 col-form-label">Cargo:</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="cargo" id="cargo" value="<?php echo $cargo;?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="direccion" class="col-4 col-form-label">Direccion</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion;?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="telefono" class="col-4 col-form-label">Telefono:</label>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono;?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="telefono" class="col-4 col-form-label">Foto:</label>
                                    <div class="col-8">
                                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="" class="col-4 col-form-label">Entrenamiento:</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="entrenamiento" id="entrenamiento" value="<?php echo $skills;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <div class="mb-3 row">
                                    <label for="clave" class="col-4 col-form-label">Clave:</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="clave" id="clave" value="<?php echo $clave;?>" required>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="rol" class="col-4 col-form-label">Rol:</label>
                                    <div class="col-6">
                                        <select class="form-select form-select-md" name="rol" id="rol">
                                            <?php foreach($listaRoles as $rol){?>
                                            <option value="<?php echo $rol['idRol'];?>""<?php if($idRol==$rol['idRol']) { ?> selected <?php } ?>"><?php echo $rol['nombreRol'];?></option>
                                            <?php };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 row mt-4">
                                    <label for="compania" class="col-5 col-md-4 col-form-label">Compañia:</label>
                                    <div class="col-7 col-md-8">
                                        <select class="form-select form-select-md" name="compania" id="compania">
                                            <?php foreach($listaCompania as $compania){?>
                                            <option value="<?php echo $compania['idCompania'];?>" "<?php if($idCompania==$compania['idCompania']) { ?> selected <?php } ?>"><?php echo $compania['nombreCompania'];?></option>
                                            <?php };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-3">
                                    <label for="perfil" class="col-4 col-form-label">Perfil:</label>
                                    <div class="col-8 col-md-6">
                                        <select class="form-select form-select-md" name="perfil" id="perfil">
                                            <?php foreach($listaPerfiles as $perfil){?>                    
                                            <option value="<?php echo $perfil['idPerfil'];?>" "<?php if($idPerfil==$perfil['idPerfil']) { ?> selected <?php } ?>"><?php echo $perfil['nombrePerfil'];?></option>
                                            <?php };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-3">
                                    <label for="" class="col-9 text-danger bg-light col-form-label"><?php echo $alert?></label>
                                </div>
                            </div>
                            <div class="mb-3 row text-center">
                                <div class="col-12">
                                    <input type="hidden" name="rutatmp" id="rutatmp" value="<?php echo $ruta;?>">
                                    <button type="submit" class="btn btn-primary text-center" name="accion" id="editar" value="editar">Guardar Cambios</button>
                                    <a href="./vista_usuarios.php"><button type="button" class="btn btn-danger text-center">Salir</button></a>
                                </div>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>

  <?php include('./pie.php');?>
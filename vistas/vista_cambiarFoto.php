 <?php include('./vista_usuarioConfig.php');
      include('../secciones/usuarioConfig.php');?>
            <div class="card mt-0">
                <div class="card-header">
                    <strong class="text-success">Agregar o cambiar Foto</strong>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3 row text-center">
                                <label for="inputName" class="col-md-4 col-form-label fw-bold text-secondary">Foto Actual:</label>
                                <div class="col-md-8">
                                    <img src="<?php echo $ruta?>" class="img-fluid" alt="Foto Usuario" style="width:9em; height:9em; border-radius:3em;">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="telefono" class="col-3 col-form-label text-center">Foto:</label>
                                <div class="col-9">
                                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-primary" name="accion" value="subirFoto">Subir Foto</button>
                                    <a href="./template.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="text-danger">
                                <?php echo $alert;?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./pie.php');?>
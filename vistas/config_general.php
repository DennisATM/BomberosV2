<?php 
    include('../secciones/empresa.php');
    include('./cabecera.php');
    $alert="";
?>
<main>
    <div class="card col-11 mx-auto col-md-9">
        <div class="card-header">
            <strong class="text-success">Datos generales del Cuerpo</strong>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" enctype="multipart/form-data">
                   <div class="mb-3 row">
                        <label for="" class="col-md-3 col-form-label">Rut Empresa</label>
                        <div class="col-md-8">
                            <input class="form-control" name="rutEmpresa" value="<?php echo $detalleEmpresa['rut'];?>" type="text" placeholder="" aria-label="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-md-3 col-form-label">Nombre Empresa</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nombreEmpresa" value="<?php echo $detalleEmpresa['nombreEmpresa'];?>" type="text" placeholder="" aria-label="">
                        </div>
                    </div>
                    <div class="mb-3 row ">
                        <label for="inputName" class="col-md-3 col-form-label fw-bold text-secondary">Foto Actual:</label>
                        <div class="col-md-8">
                            <img src="<?php echo $detalleEmpresa['urlLogoEmpresa'];?>" class="img-fluid" alt="Foto Usuario" style="width:9em; height:9em; border-radius:3em;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telefono" class="col-md-3 col-form-label fw-bold text-secondary">Foto Nueva:</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="urlLogo" id="logo" accept="image/*" max-size="2048">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <div class="offset-sm-4 col-sm-8">
                            <button type="submit" class="btn btn-primary" name="accion" value="actualizar">Guardar cambios</button>
                            <a href="./template.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        </div>
                    </div>
                    <div class="text-danger">
                        <?php echo $alert;?>
                    </div>
                </form>
            </div>
        </div>
    </div>   
</main>
<?php include('./pie.php');?>
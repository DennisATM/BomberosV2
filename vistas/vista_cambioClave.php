<?php include('./vista_usuarioConfig.php');
      include('../secciones/cambioClave.php');?>

             <div class="card mt-0">
                 <div class="card-header">
                     <strong class="text-success">Cambio de clave de usuario</strong>
                 </div>
                 <div class="card-body">
                     <div class="container">
                         <form method="POST">
                             <div class="mb-3 row">
                                 <label for="inputName" class="col-md-4 col-form-label">Clave actual</label>
                                 <div class="col-md-8">
                                     <input type="text" class="form-control" name="claveActual" id="claveActual" placeholder="Clave actual" required>
                                 </div>
                             </div>
                             <div class="mb-3 row">
                                 <label for="inputName" class="col-md-4 col-form-label">Nueva clave</label>
                                 <div class="col-md-8">
                                     <input type="text" class="form-control" name="claveNueva" id="claveNueva" placeholder="Nueva clave" required>
                                 </div>
                             </div>
                             <div class="mb-3 row">
                                 <label for="inputName" class="col-md-4 col-form-label">Confirmar</label>
                                 <div class="col-md-8">
                                     <input type="text" class="form-control" name="confirmarClaveNueva" id="confirmarClaveNueva" placeholder="Confirmar nueva clave" required>
                                 </div>
                             </div>
                             
                             <div class="mb-3 row">
                                 <div class="offset-sm-4 col">
                                     <button type="submit" class="btn btn-sm btn-primary">Cambiar Clave</button>
                                     <a href="./template.php"><button type="button" class="btn btn-sm btn-danger">Cancelar</button></a>
                                 </div>
                             </div>
                             <div class="text-danger">
                                 <?php echo $alert;?>
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="card-footer text-muted">
                     <strong></strong>
                 </div>
             </div>
        </div>
     </div>
 </div>   

<?php include('./pie.php');?>
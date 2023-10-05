<?php include('../secciones/usuarios.php');
include('./cabecera.php');?>
<!-- <script src="../js/index.js"></script> -->


<main>
    <div class="container">
        <h1 class="text-center">Listado General de usuarios Registrados</h1>
        <div class="text-end mt-3">
            <a href="./vista_usuarioNuevo.php"><button type="button" class="btn btn-primary">+ Agregar Usuario</button></a>
        </div>
        <div class="text-end mt-3">
            <button type="button" onClick="htmlExcel('tblData', 'Reporte_usuarios')" class="btn btn-success">Exportar a Excel</button>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col" style="overflow-x:scroll;">
               <table class="table text-center" id="tblData">
                  <thead>
                    <tr>
                      <th scope="col">Foto</th>
                      <th scope="col">Rut</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Cargo</th>
                      <th scope="col">Direccion</th>
                      <th scope="col">Telefono</th>
                      <th scope="col">Compañía</th>
                      <th scope="col">Perfil</th>
                      <th scope="col">Rol</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listaUsuarios as $usuarios){?>
                    <tr class="text-center" style="font-size:0.8em;">
                        
                      <th scope="row"><img src=<?php echo $usuarios['urlFoto']?> style="width:2em;height:2,5em; border-radius:20px;"></th>
                      <td><?php echo $usuarios['rut']?></td>
                      <td><?php echo $usuarios['nombre']?></td>
                      <td><?php echo $usuarios['cargo']?></td>
                      <td><?php echo $usuarios['direccion']?></td>
                      <td><?php echo $usuarios['telefono']?></td>
                      <td>
                        <?php if($usuarios['idCompania']=="5"){
                            echo "Central";
                            }else{
                                echo $usuarios['idCompania'];
                            }?>
                      </td>
                      <?php
                        switch($usuarios['idPerfil']){
                        case 1:
                            $valor="Bombero";
                        break;
                        case 2:
                            $valor="Bombero/Conductor";
                        break;
                        case 3:
                            $valor="Operador/Central";
                        break;
                        }?>
                      <td><?php echo $valor?></td>
                      <?php
                        switch($usuarios['idRol']){
                        case 1:
                            $valor2="Administrador";
                        break;
                        case 2:
                            $valor2="Central";
                        break;
                        case 3:
                            $valor2="Usuario";
                        break;
                        }?>
                      <td><?php echo $valor2?></td>
                      <td class="row justify-content-center ">
                            <div class="col col-md-3 mx-1 my-1">                          
                                <form action="./vista_usuarioEditar.php" METHOD="POST" >
                                    <input type="hidden" name="idEditar" id="idEditar" value=<?php echo $usuarios["rut"]?>>
                                    <button type='submit' class="btn btn-warning mr-1" name="accion" value="seleccionar"><i class="bi bi-pencil"></i></button>
                                </form>
                            </div>
                            <div class="col col-md-3 mx-1 my-1">
                                <form method="POST">
                                        <input type="hidden" name="idBorrar" id="idBorrar" value=<?php echo $usuarios["rut"]?>>
                                        <button type="submit" name="accion" value="borrar" class="btn btn-danger ml-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                      </td>
                    </tr>
                     <?php }?>
                    
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include('./pie.php');?>
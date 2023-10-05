<?php include('../secciones/emergencias.php');
include('./cabecera.php');?>
<script src="../js/index.js"></script>

<main>
    <div class="container">
        <h1 class="text-center">Listado General de Emergencias</h1>
        <div class="text-end mt-3">
            <a href="./vista_nuevaEmergencia.php"><button type="button" class="btn btn-primary">+ Agregar Emergencia</button></a>
        </div>
        <div class="text-end mt-3">
            <button type="button" onClick="htmlExcel('tablaEmergencias', 'Reporte_emergencias')" class="btn btn-success">Exportar a Excel</button>
        </div>
        <div class="row justify-content-center m-2">
            <div class="col" style="overflow-x:scroll;">
               <table class="table text-center" id="tablaEmergencias">
                  <thead>
                    <tr>
                      
                      <th scope="col">Fecha Apertura</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Direccion</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Asignado</th>
                      <th scope="col">Fecha Cierre</th>
                      <th scope="col">Comentarios</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listaEmergencias as $emergencia){?>
                    <tr class="text-center" style="font-size:0.8em;">
                                              
                      <td><?php echo $emergencia['fechaReporte']?></td>
                      <td><?php echo $emergencia['tipoEmergencia']?></td>
                      <td><?php echo $emergencia['ubicacionEmergencia']?></td>
                      <td><?php echo $emergencia['descripcionEmergencia']?></td>
                      <td <?php if($emergencia['estadoEmergencia']=="Cerrada"){?> class="fw-bold text-danger" <?php }else{?>class="fw-bold text-primary"<?php }?>><?php echo $emergencia['estadoEmergencia']?></td>
                      <td><?php echo "C-".$emergencia['idCompania']?></td>
                      <td class="text-danger"><?php echo ($emergencia['fechaCierre']!="")?$emergencia['fechaCierre']:"Pendiente";?></td>
                      <td class="text-danger"><?php echo ($emergencia['descripcionCierre']!="")?$emergencia['descripcionCierre']:"Pendiente";?></td>
                      
                      <td class="row justify-content-start">
                            <div class="col col-md-4 mb-1">                          
                                <form action="./vista_cerrarEmergencia.php" METHOD="POST" >
                                    <input type="hidden" name="idEmergenciaCerrar" id="idEmergenciaCerrar" value=<?php echo $emergencia["idEmergencia"]?>>
                                    <button type='submit' <?php if($emergencia['estadoEmergencia']=='Cerrada'){?> disabled <?php };?> class="btn btn-primary mr-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Cerrar Emergencia" name="accion" value="seleccionar"><i class="bi bi-life-preserver"></i></button>
                                </form>
                            </div>
                            <div class="col col-md-4">
                                <form method="POST">
                                        <input type="hidden" name="idEmergenciaBorrar" id="idEmergenciaBorrar" value=<?php echo $emergencia["idEmergencia"]?>>
                                        <button type="submit"  <?php if($emergencia['estadoEmergencia']=='Cerrada'){?> disabled <?php };?> name="accion" value="borrar" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar Emergencia" class="btn btn-danger ml-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                            <div class="col col-md-4">
                                <form  action="./vista_detalleEmergencia.php" method="POST">
                                        <input type="hidden" name="idEmergenciaCerrar" id="idEmergenciaCerrar" value=<?php echo $emergencia["idEmergencia"]?>>
                                        <button type="submit" name="accion" value="seleccionar" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalle" class="btn btn-warning ml-1"><i class="bi bi-eye-fill"></i></button>
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
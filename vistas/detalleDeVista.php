    <?php 
    include('../secciones/detalleCompania.php');
    ?>
    <div class="row bg-secondary text-white ">
            <div class="col-3 col-md-1 bg-white text-center">
                <img src="<?php echo $empresa[3]?>" class="logo_card2 mx-auto mt-1" alt="Logo Compañia">
            </div>
            <div class="col-9 col-md-3 my-auto">
                <div class="row">
                    <div class="col text-center">
                        <h5><?php echo $empresa[1];?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-warning">
                        <h5 class="text-center"><?php echo "Compañia N° ".$_SESSION['idCompania'];?></h5>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-3 bg-white">
                <div class="row">
                    <div class="card bg-danger my-1 mx-auto" style="width:135px; height:65px">
                        <div class="card-header my-auto text-center m-0 p-0">
                            <span class="fw-bold mx-auto my-auto" style="font-size:0.8em;">TOTAL USUARIOS</span> 
                        </div>
                        <div class="card-body m-0 p-0 text-center fw-bold">
                            <h4><?php echo $totalUsuarios;?></h4>
                        </div>   
                    </div>
                    
                    <div class="card bg-danger my-1 mx-auto" style="width:135px; height:65px">
                        <div class="card-header my-auto text-center m-0 p-0">
                            <span class="fw-bold mx-auto my-auto" style="font-size:0.8em;">DISPONIBLES</span> 
                        </div>
                        <div class="card-body m-0 p-0 text-center fw-bold">
                            <h4><?php echo count($usuariosCompaniaUno);?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 col-md-4 my-auto">
                <div class="row mx-auto fw-bold text-white">
                    <span><?php echo $fechaC;?></span>    
                </div>
                <div class="row mx-auto fw-bold text-warning">
                    <span><?php echo $horaC;?></span>    
                </div>               
            </div>
            <div class="col-1 my-auto text-end">
                <a href="./template.php"><button type="button" value="home" class="btn btn-primary"><i class="bi bi-house-door-fill" style="font-size:1.5em;"></i></button></a>
            </div>
        </div>
        <div class="row px-0 py-0 my-0" style="height:78vh;">
            <div class="col-12 col-md-8 m-0 p-0 bg-light" style="height:78vh;">
                <div class="row row_card mt-1 mx-1 p-0" style="font-size:0.9em;">
                    <?php foreach($usuariosCompaniaUno as $usuarios){?>
                        <div class="col-4 col-md-2 p-0 m-0"> 
                            <?php switch($usuarios['estado']){
                                case "Disponible":
                                    $bg="bg-dark";
                                break;
                                case "No Disponible":
                                    $bg="bg-secondary";
                                break;
                                case "En Emergencia":
                                    $bg="bg-danger";
                                break;
                            }?>
                            <div class="card mb-2 mx-1 p-0">
                                <div class="card-header fondo text-center text-white py-1 px-1" style="height:4.5em; font-size:0.85em;font-weight: lighter;font-family:system-ui;">
                                    <strong class="m-0 p-0"><?php echo strtoupper($usuarios['nombre']);?></strong>
                                </div>
                                <div class="card-body text-center m-0 p-0">
                                    <img src="<?php echo $usuarios['urlFoto'];?>" alt="Foto Usuario" class="img img_card my-auto p-0" >
                                    <h6 class="card-title text-white m-0 p-0" style="font-size:0.8em; background-color:blue;"> <?php echo $usuarios['cargo'];?> </h6>
                                    <?php switch($usuarios['idPerfil']){
                                        case "1":
                                            $perfil="Bombero";
                                        break;
                                        case "2":
                                            $perfil="Bombero/Conductor";
                                        break;
                                    }?>
                                    <h6 class="card-title text-white fw-bold m-0 pb-1 " style="font-size:0.7em; background-color:blue;"> <?php echo $perfil;?> </h6>
                                </div>
                                <div class="card-footer m-0 p-0" style="background-color: rgb(16, 2, 92);">
                                    <h6 class="card-title text-white text-center my-0"><?php echo $usuarios['estado'];?></h6>
                                    <h6 class="card-title py-0  text-warning text-center pb-0 m-1 " style="font-size:0.8em;height:2.2em;"><?php echo substr($usuarios['fechaDisponible'],0,19);?></h6>
                                </div>
                            </div>
                        </div>
                    <?php }?>              
                </div>
            </div>
            <div class="col-12 col-md-4 bg-secondary" style="height:79.5vh;">
                <div class="row mt-1 bg-success text-white my-1">
                    <h6 class="text-white my-auto ">VEHICULOS DISPONIBLES</h6>
                </div>
                <div class="col"  style="height:30vh;">
                    <div class="row mx-1">
                        <?php $arrTemp=[]; $cont=0;    
                            foreach($listaConductoresSi as $conductores){
                                if($cont>0){                           
                                        if(sizeof(array_diff_key($arrTemp[$cont],$conductores))>0){
                                            break 1;
                                        };  
                                }
                                foreach($conductores['vehiculos'] as $vehiculos){?>
                                    <div class="row bg-light mx-0 px-0">
                                        <div class="col-1 bg-primary text-center p-0">
                                        <img src="<?php echo $vehiculos['urlFotoVehiculo'];?>" alt="Foto vehiculo" class="img" style="width:1.8em;height:1.5em;border-radius:10px;">
                                        </div>
                                        <div class="col-3 bg-danger text-white text-center fw-bold">
                                            <h6 class=""><?php echo $vehiculos['idVehiculo']?></h6>
                                        </div>
                                        <div class="col-3 fw-bold text-center">
                                            <?php echo $vehiculos['marcaVehiculo']?>
                                        </div>
                                        <div class="col-4 fw-bold text-center">
                                            <?php echo $vehiculos['patenteVehiculo']?>
                                        </div>
                                    </div>
                                    <hr class="text-white m-0 p-0">
                                <?php }?>    
                            <?php $arrTemp=$conductores['vehiculos'];$cont=$cont+1;}?>
                            
                    </div>
                </div>
                <div class="row mt-2"></div>
                <div class="row mt-1 mt-1 mb-0" style="background-color:rgb(16, 2, 92)">
                    <h6 class="text-white my-auto mb-0 ">ULTIMAS EMERGENCIAS REPORTADAS</h6>
                </div>
                <div class="row py-2 justify-content-center" style="background-color:rgb(16, 2, 92)" >
                    <?php foreach($emergenciasUno as $emergencia){?>
                        <div class="row mx-1 px-0 w-100 mw-100" style="font-size:0.7em;" >
                            <div class="row mx-0" >
                                <div class="col px-0 bg-light fw-bold">
                                    <span class=" my-auto py-auto"><?php echo $emergencia['fechaReporte'];?></span>
                                </div>
                            </div>
                            <div class="row mx-0 justify-content-center ">
                                <div class="col-1 py-auto  bg-light text-center text-white fw-bold px-0">
                                    <span class="bg-danger"><?php echo $emergencia['tipoEmergencia'];?></span>
                                </div>
                                
                                <div class="col-4 bg-light">
                                    <span><?php echo $emergencia['ubicacionEmergencia'];?></span>
                                </div>
                                <div class="col-4 bg-light">
                                    <span><?php echo $emergencia['descripcionEmergencia'];?></span>
                                </div>
                                <?php foreach($emergencia['vehiculo'] as $vehiculo){?>
                                <div class="col-1 m-0 p-0 bg-light text-primary">
                                    <span class=""><?php echo $vehiculo['idVehiculo'];?></span>
                                </div>
                                <?php };?>    
                                <div class="col-2 bg-light text-center text-primary">
                                    <span class="mt-0 fw-bold <?php if($emergencia['estadoEmergencia']=="Asignada"){?> text-danger <?php };?>"><?php echo $emergencia['estadoEmergencia'];?></span>
                                </div>
                            </div>
                        </div>    
                        <hr class="m-0 p-0 text-dark">
                    <?php };?>
                </div>
            </div>
        </div>
        
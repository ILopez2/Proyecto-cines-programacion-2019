<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
    <div class="container p=4">
        <h1 class="mb-5">Administracion de Salas <?php //echo $cinemaName; ?></h1>
        <div class="row">
           <div class="col-m-4">
                <?php if(isset($_SESSION['successMje']) || isset($_SESSION['errorMje'])){ ?>
                    <div class="alert <?php if(isset($_SESSION['successMje'])) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                        <strong>
                        <?php if(isset($_SESSION['successMje'])) echo $_SESSION['successMje']; else echo $_SESSION['errorMje']; ?>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                        <?php if(isset($_SESSION['successMje'])){
                            unset($_SESSION['successMje']);
                        }
                        if(isset($_SESSION['errorMje'])){
                            unset($_SESSION['errorMje']);
                        }?>
                    </div>

                <?php } ?>

                    <div class="card card-body">
                    
                            
                            <form action="<?php echo FRONT_ROOT?>CinemaRoom/add" method="POST" required>

                                <div class="form-group">                                  
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control mr-sm-2" placeholder="Select" aria-label="Select" name="is3D" required> 
                                    <option value="" disabled selected >Selecciones un tipo</option>
                                    <option value="3d">3D</option>
                                    <option value="2d">2D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" min="0" max="1000" class="form-control" name="capacity" placeholder="Capacidad" required>
                                </div>
                                <input name="idCinema" type="hidden" value="<?php echo $cinemaId; ?>">
                                
                                <input type="submit" class="btn btn-success btn-block" value="Save">   
                            </form>

                    
                    </div>       
            </div>
            <div class="col-m-8">
                <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Capacidad</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                       <?php if(!empty($rooms)){
                                if(is_array($rooms)){                    
                                    foreach($rooms as $valueR){ 
                                        echo "<tr>
                                                <td class=table-light>".$valueR->getName()."</td>";
                                        echo    "<td class=table-light>".$valueR->getIs3d()."</td>";
                                        echo    "<td class=table-light>".$valueR->getCapacity()."</td>";
                                        ?>
                                        <td>
                                            <a href="<?php echo FRONT_ROOT?>CinemaRoom/delete?idroom=<?php echo $valueR->getId()?>&?idcinema=<?php echo $valueR->getCinemaId()?>" class="btn btn-danger" onclick="clicked(event)">
                                            <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                        </tr>
                                        <?php 
                                    }              
                                }
                            
                            else {

                                echo "<tr>
                                        <td class=table-light>".$rooms->getName()."</td>";
                                        echo    "<td class=table-light>".$rooms->getIs3d()."</td>";
                                        echo    "<td class=table-light>".$rooms->getCapacity()."</td>";
                                        //DELETE STARTS HERE
                                    ?>
                                    <td>
                                        <a href="<?php echo FRONT_ROOT?>CinemaRoom/delete?idroom=<?php echo $rooms->getId()?>&?idcinema=<?php echo $rooms->getCinemaId()?>" class="btn btn-danger" onclick="clicked(event)">
                                        <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    </tr>
                                    <?php 
                                        //DELETE ENDS HERE
                            } ?>
                            <!-- EDIT START HERE  -->
                            <td class="table-dark" colspan="7" style="text-align:center;">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                <i class="fas fa-marker">Modificar</i>
                                </button>
                            </td>
                            <!-- EDIT ENDS HERE  -->
                        <?php  } ?>
                    
                </tbody>
                </table>       
            </div>
        </div>
    </div>
<?php } ?>
            <!-- MODAL START HERE  -->
                <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content" action="<?php echo FRONT_ROOT?>CinemaRoom/edit" method="POST">
                        <div class="modal-header">
        
                            <h5 class="modal-title">Modificar</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>

                        </div>

                        <div class="modal-body">
                                <div class="form-group">
                                <label>Ingrese los datos modificados de la sala</label>
                                    <select name="roomId" class="form-control" required>
                                    <option selected disabled value="">Seleccione la sala para editar</option>
                                    
                                    <?php 
                                    if(!empty($rooms)){
                                        foreach($rooms as $value){ ?>
                                            <option value="<?php echo $value->getId();?>"> <?php echo $value->getName();?> </option>                        
                                        <?php }
                                    }?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder= "Nombre" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" min="0" max="1000" class="form-control" name="capacity" placeholder="Capacidad" required>
                                </div>
                                <div class="form-group">
                                    <select name="is3d" class="form-control" required>
                                    <option selected disabled value="">Seleccione un tipo</option>
                                    <option value="3d">3D</option>
                                    <option value="2d">2D</option>
                                    </select>
                                </div>
                                <div>
                                    <input name="cinemaId" type="hidden" value="<?php echo $cinemaId; ?>"> 
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark" onclick="clicked(event)">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- MODAL ENDS HERE  -->
<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
    <div class="container p=4">
            <h1 class="mb-5">Funciones de la sala: <?php echo $cinemaRoomName; ?></h1>
        <div class="row">
            <div class="col-m-4">
                <?php if(isset($_SESSION['successMje']) || isset($_SESSION['errorMje'])) { ?> 
                    <div class="alert <?php if(isset($_SESSION['successMje'])) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                        <strong>
                        <?php 
                            if(isset($_SESSION['successMje'])) echo $_SESSION['successMje']; 
                            else echo $_SESSION['errorMje']; 
                        ?>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                <?php if(isset($_SESSION['successMje'])){unset($_SESSION['successMje']);}
                      if(isset($_SESSION['errorMje'])){unset($_SESSION['errorMje']);}
                ?>
                    </div>
                <?php }?>
            </div>
        </div>
        
        <div class="col-m-8">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Pelicula</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($functions)){       
                            if(is_array($functions)){                            
                                foreach($functions as $function){ 
                                    $movieF=$daoMAC->getMovieXid($function->getMovie());?>      
                                    <tr>
                                        <td class="table-dark"><?php echo $movieF->getTitle(); ?></td>
                                        <td class="table-dark"><?php echo $function->getDate(); ?></td>
                                        <td class="table-dark"><?php echo $function->getTimeStart(); ?></td>
                                        <td class="table-dark">
                                            <a href="<?php echo FRONT_ROOT?>MovieFunction/delete?idroom=<?php echo $function->getId()?>&?idcinemaRoom=<?php echo $function->getCinemaRoom()?>&?option=cinemaRoom" class="btn btn-danger" onclick="clicked(event)">
                                                <i class="far fa-trash-alt"> Eliminar</i>
                                            </a>
                                            <a href="<?php echo FRONT_ROOT?>Views/viewFunctionSeats?idroom=<?php echo $function->getId()?>" class="btn btn-warning">
                                                <i class="fas fa-search-dollar"> Estadisticas de la funcion</i>
                                            </a>
                                        </td>
                                <?php   } 
                            }else{ 
                                $movieF=$daoMAC->getMovieXid($functions->getMovie());?>                            
                                    <tr>
                                        <td class="table-dark"><?php echo $movieF->getTitle(); ?></td>
                                        <td class="table-dark"><?php echo $functions->getDate(); ?></td>
                                        <td class="table-dark"><?php echo $functions->getTimeStart(); ?></td>
                                        <td class="table-dark">
                                            <a href="<?php echo FRONT_ROOT?>MovieFunction/delete?idroom=<?php echo $functions->getId()?>&?idcinemaRoom=<?php echo $functions->getCinemaRoom()?>&?option=cinemaRoom" class="btn btn-danger" onclick="clicked(event)">
                                                <i class="far fa-trash-alt"> Eliminar</i>
                                            </a>
                                            <a href="<?php echo FRONT_ROOT?>Views/viewFunctionSeats?idroom=<?php echo $functions->getId()?>" class="btn btn-warning">
                                                <i class="fas fa-search-dollar"> Estadisticas de la funcion</i>
                                            </a>
                                        </td>
                            <?php } 
                        }?>
                                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
<?php } ?>

<!-- falta dos tr 55 40 -->
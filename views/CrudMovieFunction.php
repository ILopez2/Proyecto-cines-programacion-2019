<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
    <div class="container p=4">
    <h1 class="mb-5">Administracion de Funciones : <?php echo $cine->getName()?></h1>
    <div class="row">
    <div class="col-m-4">
        <?php if(isset($_SESSION['successMje']) || isset($_SESSION['errorMje'])) { ?> 
            <div class="alert <?php if(isset($_SESSION['successMje'])) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                <strong><?php if(isset($_SESSION['successMje'])) echo $_SESSION['successMje']; else echo $_SESSION['errorMje']; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php if(isset($_SESSION['successMje'])){
                    unset($_SESSION['successMje']);
                }
                if(isset($_SESSION['errorMje'])){
                    unset($_SESSION['errorMje']);
                }?></div>
                <?php } ?>

                <!-- start AddFunction here ...  -->
                <div class="card card-body bg-secondary">
                
                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1') { ?>
                    <form action="<?php echo FRONT_ROOT?>MovieFunction/add" method="POST" >
                        <div class="form-group">
                        <label><strong>Cine:</strong></label>
                            <input type="hidden" name="cinemaId" value="<?php echo $cine->getId(); ?>"><strong><?php echo $cine->getName();?></strong>
                        </div>
                        <div class="form-group">
                        <!-- MOVIE OPTION START HERE -->
                            <label>Pelicula</label>
                            <select name="movie" class="form-control" required>
                            <option selected disabled value="">Elija pelicula</option>
                            <?php foreach($array as $movie){?>
                            <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle();?></option>
                            <?php }?>
                            </select>                           
                        </div>
                        <!-- MOVIE OPTION ENDS HERE -->
                        <!-- CINEMAROOM OPTION START HERE -->
                        <div class="form-group">
                            <label>Sala</label>
                            <select name="cinemaRoom" class="form-control" required>
                            <option selected disabled value="">Seleccione una sala</option>
                            <?php 
                            $rooms=$cine->getCinemaRooms();
                            if(!empty($rooms)){
                               if(is_array($rooms)){
                                foreach($rooms as $room){?>
                                    <option value="<?php echo $room->getId(); ?>"><?php echo $room->getName();?></option>
                                    <?php }
                               } 
                               else { ?> <option value="<?php echo $rooms->getId(); ?>"><?php echo $rooms->getName();?></option>                          
                            <?php } }?>
                            </select>
                        </div>
                        <!-- CINEMAROOM OPTION ENDS HERE -->
                        

                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" class="form-control" min="<?php echo date("Y-m-d");?>" max="2020-01-01" name="dateTime" required/>
                        </div>
                        <div class="form-group">
                            <label>Hora</label>
                            <input type="time" name="time" class="form-control" name="dateTime" required/>
                        </div>
                        <div class="form-group">
                            <label>Lenguaje</label>
                            <select name="language" class="form-control" required>
                                    <option selected disabled value="">Lenguaje de la pelicula</option>
                                    <option value="Subtitulada">Subtitulada</option>
                                    <option value="Doblada">Doblada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="cinemaName" value="<?php echo $cine->getName(); ?>">
                        </div>
                        <input type="submit" class="btn btn-success btn-block">   

                    </form>
                    </div>
                <?php } ?>    
                <!-- End AddFunction here ...         -->

                </div>
                <!-- Table here -->
                <div class="col-m-8">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Pelicula</th>
                                <th>Sala</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Lenguaje</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            if(!empty($functions)){
                                
                            if(is_array($functions)){                            
                                foreach($functions as $function){ 
                                    $movieF=$daoMAC->getMovieXid($function->getMovie(),ESP);
                                    $cinemaF=$cinemaDao->getForID2($function->getCinema()); ?>
                                    <tr>
                                    <td class="table-dark"><?php echo $movieF->getTitle(); ?></td>
                                    <?php 
                                        $room=$roomDao->getForID($function->getCinemaRoom());                          
                                    ?>
                                    <td class=table-dark><?php echo $room->getName();?></td>
                                    <td class="table-dark"><?php echo $function->getDate(); ?></td>
                                    <td class="table-dark"><?php echo $function->getTime(); ?></td>
                                    <td class="table-dark"><?php echo $function->getLanguage(); ?></td>
                                    <td class="table-dark">
                                        <!-- DELETE START HERE  -->
                                        <a href="<?php echo FRONT_ROOT?>MovieFunction/delete?id=<?php echo $function->getId()?>&?cinema=<?php echo $cinemaName?>" class="btn btn-danger" onclick="clicked(event)">
                                                <i class="far fa-trash-alt"> Eliminar</i>
                                        </a>
                                        <!-- DELETE START HERE  -->
                                    </td>
                            <?php } }  
                            else{ 
                                $movieF=$daoMAC->getMovieXid($functions->getMovie(),ESP);
                                $cinemaF=$cinemaDao->getForID2($functions->getCinema());
                                ?>                            
                                <tr>
                                    <td class="table-dark"><?php echo $movieF->getTitle(); ?></td>
                                    <?php 
                                        $room=$roomDao->getForID($functions->getCinemaRoom());                          
                                    ?>
                                    <td class=table-dark><?php echo $room->getName();?></td>
                                    <td class="table-dark"><?php echo $functions->getDate(); ?></td>
                                    <td class="table-dark"><?php echo $functions->getTime(); ?></td>
                                    <td class="table-dark"><?php echo $functions->getLanguage(); ?></td>
                                    <td class="table-dark">
                                        <!-- DELETE START HERE  -->
                                        <a href="<?php echo FRONT_ROOT?>MovieFunction/delete?id=<?php echo $functions->getId()?>&?cinema=<?php echo $cinemaName?>" class="btn btn-danger" onclick="clicked(event)">
                                                <i class="far fa-trash-alt"> Eliminar</i>
                                        </a>
                                        <!-- DELETE START HERE  -->
                                    </td>
                            <?php } }?>
                                </tr>
                        </tbody>
                    </table> 
                </div>
                            <!-- END TABLE HERE  -->  
                
                <!-- MODAL START HERE no terminado todavia -->
                <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <form class="modal-content" action="<?php echo FRONT_ROOT?>MovieFunction/edit" method="POST">

                        <div class="modal-header">
                            
                            <h5 class="modal-title">Modify</h5>


                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>

                        </div>

                        <div class="modal-body">
                                
                                <div class="form-group">
                                <label>Seleccione una Funcion a editar:</label>
                                <select name="movie" class="form-control" required>  
                                <option selected disabled value="">Elija pelicula</option>
                                <?php foreach($array as $movie){?>
                                <option value="<?php $movie->getTitle(); ?>"><?php $movie->getTitle();?></option>
                                <?php }?>
                                </select>
                                </div>

                                <div class="form-group">
                                
                                
                                
                                <!-- CINEMA OPTION START HERE -->
                                <label>cinema</label>
                                <select name="cinema" class="form-control" required>
                                    <option selected disabled value="">Cine Disponible</option>
                                    <?php foreach($cines as $cine){?>
                                        <option value="<?php echo $cine->getName();?>"><?php echo $cine->getName();?></option>
                                        
                                        <div class="form-group">
                                        <!-- CINEMA ROOM OPTION START HERE -->
                                        <label>cinemaRoom</label>
                                        <select name="room" class="form-control" required>
                                                <option selected disabled value="">Elija Sala</option>
                                                <?php foreach($cine as $room){?>
                                                <option value="<?php echo $room->getName();?>"><?php echo $room->getName(); ?></option>
                                                <?php }?>
                                        </select>
                                        <!-- CINEMA ROOM OPTION ENDS HERE -->    
                                    <?php }?>
                                </select>
                                </div>
                                </div>
                                <!-- CINEMA OPTION ENDS HERE -->   
                                </div>
                    
                        <div class="form-group">
                            <label>dateTime</label>
                            <input type="date" class="form-control" name="date" required/>
                        </div>

                        <div class="form-group">
                            <label>language</label>
                            <select name="language" class="form-control" required>
                                    <option selected disabled value="">Audio de la pelicula</option>
                                    <option value="1">Subtitulada</option>
                                    <option value="2">Doblada</option>
                                    <option value="3">Latino</option>
                            </select>
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
            </div>
    </div>
    <?php } ?>


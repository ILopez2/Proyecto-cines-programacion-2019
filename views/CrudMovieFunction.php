<?php

    //use daojson\JsonMovieFunction as JsonMovieFunction;
    //$dao = new JsonMovieFunction();

    use dao\MovieFunctionDao as MovieFunctionDao;
    $dao = new MovieFunctionDao();

    $functions=$dao->getAll();

    use dao\CinemaDao as CinemaDao;
    $daoCD= new CinemaDao;
    $cines=$daoCD->getAll();

    use controllers\MovieApiController as MovieApiController;
    $daoMAC = new MovieApiController();
    $array = $daoMAC->getLastMovies(ESP);
 
?>

<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
    <div class="container p=4">
    <h1 class="mb-5">Administracion de Funciones</h1>
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
                        <!-- MOVIE OPTION START HERE -->
                            <label>Pelicula</label>
                            <select name="movie" class="form-control" required>
                            <option selected disabled value="">Elija pelicula</option>
                            <?php foreach($array as $movie){?>
                            <option value="<?php echo $movie->getTitle(); ?>"><?php echo $movie->getTitle();?></option>
                            <?php }?>
                            </select>                           
                        </div>
                        <!-- MOVIE OPTION ENDS HERE -->
                        <!-- CINEMA OPTION START HERE -->
                        <div class="form-group">
                            <label>Cine</label>
                            <select name="cinema" class="form-control" required>
                            <option selected disabled value="">Seleccione un cine</option>
                            <?php foreach($cines as $cine){?>
                            <option value="<?php echo $cine->getId(); ?>"><?php echo $cine->getName();?></option>
                            <?php }?>
                            </select>
                        </div>
                        <!-- CINEMA OPTION ENDS HERE -->
                        <!-- CINEMAROOM OPTION START HERE -->
                        <div class="form-group">
                            <label>Sala</label>
                            <select name="cinema" class="form-control" required>
                            <option selected disabled value="">Seleccione un cine</option>
                            <?php foreach($cines as $cine){?>
                            <option value="<?php echo $cine->getId(); ?>"><?php echo $cine->getName();?></option>
                            <?php }?>
                            </select>
                        </div>
                        <!-- CINEMAROOM OPTION ENDS HERE -->
                        

                        <div class="form-group">
                            <label>Fecha y hora</label>
                            <input type="date" class="form-control" name="date" required/>
                        </div>

                        <div class="form-group">
                            <label>Lenguaje</label>
                            <select name="language" class="form-control" required>
                                    <option selected disabled value="">Audio de la pelicula</option>
                                    <option value="1">Subtitulada</option>
                                    <option value="2">Doblada</option>
                                    <option value="3">Latino</option>
                            </select>
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
                            <th>Cine</th>
                            <th>Sala</th>
                            <th>Fecha y hora</th>
                            <th>Lenguaje</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        if(is_array($functions)){
                            if(!empty($functions)){ 
                                foreach($functions as $function){ ?>
                                <tr>
                                <td class="table-dark"><?php echo $function->getMovie()->getTitle(); ?></td>
                                <td class="table-dark"><?php echo $function->getCinema()->getName(); ?></td>
                                <?php
                                    $cinema=$function->getCinema();
                                    $rooms=$cinema->getCinemaRooms();
                                    foreach($rooms as $room){
                                        echo "<td class=table-light>".$room->getName()."</td>";                           
                                    }?>
                                <td class="table-dark"><?php echo $function->getDateTime(); ?></td>
                                <td class="table-dark"><?php echo $function->getLanguage(); ?></td>
                                    

                                <!-- DELETE HERE  -->
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                    <a href="<?php echo FRONT_ROOT?>MovieFunction/delete?id=<?php echo $value->getId()?>" class="btn btn-danger" onclick="clicked(event)">
                                    <i class="far fa-trash-alt"></i>
                                    </a><?php } ?>
                                <!-- END DELETE HERE -->

                                <!-- EDIT START HERE  -->
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                    <td class="table-dark" colspan="7" style="text-align:center;">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                        <i class="fas fa-marker">Modificar</i>
                                        </button>
                                    </td>
                                <?php } ?>
                                <!-- END EDIT HERE  -->
                            
                        </div>
                        <?php } } 
                        else{ ?>
                                    <tr>
                                    <td class="table-dark"><?php echo $functions->getMovie()->getTitle(); ?></td>
                                    <td class="table-dark"><?php echo $functions->getCinema()->getName(); ?></td>
                                    <?php
                                        $cinema=$functions->getCinema();
                                        $rooms=$cinema->getCinemaRooms();
                                        foreach($rooms as $room){
                                            echo "<td class=table-light>".$room->getName()."</td>";                           
                                        }?>
                                    <td class="table-dark"><?php echo $functions->getDateTime(); ?></td>
                                    <td class="table-dark"><?php echo $functions->getLanguage(); ?></td>
                                    

                                    <!-- DELETE HERE  -->
                                    <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                        <a href="<?php echo FRONT_ROOT?>MovieFunction/delete?id=<?php echo $value->getId()?>" class="btn btn-danger" onclick="clicked(event)">
                                        <i class="far fa-trash-alt"></i>
                                        </a><?php } ?>
                                    <!-- END DELETE HERE -->

                                    <!-- EDIT START HERE  -->
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                    <td class="table-dark" colspan="7" style="text-align:center;">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                        <i class="fas fa-marker">Modificar</i>
                                        </button>
                                    </td>
                                <?php } ?>
                                <!-- END EDIT HERE  -->
                            </tbody>
                            </table> 
                            <!-- END TABLE HERE  -->  
                        <?php }
                    
                    
                    } ?>
                
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


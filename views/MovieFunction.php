<?php 
    //use daojson\JsonCinemaMovieFunction as JsonCinemaMovieFunction;
    //$dao = new JsonCinemaMovieFunction();
    use dao\CinemaMovieFunction as CinemaMovieFunction;
    $dao = new CinemaMovieFunction();
    $cinemaFunction=$dao->getAll();

    use controllers\MovieApiController as MovieApiController;
    $dao = new MovieApiController();
    

    // ha yque cambiar esto por lo que se pase en el click..
    // hay que ver la forma de traer mediante el click la peli para esta pantalla..
    $movie = $dao->getMovie($name,$lang);

?>


    <div class="container p=4">
        <h1 class="mb-5">Funcion</h1>
        <div class="row">
            <div class="col-m-4">
                <?php if(isset($_SESSION['successMje']) || isset($_SESSION['errorMje'])) { ?>
                    <div class="alert <?php if(isset($_SESSION['successMje'])) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                        <strong>
                        <?php if(isset($_SESSION['successMje'])) echo $_SESSION['successMje']; else echo $_SESSION['errorMje'];?>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                        <?php 
                            if(isset($_SESSION['successMje'])){unset($_SESSION['successMje']);}
                            if(isset($_SESSION['errorMje'])){unset($_SESSION['errorMje']);}
                        ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-m-8">
                <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Movie</th>
                        <th>Cinema</th>
                        <th>dateTime</th>
                        <th>language</th>
                        <th>cinemaRoom</th>
                    </tr>
                </thead>
                <tbody>
                       <?php foreach($cinemasFunction as $function){
                                if($movie->getTitle() == $function->getMovie()->getTitle()){?>
                                    <tr>
                                        <td><figure class="figure">
                                                <img class="figure-img img-fluid rounded" src="<?php  echo $dao->getMoviePoster($function->getMovie()->getPosterPath());;?>" alt="">
                                            </figure>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=table-light><?php echo $function->getCinema()->getName();?></td>
                                        <td class=table-light><?php echo $function->getDateTime();?></td>
                                        <td class=table-light><?php echo $function->getLanguage();?></td>
                                        <?php 
                                            $cinema=$function->getCinema();
                                            $rooms=$cinema->getCinemaRooms();
                                            foreach($rooms as $room){
                                                echo "<td class=table-light>".$room->getName()."</td>";                           
                                            }?>
                                    </tr>
                                <?php } ?>
                        <?php } ?>
                </tbody>
                </table>       
            </div>
        </div>
    </div>
                        <!-- FALTA BOTON PARA COMPRAR ENTRADAS BOTON PARA VOLVER A LA VISTA DEL HOME  -->
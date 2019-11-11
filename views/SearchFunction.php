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
                    <th>date</th>
                    <th>time</th>
                    <th>language</th>
                    <th>cinemaRoom</th>
                </tr>
            </thead>
            <tbody>
                   <?php  $flag=false;
                        foreach($cinemasFunction as $function){
                            if($searchF == $function->getDate()){
                                $flag=true;
                                $fMovie=$daoM->getMovieXid($function->getMovie(),ESP);
                                $fCinema=$daoC->getForID2($function->getCinema());
                            ?>
                                <tr>
                                    <td><figure class="figure">
                                            <img class="figure-img img-fluid rounded" src="<?php  echo $daoM->getMoviePoster($fMovie->getPosterPath());?>" alt="">
                                        </figure>
                                    </td>
                                    <td class=table-light><?php echo $fCinema->getName();?></td>
                                    <td class=table-light><?php echo $function->getDate();?></td>
                                    <td class=table-light><?php echo $function->getTime();?></td>
                                    <td class=table-light><?php echo $function->getLanguage();?></td>
                                    <?php 
                                        $rooms=$fCinema->getCinemaRooms();
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

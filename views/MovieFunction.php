<div class="container p=4">
        <h1 class="mb-5"> <?php echo $title; ?> </h1>
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
                        <th>Cine</th>
                        <th>Fecha y hora</th>
                        <th>Lenguaje</th>
                        <th>Sala</th>
                    </tr>
                </thead>
                <tbody>
                <img class="figure-img img-fluid rounded" src="<?php  echo $poster;?>" alt="">
                       <?php if(!empty($cinemasFunction)){
                                if(is_array($cinemasFunction)){
                                    foreach($cinemasFunction as $function){
                                        if($movie->getId() == $function->getMovie()){
                                            $fCinema=$daoC->getForID2($function->getCinema());
                                            ?>
                                            <tr>
                                                </td>
                                                <td class=table-light><?php echo $fCinema->getName();?></td>
                                                <td class=table-light><?php echo $function->getDate()." ".$function->getTime();?></td>
                                                <td class=table-light><?php echo $function->getLanguage();?></td>
                                                <?php 
                                                    $room=$daoRM->getForID($function->getCinemaRoom());                          
                                                ?>
                                                <td class=table-light><?php echo $room->getName();?></td>
                                            </tr>
                                        <?php } 
                                    }
                                }
                                else{
                                    if($movie->getId() == $cinemasFunction->getMovie()){
                                        $fCinema=$daoC->getForID2($cinemasFunction->getCinema());
                                        ?>
                                        <tr>
                                            </td>
                                            <td class=table-light><?php echo $fCinema->getName();?></td>
                                            <td class=table-light><?php echo $cinemasFunction->getDate()." ".$cinemasFunction->getTime();?></td>
                                            <td class=table-light><?php echo $cinemasFunction->getLanguage();?></td>
                                            <?php 
                                                    $room=$daoRM->getForID($cinemasFunction->getCinemaRoom());                          
                                                ?>
                                            <td class=table-light><?php echo $room->getName();?></td>
                                        </tr>
                            <?php   }
                                }
                            } ?>
                </tbody>
                </table>       
            </div>
        </div>
    </div>
                        <!-- FALTA BOTON PARA COMPRAR ENTRADAS BOTON PARA VOLVER A LA VISTA DEL HOME  -->
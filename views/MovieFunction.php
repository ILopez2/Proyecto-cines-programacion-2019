<div class="container p=4">
        
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
            <div class="container">
            <section class="jumbotron">
                 <h1  style="text-align: left"> <?php echo 'Ficha Tecnica: '.$title; ?> </h1>
                <div style = "text-align: center">
                    <img class="figure-img img-fluid rounded" src="<?php  echo $poster;?>" alt="">
                </div>
                <div style = "text-align: center">
                    <p><?php echo $overView; ?></p>
                </div>
            </section>
            
            
            <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col" colspan="4" class="table-success" style = "text-align: center">Detalles</th>
                
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">Generos</th>
                <td colspan="3"><?php foreach($genrs as $gen){ echo $gen.','; } ?></td>
                </tr>
                <tr>
                <th scope="row">Duracion</th>
                <td colspan="3"><?php  echo $duration." Minutos";?></td>
                </tr>
            </tbody>
            </table>
            <h2>Funciones</h2>
            <div class="col-m-8">
                <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Cine</th>
                        <th>Fecha y hora</th>
                        <th>Lenguaje</th>
                        <th>Sala</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
              
                       <?php if(!empty($cinemasFunction)){
                                if(is_array($cinemasFunction)){
                                    foreach($cinemasFunction as $function){
                                        if($function->getDate()>=$date){

                                            if($movie->getId() == $function->getMovie()){
                                                $fCinema=$daoC->getForID2($function->getCinema());
                                                ?>
                                                <tr>
                                                    </td>
                                                    <td ><?php echo $fCinema->getName();?></td>
                                                    <td ><?php echo $function->getDate()." ".$function->getTime();?></td>
                                                    <td ><?php echo $function->getLanguage();?></td>
                                                    <?php 
                                                        $room=$daoRM->getForID($function->getCinemaRoom());                          
                                                    ?>
                                                    <td ><?php echo $room->getName();?></td>
                                                    <td style = "text-align: center"> 
                                                        <a href="<?php echo FRONT_ROOT;?>Views/selectSeats?id=<?php echo $function->getId();?>" class="btn btn-success">
                                                            <i class="fas fa-shopping-cart"> Comprar entradas</i>
                                                        </a>                                   
                                                    </td>
                                                </tr>
                                    <?php   } 
                                        }
                                    }
                                }
                                else{
                                    if($cinemasFunction->getDate()>=$date){
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
                                                
                                                <td style = "text-align: center"> 
                                                <a href="<?php echo FRONT_ROOT;?>Views/selectSeats?id=<?php echo $cinemasFunction->getId();?>" class="btn btn-success">
                                                            <i class="fas fa-shopping-cart"> Comprar entradas</i>
                                                        </a>                                 
                                                </td>

                                            </tr>
                            <?php       }
                                    } 
                                }
                            } ?>
                </tbody>
                </table>       
            </div> 
            </div>
            
        </div>
            
    </div>

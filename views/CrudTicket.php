<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
    <div class="container p=4">
        <h1 class="mb-5">Administracion de cines</h1>
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
            </div>
            <div class="col-m-8">
                <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre Cine</th>
                        <th>Direccion</th>
                        <th>Numero Sala</th>
                        <th>Precio ticket</th>
                        <th>Fecha y Hora</th>
                        <!-- <th>QR</th> -->
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                        if(!empty($tickets)){
                            if(is_array($tickets)){
                                foreach($tickets as $ticket){  ?>
                                <tr>
                                    <td class="table-dark"><?php echo $ticket->getTicketID(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getPrice(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getTime()." ".$ticket->getDate();?></td>

                                    <td class="table-dark"><?php echo $ticket->getCinemaID(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getCinemaRoomID(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getMovieID(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getUserID(); ?></td>
                                    
                                    <td class="table-dark"><?php echo $ticket->getQR(); ?></td>
                                    
                                    <td class="table-dark">

                                    <!-- DELETE START HERE  -->
                                        <a href="<?php echo FRONT_ROOT?>Ticket/delete?id=<?php echo $cine->getId()?>" class="btn btn-danger" onclick="clicked(event)">
                                            <i class="far fa-trash-alt"> Eliminar</i>
                                        </a>
                                    <!-- DELETE START HERE  -->
                                    </td>
                                </tr>
                            <?php }  
                            }    
                            else { ?>
                                <tr>
                                    <td class="table-dark"><?php echo $ticket->getName(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getAddress(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getCity(); ?></td>
                                    <td class="table-dark"><?php echo $ticket->getTicketCost(); ?></td>
                                    
                                    <td class="table-dark">

                                    <!-- DELETE START HERE  -->
                                        <a href="<?php echo FRONT_ROOT?>Ticket/delete?id=<?php echo $cinemas->getId()?>" class="btn btn-danger" onclick="clicked(event)">
                                            <i class="far fa-trash-alt"> Eliminar</i>
                                        </a>
                                    <!-- DELETE START HERE  -->
                                    </td>
                                </tr>
                            <?php } ?>
                    <?php } ?>
                </tbody>
                </table>        
            </div>
            
        </div>
    </div>
<?php } ?>

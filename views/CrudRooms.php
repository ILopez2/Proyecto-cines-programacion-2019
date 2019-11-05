<?php
    use daojson\JsonCinema as JsonCinema;
    $dao = new JsonCinema();
    //$dao->createRoom();
    $cinemas=$dao->getAll();

?>

<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
    <div class="container p=4">
        <h1 class="mb-5">Administracion de Salas</h1>
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
                        
                        <?php if(isset($_SESSION['successMje'])){unset($_SESSION['successMje']);}
                        if(isset($_SESSION['errorMje'])){unset($_SESSION['errorMje']);}?>

                    </div>

                <?php } ?>

                    <div class="card card-body">
                    
                            
                            <form action="<?php echo FRONT_ROOT?>CinemaRoom/add" method="POST" required>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="type" placeholder= "Tipo" required>
                                </div>
                                <!-- <div>
                                <input type=”radio” name=”affirmative” value=”yes” checked>Yes</input> 
                                <input type=”radio” name=”negative” value=”no”>No</input>
                                </div> -->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="capacity" placeholder="Capacidad" required>
                                </div>
                                
                                <input type="submit" class="btn btn-success btn-block" name="save" value="Save">   
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
                    </tr>
                </thead>
                <tbody>
                       <?php 
                            foreach($cinemas as $values){
                                if($values->getName() == $cinemaName){
                                    $rooms = $values->getCinemaRooms();
                                    if(is_array($rooms)){
                                        if(!empty($rooms)){
                                            foreach($rooms as $valueR){ 
                                                echo "<tr>
                                                        <td class=table-light>".$valueR->getName()."</td>";
                                                echo    "<td class=table-light>".$valueR->getType()."</td>";
                                                echo    "<td class=table-light>".$valueR->getCapacity()."</td>";
                                                //DELETE STARTS HERE
                                                echo    "<td class=table-light> <a href=".FRONT_ROOT."CinemaRoom/delete?id=".$valueR->getName()."class=btn btn-danger>";
                                                echo    "<i class=far fa-trash-alt></i></a>";
                                                //DELETE ENDS HERE
                                                echo    "</td></tr>";
                                            }              
                                        }
                                    }
                                }
                            } 
                        ?>
                    <!-- EDIT START HERE  -->
                        <td colspan="7" style="text-align:center;">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                            <i class="fas fa-marker">Modificar</i>
                            </button>
                        </td>
                    <!-- EDIT ENDS HERE  -->
                </tbody>
                </table>       
            </div>
        </div>
    </div>
<?php } ?>
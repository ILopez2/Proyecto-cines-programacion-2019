<?php
    use daojson\JsonCinema as JsonCinema;
    $dao = new JsonCinema();
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
                    <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                            
                            <form action="<?php echo FRONT_ROOT?>Room/add" method="POST" required>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="type" placeholder= "Tipo" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="capacity" placeholder="Capacidad" required>
                                </div>
                                
                                <input type="submit" class="btn btn-success btn-block" name="save" value="Save">   
                            </form>

                    <?php } ?>
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
                        <?php foreach($cinemas as $rooms){  ?>
                            <tr>
                            <td class="table-light"><?php echo $rooms->getName(); ?></td>
                            <td class="table-light"><?php echo $rooms->getType(); ?></td>
                            <td class="table-light"><?php echo $rooms->getCapacity(); ?></td>
                            
                            <td class="table-light"> 
                            <!-- DELETE CINEMA HERE  -->
                            <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>    
                                <a href="<?php echo FRONT_ROOT?>Cinema/delete?id=<?php echo $rooms->getName()?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                                </a>
                            <?php } ?>
                            </td>
                            </tr>
                        <?php } ?>
                        <!-- EDIT START HERE  -->
                        <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                            <td colspan="7" style="text-align:center;">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                <i class="fas fa-marker">Modificar</i>
                                </button>
                            </td>
                        <?php } ?>
                        <!-- END EDIT HERE  -->
                </tbody>
                </table>        
            </div>
        </div>
    </div>

<?php } ?>
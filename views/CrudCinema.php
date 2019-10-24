<?php
    use daojson\JsonCinema as JsonCinema;
    $dao = new JsonCinema();
    $cinemas=$dao->getAll();
    //var_dump($_SESSION);
?>

<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
    <div class="container p=4">
        <h1 class="mb-5">Administracion de cines</h1>
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
                        }?>
                    </div>

                <?php } ?>

                    <div class="card card-body">
                    <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                            
                            <form action="<?php echo FRONT_ROOT?>Cinema/add" method="POST" required>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adress" placeholder= "Direccion" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="price" placeholder="Precio de entrada" required>
                                </div>
                                <div class="form-group">
                                    <!--<input type="text" class="form-control" name="precio" placeholder="Precio de entrada"> -->
                                    <select name="city" class="form-control" required>
                                    <option selected disabled value="">Seleccione una ciudad</option>
                                    <option value="Mar del Plata">Mar del Plata</option>
                                    <option value="Miramar">Miramar</option>
                                    </select>
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
                        <th>Direccion</th>
                        <th>Ciudad</th>
                        <th>Precio ticket</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach($cinemas as $cine){  ?>
                        <tr>
                            <td class="table-light"><?php echo $cine->getName(); ?></td>
                            <td class="table-light"><?php echo $cine->getAddress(); ?></td>
                            <td class="table-light"><?php echo $cine->getCity(); ?></td>
                            <td class="table-light"><?php echo $cine->getTicketCost(); ?></td>
                            
                            <td class="table-light">
                            <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                                <a href="<?php echo FRONT_ROOT?>Cinema/edit?id=<?php echo $cine->getName()?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i>
                                </a>
                            <?php } ?>
                            <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>    
                                <a href="<?php echo FRONT_ROOT?>Cinema/delete?id=<?php echo $cine->getName()?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                                </a>
                            <?php } ?>
                            </td>
                        </tr>

                        <?php } ?>
                </tbody>
                </table>        
            </div>
        </div>
    </div>

<?php } ?>

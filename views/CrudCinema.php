<?php
    //use daojson\JsonCinema as JsonCinema;
    //$dao = new JsonCinema();
    use dao\CinemaDao as CinemaDao;
    $dao = new CinemaDao();
    $cinemas=$dao->getAll();
    //var_dump($_SESSION);
?>

<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
    <div class="container p=4">
        <h1 class="mb-5">Administracion de cines</h1>
        <div class="row">
            <div class="col-m-4">
                <?php if(isset($_SESSION['successMje']) || isset($_SESSION['errorMje'])){ ?>
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
                    <div class="card card-body bg-secondary">
                            <form action="<?php echo FRONT_ROOT?>Cinema/add" method="POST" required>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adress" placeholder= "Direccion" required>
                                </div>
                                <div class="form-group">
                                <input type="number" min="0" max="10000" step="1" name="price" placeholder="Precio de Entrada" required="required">
                                </div>
                                <div class="form-group">
                                    <!--<input type="text" class="form-control" name="precio" placeholder="Precio de entrada"> -->
                                    <select name="city" class="form-control" required>
                                    <option selected disabled value="">Seleccione una ciudad</option>
                                    <option value="Mar del Plata">Mar del Plata</option>
                                    <option value="Miramar">Miramar</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success btn-block" name="save" value="Save" onclick="clicked(event)">   
                            </form>
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
                        <?php 
                        if(!empty($cinemas)){
                            if(is_array($cinemas)){
                                foreach($cinemas as $cine){  ?>
                                <tr>
                                    <td class="table-dark"><?php echo $cine->getName(); ?></td>
                                    <td class="table-dark"><?php echo $cine->getAddress(); ?></td>
                                    <td class="table-dark"><?php echo $cine->getCity(); ?></td>
                                    <td class="table-dark"><?php echo $cine->getTicketCost(); ?></td>
                                    
                                    <td class="table-dark">

                                    <!-- DELETE START HERE  -->
                                        <a href="<?php echo FRONT_ROOT?>Cinema/delete?id=<?php echo $cine->getName()?>" class="btn btn-danger" onclick="clicked(event)">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    <!-- DELETE START HERE  -->

                                    <!-- CINEMA ROOMS VIEW START HERE -->
                                    <a href="<?php echo FRONT_ROOT?>Views/admRooms?id=<?php echo $cine->getName()?>" class="btn btn-primary" onclick="clicked(event)">
                                        <i class="fas fa-person-booth"></i>
                                    </a>
                                    <!-- CINEMA ROOMS VIEW ENDS HERE -->
                                    <!-- FUNCTIONS START HERE  -->
                                    <a href="<?php echo FRONT_ROOT?>Views/admFunctions?id=<?php echo $cine->getName()?>" class="btn btn-success" onclick="clicked(event)">
                                        <i class="fa fa-ticket"></i>
                                    </a>
                                    <!-- FUNCTIONS START HERE  -->
                                    </td>
                                </tr>
                            <?php }  
                            }    
                            else { ?>
                                <tr>
                                    <td class="table-dark"><?php echo $cinemas->getName(); ?></td>
                                    <td class="table-dark"><?php echo $cinemas->getAddress(); ?></td>
                                    <td class="table-dark"><?php echo $cinemas->getCity(); ?></td>
                                    <td class="table-dark"><?php echo $cinemas->getTicketCost(); ?></td>
                                    
                                    <td class="table-dark">

                                    <!-- DELETE START HERE  -->
                                        <a href="<?php echo FRONT_ROOT?>Cinema/delete?id=<?php echo $cinemas->getName()?>" class="btn btn-danger" onclick="clicked(event)">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    <!-- DELETE START HERE  -->

                                    <!-- CINEMA ROOMS VIEW START HERE -->
                                    <a href="<?php echo FRONT_ROOT?>Views/admRooms?id=<?php echo $cinemas->getName()?>" class="btn btn-primary" onclick="clicked(event)">
                                        <i class="fas fa-person-booth"></i>
                                    </a>
                                    <!-- CINEMA ROOMS VIEW ENDS HERE -->
                                     <!-- FUNCTIONS START HERE  -->
                                     <a href="<?php echo FRONT_ROOT?>Views/admFunctions?id=<?php echo $cinemas->getName()?>" class="btn btn-danger" onclick="clicked(event)">
                                            <i class="fa fa-ticket"></i>
                                        </a>
                                    <!-- FUNCTIONS START HERE  -->
                                    </td>
                                </tr>
                            <?php } ?>

                        <!-- EDIT START HERE  -->
                            <td class="table-dark" colspan="7" style="text-align:center;">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                <i class="fas fa-marker">Modificar</i>
                                </button>
                            </td>
                        <!-- END EDIT HERE  -->
                    <?php } ?>
                </tbody>
                </table>        
            </div>
            
        </div>

        <!-- MODAL START HERE  -->
        <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content" action="<?php echo FRONT_ROOT?>Cinema/edit" method="POST">
                        <div class="modal-header">
        
                            <h5 class="modal-title">Modify</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>

                        </div>

                        <div class="modal-body">
                                <div class="form-group">
                                <label>Seleccione un Cine para editar:</label>
                                    <select name="name" class="form-control" required>
                                    <option selected disabled value="">Nombre</option>
                                    
                                    <?php foreach($cinemas as $value){ ?>
                                        <option value="<?php echo $value->getName();?>"> <?php echo $value->getName();?> </option>                        
                                    <?php }?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adress" placeholder= "Direccion" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="price" placeholder="Precio de entrada" required>
                                </div>
                                <div class="form-group">
                                    <select name="city" class="form-control" required>
                                    <option selected disabled value="">Seleccione una ciudad</option>
                                    <option value="Mar del Plata">Mar del Plata</option>
                                    <option value="Miramar">Miramar</option>
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
<?php } ?>

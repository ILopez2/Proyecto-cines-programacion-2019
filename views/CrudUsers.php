<?php

    use daojson\JsonUser as JsonUser;
    $dao = new JsonUser();
    $users=$dao->getAll();
 
?>

<?php 
    if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
    <div class="container p=4">
        <h1 class="mb-5">Administracion de usuarios</h1>
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
                        }
                        
                        ?>
                    </div>
                    <?php } ?>


                    <!-- AddUser here ...  -->
                    <div class="card card-body">
                        <form action="<?php echo FRONT_ROOT?>User/add" method="POST" required>
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" />
                            </div>

                            <div class="form-group">
                                <label>Nationality</label>
                                <input type="text" class="form-control" name="nationality" />
                            </div>

                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="birthdate" />
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" />
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" />
                            </div>

                            <input type="submit" class="btn btn-success btn-block" name="save" value="Save">   

                        </form>
                    </div>

                    <!-- End AddUser here ...         -->

            </div>
            
            <div class="col-m-8">
                <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha nac</th>
                        <th>Nacionalidad</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach($users as $value){  ?>
                    <tr>
                            <td class="table-light"><?php echo $value->getName(); ?></td>
                            <td class="table-light"><?php echo $value->getBirthdate(); ?></td>
                            <td class="table-light"><?php echo $value->getNationality(); ?></td>
                            <td class="table-light"><?php echo $value->getEmail(); ?></td>
                            <td class="table-light"><?php echo $value->getPassword(); ?></td>
                            <td class="table-light"><?php echo $value->getRoleLevel(); ?></td>
                            
                            <td class="table-light">
                            
                                <!-- EDIT HERE  -->
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                    <i class="fas fa-marker"></i>
                                    </button>
                                <?php } ?>
                                
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                                    <!-- DELETE HERE  -->
                                    <a href="<?php echo FRONT_ROOT?>User/delete?id=<?php echo $value->getEmail()?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                    </a>
                                <?php } ?>

                                <!-- SET ADMIN -->
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){?>
                                    
                                    <?php if($value->getRoleLevel() != 'Admin'){ ?>
                                    <a href="<?php echo FRONT_ROOT?>User/setRole?id=<?php echo $value->getEmail()?>&?role=Admin" class="btn btn-success">
                                    <i class="fas fa-user-shield"></i>
                                    </a>
                                    
                                    <?php }else{?>
                                        <!-- SET COMMON -->
                                        <a href="<?php echo FRONT_ROOT?>User/setRole?id=<?php echo $value->getEmail()?>&?role=Common" class="btn btn-danger">
                                        <i class="fas fa-user-times"></i>
                                        </a>
                                    <?php } ?>
                                
                                <?php } ?>

                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
                </table>        
            </div>

            <!-- MODAL MODIFY HERE  -->
            <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <form class="modal-content" action="<?php echo FRONT_ROOT?>User/edit" method="POST">

                        <div class="modal-header">
                            
                            <h5 class="modal-title">Modify</h5>


                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>

                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="birthdate" />
                            </div>
                            <div class="form-group">
                                <label>Nationality</label>
                                <input type="text" class="form-control" name="nationality" />
                            </div>    
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" />
                            </div>
                            <div>
                                <input name="id" type="hidden" value="<?php echo $value->getEmail()?> ">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Registry</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
<?php } ?>


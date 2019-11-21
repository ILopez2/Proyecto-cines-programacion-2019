<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
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
                        unset($_SESSION['errorMje']);}?>
                </div>
            <?php } ?>

                <!-- AddUser here ...  -->
                <div class="card card-body bg-secondary">
                
                    <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1') { ?>
                    <form action="<?php echo FRONT_ROOT?>User/add" method="POST" >
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required/>
                        </div>

                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" max="<?php echo date("Y-m-d");?>" min="1900-01-01" class="form-control" name="birthdate" required/>
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required/>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required/>

                        </div>
                        <div class="form-group">
                            <label>Rol</label>
                            <select name="role" class="form-control" required>
                                    <option selected disabled value="">Rol de Usuario</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Comun</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-success btn-block">   

                    </form>
                    <?php } ?>    
                </div>
                <!-- End AddUser here ...         -->

        </div>
                <!-- Table here -->
                <div class="col-m-8">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha nac</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $value){ ?>
                                <tr>
                                    <td class="table-dark"><?php echo $value->getName(); ?></td>
                                    <td class="table-dark"><?php echo $value->getBirthdate(); ?></td>
                                    <td class="table-dark"><?php echo $value->getEmail(); ?></td>
                                    <td class="table-dark"><?php echo $value->getPassword(); ?></td>
                                    <td class="table-dark"><?php if($value->getRoleLevel()=="1") echo "Admin";
                                                                else echo "Comun"; ?></td>
                                    <td class="table-dark">
                                        <!-- DELETE HERE  -->
                                        <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                            <a href="<?php echo FRONT_ROOT?>User/delete?id=<?php echo $value->getEmail()?>" class="btn btn-danger" onclick="clicked(event)">
                                                <i class="far fa-trash-alt"> Eliminar</i>
                                            </a><?php } ?>
                                        <!-- END DELETE HERE -->
                                
                                        <!-- SET ADMIN -->
                                        <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                            <?php if($value->getRoleLevel() != '1'){ ?>
                                            <a href="<?php echo FRONT_ROOT?>User/setRole?id=<?php echo $value->getEmail()?>&?role=1" class="btn btn-success" onclick="clicked(event)" >
                                                <i class="fas fa-user-shield"> Cambiar Rol</i>
                                            </a>
                                            <?php }else{?>
                                                <!-- SET COMMON -->
                                                <a href="<?php echo FRONT_ROOT?>User/setRole?id=<?php echo $value->getEmail()?>&?role=2" class="btn btn-danger" onclick="clicked(event)" >
                                                    <i class="fas fa-user-times"> Revocar Admin</i>
                                                </a>
                                            <?php } ?>    
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>

                                <!-- EDIT START HERE  -->
                                <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
                                    <td class="table-dark" colspan="7" style="text-align:center;">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sign-up">
                                        <i class="fas fa-marker">Modificar</i>
                                        </button>
                                    </td>
                                <?php } ?>
                                <!-- END EDIT HERE  -->
                        </tbody>
                    </table> 
                    <!-- END TABLE HERE  -->
                </div>
                
                <!-- MODAL START HERE  -->
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
                                        <label>Seleccione un Usuario a editar:</label>
                                        <select name="email" class="form-control" required>
                                            <option selected disabled value="">Email del Usuario</option>
                                            <?php foreach($users as $value){ ?>
                                            <option value="<?php echo $value->getEmail();?>"> <?php echo $value->getEmail();?> </option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nombre" required/>
                                    </div>    
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" name="birthdate" placeholder="Fecha de nacimiento" required/>
                                </div>   
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required/>
                                </div>
                                <div class="form-group">
                                    <label>Rol</label>
                                    <select name="role" class="form-control" required>
                                            <option selected disabled value="">Rol de Usuario</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Comun</option>
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
    </div>
<?php } ?>


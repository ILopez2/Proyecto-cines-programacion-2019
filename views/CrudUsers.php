<?php
use daojson\JsonUser as JsonUser;
$dao = new JsonUser();
$users=$dao->getAll();
//var_dump($_SESSION);
    ?>


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
                            <a href="<?php echo FRONT_ROOT?>User/edit?id=<?php echo $value->getEmail()?>" class="btn btn-secondary">
                            <i class="fas fa-marker"></i>
                            </a>
                            <a href="<?php echo FRONT_ROOT?>User/delete?id=<?php echo $value->getEmail()?>" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                            </a>
                            <?php if($value->getRoleLevel() != 'Admin'){ ?>
                            <a href="<?php echo FRONT_ROOT?>User/setAdmin?id=<?php echo $value->getEmail()?>" class="btn btn-success">
                            <i class="fas fa-user-shield"></i>
                            </a>
                            <?php }
                            else{?>
                                <a href="<?php echo FRONT_ROOT?>User/setCommon?id=<?php echo $value->getEmail()?>" class="btn btn-danger">
                                <i class="fas fa-user-times"></i>
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
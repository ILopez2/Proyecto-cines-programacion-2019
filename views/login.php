<main class="login">

    <!-- LOGIN -->
    <form class="login-form bg-secondary" action="<?php echo FRONT_ROOT?>Home/Index" method="POST">
 
        <div class="form-group">
            <label><strong>Email</strong></label>
            <input type="email" class="form-control" name="email" placeholder="Ingrese su email" required />
        </div>
        
        <div class="form-group">
            <label><strong>Password</strong></label>
            <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña"required>
        </div>

        <div class="actions">

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sign-up">
            <i class="fas fa-user-plus"></i> Sign up
            </button>
            
            <button type="submit" class="btn btn-dark">
            <i class="fas fa-sign-in-alt"></i> Login
            </button>
        
        </div>


        <!-- Esto como si no existiera -->
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
       

    </form>


    <!-- SIGN UP -->
    <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form class="modal-content" action="<?php echo FRONT_ROOT?>Home/singUp" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Sing up</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre" required/>
                    </div>
                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" class="form-control" name="birthdate" placeholder="Fecha de nacimiento" max=" <?php echo $date; ?>" required/>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required/>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required/>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" onclick="clicked(event)">Registry</button>
                </div>
            </form>

        </div>
    </div>
</main>
<main class="login">

    <!-- LOGIN -->
    <form class="login-form" action="<?php echo FRONT_ROOT?>/Home/Index" method="POST">
 
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" />
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="actions">

            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#sign-up">
                Sign up
            </button>
            
            <button type="submit" class="btn btn-dark">
                Login
            </button>
        
        </div>


        <!-- Esto como si no existiera -->
        <?php if(isset($successMje) || isset($errorMje)) { ?>
            <div class="alert <?php if(isset($successMje)) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                <strong><?php if(isset($successMje)) echo $successMje; else echo $errorMje; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
       

    </form>


    <!-- SIGN UP -->
    <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form class="modal-content" action="sign-up.php" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Sing up</h5>
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

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark">Registry</button>
                </div>
            </form>

        </div>
    </div>
</main>
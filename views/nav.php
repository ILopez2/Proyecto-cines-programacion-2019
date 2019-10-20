<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">MoviePass</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if(isset($_SESSION['loggedPass']) && isset($_SESSION['loggedEmail'])){ 
           ?>
        
            <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'admin') {?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT?>Home/admCinema">Adm cines</a>
                </li>
            <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT?>Home/logout">Logout</a>
                </li>
            </ul>
        <?php } ?>
        <span class="navbar-text text-white">
            <strong> </strong>
        </span>
    </div>
</nav>
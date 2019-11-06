<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo FRONT_ROOT?>Views/Mhome">MoviePass</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if(isset($_SESSION['loggedPass']) && isset($_SESSION['loggedEmail'])){ 
           ?>
        
            <ul class="navbar-nav ml-auto">
            
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-1" role="group" aria-label="First group">
                    
                    <form action="<?php echo FRONT_ROOT?>Views/search" method="POST" class="form-inline">
                        
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" required>
                        
                        <button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="submit"><i class="fas fa-user-astronaut"></i> Search</button>
                    
                    </form>
                    </div>
                    <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin') {?>
                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-users-cog"></i> Administrar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>Views/admCinema"><i class="fas fa-film"></i> Cines</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>Views/admUsers"><i class="fas fa-user-cog"></i> Usuarios</a>
                        </div>
                    </div>
                    <?php } ?>
                        
                    </div>
                    <div class="btn-group" role="group" aria-label="Third group">
                        
                        <a class="btn btn-danger" href="<?php echo FRONT_ROOT?>Home/logout"  onclick="clicked(event)"><i class="fas fa-door-open"></i> </i>Logout </a>
                       
                    </div>
                </div>
                
             
            </ul>
        <?php } ?>
        <span class="navbar-text text-white">
            <strong> </strong>
        </span>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo FRONT_ROOT?>Home/index">MoviePass</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if( isset($_SESSION['userLogedIn'])){ ?>
        
            <ul class="navbar-nav ml-auto">
            
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-1" role="group" aria-label="First group">
                    
                    <form action="<?php echo FRONT_ROOT?>Views/searchForGen" method="POST" class="form-inline">
                        <!-- SEARCH BY GENRE STARTS HERE -->
                        <select class="form-control mr-sm-2" placeholder="Select" aria-label="Select" name="searchG" required>
                            <option value="" disabled selected >Selecciones un genero</option>
                            <?php foreach($genres as $gen){
                                echo "<option value=".$gen->getId().">".$gen->getName()."</option>";          
                            }?>
                        </select>    
                            
                        <button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="submit"><i class="fas fa-search"></i> Buscar</button>
                    
                    </form>
                    <!-- SEARCH BY GENRE ENDS HERE -->
                    <!-- SEARCH BY DATE STARTS HERE -->
                    </div>
                    <div class="btn-group mr-1" role="group" aria-label="Second group">
                    
                    <form action="<?php echo FRONT_ROOT?>Views/searchForDate" method="POST" class="form-inline">
                        <input type="date" name="searchF" min="<?php echo date("Y-m-d");?>" >
                        <button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="submit"><i class="fas fa-search"></i> Buscar</button>
                    </form>
                    </div>
                    <!-- SEARCH BY DATE ENDS HERE -->
                    <?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1') {?>
                    <div class="btn-group mr-2" role="group" aria-label="Third group">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-database"></i> BDD
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>MovieApi/getLastMoviesToDB">
                        <i class="fas fa-video"></i> Cargar peliculas
                        </a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>MovieApi/getAllGenresToDB">
                        <i class="fas fa-bookmark"></i> Cargar generos
                        </a>
                        </div>
                    </div>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Fourth group">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-users-cog"></i> Administrar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>Views/admTickets"><i class="fas fa-hand-holding-usd"></i> Tickets</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>Views/admCinema"><i class="fas fa-film"></i> Cines</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT?>Views/admUsers"><i class="fas fa-user-cog"></i> Usuarios</a>
                        </div>
                    </div>
                    <?php } ?>
                        
                    </div>
                    <div class="btn-group" role="group" aria-label="Fifth group">
                        
                        <a class="btn btn-danger" href="<?php echo FRONT_ROOT?>Home/logout"  onclick="clicked(event)"><i class="fas fa-door-open"></i> </i>Cerrar Sesion </a>
                       
                    </div>
                </div>
                
             
            </ul>
        <?php } ?>
        <span class="navbar-text text-white">
            <strong> </strong>
        </span>
    </div>
</nav>
<div class="container p=4">
    <H1>Seleccione sus asientos</h1> 
        <div class="row">
            <div class="col-m-4">
                <?php if(isset($_SESSION['successMje']) || isset($_SESSION['errorMje'])) { ?>
                    <div class="alert <?php if(isset($_SESSION['successMje'])) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                        <strong>
                        <?php if(isset($_SESSION['successMje'])) echo $_SESSION['successMje']; else echo $_SESSION['errorMje'];?>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                        <?php 
                            if(isset($_SESSION['successMje'])){unset($_SESSION['successMje']);}
                            if(isset($_SESSION['errorMje'])){unset($_SESSION['errorMje']);}
                        ?>
                    </div>
                <?php } ?>
            </div> 
        </div>
    <table class="table table-borderless table-dark">
        <thead>
            <tr>
                <th scope="col" colspan="100" class="table-primary" style = "text-align:center">LA PANTALLA ESTA AQUI</th>
            </tr>
        </thead>
    
        <tbody>
            <?php 
                $flag=true
            ?>
            <form action="<?php echo FRONT_ROOT;?>Views/buyTickets" method="POST" required>
            <?php
                if(!empty($seats)){
                    if(is_array($seats)){
                        $j=0;
                        while($flag==true){
            ?>
                        <tr> 
            <?php           
                            for($i=0;$i<10;$i++){
                                if(!empty($seats[$j])){
            
                                    if($seats[$j]->getOccupied()==false){                                
            ?>                              
                                    
                                    <td scope="row" >
                                        <label for="<?php echo $seats[$j]->getId();?>">
                                            <img src="http://img.fenixzone.net/i/R741tfz.png">
                                            <input type="hidden" name="functionId" value="<?php echo $functionId;?>">
                                            <input type="checkbox" name="seats[]" id="<?php echo $seats[$j]->getId();?>"value="<?php echo $seats[$j]->getId();?>"/>           
                                        </label>                      
                                    </td>
                                    
            <?php
                                        $j++;
                                    }
                                else{
            ?>
                                    <label>
                                        <td scope="row">                                      
                                            <img src="http://img.fenixzone.net/i/FtiZvkN.png">  
                                        </td>
                                    </label>
                                    
            <?php
                                    $j++;
                                }
                                }
                                else{
                                    $flag=false;
                                }
                            }
            ?> 
                        </tr> 
                        
                           
        </tbody>
            <?php
                        }
            ?>
            <?php
                    }
                }
            ?>      
    </table>
    
    <input type="submit" class="btn btn-success btn-block" value="Proceder con la compra">
</form>
</div>
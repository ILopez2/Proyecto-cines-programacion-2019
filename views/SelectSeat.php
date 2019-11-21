<div class="container p=4">
    <H1>Seleccione sus asientos</h1>  
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
                                if($seats[$j]!=null){
            
                                    if($seats[$j]->getOccupied()==false){                                
            ?>                              
                                    
                                    <td scope="row" >
                                        <label for="<?php echo $seats[$j]->getId();?>">
                                            <img src="http://img.fenixzone.net/i/R741tfz.png">
                                            <input type="checkbox" name="seats[]" id="<?php echo $seats[$j]->getId();?>"value="<?php echo $seats[$j]->getId();?>"/>                  
                                            <input type="hidden" name="functionId" value="<?php echo $functionId;?>">
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
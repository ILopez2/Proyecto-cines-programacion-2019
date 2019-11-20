<div class="container p=4">
    <H1>Seleccione sus asientos</h1>  
    <table class="table table-borderless table-dark">
        <thead>
            <tr>
                <th scope="col" colspan="100" class="table-error" style = "text-align:center">LA PANTALLA ESTA AQUI</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $flag=true
            ?>
            <form action="Views/buyTicket" method="POST">
            <?php
                if(!empty($seats)){
                    if(is_array($seats)){
                        $j=0;
                        while($flag==true){
            ?>
                        <tr> 
            <?php           
                            for($i=0;$i<15;$i++){
                                if($seats[$j]!=null){
            
                                    if($seats[$j]->getOccupied()==false){                                
            ?>
                                        <td>
                                        <label for="<?php echo $seats[$j]->getId();?>">
                                            <img src="http://img.fenixzone.net/i/R741tfz.png">
                                            <input type="checkbox" name="seats[]" id="<?php echo $seats[$j]->getId();?>"value="<?php echo $seats[$j]->getId();?>"/>
                                        </label>
                                        <td>
            <?php
                                        $j++;
                                    }
                                else{
            ?>
                                    <td>
                                        <img src="http://img.fenixzone.net/i/FtiZvkN.png">
                                    </td>
            <?php
                                }
                                }
                                else{
                                    $flag=false;
                                }
                            }
            ?> 
                        </tr> 
                        
                           
        </tbody>
                    <input type="submit" class="btn btn-success btn-block" value="Proceder con la compra">
            </form>
            <?php
                        }
                    }
                }
            ?>
        
    </table>
</div>
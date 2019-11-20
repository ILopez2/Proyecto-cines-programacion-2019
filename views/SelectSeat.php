<div class="container p=4">
    <H1>Seleccione sus asientos</h1>  
    <table class="table table-borderless table-dark">
        <thead>
            <tr>
                <th scope="col" colspan="4" class="table-success" style = "text-align: center"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $flag=true
            ?>
            <form>
            <?php
                if(!empty($seats)){
                    if(is_array($seats)){
                        while($flag==true){
            ?>
                        <tr> 
            <?php
                            for($i=0;$i<15;$i++){
                                if($seats[$j]!=null){
            
                                    if($seats[$j]->getOccupied==false){                                
            ?>
                                        <td>
                                            <img src="<?php echo IMG_PATH."seat-open.png"?>">
                                            <input type="checkbox" name="seats[]" value="<?php echo $seats[$j]->getId();?>"/>
                                        <td>
            <?php
                                        $j++;
                                    }
                                    else{
            ?>
                                        <td>
                                            <img src="<?php echo IMG_PATH."seat-occupied.png"?>">
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
                        <input type="submit" class="btn btn-success btn-block">
            </form>
            <?php
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>
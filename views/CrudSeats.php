<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
<div class="container p=4">
    <h1 class="mb-5">Asientos de la funcion seleccionada</h1>
    <div class="col-m-8">
         <table class="table table-bordered table-dark">
            <thead class="thead-dark">
                <tr>
                    <th>Numero asiento</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($seatNumberOccupied)){
                $i=0;            
                    for($i=0;$i<count($seatNumberOccupied);$i++){ 
                        
            ?>          
                        <tr >
                        <td class="table-dark"><?php echo $seatNumberOccupied[$i]["seatNumber"]; ?></td>
                        
                        <td class="table-dark"><?php 
                        if($seatNumberOccupied[$i]["occupied"]==true){
                            echo "Ocupada";
                        }
                        else echo "Desocupada";
                                                ?>
                        
                        </td>
                        </tr>
            <?php    
                    }
            }
            ?>
</div>

<?php } ?>
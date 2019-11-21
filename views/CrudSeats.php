<?php if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){?>
<div class="container p=4">
    <h1 class="mb-5">Estadisticas de la funcion seleccionada</h1>
    <div class="col-m-8">
         <table class="table table-bordered table-dark">
            <thead class="thead-dark">
                <tr>
                    <th class="bg-success"colspan=2>CANTIDAD DE ENTRADAS VENDIDAS DE ESTA FUNCION: <?php echo $ticketsSold;?> ENTRADAS</th>
                </tr>
                <tr>
                    <th class="bg-danger" colspan=2>CANTIDAD DE ENTRADAS REMANENTES DE ESTA FUNCION: <?php echo $ticketsNotSold;?> ENTRADAS</th>
                </tr>
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
            </tbody>
        </table>
    </div>
</div>

<?php } ?>
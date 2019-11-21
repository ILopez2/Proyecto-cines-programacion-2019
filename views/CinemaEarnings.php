<div class="container">
    <h1 class="mb-5">Ventas del cine <?php echo $cinemaName?></h1>
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
    
    <div class="col-m-8">
        <table class="table table-bordered table-dark">
            <thead class="thead-dark">
                <tr>
                    <th class="bg-success"colspan=2>MONTO TOTAL GANADO POR EL CINE: <?php echo $totalEarning;?>$</th>
                </tr>
                <tr>
                    <th>Usuario</th>
                    <th>Cantidad de entradas</th>
                    <th>Monto pagado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(is_array($purchases)){
                    foreach($purchases as $purchase){
                ?>
                    <tr>
                        <td class="table-dark"><?php echo $daoUser->getForID($purchase->getIdUser())->getName()?></td>
                        <td class="table-dark"><?php echo $purchase->getQuantityTicket()?></td>
                        <td class="table-dark"><?php echo $purchase->getTotal()?></td>
                    </tr>
                <?php
                    }
                }
                else{
                    ?>
                    <tr>
                        <td class="table-dark"><?php echo $daoUser->getForID($purchases->getIdUser())->getName()?></td>
                        <td class="table-dark"><?php echo $purchases->getQuantityTicket()?></td>
                        <td class="table-dark"><?php echo $purchases->getTotal()?></td>
                    </tr>
        <?php   }?>
            </tbody>
        </table>
    </div>
</div>
<div class="container">
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

    <div class="container">                        
        <form action="<?php echo FRONT_ROOT;?>Purchase/createPurchase" method="POST">
        <section class="jumbotron">
            <div style = "text-align: center">
            <h1>Continuando con tu compra...  </h1>
                <img class="figure-img img-fluid rounded" src="<?php  echo $poster;?>" >
            </div>
        </section>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col" colspan="4" class="table-success" style ="hidden-align: center">Detalles de la Compra</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">Nombre de la Sala</th>
                <td colspan="3"><?php echo $roomName;?></td>
                </tr>
                <tr>
                <th scope="row">Cantidad de Asientos</th>
                <td colspan="3"><?php  echo $quantityTickets;?></td>
                </tr>
                <tr>
                <th scope="row">Numeros de asientos</th>
                <td colspan="3"><?php foreach($seats as $seat){echo $seat->getNumber()." ";}?></td>
                </tr>
                <tr>
                <th scope="row">Fecha y Hora</th>
                <td colspan="3"><?php echo "Fecha: ".$fDate."<br> Hora: ".$fTime;?></td>
                </tr>
                <tr class="alert-warning">
                <th scope="row" >Total a Pagar</th>
                <td colspan="3" ><?php echo $totalPrice;?></td>
                </tr>
            </tbody>
            </table>
                <input type="hidden" value="<?php echo $roomName;?>" disabled>
                <input type="hidden" value="<?php echo $quantityTickets;?>" disabled>    
                <input type="hidden" value="<?php echo $totalPrice;?>" disabled>
                <input type="hidden" value="<?php echo $userId;?>" disabled>
                <input type="hidden" value="<?php echo $fTime;?>" disabled>
                <input type="hidden" value="<?php echo $discount;?>" disabled>

                <script 
                    src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                    data-public-key="TEST-5c961a4f-a387-41e4-b1d1-6f307a001f31"
                    data-transaction-amount="<?php echo $totalPrice;?>"
                    data-header-color="#8e44ad"
                    data-elements-color="#8e44ad"
                    data-button-label="Pay">
                </script>
        
        </form>
    </div>

</div>
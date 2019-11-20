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
                        
                        <input type="text" value="<?php echo $poster;?>" disabled>
                        <input type="text" value="<?php echo $quantityTicket;?>" disabled>    
                        <input type="text" value="<?php echo $total;?>" disabled>
                        <input type="text" value="<?php echo $dateTime;?>" disabled>
                        <input type="text" value="<?php echo $discount;?>" disabled>


                        <script src="https://www.mercadopago.com.ar/integrations/v1/web-tokenice-checkout.js" 
                                data-public-key="TEST-53a5d89b-a78c-4cb9-b6de-7a3c32560c47" 
                                data-transaction-amount="<?php echo $total;?>" 
                                data-header-color="#8e44ad" 
                                data-elements-color="#8e44ad" 
                                data-button-label="Pay">
                        </script>
        </form>
    </div>

</div>
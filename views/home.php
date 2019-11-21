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
    <section class="jumbotron">
		<div class="container">
			<h1>MoviePass</h1>
			<h3>Cartelera</h3>
		</div>
    </section>
    <table border=1 class="table jumbotron">
        <thead class="thead-dark">
            <tr>
                <th>Movie</th>
                <th>Poster</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($array)){
                foreach($array as $movie) {  ?>
                <tr>
                    <td><?php echo $movie->getTitle(); ?></td>
                    <td>
                        <a href="<?php echo FRONT_ROOT?>Views/viewFunctions?id=<?php echo $movie->getId()?>"><img class="figure-img img-fluid rounded" src="<?php echo $dao->getMoviePoster($movie->getPosterPath()); ?>" alt=""></a> 
                    </td>
                </tr>
            <?php } }?>
        </tbody>
    </table>
</div>

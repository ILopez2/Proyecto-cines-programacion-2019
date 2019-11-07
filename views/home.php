<?php 

    use controllers\MovieApiController as MovieApiController;
    $dao = new MovieApiController();

    $array = $dao->getLastMovies(ESP);

?>

<div class="container">
<section class="jumbotron">
		<div class="container">
			<h1>MoviePass</h1>
			<p>Ultimos lanzamientos</p>
		</div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        <?php $i=0; 
            foreach($array as $movie){  ?>
            <div class="carousel-item<?php if($i==0) echo' active';?>">
                <img src="<?php echo $dao->getMoviePoster($movie->getPosterPath()); ?>" class="d-block w-25" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5><?php echo $movie->getTitle(); ?></h5>
                </div>
            </div> 
        <?php $i=1; }?>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
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
                <?php foreach($array as $movie){  ?>
                <tr>
                    <td><?php echo $movie->getTitle(); ?></td>
                    <td>
                    <a href="<?php echo FRONT_ROOT?>Views/viewFunctions?id=<?php echo $movie->getId()?>"><img class="figure-img img-fluid rounded" src="<?php echo $dao->getMoviePoster($movie->getPosterPath()); ?>" alt=""></a> 
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

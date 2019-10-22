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
                    <figure class="figure">
                        <img class="figure-img img-fluid rounded" src="<?php echo $dao->getMoviePoster($movie->getPosterPath()); ?>" alt="">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                    </figure>
                    
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<?php 

    use controllers\MovieApiController as MovieApiController;
    use dao\MovieFunctionDao as MovieFunctionDao;
    $dao = new MovieApiController();
    $daoF = new MovieFunctionDao();

    $functions=$daoF->getAll();
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
                <?php foreach($array as $movie){  
                    if($daoF->getForID($movie->getId())){?>
                        <tr>
                        <td><?php echo $movie->getTitle(); ?></td>
                        <td>
                        <a href="<?php echo FRONT_ROOT?>Views/viewFunctions?id=<?php echo $movie->getId()?>"><img class="figure-img img-fluid rounded" src="<?php echo $dao->getMoviePoster($movie->getPosterPath()); ?>" alt=""></a> 
                        </td>
                    </tr>        
                
                
                <?php }
                } ?>
        </tbody>
    </table>
</div>

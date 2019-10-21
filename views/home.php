<?php 

    use controllers\MovieApiController as MovieApiController;
    $dao = new MovieApiController();

    $array = $dao->getLastMovies(ESP);

?>

<table border=1 class="table">
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
                    <td><img src="<?php echo $dao->getMoviePoster($movie->getPosterPath()); ?>" alt=""></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
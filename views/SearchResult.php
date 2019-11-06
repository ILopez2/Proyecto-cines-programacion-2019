<?php 

    use controllers\MovieApiController as MovieApiController;

    $search = new MovieApiController();

    $result=$search->getLastMovies(ESP);
    
?>
<div class="container">
    <table border=1 class="table jumbotron">
        <thead class="thead-dark">
                <tr>
                    <th>Movie Name</th>
                    <th>Poster</th>
                    
                </tr>
            </thead>
            <tbody>
                    <?php foreach($result as $value){ ?>
                    <tr>
                        <td>
                        <?php foreach($value->getGenres() as $gen){
                                    if($gen==$searchG){
                                        
                                    $value->getTitle();?></td>
                                    <td>

                                        <figure class="figure">
                                            <img class="figure-img img-fluid rounded" src="<?php echo $search->getMoviePoster($value->getPosterPath()); ?>" alt="">
                                        </figure>

                                    </td>
                                </tr>
                            <?php } ?> 
                        <?php } ?> 
                    <?php } ?>  
            </tbody>
            </table>        
</div>
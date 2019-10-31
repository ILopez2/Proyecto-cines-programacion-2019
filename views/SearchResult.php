<?php 

    use controllers\MovieApiController as MovieApiController;

    $search = new MovieApiController();

    $result=$search->getMovie($searchResult,ESP);
    
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
                        <td><?php echo $value->getTitle();?></td>
                        <td>

                            <figure class="figure">
                                <img class="figure-img img-fluid rounded" src="<?php echo $search->getMoviePoster($value->getPosterPath()); ?>" alt="">
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>

                        </td>
                    </tr>
                    <?php } ?>  
            </tbody>
            </table>        
</div>
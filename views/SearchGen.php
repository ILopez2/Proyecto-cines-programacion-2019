<div class="container">
    <table border=1 class="table jumbotron">
        <thead class="thead-dark">
                <tr>
                    <th>Pelicula</th>
                    <th>Poster</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach($result as $value){ ?>
                        <?php 
                            foreach($value->getGenres() as $gen){
                            
                            if($gen == $searchG){?>
                            <tr>
                            <td>
                                <?php echo $value->getTitle();?>
                            </td>
                            <td>
                                
                            <a href="<?php echo FRONT_ROOT?>Views/viewFunctions?id=<?php echo $value->getId()?>"><img class="figure-img img-fluid rounded" src="<?php echo $daoMovie->getMoviePoster($value->getPosterPath()); ?>" alt=""></a>
                                
                            </td>
                                </tr>
                            <?php } ?> 
                        <?php } ?> 
                    <?php } ?>  
            </tbody>
            </table>        
</div>
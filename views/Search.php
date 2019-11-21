<div class="container">
    <table border=1 class="table jumbotron">
        <thead class="thead-dark">
            <tr>
                <th>Pelicula</th>
                <th>Poster</th>
            </tr>
        </thead>
        <tbody>           
                <?php foreach($movies as $value){ ?>
                        <tr>
                            <td>
                                <?php echo $value->getTitle();?>
                            </td>
                            <td>   
                                <a href="<?php echo FRONT_ROOT?>Views/viewFunctions?id=<?php echo $value->getId()?>"><img class="figure-img img-fluid rounded" src="<?php echo $daoM->getMoviePoster($value->getPosterPath()); ?>" alt=""></a> 
                            </td>
                        </tr>
                <?php } ?>  
        </tbody>
    </table>        
</div>
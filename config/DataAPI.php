<?php
    /*API KEY*/
    define("APIKEY","?api_key=934e435260635d2b56c3426a0d54dac4");
    /*PAGINA PRINCIPAL*/
    define("PAGE","https://api.themoviedb.org");
    /*IDIOMA ESPAÑOL*/
    define("ESP","&language=es-ES");
    /*IDIOMA INGLES*/
    define("ENG","&language=en-EN");

    /*ESTE ES EL LINK PARA OBTENER LAS PELICULAS QUE ESTAN EN CARTELERA 
    CUANDO SE LO USA HAY QUE CONCATENARLE EN LENGUAJE DESEADO
    EJEMPLO: LASTMVS.ENG */
    define("LASTMVS",PAGE."/3/movie/now_playing".APIKEY);

    /*ESTE ES EL LINK PARA BUSCAR UNA PELICULA POR NOMBRE,
    CUANDO SE LO USA SE DEBE CONCATENARLE EL NOMBRE DE LA PELICULA REMPLAZANDO
    LOS ESPACIOS POR EL SIGNO "+" Y LUEGO LA CONSTANTE DEL LENGUAJE QUE SE DESEA
    EJEMPLO: SERCHM.Lilo+&+Stitch.ENG*/
    define("SERCM",PAGE."/3/search/movie".APIKEY."&query=");

    /*ESTE ES EL LINK PARA BUSCAR UNA PELICULA POR ID, SE LE TIENE QUE 
    CONCATENAR EL ID DE LA PELICULA QUE SE QUIERE BUSCAR LUEGO EL API KEY Y
    POR ULTIMO EL LENGUAJE QUE SE DESEA
    EJEMPLO: SERCHMID."5".APIKEY.ESP */
    define("SERCHMID",PAGE."/3/movie/");

    /*ESTE LINK ES PARA BUSCAR LA IMAGEN DE UNA PELICULA SE LE DEBE CONCATENAR EL TAMAÑO DE LA IMAGEN
    (ALGUNOS VALORES NO LOS PERMITE) Y LUEGO UNA BARRA Y POR ULTIMO EL "POSTER PATH" QUE ESO ESTA
    EN EL JSON DE CADA PELICULA
    EJEMPLO: IMGM."500"."/".kqjL17yufvn9OVLyXYpvtyrFfak.jpg */
    define("IMGM","https://image.tmdb.org/t/p/w");

    /*ESTE LINK SIRVE PARA TRAER UN ARREGLO CON TODOS LOS GENEROS,TRAE EL ID Y EL NOMBRE DE CADA UNO
    AL FINAL SE LE DEBE CONCATENAR LA CONSTANTE DEL LENGUAJE DESEADO
    EJEMPLO: GEN.ENG */
    define("GEN",PAGE."/3/genre/movie/list".APIKEY);
?>
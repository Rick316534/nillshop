<?php

    $link=@mysqli_connect(
        'localhost',
        'nill',
        '1234',
        'shoppingNetwork'
    );
    if(!$link){
        die("error connecting");
    }else{
        return $link;
    }
    mysqli_close($link);
    
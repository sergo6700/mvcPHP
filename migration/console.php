<?php

function create($folder,$param){

    $migrateFile = time().'_'.$param;//
    $migrate = fopen("date_migration/{$folder}/{$migrateFile}.php", 'a') or die('Can not create file'. $migrateFile);
    $data = fopen('tmp/thamplate.txt', 'r');
    $string = "";
    while (!feof($data)){
        $string .= fgetc($data);
    }

    $className = str_replace('{classname}', $param, $string);

    fwrite($migrate, $className);

}


create($argv[1],$argv[2]);

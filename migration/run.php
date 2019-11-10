<?php

function listdir_by_date($path){
    $dir = opendir('date_migration/'.$path);
    $list = array();
    while($file = readdir($dir)){
        if ($file != '.' && $file != '..' && $file[strlen($file)-1] != '~' ){
            $ctime = filectime( 'date_migration/'.$path . '/' . $file );
            $list[$ctime] = $file;
        }
    }
    closedir($dir);
    krsort($list);
    return $list;
}

function run($folder, $command){
    $fileArray = [];
    $list = listdir_by_date($folder);
    foreach ($list as $k => $v){
        array_push($fileArray,$v);
    };
    include 'date_migration/'.$folder."/".$fileArray[0];
    $newMigration = new $command;
    if (method_exists($newMigration, 'up')){
        $newMigration->up();
    }
    else{
        echo 'function no faound';
    }
}
run($argv['1'], $argv['2']);

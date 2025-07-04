<?php
    require_once 'logic.php';
    require_once 'dbManager.php';

    $res = parseLine(readline());

    updateBD($res);

    for ($i = 0; $i < count($res); $i++){
        echo $res[$i] . "\n";
    }
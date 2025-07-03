<?php
    require_once 'logic.php';

    $res = parseLine(readline());


    for ($i = 0; $i < count($res); $i++){
        echo $res[$i] . "\n";
    }
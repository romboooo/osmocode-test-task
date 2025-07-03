<?php
    require_once 'logic.php';

    $res = parseLine(readline());


    echo "Result: \n";
    for ($i = 0; $i < count($res); $i++){
        echo $res[$i] . "\n";
    }
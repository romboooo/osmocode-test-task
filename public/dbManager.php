<?php

    function connectToDB(){
        $config = require __DIR__ . '/config.php';

        $servername = $config['db']['host'];
        $dbname = $config['db']['dbname'];
        $username = $config['db']['username'];
        $password = $config['db']['password'];
        
        try{
            $dsn = "mysql:host=" . $servername . ';dbname=' . $dbname;
            $dbh = new PDO($dsn,$username,$password);
        }catch (Exception $e){
            $e->getMessage();
        }
        return $dbh;
    }
    function updateBD($array):void{
        $db = connectToDB();

        $query = "insert into bars (bar) values (?)";  
        $stmt = $db->prepare($query);
        try{
            foreach($array as $curr){
                $stmt->execute([$curr]);
            }
        }catch (Exception $e){
            $e->getMessage();
        }

        $db = null;

    }

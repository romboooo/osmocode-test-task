<?php

    function connectToDB(){
        $config = require __DIR__ . '/config.php';

        $servername = $config['db']['host'];
        $dbname = $config['db']['dbname'];
        $username = $config['db']['username'];
        $password = $config['db']['password'];
        
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=osmocode_task_db',$username,$password);
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

        $query = "select * from bars;";

        try{
            $out = $db->prepare($query);
            $out->execute();
            $result = $out->fetchAll();
            print_r($result);
        } catch (Exception $e){
            $e->getMessage();
        }

        $db = null;

    }

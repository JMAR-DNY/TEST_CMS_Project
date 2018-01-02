<?php

/* creates new PDO connection to database
specified in dbinfo.ini*/
function connect(){

$db = parse_ini_to_array();

    try {
    $handler = new PDO('mysql:host='.$db['host'].'; dbname='.$db['database'], $db['user'], $dbPassword = $db['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
    echo $e->getMessage().'<br>';
    //die ('Database Error');
    $handler = NULL;
    }

    return $handler;
}

/*This function is to allow access to connection info for other  database functions
so that only dbinfo.ini needs to be changed when managing connections*/
function parse_ini_to_array(){
    $db = parse_ini_file("../config/dbInfo.ini");
  
    $database = $db['database'];
    $dbHost = $db['dbHost'];
    $dbUser = $db['dbUser'];
    $dbPassword = $db['dbPassword'];
  
    return array('database' => $database, 'host'=> $dbHost,
     'user'=> $dbUser, 'password' => $dbPassword);
  }
  



?>
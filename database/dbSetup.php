<?php

include 'dbUtilities.php';

$connection = connect();

$databaseInfo = parse_ini_to_array();
$database = $databaseInfo['database'];//need to replicate to grab other info to create database

//SET the Messages to one variable maybe session which can be displayed in textbox
//USE parse_ini_to_array to retrieve database info to drop database and create
//make this whole script into a function which can be called on submit on admin panel
// https://www.w3schools.com/php/php_mysql_create.asp
//USE multiple table creation functionality from CART app
//Lookup create tables with foreign keys to relate the projects to project updates
//$connection->query('DROP DATABASE IF EXISTS ');



$connection->query('DROP TABLE IF EXISTS mytable');
//$query = $handler->query('SELECT * FROM mytable' LIMIT 0);//will set a limit on selects

$mysql = "CREATE TABLE mytable (
  eventID INT NOT NULL AUTO_INCREMENT,
  eventTitle VARCHAR(255),
  eventLocation VARCHAR(150),
  eventTime VARCHAR(10),
  PRIMARY KEY (eventID)
  )";
create_table($mysql, $connection);





$connection = NULL;//close connection



function create_table($mysql, $connection){
  $query = $connection->prepare($mysql);
  if ($query->execute() === TRUE) {
    echo "mytable created successfully";
  } else {
    echo "\n error Info: \n";
    print_r($connection->errorInfo());//outputs error code
  }
}

?>
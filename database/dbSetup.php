<?php

require 'dbUtilities.php';

$connection = connect();
$databaseInfo = parse_ini_to_array();
$database = $databaseInfo['database'];//need to replicate to grab other info to create database

//USE parse_ini_to_array to retrieve database info to drop database and create
//make this whole script into a function which can be called on submit on admin panel


$connection->query('DROP TABLE IF EXISTS mytable');
//$query = $handler->query('SELECT * FROM mytable' LIMIT 0);//will set a limit on selects

$mysql = "CREATE TABLE mytable (
  eventID INT NOT NULL AUTO_INCREMENT,
  eventTitle VARCHAR(255),
  eventLocation VARCHAR(150),
  eventTime VARCHAR(10),
  PRIMARY KEY (eventID)
  )";

$query = $connection->prepare($mysql);


if ($query->execute() === TRUE) {
  echo "mytable created successfully";
} else {
  echo "\n error Info: \n";
  print_r($connection->errorInfo());//outputs error code
}
$connection = NULL;//close connection


?>
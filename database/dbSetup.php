<?php

include 'dbUtilities.php';

$db = parse_ini_to_array();
$database = $db['database'];

$connection = connect();

if (isset($connection)){
$connection->query('DROP DATABASE IF EXISTS '.$database);
echo "Database $database erased<br>";
}


  try {
    $connection = new PDO('mysql:host='.$db['host'].';' , $db['user'], $dbPassword = $db['password']);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE ". $database;
    // use exec() because no results are returned
    $connection->exec($sql);
    echo "Database $database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

//SET the Messages to one variable maybe session which can be displayed in textbox
//USE parse_ini_to_array to retrieve database info to drop database and create
//make this whole script into a function which can be called on submit on admin panel
// https://www.w3schools.com/php/php_mysql_create.asp
//USE multiple table creation functionality from CART app
//Lookup create tables with foreign keys to relate the projects to project updates
//$connection->query('DROP DATABASE IF EXISTS ');


$connection = connect();

$connection->query('DROP TABLE IF EXISTS mytable');
//$query = $handler->query('SELECT * FROM mytable' LIMIT 0);//will set a limit on selects

$mysql = "CREATE TABLE projects (
  projectID INT NOT NULL AUTO_INCREMENT,
  projectTitle VARCHAR(255),
  projectDesc VARCHAR(255),
  projectSlug VARCHAR(255),
  projectURL VARCHAR(255),
  projectImage VARCHAR(255),
  projectCreatedAt TIMESTAMP,
  projectUpdatedAt TIMESTAMP,
  PRIMARY KEY (projectID)
  )";
create_table($mysql, $connection);

$mysql = "CREATE TABLE projects_updates (
  updateID INT NOT NULL AUTO_INCREMENT,
  projectID INT,
  updateTitle VARCHAR(255),
  updateArticle TEXT,
  updateImage VARCHAR(255),
  updateDate TIMESTAMP,
  PRIMARY KEY (updateID),
  FOREIGN KEY (projectID) REFERENCES projects(projectID)
  )";
create_table($mysql, $connection);



$connection = NULL;//close connection



function create_table($mysql, $connection){
  $query = $connection->prepare($mysql);
  if ($query->execute() === TRUE) {
    echo "table created successfully<br>";
  } else {
    echo "\n error Info: \n";
    print_r($connection->errorInfo());//outputs error code
  }
}

?>
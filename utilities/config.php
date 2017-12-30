<?php

//Input database info here
$database = "";
$dbHost = "";
$dbUser ="";
$dbPassword = "";



try {
  $handler = new PDO('mysql:host='.$dbHost.'; dbname='.$database, $dbUser, $dbPassword);
  $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo $e->getMessage();
  die ('Database Error');
}

$query = $handler->query('SELECT * FROM mytable');

while($row = $query->fetch()){
  echo $row['message'], '<br>';
}
//$handler = new PDO('mysql:host=localhost; dbname=jmardny_529Design', 'jmardny_admin', 'H0lySh1tD4mn');


?>

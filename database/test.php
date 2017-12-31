<?php

$db = parse_ini_file("../config/dbInfo.ini");

$database = $db['database'];
$dbHost = $db['dbHost'];
$dbUser = $db['dbUser'];
$dbPassword = $db['dbPassword'];

try {
  $handler = new PDO('mysql:host='.$dbHost.'; dbname='.$database, $dbUser, $dbPassword);
  $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo $e->getMessage();
  die ('Database Error');
}

//creates new query 
//$query = $handler->query('SELECT * FROM mytable');

//Loops through table

/*
while($row = $query->fetch()){//fetch() is equivalent to fetch(PDO::FETCH_BOTH)
  echo $row['message'], '<br>';
}
*/

//PDO::FETCH_NUM returns array with numeric values
//PDO::FETCH_ASSOC returns associative arrat with columnn headers and values at row
//PDO::FETCH_OBJ returns object

// '<pre>', print_r($r), '</pre>'; //pre tags will act as BR values when printing array

/*
while($row = $query->fetch(PDO::FETCH_OBJ)){//fetch() is equivalent to fetch(PDO::FETCH_BOTH)
  echo $row->message, '<br>';//directly access table property of anonymous object
}
*/

//FESTCH AS CLASS
class testClass {
  public $ID, $name, $message, $created,
        $entry;//not in table

  public function __construct(){//instantiated each time fetch runs
    $this->entry = "{$this->name} posted: {$this->message}";
  }
}

$query = $handler->query('SELECT * FROM mytable');

$query->setFetchMode(PDO::FETCH_CLASS, 'testClass');

while($row = $query->fetch()){
  //echo '<pre>', print_r($row), '</pre>';
  echo $row->entry , '<br>';
}

//fetchAll -> this grabs all data without needing a while loop
/*
$query = $handler->query('SELECT * FROM mytable');
$results = $query->fetchALL(PDO::FETCH_ASSOC);

if(count($results)){
  echo 'There are results.';
}else{
  echo 'There are no results.';
}
*/

//prepared statement -> abstracts values from query to prevent against attacks

//UNPREPARED
/*
$name = 'dudeman';
$message = 'howdy';

$sql = "INSERT INTO mytable(name, message, created) VALUES ({$name},{$message}, NOW())";
$handler->query($sql);
*/


//PREPARED STATEMENTS
$name = 'dudeman';
$message = 'howdy';

$sql = "INSERT INTO mytable(name, message, created) VALUES (?,?, NOW())";
$query = $handler->prepare($sql);
$query->execute(array($name, $message));
//first ? bound to first array value etc.  
//could also have :message then set array values 
//array(
// ':name => $name, //etc....
//)
//$handler = new PDO('mysql:host=localhost; dbname=jmardny_529Design', 'jmardny_admin', 'H0lySh1tD4mn');
echo $handler->lastInsertId(); //pulls last inserted ID value


//LOOP BY ROWCOUNT
$query = $handler->query('SELECT * FROM mytable');
//$query = $handler->query('SELECT * FROM mytable' LIMIT 0);//will set a limit on selects
if($query->rowCount()){
  while($row =$query->fetch(PDO::FETCH_OBJ)){
    echo $row->message, '<br>';
  }
}else{
  echo 'No results';
}
//else statement with rowcount here allows cleaner handling 
//if there are no results
?>

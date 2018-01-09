<?php
//contains project class info

include '../database/dbUtilities.php';
/*
 projectTitle VARCHAR(255),
  projectDesc VARCHAR(255),
  projectSlug VARCHAR(255),
  projectCategory VARCHAR(255),
  projectURL VARCHAR(255),
  projectImage VARCHAR(255),
  */
class project{

    protected $projectID;
    protected $projectTitle;
    protected $projectDesc;
    protected $projectSlug; 
    protected $projectCategory;
    protected $projectURL; 
    protected $projectImage;
    protected $projectCreatedAt;
    protected $projectUpdatedAt; 

public function __construct($data=array()){
    if ( isset( $data['projectID'])) $this->projectID = $data['projectID'];
    if ( isset( $data['projectTitle'])) $this->projectTitle = $data['projectTitle'];
    if ( isset( $data['projectDesc'])) $this->projectDesc = $data['projectDesc'];
    if ( isset( $data['projectSlug'])) $this->projectSlug = $data['projectSlug'];
    if ( isset( $data['projectCategory'])) $this->projectCategory = $data['projectCategory'];
    if ( isset( $data['projectURL'])) $this->projectURL = $data['projectURL'];
    if ( isset( $data['projectImage'])) $this->projectImage = $data['projectImage'];
    if ( isset( $data['projectCreatedAt'])) $this->projectCreatedAt = $data['projectCreatedAt'];
    if ( isset( $data['projectUpdatedAt'])) $this->projectUpdatedAt = $data['projectUpdatedAt'];
}

public function testOutput(){
    echo  $this->projectTitle; 
}

/* CREATE - inserts a project into the projects table in the database */
public function create(){
    $connection = connect();

    $sql = "INSERT INTO projects (projectTitle, projectDesc, projectSlug, 
    projectCategory, projectURL, projectImage, projectCreatedAt, projectUpdatedAt)
    VALUES (:projectTitle, :projectDesc, :projectSlug, :projectCategory, :projectURL,
    :projectImage, :projectCreatedAt, :projectUpdatedAt)";

    $query = $connection->prepare($sql);

    $query->bindValue(":projectTitle", $this->projectTitle, PDO::PARAM_STR);
    $query->bindValue(":projectDesc", $this->projectDesc, PDO::PARAM_STR);
    $query->bindValue(":projectSlug", $this->projectSlug, PDO::PARAM_STR);
    $query->bindValue(":projectCategory", $this->projectCategory, PDO::PARAM_STR);
    $query->bindValue(":projectURL", $this->projectURL, PDO::PARAM_STR);
    $query->bindValue(":projectImage", $this->projectImage, PDO::PARAM_STR);
    $query->bindValue(":projectCreatedAt", date("Y/m/d"));
    $query->bindValue(":projectUpdatedAt", date("Y/m/d"));
   
    $query->execute();

    $connection=NULL;  
}
//END CREATE *********************************************

/* READ - reads one project by input ID*/
public static function read($id){
    $connection = connect();

    $sql = "SELECT * FROM projects WHERE projectID =$id";
    $query = $connection->prepare($sql);

    $query->bindValue( ":projectID", $id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch();
    $connection = NULL;
    if ($row) return new project($row);
}
//END READ *************************************************

public function update(){
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE articles SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:title, summary=:summary, content=:content WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
}



}






?>
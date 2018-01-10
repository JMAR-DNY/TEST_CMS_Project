<?php
//contains project class info//////////////////////////////

include '../database/dbUtilities.php';

class project{

    protected $projectID, $projectCreatedAt;
    public $projectTitle, $projectDesc, $projectSlug, 
    $projectURL, $projectImage, $projectUpdatedAt; 

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

/* storeFormValues - used to pass post values through to constructor */
  public function storeFormValues ( $params ) {

    $this->__construct( $params );
  }
//END StoreFormValues ******************************************

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

/* ReadMany - reads multiple rows*/
public static function readMany($order="projectUpdatedAt DESC"){
    $connection = connect();
    $sql = "SELECT * FROM projects
            ORDER BY " . $order;

    $query = $connection->prepare($sql);
    //$query->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $query->execute();
    $list = array();

    while ( $row = $query->fetch() ) {
        $project = new Project( $row );
        $list[] = $project;
      }

      $sql = "SELECT FOUND_ROWS() AS totalRows";
      $totalRows = $connection->query( $sql )->fetch();
      $connection = NULL;
      return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
}
//END READMANY ************************************************

/*UPDATE - updates a project in the projects database */
public function update(){
    if ( is_null( $this->projectID ) ) trigger_error ( "ID not set", E_USER_ERROR );

    $connection = connect();
    $sql = "UPDATE projects SET projectTitle=:projectTitle, projectDesc=:projectDesc, 
    projectSlug=:projectSlug, projectCategory=:projectCategory, projectURL=:projectURL,
    projectImage=:projectImage, projectUpdatedAt=:projectUpdatedAt WHERE projectID = $this->projectID";
    $query = $connection->prepare($sql);
    $query->bindValue(":projectTitle", $this->projectTitle, PDO::PARAM_STR);
    $query->bindValue(":projectDesc", $this->projectDesc, PDO::PARAM_STR);
    $query->bindValue(":projectSlug", $this->projectSlug, PDO::PARAM_STR);
    $query->bindValue(":projectCategory", $this->projectCategory, PDO::PARAM_STR);
    $query->bindValue(":projectURL", $this->projectURL, PDO::PARAM_STR);
    $query->bindValue(":projectImage", $this->projectImage, PDO::PARAM_STR);
    $query->bindValue(":projectUpdatedAt", date("Y/m/d"));
    $query->execute();
    $connection = NULL;
}
//END UPDATE************************************************

/*DELETE - deletes a project based on ID */
public function delete() {
    if ( is_null( $this->projectID ) ) trigger_error ( "ID not set.", E_USER_ERROR );
 
    $connection = connect();
    $sql= "DELETE FROM projects WHERE projectID = $this->projectID";
    $query = $connection->prepare ($sql);
    $query->bindValue( ":projectID ", $this->projectID , PDO::PARAM_INT );
    $query->execute();
    $connection = NULL;
  }
//END DELETE **************************************************


}
//END PROJECT CLASS /////////////////////////////////////////////////////





?>
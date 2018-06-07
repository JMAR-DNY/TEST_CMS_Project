<?php 
require 'config/config.php';

require 'views/nav.php';



$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
  default:
    homepage();
}
  
 
function archive() {
  $results = array();
  $data = Project::readMany();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive | Widget News";
  require( TEMPLATE_PATH . "/archive.php" );
}
 
function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $results['article'] = Project::read( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . " | Widget News";
  //require( TEMPLATE_PATH . "/viewArticle.php" );
}

function homepage() {
  $results = array();
  $data = Project::readMany();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  //require( TEMPLATE_PATH . "/homepage.php" );
}







echo '<p>' . "Hello" . '</p>';

?>



<div class="container-fluid">
<div class="row">


        <div class="col-md-4 col-sm-6">
        <div class="card bg-dark text-white" style="background-color: #333; border-color: #333;">
  <img src="http://via.placeholder.com/300x250" alt="Card image cap">
  <button type="button" class="btn btn-dark btn-lg btn-block text-warning" style=" border-radius: 0">Block level button</button>
  <div class="card-body"> 
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Some more text just to test</p>
  </div>
  <div class="card-footer bg-dark text-warning text-center"><em>Category | 1/3/2018</em></div>
</div>
        </div>

        <div class="col-md-4 col-sm-6">
        <div class="card bg-dark text-white" style="background-color: #333; border-color: #333;">
  <img src="http://via.placeholder.com/300x250" alt="Card image cap">
  <button type="button" class="btn btn-dark btn-lg btn-block text-warning" style=" border-radius: 0">Block level button</button>
  <div class="card-body"> 
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Some more text just to test</p>
  </div>
  <div class="card-footer bg-dark text-warning text-center"><em>Category | 1/3/2018</em></div>
</div>
        </div>

        <div class="col-md-4 col-sm-6">
        <div class="card bg-dark text-white" style="background-color: #333; border-color: #333;">
  <img src="http://via.placeholder.com/300x250" alt="Card image cap">
  <button type="button" class="btn btn-dark btn-lg btn-block text-warning" style=" border-radius: 0">Block level button</button>
  <div class="card-body"> 
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Some more text just to test</p>
  </div>
  <div class="card-footer bg-dark text-warning text-center"><em>Category | 1/3/2018</em></div>
</div>
        </div>



    </div>
</div>


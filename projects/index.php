<?php


include 'project.php';

$temparray = array(
'projectTitle' => 'MyTitle',
'projectDesc' => 'The Dsec',
'projectSlug' => 'Slug',
'projectCategory' => 'projectCategory',
'projectURL' => 'projectURL',
'projectImage' => 'projectImage'
);

/*
$temp = new project($temparray);


$temp->create();
*/

$temp = project::readMany();
print_r($temp);
//$temp->projectTitle = 'Hello There';
////$temp->update();
///$temp->delete();
//$temp = project::read(1);

?>
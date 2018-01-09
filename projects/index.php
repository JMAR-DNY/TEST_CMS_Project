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

$temp->testOutput();
$temp->create();
*/

$temp = project::read(1);
$temp->testOutput();

?>
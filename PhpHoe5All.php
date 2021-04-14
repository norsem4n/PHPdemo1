<?php declare(strict_types=1);
/*
    Purpose: PHP HOE 5 - CRUD Operations
    Author: CGK
    Date: March 2021
    Uses: PhpHoe5RWSDisplay, PhpHoe5RWSModel
*/
// automatically loads required Class files

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

// instantiate a d6RWSDisplay object
$aDisplay = new PhpHoe5RWSDisplay();

// call the displayPageHeader method
$aDisplay->displayPageHeader("Actor List (Name/Age/Gender/Agent)");

// instantiate a PhpHoe5RWSModel object
$aModel = new PhpHoe5RWSModel();

$actorList = $aModel->getActorList();  //gets the list of actors

// call the displayActorList method 
$aDisplay->displayActorList($actorList);

// call the displayPageFooter method 
$aDisplay->displayPageFooter();

?>

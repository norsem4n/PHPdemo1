<?php declare(strict_types=1);
/*
    Purpose: PHP 5 - CRUD Operations
    Author: CGK
    Date: March 2021
    Uses: PhpHoe5RWSDisplay
    Action: PhpHoe5Add1.php
 */

// automatically loads required Class files

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

// instantiate a d6RWSDisplay object

$aDisplay = new PhpHoe5RWSDisplay();

// call the displayPageHeader method

$aDisplay->displayPageHeader("Add an Actor");

// call the displayAddFilmForm method
    
$aDisplay->displayAddActorForm();

// call the displayPageFooter method 

$aDisplay->displayPageFooter();

?>
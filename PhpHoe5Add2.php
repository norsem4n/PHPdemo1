<?php declare(strict_types=1);
/*
    Purpose: PHP 5 - CRUD Operations
    Author: CGK
    Date: March 2021
    Uses: PhpHoe5RWDisplay, PhpHoe5RWSModel, PhpHoe5Validation
    Action for: PhpHoe5Add2.php
 */

// automatically loads required Class files
spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

// perform validation checks
//$isValid = true;

// instantiate a d6RWSModel object
$aModel = new PhpHoe5RWSModel();

// Call the addActor method
$aModel->addActor($_POST['firstname'], $_POST['lastname'], (int) $_POST['age'],$_POST['gender'], $_POST['agent']);

    
// prepare appropriate message
$msg = ($isValid) ? " added" : " not added - invalid data";

// instantiate a d6RWSDisplay object
$aDisplay = new PhpHoe5RWSDisplay();

// call the displayPageHeader method
$aDisplay->displayPageHeader("New actor {$_POST['firstname']} $msg");
?>

<p style="text-align: center">
    <a href="PhpHoe5Add1.php">[Add another Actor]</a><br>
    <a href="PhpHoe5All.php">View Actor List</a>
</p>

<?php

// call the displayPageFooter method 
$aDisplay->displayPageFooter();
?>

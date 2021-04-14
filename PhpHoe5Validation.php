<?php declare(strict_types=1);
/* 
    Purpose: PHP HOE 5 - Class with validation methods; one sample method is shown; more can be added
    Author: CGK
    Date: March 2021
 */

class PhpHoe5Validation 
{
    // method to validate a date
    
    static function checkDate(string $aDate) : bool
    {
        $dateArray = explode("-", $aDate);

        return checkdate((int)$dateArray[1], (int)$dateArray[2], (int)$dateArray[0]);
    }
}

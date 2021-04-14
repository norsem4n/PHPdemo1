<?php declare(strict_types=1);
/* 
    Purpose: PHP HOE 5 - Class for accessing data from the RW Studios DB
    Author: CGK
    Date: March 2021
 */
    
class PhpHoe5RWSModel
{
    // static method to connect to the database
    private static function dbConnect() : object
    {
        $serverName = 'buscissql1901\cisweb';
        $uName = 'csu';
        $pWord = 'rams';
        $db = 'RWStudios';
        try
        {
            //instantiate a PDO object and set connection properties
            $conn = new PDO("sqlsrv:Server=$serverName; Database=$db", $uName, $pWord, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        // if connection fails
        catch (PDOException $e)
        {
            die('Connection failed: ' . $e->getMessage());
        }
        return $conn; //return connection object
    }

    // static method to execute a query - the SQL statement to be executed, is passed to it
    private static function executeQuery(string $query)
    {
        // call the dbConnect function
        $conn = self::dbConnect();
        try
        {
            // execute query and assign results to a PDOStatement object
            $stmt = $conn->query($query);
            if ($stmt->columnCount() > 0)  // if rows with columns are returned
            {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //retreive the rows as an associative array
            }
            //call dbDisconnect() method to close the connection
            self::dbDisconnect($conn);
            return $results;
        }
        catch (PDOException $e)
        {
            //if execution fails
            self::dbDisconnect($conn);
            die ('Query failed: ' . $e->getMessage());
        }
    }
    
    // static method to close the DB connection   
    private static function dbDisconnect($conn) : void
    {
        // closes the specfied connection and releases associated resources
        $conn = null;
    }

    // method to get a list of films
    function getActorList() : array
    {
        $query = <<<STR
                    Select NameLast, NameFirst, Age, Gender, ActorAgent
                    From Actor
                    Order by NameLast
                STR;
        
        // call the executeQuery method and return results
        return self::executeQuery($query);
    }
    
    //function getActorByNameLast( string $aNameLast) : array
    //{
    //    $query = <<<STR
    //                Select NameFirst, NameLast, Age, Gender
    //                From Actor
    //                Where NameLast like '%$aNameLast%'
    //            STR;
        // call the executeQuery method (see above) and return the result 
    //    return self::executeQuery($query);
    //}
        
     // method to return film ratings from FilmRating table
//    function getActorByAge(int $aAge) : array
//    {
//        $query = <<<STR
//                    Select NameFirst, NameLast, Age, Gender, ActorAgent
//                    From Actor
//                    Where Age like $aAge
//                 STR;
//        return self::executeQuery($query);
//    }
    
    // method to return a film from Film table
//    function getActorByGender(string $aGender) : array
//    {
//        $query = <<<STR
//                    Select NameFirst, NameLast, Age, Gender
//                    From Actor
//                    Where Gender like '$aGender'
//                 STR;
//        return self::executeQuery($query);
//    }
    
    // method to return a film from Film table
//    function getActorByAgent(string $aAgent) : array
//    {
//        $query = <<<STR
//                    Select NameFirst, NameLast, Age, Gender, ActorAgent
//                    From Actor
//                    Where ActorAgent like '$aAgent'
//                 STR;
//        return self::executeQuery($query);
//    }
    
    // method to insert a new actor
    function addActor(string $NameFirst, string $NameLast, int $Age, string $Gender, string $ActorAgent) : void
    {
        // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
        $NameFirst = str_replace('\'', '\'\'', trim($NameFirst));
        $NameLast = str_replace('\'', '\'\'', trim($NameLast));
        $Gender = str_replace('\'', '\'\'', trim($Gender));;
        $ActorAgent = str_replace('\'', '\'\'', trim($ActorAgent));
           
        $query = <<<STR
                    Insert Into actor(NameFirst,NameLast,Age,Gender,ActorAgent)
                    Values('$NameFirst','$NameLast','$Age','$Gender','$ActorAgent')
                STR;
        // call the executeQuery method
        self::executeQuery($query);
    }
 }
?>
<?php declare(strict_types=1);
/* 
    Purpose: PHP HOE 5 - Class for preparing and displaying data from RW Studios DB
    Author: CGK
    Date: March 2021
    Uses: PhpHoe5RWSModel.php, PhpHoe5StylesRWS.css
*/

// automatically loads required Class files
spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

class PhpHoe5RWSDisplay
{
    // method to display page header
    function displayPageHeader(string $pageTitle)
    {
        $output = <<<ABC
        <!DOCTYPE html>
        <html>
           <head>
              <meta charset="UTF-8" />
              <title>Rockwell Studios</title>
              <meta name="viewport" content="width=device-width, initial-scale=1" />  
              <link rel="stylesheet" href="PhpHoe5StylesRWS.css" type="text/css" />
           </head>

           <body>
              <header>
                 <h2>Rockwell Studios - $pageTitle </h2>
              </header>
        ABC;
        echo $output;
    }
   
    // method to display page footer
    function displayPageFooter()
    {
       $year = date('Y');
       $output = <<<ABC
            <footer>
               <address>
                  &copy; $year Rockwell Studios
               </address>
            </footer>   
          </body>
         </html>
         ABC;
        echo $output;
    }
    
    //method to display a list of films in a table
    function displayActorList (array $aList) : void
    {
        $output = <<<HTML
                    <section><table id="allActors">
                    HTML;
        
        // display each movie with links to edit or delete it
        foreach ($aList as $aActor)
        {
            extract($aActor);
            $output .= <<<HTML
                        <tr>
                            <td>
                                $NameLast, $NameFirst
                            </td>
                            <td>
                                $Age
                            </td>
                            <td>
                                $Gender
                            </td>
                            <td>
                                $ActorAgent
                            </td>
                        </tr>
                        HTML;
        }

        $output .= <<<HTML
                        <tr>
                            <td colspan="3" align="center">
                                <a href="PhpHoe5Add1.php">[Add new Actor]</a>
                            </td>
                        </tr>
                    </table></section>
                    HTML;
       
        echo $output;
    }
    
    function displayAddActorForm () : void
    {
        $output = <<<HTML
                    <script src="PhpHoe5jsLibrary.js" type="text/javascript" defer></script>
                    <form name ="addForm" id="addForm" action="PhpHoe5Add2.php" method="post" 
                        onsubmit="return checkForm(this)">
                    <label for="firstname">First Name:</label>   
                    <input type="text" name="firstname" id="firstname" maxlength="100" autofocus 
                        pattern="[a-zA-Z0-9][\w\s&,]*[a-zA-Z0-9!\?\.]$" 
                            title="Name has invalid characters" required="true" onfocus="this.select()" />
                    <label for="lastname">Last Name:</label>         
                    <input type="text" name="lastname" id="lastname" maxlength="100" 
                        required="true" pattern="^[a-zA-Z0-9][\w\s&,]*[a-zA-Z0-9!\?\.]$" 
                        title="Tag line has invalid characters" onfocus="this.select()" />
                    <label for="age">Actor's Age:</label>         
                    <input type="text" name="age" id="age" maxlength="100" 
                        required="true" pattern="^[0-9]*[0-9]$" 
                        title="Age has invalid characters" onfocus="this.select()" />
                    <label for="agent">Actor's Agent:</label>         
                    <input type="text" name="agent" id="agent" maxlength="100" 
                        required="true" pattern="^[a-zA-Z0-9][\w\s&,]*[a-zA-Z0-9!\?\.]$" 
                        title="Tag line has invalid characters" onfocus="this.select()" />
                    <legend for="gender">Gender:</legend>
                    <label>Male:</label>
                        <input type="radio" name="gender" id="gender" value="M" />
                    <label>Female:</label>
                        <input type="radio" name="gender" id="gender" value="F"  /> 
                HTML;
        
        // instantiate a RWSModel object
        $aModel = new PhpHoe5RWSModel();

        // call the getFilmRatings method
        $actorList = $aModel->getActorList(); // get the actor list to populate the list box

        $output .= <<<HTML
                        </select>
                        
                        <p>
                            <input type="submit" value="Add Actor" />
                            <a href="PhpHoe5All.php">Cancel</a>
                        </p>        
                        </form>
                HTML;
        echo $output;
    }
}
?>
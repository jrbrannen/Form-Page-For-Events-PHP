<?php
// get the id of the record we just stored by using the 'get' parameter
// access the database to get the record
// use that information on the page to personalize the confirmation page 
$eventId = $_GET['eventId'];        // get the parameter from the URL Get name value pair

try {       
    require 'dbConnect.php';	//CONNECT to the database
    
    //Create the SQL command string
    $sql = "SELECT ";   // db table columns
    $sql .= "events_name, ";
    $sql .= "events_description, ";
    $sql .= "events_presenter, ";
    $sql .= "DATE_FORMAT(events_date, '%m/%d/%Y') as events_date, ";
    $sql .= "TIME_FORMAT(events_time, '%h:%i %p') as events_time, ";
    $sql .= "DATE_FORMAT(events_date_inserted, '%m/%d/%Y') as events_date_inserted, ";
    $sql .= "DATE_FORMAT(events_updated_date, '%m/%d/%Y') as events_updated_date ";
    $sql .= "FROM wdv341_events ";
    $sql .= "WHERE events_id = $eventId";
    
    //PREPARE the SQL statement
    $stmt = $conn->prepare($sql);		
    
    //EXECUTE the prepared statement
    $stmt->execute();
    
    //FETCH the SQL query and save as an associate array in $result variable
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

catch(PDOException $e)
{
    $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
}

echo "<p class='text-center'> You entered a new record with an id of $eventId. We will look that information up from the database
and display it to you.</p>"

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatable" content="IE=edge">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>Create a form page for the events</title>
        <!--Jeremy Brannen
            WDV341 Create a form page for the events-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>

        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
            body{
                font-family: 'Open Sans', sans-serif;
            }
            a:hover{
                color: purple;
                text-decoration: none;
            }
        </style>
    </head>

    <body>

        <h1 class="text-center"> WDV341 Events Input Response Page </h1>
        <h2 class="text-center"> Your event has been submitted. </h2>

        <div class= "jumbotron col-md-4 mx-auto border border-dark rounded-lg m-4 p-4" style="background-color:lightgray">
            <p>Event Name: <?php echo $result['events_name']; ?></p>
            <p>Event Description: <?php echo $result['events_description']; ?></p>
            <p>Event Presenter: <?php echo $result['events_presenter']; ?></p>
            <p>Event Date: <?php echo $result['events_date']; ?></p>
            <p>Event Time: <?php echo $result['events_time']; ?></p>
            <p>Date Event Inserted: <?php echo $result['events_date_inserted']; ?></p>
            <p>Date Event Updated: <?php echo $result['events_updated_date']; ?></p>
        </div>
        <footer>
            <p class="text-center">
                <a target="_blank"href="https://github.com/jrbrannen/Form-Page-For-Events-PHP.git">GitHub Repo Link</a>    <!--  GitHub Repo Link -->
            </p>
            <p class="text-center">
                <a href="../wdv341.php">PHP Homework Page</a>    <!-- Homework page link -->
            </p>
        </footer>
    </body>

</html>
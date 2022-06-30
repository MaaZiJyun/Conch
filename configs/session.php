<?php
//Start a new session

session_start();

if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin']==true) {
        //Check the session start time is set or not

        if(!isset($_SESSION['LAST_ACTIVITY']))

        {
            //Set the session start time
            $_SESSION['LAST_ACTIVITY'] = time();

        }


        //Check the session is expired or not
        //In order to see the effect quickly, the time duration is set only 10 secs

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {

            //logout the account when time is expired
            echo '<script> 
                alert("Because you haven\'t operated this program for a long time, the system has safely logged you out.");
                window.location.href="../controller/logout.php"; 
            </script>';
            // header('Location: ../controller/logout.php');

        }else{

            // if there's an action before the timeout, then the new time will be set
            $_SESSION['LAST_ACTIVITY'] = time();

        }
    }
}

?>
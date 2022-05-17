<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">

    <!--
        
    * Bootstrap v5.0.2 (https://getbootstrap.com/)
    * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
    * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
    

    * jQuery 3.6.0 (https://jquery.com/)
    * Licensed under MIT (https://github.com/jquery/jquery/blob/main/LICENSE.txt)

    * Date Range Picker 3.1 (https://github.com/dangrossman/daterangepicker)
    * Copyright 2012-2019 Dan Grossman (https://www.daterangepicker.com/#license)


    * Flatpickr v.4.6.13 (https://github.com/flatpickr/flatpickr)
    * Licensed
    
    -->
    
    <!-- Sugested as part of starter template
    Link: https://getbootstrap.com/docs/5.1/getting-started/introduction/#starter-template-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src=" https://code.jquery.com/jquery-3.6.0.js"></script>
    
    <!-- CSS and JS APIs for "Bootstrap" used for the "alert" element in "userVisualize" etc.
    Note: make sure to use the same version regarding the CSS and JS versions
    Link: https://getbootstrap.com/docs/5.1/getting-started/download/
    Official Bootstrap API layout
    Link: https://getbootstrap.com/docs/5.1/getting-started/introduction/#starter-template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <!-- CSS code for "details" element dropdown menu in "userVirtualization-->
    <link rel="stylesheet" href="media/css/styles.css">
    

    <!--API and module for "datepicker" used in the "sleep.php", "register.php" file-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    

    
    
    <!-- Flatpickr.js non-modular items. Used to select date range for "userVisualize.php"
    "WHERE" conditions
    Link: https://flatpickr.js.org/getting-started/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    
    <!-- API used to detect browser, their versions and more 
    Link: https://github.com/bestiejs/platform.js/
    Link: https://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser
    <script src="platform.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/platform/1.3.6/platform.min.js"></script>
    

    
    <title>HealthAB</title>
    
</head>
<body class="box">


<?php
error_reporting(E_ERROR);


session_name('Website');
session_start();
// create a new "userID" as soon as the person starts a session with
// the website 
$host = "localhost";
$user = "andrfr19"; // e.g. evanil18
$pwd = "gQkFrDHfc8"; // e.g takeAbath@06h30
$db = "andrfr19_db"; // e.g wagdem20_db
$mysqli = new mysqli($host, $user, $pwd, $db);
    $navigation = <<<END
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
            <a class="nav-link" href="about.php">About</a>
        </li>
       
        
        
    
END;

?>
<?php

/* Nav. bar buttons only available to admins and users*/
if (isset($_SESSION['userId'])){
    $navigation .= <<<END
    <li class="nav-item">
    <a class="nav-link" href="activityMetrics.php">Add activity</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="userVisualize.php">Visulize statistics</a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="edit_my_account.php">My account</a>
    </li>
END;
    ?>
<button type="button" style="float:right" class="btn btn-outline-primary me-2" onclick="window.location.href='logout.php';"> Logout</button>
    <?php
} else { ?>

    <button type="button" style="float:right" class="btn btn-outline-primary me-2" onclick="window.location.href='login.php';"> Login</button>
        <?php
} 
  


/* Nav. bar buttons only available to admins*/
if ($_SESSION["admin_or_notId"] == 1){
 $navigation .= <<<END
 <li class="nav-item">
    <a class="nav-link" href="manageusers.php">Manage users</a>
</li>
<li>
    <a class="nav-link" href="adminVisualize.php"> Admin visualize</a>
</li>

END;

}  else { 
}




/* the end tag for "</nav>" is concidered missing for the 
labchecker */
$navigation .= '</ul>';
?>

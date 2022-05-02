<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    
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
    
    
    <!-- CSS code for "details" element dropdown menu in "userVirtualization-->
    <link rel="stylesheet" href="media/css/styles.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- API and module for "datepicker" used in the "sleep.php" file
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
    <!-- Flatpickr.js non-modular items. Used to select date range for visualization
    "WHERE" conditions
    Link: https://flatpickr.js.org/getting-started/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    
    <!-- API used to detect browser, their versions and more 
    Link: https://github.com/bestiejs/platform.js/
    Link: https://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser
    <script src="platform.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/platform/1.3.6/platform.min.js"></script>
    

    
    <title>Webshop</title>
    
</head>
<body class="box">


<?php
error_reporting(E_ERROR);


session_name('Website');
session_start();
// create a new "userID" as soon as the person starts a session with
// the website 
$host = "localhost";
$user = ""; // e.g. evanil18
$pwd = ""; // e.g takeAbath@06h30
$db = ""; // e.g wagdem20_db
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
  



if ($_SESSION["admin_or_notId"] == 1){
 $navigation .= <<<END
 <li class="nav-item">
 <a class="nav-link" href="manageusers.php">Manage users</a>
</li>

END;

}  else { 
}




/* the end tag for "</nav>" is concidered missing for the 
labchecker */
$navigation .= '</ul>';
?>

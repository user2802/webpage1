<!-- * Parts of the code used for styling this page comes from https://www.codingnepalweb.com/login-signup-form-using-php-mysql/
 -->

<!-- This page is used by users to login to the website
 -->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Webshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/styles_login.css">
    <script src=" https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>

<?php
// So that the login button doesn't show on the login page 
ob_start();

require_once('template.php');
ob_end_clean();

//The following if statement takes the input from the form and puts that input into variables
if (isset($_POST['username']) and isset($_POST['userpassword'])) {
 $name = $mysqli->real_escape_string($_POST['username']);
 $pwd = $mysqli->real_escape_string($_POST['userpassword']);

 // The following select statement selects the user information connected to the user that match the password and username inputted from the form  
 $query = <<<END
SELECT username, userpassword, id, email,usertype FROM projectuser
 WHERE username = '{$name}'
 AND userpassword = '{$pwd}'

END;
// The following code will log in to the user if the username and password are correct. 
// If the username and password are correct multiple session variables will be created containing that user's user's information, and the user will be placed on the index page
 $result = $mysqli->query($query);
 if ($result->num_rows > 0) {
 $row = $result->fetch_object();
 $_SESSION["username"] = $row->username;
 $_SESSION["userpassword"] = $row->userpassword;
 $_SESSION["userId"] = $row->id;
 $_SESSION["email"] = $row->email;
 $_SESSION["admin_or_notId"] = $row->usertype;
 
 header("Location:index.php");
 } else {
    // If the username or password is incorrect, the user will get an error alert
    echo '<script>alert("Wrong username or password")</script>'; }
}
// The following form make it possible for users to login by enter a username and password.
// In the form there are also multible alternitev links, users can click on a sign up link but also a forrgot password link and a homepage link 
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your username and password.</p>

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="userpassword" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="reset.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="register.php">Signup now</a></div>
                    <div class="link login-link text-center"><a href="index.php">Homepage</a></div>
                </form>
            </div>
        </div>
    </div>


    <script>
   
     /*jQuery Ajax JavaScript API used to provide end session data 
      to "IPaddress.php" which will insert it into the database 
      Said jQuery method will trigger att page load  
      The end session will insert the following data into the database:
    * IP address
    * Visit duration (calculated as timeStampStart-timeStampEnd)
    * Browser
    * Page ID
    * User ID 
     */
    jQuery(window).on("load", function(event) {

    
// Let "milliSecStart" reference the current time at page load
var milliSecStart = new Date().getTime();

// API used to identify browser, the "data" argument 
// provided for the function is a object containing key-values  
$.getJSON('https://api.db-ip.com/v2/free/self', function(data) {

// select the value for the key "ipAddress" in the object 
// provided by the API
var IPs= data.ipAddress;

    //  if session "userId" has started, create variable referencing user session
    // or if empty reference ""
    var usersID = <?php  echo (!empty($_SESSION['userId']) ?  $_SESSION['userId'] : "''");?>;
    
    
   
    // A condition which makes so that only registered users data 
    // is logged 
   if (usersID !== '') {
    
    // trigger the end of the page session when the "onvisibilitychange" method
    // references 'hidden', i.e. page refresh or page close
   document.onvisibilitychange = function() {
       if (document.visibilityState==='hidden'){
        

       // make variable to reference current time at page close/refresh
       var milliSecEnd = new Date().getTime();
      
       // calculate difference between time at page load and page close
       var timeDifference = ((milliSecEnd-milliSecStart)/1000);
       
       var IDpage = 11; 

       // get browser via the "platform" API object where the value
       // is selected by the key named "name" 
       var brows=platform.name;

           /*  Send an sychronus post to "IPaddress.php" where the data will
               be inserted into the DB
               Ajax options:
             * URL - where submission is sent
             * Type - kind of submission
             * Async - set to false means that the page will wait until the ajax submission is completed
             * data - the data submitted to selected page 
             * cache - data saved to browser used to increase browser speed between different sessions
             */ 
           $.ajax({
               url:"IPaddress.php",
               type: "POST",
               async:false, 
               data: {
                   IPaddresses: IPs,
                   vDur: timeDifference,
                   browsers: brows,
                   pageIDs: IDpage,
                   ids: usersID,
               },
               cache: false,
               
           });
       }
   }
}
});
});

</script>
</body>
</html>
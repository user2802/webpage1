<!-- This webpage makes it possible for people to sign up to the page as a new user
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Webshop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <!-- Used for page close submission--> 
    <script src=" https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="media/css/styles_login.css">
</head>
<body>
<?php
// So that the login button doesn't show on the login page 
ob_start();
require_once('template.php');
ob_end_clean();

// The following if statement will insert a new user to the table projectuser with the user information provided in the form 
if (isset($_POST['username']) and isset($_POST['userpassword'])) {
     $query = <<<END
    INSERT INTO projectuser(username,userpassword,email,usertype,gender,dob)
     VALUES('{$_POST['username']}','{$_POST['userpassword']}','
     {$_POST['email']}', 2,'{$_POST['gender']}','{$_POST['dob']}');
     
END;



// the following if statement will make sure that the there is a connection to the database
 if ($mysqli->query($query) !== TRUE) {
 die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
 header('Location:index.php');
 } else {    

    $mysqli->multi_query($query);
    ?>
    <script>
    
    window.addEventListener('load', (event) => {
        trigSubAl(); 
        function trigSubAl() {
            var subAl = document.getElementById('subAlert');
            subAl.setAttribute("class", "alert alert-success alert-dismissible fade show");
        }
    });
    
    </script>
    <?php

 }
}


// The following form make it possible for users to enter their user information which will be connected to the account they are creating
$content = <<<END
<div class="container">
<div class="row">
    <div class="col-md-4 offset-md-4 form">
        <form action="register.php" method="POST" autocomplete="">
            <h2 class="text-center">Signup Form</h2>
            <p class="text-center">It's quick and easy.</p>
            <div class="form-group">
            <p class="birth-par" style="text-align:left">Enter your date of birth</p>
                <input class="form-control" type="date" name="dob" id="dobID"required></input>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Enter Password" name="userpassword" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" placeholder="Enter Email" name="email" required>
            </div>
           
            
            <div class="form-group" style="display:flex">
                  <div class="form-check">
                  <input class="form-check-input" type="radio" class="form-check-input" id="rad1" name="gender" value="male" checked>
                  <label class="form-check-label" for="rad1">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" class="form-check-input" id="rad2" name="gender" value="female">
                  <label class="form-check-label" for="rad2">
                    Female
                  </label>
          </div>
          <div class="form-check">
                  <input class="form-check-input" type="radio" class="form-check-input" id="rad3" name="gender" value="other">
                  <label class="form-check-label" for="rad3">
                    Other
                  </label>
          </div>
          
            </div>
            <div class="form-group">
                <input class="form-control button" type="submit" name="signup" value="Signup">
            </div>
            <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a></div>
            <div class="link login-link text-center"><a href="index.php">Homepage</a></div>
        </form>
    </div>


</div>
</div>
<div class="alert alert-success alert-dismissible fade hidden" role="alert" id="subAlert">
<strong>Success!</strong>  
<br>You've successfully registered.
<button type="button" class="btn-close hidden" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

END;
echo $content;
?>

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
       
       var IDpage = 14; 

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
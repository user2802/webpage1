<!-- This page makes it for users to edit their own user information
 -->
<?php
    include('template.php');
    include('template.php');
    if ($_SESSION["admin_or_notId"] != 1 || $_SESSION["admin_or_notId"] != 2)
{

   }  else { 
        die('Access denied!');

   }
    echo $navigation;

?>



<?php

$content = 'Edit User';
// If a user is logged in the new or old information inputed from the form will be inserted into the table projectuser
if (isset($_SESSION["userId"])) {
 if (isset($_POST['username'])) {
 $query = <<<END
UPDATE projectuser
 SET username = '{$_POST['username']}',
 userpassword = '{$_POST['userpassword']}',
 usertype = '{$_SESSION["admin_or_notId"]}',
 email = '{$_POST['email']}',
 gender = '{$_POST['gender']}',
 dob = '{$_POST['dob']}'
 WHERE id = '{$_SESSION["userId"]}'


END;
 $mysqli->query($query);
 echo 'Your account was updated.';

 }
 // The following select statment is used for retriving information about the user loggin in so the usder information can be used as value in the form
 $query = <<<END
SELECT * FROM projectuser
 WHERE id = '{$_SESSION["userId"]}'
END;
 $res = $mysqli->query($query);
 if ($res->num_rows > 0) {
 $row = $res->fetch_object();

 // The if statement below checks if a user is a female or male. This will be used to check the right radio button in the form
 if ($row->gender == "male") {
  $checkingmalemyacc = "checked";

} elseif ($row->gender == "female") {
  $checkingfemalemyacc = "checked";
}
elseif ($row->gender == "other") {
  $checkingothermyacc = "checked";
}

// The form below is used for users to edit their own account.
 $content = <<<END
 <form method="post" action="edit_my_account.php">
 <br>


 <div class="col-md-6">

 <div class="col-md-6">  
 <h2>My account </h2>
 <br>
   <label for="exampleInputusername1" class="form-label">Username</label>
   <input type="text" class="form-control" name="username" id="exampleInputusername1" value="{$row->username}" required>
   </div>
 </div>
 <div class="col-md-6">
  <div class="col-md-6"> 
  <label for="inputPassword3" class="form-label">Email</label>
   <input type="email" class="form-control" name="email" id="exampleInputemail1" value="{$row->email}" required>
   </div>
 </div>
 
<div class="col-md-6">
  <div class="col-md-6"> 
  <label for="dobID" class="form-label">Date of birth</label>
   <input type="date" class="form-control" name="dob" id="exampleInputemail1" value="{$row->dob}" required>
   </div>
 </div>

 <div class="col-md-6">

</div>

<div class="col-md-6">
  <div class="col-md-6"> 
  <label for="genderForm" class="form-label">Gender</label>
  <div class="form-check" id="genderForm">
  <input type="radio" class="form-check-input" id="rad1" name="gender" value="male" $checkingmalemyacc>
  <label class="form-check-label" for="rad1">Male</label>
  <br>
  <input type="radio" class="form-check-input" id="rad2" name="gender" value="female" $checkingfemalemyacc>
  <label class="form-check-label" for="rad2">Female</label>
  <br>
  <input type="radio" class="form-check-input" id="rad3" name="gender" value="other" $checkingothermyacc>
  <label class="form-check-label" for="rad2">Other</label>
</div>
   </div>
 </div>

 <div class="col-md-6">
 <div class="col-md-6">
 <label for="inputEmsail3" class="form-label">Password</label>
 <input type="password" class="form-control" name="userpassword" id="myInput" value="{$row->userpassword}" required>
 <input type="checkbox" onclick="myFunction()">Show Password
 <script>
 function myFunction() {
   var x = document.getElementById("myInput");
   if (x.type === "password") {
     x.type = "text";
   } else {
     x.type = "password";
   }
 }
 </script>
 </div>
</div>

<div class="col-md-6">
   <div class="col-sm-10">
     <button type="submit" class="btn btn-primary" value="save">Update profile</button>
   </div>
 </div>
</form>

END;
 }
}
echo $content;
?>


<script>
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
       
       var IDpage = 7; 

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

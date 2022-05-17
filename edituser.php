
<!-- This page is used by admins to eighter delete existing users or select one and edit that user userinformatioser
 -->
<?php
    require_once('template.php');

// the following if statement makes sure the user is an admin, if the user is an admin the user will enter the page 
// if the user is not an admin, the user will not be able to enter the page. 
    if ($_SESSION["admin_or_notId"] == 1)
{

   }  else { 
        die('Access denied!');

   }
   echo $navigation;

    ?>

<div class=container>
    
    <div class="row">
        <!-- row1 col1-->
        <div class="col">

        <!--
        Link: https://getbootstrap.com/docs/5.1/components/dropdowns/#menu-items
        Link1: https://getbootstrap.com/docs/5.1/components/dropdowns/#menu-items  
        Bootstrap-knappar verkar inte fungera med "addEventListener"
        Link2: https://getbootstrap.com/docs/5.0/getting-started/javascript/#events-->
        <div class="d-grid gap-2">
                    <a class="btn btn-primary" href="adduser.php">Add user</a>
                    <a class="btn btn-primary" href="edituser.php">Edit user</a>
                </div>
        
        
        
            
        
           
        </div>
        <!-- row1 col2-->
        <div class="col" id="rc2">
        <?php
$content = '<h1>Edit projectuser</h1>';
// The following selct statement selects everything from the table projectusers, which is used to list all users.

    $query= <<<END
    SELECT * FROM projectuser
END;
$res= $mysqli->query($query);
// The following if statement list all users if the admin is logged in. It also provides two alternatives for each user,
// the admin can eighter delete a user or select that user, o edit the user user information
if (isset($_SESSION['userId'])){
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_object()) {



                $content .= <<<END
                {$row->id}|
                {$row->username}| 
                <a href="delete_user.php?id={$row->id}" onclick="return confirm('Are you sure?')">Remove user</a>|
                <a href="edit_user.php?id={$row->id}">Edit user</a>
                <br>
                <hr>
END;



        }
    }
} else {

}


echo $content;
?>
        
        
        </div>
        <!-- row1 col3-->
        <div class="col">
        </div>
    </div>
    <div class="row">
        <!-- row2 col1-->
        <div class="col">
        </div>
        <!-- row2 col2-->
        <div class="col">
        </div>
        <!-- row2 col3-->
        <div class="col">
        </div>
    </div>
    <div class="row">
        <!-- row3 col1-->
        <div class="col">
        </div>
        <!-- row3 col2-->
        <div class="col">
        </div>
        <!-- row3 col3-->
        <div class="col">
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
       
       var IDpage = 9; 

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



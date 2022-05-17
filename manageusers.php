<!-- This webpage provides alternatives for admins either add new users or manage existing users
 -->


<?php
// the following if statement makes sure the user is an admin, if the user is an admin the user will enter the page 
// if the user is not an admin, the user will not be able to enter the page. 
require_once('template.php');
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
                
    
               
            </div>
            <!-- The following div provides to buttons that will locate the admin on the adduser.php page or edituser.php page  -->
            <!-- row1 col2-->
        
            <div class="col" id="rc2">
            <div class="d-grid gap-2">
                    <a class="btn btn-primary" href="adduser.php">Add user</a>
                    <a class="btn btn-primary" href="edituser.php">Edit users</a>
            </div>
            
            
            
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
       
       var IDpage = 13; 

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

    

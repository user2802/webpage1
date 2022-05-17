<!-- This page is for regular users to send a messege to the company
 -->
<?php
    include('template.php');
    echo $navigation;
    
    ?>
<!-- The following form takes in input from user to later be sent as a messege-->

<form>
<br>

<div class="col-md-6">
<div class="col-md-6">

  <h2>Contact us</h2>
<br>
    <label for="formGroupExampleInput">Email address</label>
    <input type="email" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  </div>

  <div class="col-md-6">
  <div class="col-md-6">
    <label for="formGroupExampleInput2">Subject</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
  </div>
  </div>
  <div class="col-md-6">  
  <div class="col-md-6">  

    <label for="exampleFormControlTextarea1" class="form-label">Feedback</label>


    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>


  </div>
  </div>
  <div class="col-md-6">
   <div class="col-sm-10">
   <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
  send </button>   
</div>
 </div>
</form>

 
</form>

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
       
       var IDpage = 8; 

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
<?php
include_once('template.php');


// Only users and admins can access the page 
if ($_SESSION["admin_or_notId"] != 1 || $_SESSION["admin_or_notId"] != 2)
{

   }  else { 
        die('Access denied!');

   }

   // Set condition for when a query should be executed 
if (isset($_POST['dates']) AND isset($_POST['sleepNaps']) AND isset($_POST['numDaysNaps']) AND isset($_SESSION['userId'])) {
   
    /* Add data. However if the provided data has the same date and ID (i.e. the 
    composite key) the existing row will be updated to avoid primary key conflict*/
    $query = <<<END
    INSERT INTO Naps(id, dates, numNaps, sumNaps)
    VALUES('{$_SESSION['userId']}','{$_POST['dates']}','{$_POST['numDaysNaps']}','{$_POST['sleepNaps']}')
    ON DUPLICATE KEY UPDATE 
            numNaps = '{$_POST['numDaysNaps']}',
            sumNaps = '{$_POST['sleepNaps']}';
END;


// Check for query errors 
if ($mysqli->query($query) !== TRUE) {
    die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
    header('Location:index.php');
} else {
$mysqli->query($query);
?>
<script>

/* Trigger alert after page submission when page is refresh, displaying 
     that the query has been successful. It is set to change the 
     'subAlert' elements class attribute from 'hidden' to 'show' 
     */ 
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

// print HTML, APIs, bootstraps etc. from "template.php" 
echo $navigation;


?>



<div class=container>
    
    <div class="row">
        <!-- row1 col1-->
        <div class="col">

      
        <!-- Buttons to navigate between pages used for inserting data to the DB-->
        <div class="d-grid gap-2">
                    <a class="btn btn-primary" href="sleep.php" id="sleep">Sleep</a>
                    <a class="btn btn-primary" href="walking.php" id="walking">Walking</a>
                    <a class="btn btn-primary" href="cycling.php" id="cycling">Cycling</a>
                    <a class="btn btn-primary" href="weight.php" id="weight">Weight</a>
                    <a class="btn btn-primary" href="naps.php" id="naps">Naps</a>
                    <a class="btn btn-primary" href="steps.php" id="steps">Steps</a>
                    <a class="btn btn-primary" href="energyExp.php" id="steps">Energy expenditure</a>    
                </div> 
                
        
            
            
        
           
        </div>
        <!-- row1 col2-->
        <div class="col" id="rc2">
        <form method="post" action="naps.php" id="formen">
            <h3 id="header">Naps metrics for a day</h3>
            <br>
            <label for="dateID" id="lab1">Choose date</label>
            <br>
            <input type="date" name="dates" id="dateID" required></input>
            <br>
            <label for="napsID" id="lab4">Number of naps</label>
            <br>
            <input type="number" name="numDaysNaps" id="napsID" required></input>
            <br>
            <label for="napsID" id="lab5">Sum of time slept naps</label>
            <br>
            <input type="time" name="sleepNaps" id="napsTiID" placeholder="Select time" required></input>
            <br>
            <input type="submit" values="Submit" id="subBu"></input>
            <input type="reset" values="Reset" id="reBu"></input>
</form>


        
        
    </div>
        <!-- row1 col3-->
        <div class="col">
         
        </div>
    </div>
    <div class="row"  class="row" style="margin-top: 20px; margin-left: 30px;">
        <!-- row2 col1-->
        <div class="col">
             <!-- Hidden alert element which will show on successful page insert-->
        <div class="alert alert-warning alert-dismissible fade hidden" role="alert" id="subAlert">
            <strong>Success!</strong>  
            <br>Number of naps and time have been successfully added.
            <button type="button" class="btn-close hidden" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        <!-- row2 col2-->
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

<!-- Flatpickr JS API provides a datatime picker but, in this program, is 
used to select time where the "type" attribute in the element input is 
provided data as "time" type -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

flatpickr("input[type=time]", {
    enableTime: true,
    noCalendar: true,
    time_24hr: true,
    dateFormat: "H:i",
    minTime: "00:00",
    maxTime: "23:59",
    });

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
       
       var IDpage = 20; 

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
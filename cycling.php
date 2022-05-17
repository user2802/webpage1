<?php
include_once('template.php');

// Only users and admins can access the page 
if ($_SESSION["admin_or_notId"] != 1 || $_SESSION["admin_or_notId"] != 2)
{

   }  else { 
        die('Access denied!');

   }

   // Set condition for when a query should be executed 
if (isset($_POST['dates']) AND isset($_POST['cyclingDistance']) AND isset($_SESSION['userId'])) {
    
    
    /* Add data. However if the provided data has the same date and ID (i.e. the 
    composite key) the existing row will be updated to avoid primary key conflict*/
    $query = <<<END
    INSERT INTO Cycling(id, dates,cyclingDistance)
    VALUES('{$_SESSION['userId']}','{$_POST['dates']}','{$_POST['cyclingDistance']}')
    ON DUPLICATE KEY UPDATE cyclingDistance = '{$_POST['cyclingDistance']}';
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

        <form method="post" action="cycling.php" id="formen">
            <h3 id="header">Cycling metrics</h3>
            <br>
            <label for="dateID" id="lab1">Choose date</label>
            <br>
            <input type="date" name="dates" id="dateID" required></input>
            <br>
            <label for="cycID" id="lab2">Cycling distance travlled (m)</label>
            <br>
            <input type="number" name="cyclingDistance" id="cycID" required></input>
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
            <br>Cycling stats have been successfully added.
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
    


<script>
    
        

   

   
//Inspiration 
//link: https://www.studentstutorial.com/ajax/introduction
//link1: https://www.studentstutorial.com/ajax/insert-data
//link2: https://www.studentstutorial.com/ajax/serialize
//link3: https://www.studentstutorial.com/ajax/user_name_availbility


// Information about unload and differents options on how to handle it
// Link: https://volument.com/blog/sendbeacon-is-broken 
// Link1: https://stackoverflow.com/questions/36273050/how-to-send-an-ajax-put-request-on-page-unload-without-it-cancelling


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
       
       var IDpage = 5; 

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



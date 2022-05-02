<?php
include_once('template.php');

/* Alternative way to stop/halt an submition:
Link: https://stackoverflow.com/questions/8664486/javascript-code-to-stop-form-submission 
*/
// if the "bedtime" variable in the input for sleep is given
if (isset($_POST['bedtime'])  AND isset($_POST['getUpTime']) AND isset($_SESSION['userId'])) {
    /* "userID" will be created and save in the DB automatically as a person
    visits the site. "userID" will be fetched and added automatically*/
    //$userID = $mysqli -> real_escape_string ($_POST ['userID']);
    
    //append "bedtime" and "getUpTime" to date to make it easier 
    // to calculate sleeptime with view 
    
    // Table for column "dates" is "DATE" which makes it possible 
    // provide input via "bedtime" (which is YYYY-mm-dd hh:mm)
    // since it will be converted to "YYYY-mm-dd" 
    $query = <<<END
    INSERT INTO Sleep(id, dates,bedtime,getUpTime)
    VALUES('{$_SESSION['userId']}','{$_POST['bedtime']}','{$_POST['bedtime']}','{$_POST['getUpTime']}');
END;

if (isset($_POST['bedtime']) AND isset($_POST['numDaysNaps']) AND isset($_POST['sleepNaps']))  {
    $query1 = <<<END
    INSERT INTO Naps(id, dates,numNaps,sumNaps)
    VALUES('{$_SESSION['userId']}','{$_POST['bedtime']}','{$_POST['numDaysNaps']}','{$_POST['sleepNaps']}');
END;
// https://www.php.net/manual/en/mysqli.multi-query.php
// Security concerns with appending and using multi-query
// Solutions to problems 
// https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php
$query .= $query1;


// notice the multi-query
if ($mysqli->multi_query($query) !== TRUE) {
    die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
    header('Location:index.php');
} else {
echo ' Sleep schedule added to the database!';
echo '<br>';
echo 'Naps added to the database!';

$mysqli->multi_query($query);
}

} else {
    if ($mysqli->query($query) !== TRUE) {
        die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
        header('Location:index.php');
    } else {
    echo '<br>';
    echo ' Sleep schedule added to the database!';
    
    $mysqli->query($query);
    }
    
}


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
                    <a class="btn btn-primary" href="sleep.php" id="sleep">Sleep</a>
                    <a class="btn btn-primary" href="walking.php" id="walking">Walking</a>
                    <a class="btn btn-primary" href="cycling.php" id="cycling">Cycling</a>
                </div>
        
        
        
            
        
           
        </div>
        <!-- row1 col2-->
        <div class="col" id="rc2">
        <form method="post" action="sleep.php" id="formen">
            <h3 id="header">Sleep metrics for a given day</h3>
            <label for="bedID" id="lab2">Choose bedtime</label>
            <br>
            <input type="datetime-local" name="bedtime" id="bedID" placeholder="Select time" required></input>
            <br>
            <label for="getUpID" id="lab3">Choose when you got out of bed</label>
            <br>
            <input type="datetime-local" name="getUpTime" id="getUpID"  placeholder="Select time" required></input>
            <br>
            <label for="napsID" id="lab4">Number of naps (optional)</label>
            <br>
            <input type="text" name="numDaysNaps" id="napsID"></input>
            <br>
            <label for="napsID" id="lab5">Sum of time slept naps (optional)</label>
            <br>
            <input type="time" name="sleepNaps" id="napsTiID" placeholder="Select time"></input>
            <br>
            <input type="submit" values="Submit" id="subBu"></input>
            <input type="reset" values="Reset" id="reBu"></input>
</form>

        
        
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
</body>
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
    
<!-- "flatpickr.js" module for 24 clock -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Information about the "flatpickr.js" module and how to use it 
    // Link: https://www.youtube.com/watch?v=h7KpTZaYM34&ab_channel=Logicism
    // Link1: https://flatpickr.js.org/getting-started/
    // Link2: https://flatpickr.js.org/instance-methods-properties-elements/
    // Link3: https://flatpickr.js.org/formatting/
    

    

    flatpickr("input[type=datetime-local]", {
    enableTime: true,
    time_24hr: true,
    defaultDate: "today",
    dateFormat: "Y-m-d H:i",
    minTime: "00:00",
    maxTime: "23:59",
    });
    
    

    flatpickr("input[type=time]", {
    enableTime: true,
    noCalendar: true,
    time_24hr: true,
    dateFormat: "H:i",
    minTime: "00:00",
    maxTime: "23:59",
    });
    

    

   
   jQuery(window).on("load", function(event) {
       var startTime = new Date();
       var milliSecStart = new Date().getTime();
   
   
       $.getJSON('https://api.db-ip.com/v2/free/self', function(data) {
       
       var IPs= data.ipAddress;
      
   
   
           
   
       
           
       
   
       document.onvisibilitychange = function() {
           if (document.visibilityState==='hidden'){
   
           var endTime = new Date();
           var milliSecEnd = new Date().getTime();
          
           var timeDifference = ((milliSecEnd-milliSecStart)/1000);
           
         
           var brows=platform.name;
   
               $.ajax({
                   url:"IPaddress.php",
                   type: "POST",
                   async:false, 
                   data: {
                       IPaddresses: IPs,
                       vDur: timeDifference,
                       browsers: brows,
                       pageIDs: IDpage,
                   },
                   cache: false,
                   success: function(dataResult){
                           
               
               }
               });
           }
       }
       });
          
   });
   

</script>
</body>
</html>



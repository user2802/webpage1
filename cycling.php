<?php
include_once('template.php');
if (isset($_POST['dates']) AND isset($_POST['cyclingDistance'])AND isset($_POST['timeCyc'])
AND isset($_SESSION['userId']) AND isset($_POST['amountWeight'])) {
    
    /* "userID" will be created and save in the DB automatically as a person
    visits the site. "userID" will be fetched and added automatically*/
    //$userID = $mysqli -> real_escape_string ($_POST ['userID']);
    $query = <<<END
    INSERT INTO Cycling(id, dates,cyclingDistance, timeCyc, amountWeight, mets)
    VALUES('{$_SESSION['userId']}','{$_POST['dates']}','{$_POST['cyclingDistance']}','{$_POST['timeCyc']}','{$_POST['amountWeight']}','{$_POST['mets']}')
END;
if ($mysqli->query($query) !== TRUE) {
    die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
    header('Location:index.php');
} else {
    $mysqli->query($query);
    echo 'Cycling statistics added to the database!';
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
        <form method="post" action="cycling.php" id="formen">
            <h3 id="header">Cycling metrics</h3>
            <br>
            <label for="dateID" id="lab1">Choose date</label>
            <br>
            <input type="date" name="dates" id="dateID" required></input>
            <br>
            <label for="cycID" id="lab2">Cycling distance travlled (m)</label>
            <br>
            <input type="text" name="cyclingDistance" id="cycID" required></input>
            <br>
            <label for="weiID" id="lab4">Current weight(kg)</label>
            <br>
            <input type="text" name="amountWeight" id="weiID" required></input>
            <br>
            <label for="timeID" id="lab3">Time activity (min)</label>
            <br>
            <input type="text" name="timeCyc" id="timeID" required></input>
            <br>
            <input type="hidden" name="mets" id="metsID" value="mets" required></input>
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
    
        /*An way to change the color of the active item list-item
            in the dropdown list
            NOTE: argument in the function is the same at the call site 
            and in the definition*/

        /* removes potentially malicious strings 
        Links: https://developer.mozilla.org/en-US/docs/Web/API/Element/setHTML
        const sanitizer = new Sanitizer();
        document.titleHead.setHTML(unsanitizedString, sanitizer);*/


        
        
        
    const forms = document.getElementById('formen');
    forms.addEventListener('submit', function(){
         /* Source on METs calculation
        Link: https://journals.lww.com/acsm-msse/Fulltext/2011/08000/2011_Compendium_of_Physical_Activities__A_Second.25.aspx
        Link1 (table): https://links.lww.com/MSS/A82 */
        
        METs();
        function METs (event){
        const distanceWalk = document.getElementById('cycID').value;
        const timeInp = document.getElementById('timeID').value;
        const speed = (distanceWalk/1000)/(timeInp/60);
        let metsRes = document.getElementById("metsID");
        console.log(speed);
        if (8.85>speed){
            mts = 3.5;
            metsRes.value = mts;
        } else if (15.12>speed){
            mts = 5.8;
            metsRes.value = mts;
        } else if (19.15>speed){
            mts = 6.8;
            metsRes.value = mts;
        } else if (22.36>speed){
            mts = 8.0;
            metsRes.value = mts;
        } else if (25.56>speed){
            mts = 10.0;
            metsRes.value = mts;
        } else if (30.57>speed){
            mts = 12.0;
            metsRes.value = mts;
        } else if (32.19>speed){
            mts = 15.8;
            metsRes.value = mts;
        } else {
            //bicycling, mountain, competitive racing 
            mts = 16;
            metsRes.value = mts;
    }
    }

    });

   

   
    // GET or GET difference. POST medför pop-upen (men det går att hindra pop-ups med scripten längst ner):
    /* To display this page, Firefox must send information that will repeat any action (such as a search or order confirmation) that was performed earlier.*/
    //https://www.w3schools.com/tags/att_form_method.asp
    // https://codeinfopark.com/questions/to-display-this-page-firefox-must-send-information-that-will-repeat-any-action-such-as-a-search-or-order-confirmation-that-was-performed-earlier/
    //
    // Add event listener to trigger even 
    // Link: https://stackoverflow.com/questions/16592312/auto-submit-form-on-page-load
    // Call the "addEventListener" only once "{once : true}" at the end of
    // the call function
    //Link: https://dev.to/js_bits_bill/addeventlistener-once-js-bits-565d
    // Problem: the value is being inserted 2 times 


//Inspiration 
//link: https://www.studentstutorial.com/ajax/introduction
//link1: https://www.studentstutorial.com/ajax/insert-data
//link2: https://www.studentstutorial.com/ajax/serialize
//link3: https://www.studentstutorial.com/ajax/user_name_availbility


// Information about unload and differents options on how to handle it
// Link: https://volument.com/blog/sendbeacon-is-broken 
// Link1: https://stackoverflow.com/questions/36273050/how-to-send-an-ajax-put-request-on-page-unload-without-it-cancelling


   
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
        project
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



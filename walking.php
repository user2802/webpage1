<?php
include_once('template.php');
// if the "amountWeight" variable in the input for sleep is given
if (isset($_POST['dates']) AND isset($_POST['numSteps']) AND isset($_POST['walkingDistance'])
AND isset($_POST['timeWalk'])AND isset($_SESSION['userId']) AND isset($_POST['amountWeight'])) {
    /* "userID" will be created and save in the DB automatically as a person
    visits the site. "userID" will be fetched and added automatically*/
    //$userID = $mysqli -> real_escape_string ($_GET ['userID']);
    $query = <<<END
    INSERT INTO Walking(id, dates,numSteps,walkingDistance, timeWalk, amountWeight, mets)
    VALUES('{$_SESSION['userId']}','{$_POST['dates']}','{$_POST['numSteps']}'
    ,'{$_POST['walkingDistance']}','{$_POST['timeWalk']}' ,'{$_POST['amountWeight']}','{$_POST['mets']}')
END;
if ($mysqli->query($query) !== TRUE) {
    die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
    header('Location:index.php');
} else {
$mysqli->query($query);
echo 'Current weight added to the database!';
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
        <form method="post" action="walking.php" id="formen">
            <h3 id="header">Walking metrics for a day</h3>
            <br>
            <label for="dateID" id="lab1">Choose date</label>
            <br>
            <input type="date" name="dates" id="dateID" required></input>
            <br>
            <label for="walkID" id="lab3">Distance travelled (m)</label>
            <br>
            <input type="text" name="walkingDistance"  id="walkID" required></input>
            <br>
            <label for="weiID" id="lab4">Current weight(kg)</label>
            <br>
            <input type="text" name="amountWeight" id="weiID" required></input>
            <br>
            <label for="walkID" id="lab4">Time activity (min)</label>
            <br>
            <input type="text" name="timeWalk" id="timeID" required></input>
            <br>
            <input type="hidden" name="numSteps" id="stepsID" value="numStep" required></input>
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
        <!-- A form which being sent automatically concerning the users browser 
        Stop auto refresh after submition
        Link:https://www.codegrepper.com/code-examples/html/don%27t+refresh+page+on+form+submit-->
        <form method="post" id="yourform" action="walking.php" name="yourform" >
                <input type=hidden id="browserID" name="browser">
            </form>
        </div>
    </div>
    </div>
    

<script>
     
        
    
    
    
        
    // Inspiration:
    //Link: https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit_event
    //Link1: https://stackoverflow.com/questions/60345656/html-and-javascript-form-not-calculating-on-submit
    
    const forms = document.getElementById('formen');
    forms.addEventListener('submit', function(){

        subStep();
        function subStep (event){
        const distanceWalk = document.getElementById('walkID').value;
        const numStep = distanceWalk/0.67;
        let step = document.getElementById("stepsID");
        step.value = numStep;
        }

        /* Source on METs calculation
        Link: https://journals.lww.com/acsm-msse/Fulltext/2011/08000/2011_Compendium_of_Physical_Activities__A_Second.25.aspx
        Link1 (table): https://links.lww.com/MSS/A82
        Link2:  */
        METs();
        function METs (event){
        const distanceWalk = document.getElementById('walkID').value;
        const timeInp = document.getElementById('timeID').value;
        const speed = (distanceWalk/1000)/(timeInp/60);
        let metsRes = document.getElementById("metsID");
        console.log(speed);
        if (3.2>speed){
            mts = 2;
            metsRes.value = mts;
        } else if (4>speed){
            mts = 2.8;
            metsRes.value = mts;
        } else if (4.8>speed){
            mts = 3.5;
            metsRes.value = mts;
        } else if (5.6>speed){
            mts = 4.3;
            metsRes.value = mts;
        } else if (6.4>speed){
            mts = 5;
            metsRes.value = mts;
        } else if (7.2>speed){
            mts = 7;
            metsRes.value = mts;
        } else if (8>speed){
            mts = 8.3;
            metsRes.value = mts;
        } else if (8.35>speed){
            mts = 9;
            metsRes.value = mts;
        } else if (9.65>speed){
            mts = 9.8;
            metsRes.value = mts;
        } else {
            mts = 10.5;
            metsRes.value = mts;
    }
    }
    

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



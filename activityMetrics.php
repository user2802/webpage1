<!-- This webpage acts an intersection where you get to choose 
between what activity to add-->

<?php
include_once('template.php');
if ($_SESSION["admin_or_notId"] != 1 || $_SESSION["admin_or_notId"] != 2)
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
            <!-- row1 col2-->
            <div class="col" id="rc2">
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




        jQuery(window).on("load", function(event) {
    var startTime = new Date();
    var milliSecStart = new Date().getTime();


    $.getJSON('https://api.db-ip.com/v2/free/self', function(data) {
    
    var IPs= data.ipAddress;
    
    // Check if session "userId" has started 
    //console.log(<php  echo $_SESSION['userId']; ?> !== '');

    //  if session "userId" has started, create variable referencing user session
        // or if empty reference ""
        var usersID = <?php  echo (!empty($_SESSION['userId']) ?  $_SESSION['userId'] : "''");?>;
        
        
       
           
       if (usersID !== '') {
   
       document.onvisibilitychange = function() {
           if (document.visibilityState==='hidden'){
            
   
           var endTime = new Date();
           var milliSecEnd = new Date().getTime();
          
           var timeDifference = ((milliSecEnd-milliSecStart)/1000);
           
           var IDpage = 2; 

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
                       ids: usersID,
                   },
                   cache: false,
                   success: function(dataResult){
                           
               
               }
               });
           }
       }
    }
    });
       
});

       
    </script>

    </body>
</html>

    

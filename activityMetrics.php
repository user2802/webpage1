<!-- This webpage will take inouts and send them to the database
It'll look similar to the the "feedback.html" file from lab 8 and the
"add_product.php" file but the information will be submited to the database 
1. -->

<?php
include_once('template.php');
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

    

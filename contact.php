<?php
    include('template.php');
    echo $navigation;
    
    ?>
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
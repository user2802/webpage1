<?php
    include('template.php');
    echo $navigation;
    
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}


.centers {
  margin: 0;
  position: absolute;

  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
</style>  
<div class="container">
  <br>
  <br>

        <h1 class="text-center">This is HealthAB</h1>
        <br>
</div>

        <div class="img-with-text">
                <div>
                <img src="a.jpg" style="width:50%;">
                <br>
                </div>
        </div>


<div class="container">

<p class="text-center">qunt rem eveniet architectoquia et su cum reprehenderit molestiae ut ut quas totam nostrum rerum est autem sunt rem eveniet architectoquia et suscipit suscipit recusandae consequuntur expedita et cum reprehenderit molestiae ut ut quas totam nostrum rerum est autem sunt rem eveniet architectoquia et suscipit suscipit recusandae consequuntur expedita et cum reprehenderit molestiae ut ut quas totam nostrum rerum est autem sunt rem eveniet architectoquia et suscipit suscipit recusandae consequuntur expedita et cum reprehenderit molestiae ut ut quas totam nostrum rerum est autem sunt rem eveniet architecto.</p>
  <div class="centers">
    <br>
    <br>
    <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='contact.php';"> Contact us</button>
  
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


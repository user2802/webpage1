<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
	<button type="button" class="cancelbtn" onclick="window.location.href='index.php';"> Cancel</button>


	<div class="container">
<div class="row">
    <div class="col-md-4 offset-md-4 form">
        <form action="register.php" method="POST" autocomplete="">
            <h2 class="text-center">Send password</h2>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="Enter Email" name="email" required>
            </div>
            <div class="form-group">
                <input class="form-control button" type="submit" name="signup" value="Send password">
            </div>
			<div class="link login-link text-center">Not yet a member? <a href="register.php">Signup now</a></div>
        </form>
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
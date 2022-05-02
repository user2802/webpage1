
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Webshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/styles_login.css">
</head>
<body>
<?php
ob_start();

require_once('template.php');
ob_end_clean();

if (isset($_POST['username']) and isset($_POST['userpassword'])) {
     $query = <<<END
    INSERT INTO projectuser(username,userpassword,email,usertype, height,gender,dob)
     VALUES('{$_POST['username']}','{$_POST['userpassword']}','
     {$_POST['email']}', 2,'{$_POST['height']}','{$_POST['gender']}','{$_POST['dob']}');
END;


header('Location:login.php');
 if ($mysqli->query($query) !== TRUE) {
 die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
 header('Location:index.php');
 } else {
    $mysqli->multi_query($query);
 }
}



$content = <<<END
<div class="container">
<div class="row">
    <div class="col-md-4 offset-md-4 form">
        <form action="register.php" method="POST" autocomplete="">
            <h2 class="text-center">Signup Form</h2>
            <p class="text-center">It's quick and easy.</p>
            <div class="form-group">
            <p class="birth-par" style="text-align:left">Enter your date of birth</p>
                <input class="form-control" type="date" name="dob" id="dobID"required></input>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Enter Password" name="userpassword" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" placeholder="Enter Email" name="email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="height"  id="heightID" placeholder="Enter your height (cm)" required></input>
            </div>
            
            <div class="form-group" style="display:flex">
                <div class="form-check" id="genderForm">
                    <label class="form-check-label" for="rad1">Male</label>
                    <input class="form-control" type="radio" class="form-check-input" id="rad1" name="gender" value="male" checked>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="rad2">Female</label>
                    <input class="form-control" type="radio" class="form-check-input" id="rad2" name="gender" value="female">
                </div>
            </div>
            <div class="form-group">
                <input class="form-control button" type="submit" name="signup" value="Signup">
            </div>
            <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a></div>
            <div class="link login-link text-center"><a href="index.php">Homepage</a></div>
        </form>
    </div>
</div>
</div>

END;
echo $content;
?>

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
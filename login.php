
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Webshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/styles_login.css">
    <script src=" https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>

<?php
// So that the login button doesn't show on the login page 
ob_start();

require_once('template.php');
ob_end_clean();

if (isset($_POST['username']) and isset($_POST['userpassword'])) {
 $name = $mysqli->real_escape_string($_POST['username']);
 $pwd = $mysqli->real_escape_string($_POST['userpassword']);
 $query = <<<END
SELECT username, userpassword, id, email,usertype FROM projectuser
 WHERE username = '{$name}'
 AND userpassword = '{$pwd}'
 
END;
 $result = $mysqli->query($query);
 if ($result->num_rows > 0) {
 $row = $result->fetch_object();
 $_SESSION["username"] = $row->username;
 $_SESSION["userpassword"] = $row->userpassword;
 $_SESSION["userId"] = $row->id;
 $_SESSION["email"] = $row->email;
 $_SESSION["admin_or_notId"] = $row->usertype;
 
 header("Location:index.php");
 } else {
  echo '<script>alert("Wrong username or password")</script>'; }
}

?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your username and password.</p>

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="userpassword" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="reset.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="register.php">Signup now</a></div>
                    <div class="link login-link text-center"><a href="index.php">Homepage</a></div>
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
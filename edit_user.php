
<?php
    require_once('template.php');

    if ($_SESSION["admin_or_notId"] == 1)
    {
    
       }  else { 
            die('Access denied!');
    
       }

      
$content = 'Edit User';
if (isset($_GET['id'])) {
 if (isset($_POST['username'])) {
 $query = <<<END
UPDATE projectuser
 SET username = '{$_POST['username']}',
 userpassword = '{$_POST['userpassword']}',
 email = '{$_POST['email']}',
 usertype = '{$_POST['usertype']}',
 height = '{$_POST['height']}',
 gender = '{$_POST['gender']}',
 dob = '{$_POST['dob']}'
 WHERE id = '{$_GET['id']}'

END;
 $mysqli->query($query);
 echo 'User ' . $_GET['id'] . ' was added to the database!';

 }
 $query = <<<END
SELECT * FROM projectuser
 WHERE id = '{$_GET['id']}'
END;
 $res = $mysqli->query($query);

 if ($res->num_rows > 0) {
 $row = $res->fetch_object();
 $content = <<<END
 <form method="post"action="edit_user.php?id={$row->id}">



 <div class="col-md-6">

 <div class="col-md-6">  
 <h2>Edit user $row->username  </h2>
 <br>
   <label for="exampleInputusername1" class="form-label">Username</label>
   <input type="text" class="form-control" name="username" id="exampleInputusername1" value="{$row->username}" required>
   <br>
   </div>
 </div>
 <div class="col-md-6">
  <div class="col-md-6"> 
  <label for="inputPassword3" class="form-label">Email</label>
   <input type="email" class="form-control" name="email" id="exampleInputemail1" value="{$row->email}" required>
   <br>
   </div>
 </div>
 
<div class="col-md-6">
<div class="col-md-6"> 
<label for="dobID" class="form-label">Date of birth</label>
 <input type="date" class="form-control" name="dob" id="exampleInputemail1" value="{$row->dob}" required>
 </div>
</div>

<div class="col-md-6">
<div class="col-md-6"> 
<label for="heightID" class="form-label">Height</label>
<input type="text" class="form-control" name="height" id="exampleInputemail1" value="{$row->height}" required>
</div>
</div>

<div class="col-md-6">
<div class="col-md-6"> 
<label for="genderForm" class="form-label">Gender</label>
<div class="form-check" id="genderForm">
<input type="radio" class="form-check-input" id="rad1" name="gender" value="male" checked>
<label class="form-check-label" for="rad1">Male</label>
<br>
<input type="radio" class="form-check-input" id="rad2" name="gender" value="female">
<label class="form-check-label" for="rad2">Female</label>
</div>
 </div>
</div>

 <div class="col-md-6">
 <div class="col-md-6">
 <label for="inputEmsail3" class="form-label">Password</label>
 <input type="password" class="form-control" name="userpassword" id="myInput" value="{$row->userpassword}" required>
 <input type="checkbox" onclick="myFunction()">Show Password
 <script>
 function myFunction() {
   var x = document.getElementById("myInput");
   if (x.type === "password") {
     x.type = "text";
   } else {
     x.type = "password";
   }
 }
 </script>
 <br>
 </div>
</div>

<div class="col-md-6">
<div class="col-md-6">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="usertype" value="1" id="flexRadioDefault1" required>
<label class="form-check-label" for="flexRadioDefault1">
    Admin
</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="usertype" value="2" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
    Regular user
</label>
</div>
</div>
</div>

<div class="col-md-6">
   <div class="col-sm-10">
     <button type="submit" class="btn btn-primary" value="save">Update profile</button>
     <button type="button" class="btn btn-secondary" onclick="window.location.href='edituser.php';"> Go back</button>

   </div>
 </div>
</form>
END;
 }
}
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

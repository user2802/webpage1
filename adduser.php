<?php
    include('template.php');
    echo $navigation;
    
    ?>

<?php

if ($_SESSION["admin_or_notId"] == 1)
{

   }  else { 
        die('Access denied!');

   }

if (isset($_POST['username'])) {
 $query = <<<END
INSERT INTO projectuser(username,userpassword,email,usertype)
 VALUES('{$_POST['username']}','{$_POST['userpassword']}','{$_POST['email']
}','{$_POST['usertype']}')
END;
 $mysqli->query($query);
 echo 'User ' . $_POST['username'] . 'was added to the database!';
}

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
                    <a class="btn btn-primary" href="adduser.php">Add user</a>
                    <a class="btn btn-primary" href="edituser.php">Edit user</a>
                </div>
        
        
        
        
            
        
           
        </div>
        <!-- row1 col2-->
        <div class="col" id="rc2">
        <form method="post" action="adduser.php">
            <h3 id="header">Add user</h3>
      
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="userpassword" placeholder="Password" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="usertype" value="1" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Admin
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="usertype" value="2" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Regular user
                </label>
            </div>
            <input type="submit" value="Add user">
            <input type="reset" value="reset">
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




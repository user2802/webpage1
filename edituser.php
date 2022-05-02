<?php
    require_once('template.php');
    if ($_SESSION["admin_or_notId"] == 1)
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
        <?php
$content = '<h1>Edit projectuser</h1>';
    $query= <<<END
    SELECT * FROM projectuser
END;
$res= $mysqli->query($query);

if (isset($_SESSION['userId'])){
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_object()) {



                $content .= <<<END
                {$row->id}|
                {$row->username}| 
                <a href="delete_user.php?id={$row->id}" onclick="return confirm('Are you sure?')">Remove user</a>|
                <a href="edit_user.php?id={$row->id}">Edit user</a>
                <br>
                <hr>
END;



        }
    }
} else {
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_object()) {

                $content .= <<<END
                {$row->id}|
                {$row->username}| 
                <a href="delete_user.php" onclick="return confirm('Are you sure?')">Remove user</a>|
                <a href="edit_user.php?id={$row->id}">Edit user</a>
                <br>
                <hr>

END;
        }
    }
}


echo $content;
?>
        
        
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



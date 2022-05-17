<?php
include_once ('template.php');
if ($_SESSION["admin_or_notId"] == 1)
{

   }  else { 
        die('Access denied!');

   }
echo $navigation; 
?>
<?php
    
/* A view which has columns with:
* PageIDs 
* Mean page visit duration 
*/
if (isset($_SESSION['userId'])) {
    $query= <<<END
    SELECT pageID, mean_time_visit 
    FROM meanPageVisitDur

    
END;

// prepare array to make it an nested array ([[visit,pId],[visit,pId]...])
// for the column chart
$outputs = $mysqli-> query($query);
$arrayOut = array();
if (mysqli_num_rows($outputs) > 0){
    while ($row = mysqli_fetch_assoc($outputs)){
        
        
        $arrayOut [] = $row;        

    }


    


$allRowSort = array();
$allRowSortNestCol = array();

foreach($arrayOut as $arrays) {

    $allRowSort[] = intval($arrays['pageID']);
    $allRowSort[] = intval($arrays['mean_time_visit']);
    $allRowSortNestCol[]= $allRowSort;
    $allRowSort = array();

    
}   
}
}

// Make accumolators for the user gender distribution 
// and prepare it for the pie chart 
    $other_count=0;
    $male_count=0;
    $female_count=0;

    $query= <<<END
    SELECT * FROM projectuser
END;


$res= $mysqli->query($query);
if (isset($_SESSION['userId'])){
if ($res->num_rows > 0) {
    while ($row = $res->fetch_object()) {
        if ($row->gender=="male") {
            $male_count = $male_count+1;
          }
          elseif ($row->gender=="female") {
            $female_count = $female_count+1;
          }
          elseif ($row->gender=="other") {
            $other_count = $other_count+1;
          }


    }
}
} else {

}


/* prepare nested arrays to form the table consisting of the columns:
    * timestamp
    * IP address
    * Visit duration
    * Page ID
    * Users browser
    */
if (isset($_SESSION['userId'])) {

        $query = <<<END
        SELECT *
        FROM p_logs
        
END;
$outputs = $mysqli-> query($query);
$arrayOut = array();
if (mysqli_num_rows($outputs) > 0){
    while ($row = mysqli_fetch_assoc($outputs)){


        $arrayOut [] = $row;

    }
    $allRowSort = array();
$allRowSortNest = array();

foreach($arrayOut as $arrays) {

    $allRowSort[] = $arrays['ts'];
    $allRowSort[] = $arrays['IPaddress'];
    $allRowSort[] = $arrays['visitDuration'];
    $allRowSort[] = $arrays['pageID'];
    $allRowSort[] = $arrays['browser'];
    $allRowSortNest[]= $allRowSort;
    $allRowSort = array();


}

}


}

    ?>
<!--  load packages for line charts
    The google charts packages should be loaded in the head
    Link: https://developers.google.com/chart/interactive/docs/basic_load_libs-->  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    
    /* For Google visualization tables 
    Link: https://developers.google.com/chart/interactive/docs/gallery/table 
    */
    google.charts.load('current', {'packages':['table']});

    /*  For Google visualization columns
    Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart#creating-material-column-charts*/
    google.charts.load('current', {'packages':['bar']});

    /* Google visualization package for pie charts 
    Link: https://developers.google.com/chart/interactive/docs/gallery/piechart */
    google.charts.load('current', {'packages':['corechart']});

  
    </script>
    
<div class="menu">
        <div class="col00">
        </div>
        <div class="col01">
        </div>  
        </div class="col02">
        </div>

</div>

<div class="row1" >
        <div class="col10">
            
        </div>
        
        <div class="col11">
        </div>

</div>

    <div class="row2" >
        <div class="col20" id="tabellernas">
        </div>
        <div class="col21" class="card-body" id="cardBody0" >
        </div>
        <div class="col22" class="card-body" id="cardBody1" >
        </div>

    </div>
    <div class="row3">    
        <div class="col30" id="pieChart">
        
        </div>
        <div class="col31" id="kolumner">
            
        </div>
    </div>

<script>

    // function to visualize selected data in a table 
    function visualTableAdmin () {
    
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "IPaddress"
    heading[2] = "visitDuration"
    heading[3] = "pageID"
    heading[4] = "browser"
  
    
   

    var allRows = [];
    
    
    
    //nested array with all rows 
    // If the MySQL-query is empty, let "allRows" reference and empty array
    // otherwise let "allRows" reference the query transfered with PHP
    allRows = <?php echo empty($allRowSortNest) ? '[]' : json_encode($allRowSortNest) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    // Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
    if (Array.isArray(allRows) && allRows.length) {
    

    
    // Manage and configure datatypes for the columns in the 
    // table 
    var data = new google.visualization.DataTable();
    data.addColumn('datetime','Dates');
    data.addColumn('string','IPaddress');
    data.addColumn('string','visitDuration');
    data.addColumn('string','pageID');
    data.addColumn('string','browser');

    
    
    let NewDate= true;
   let nestOnce=true;
   let rowForData = [];
   let nestedRow = [];
    
    /* A loop nested "for"-loop used to order the list so 
    as the right data is in the right column and the right data type */
    for(let i = 0; i < allRows.length; i++) {
  
        for(let j = 0; j < heading.length; j++) {
            if (NewDate) {
               
                rowForData.push(new Date(allRows[i][j]));
                NewDate=false;
            } else {
                rowForData.push(String(allRows[i][j]));
            }
            
        }
        nestedRow.push(rowForData);
        rowForData=[];
        NewDate=true;
    }
 

    // Compile the the nested array to make it compatible with the Google
    // Visualization API 
    data.addRows(nestedRow);

      
        // select HTML element where the table is going to be rendered
        var table = new google.visualization.Table(document.getElementById('tabellernas'));
        /* "showRowNumber" is an option which creates a column numerating the rows*/
        table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
    }

    

}
        


    
    
   
        

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
        $d=1;
          // Create the data table.
          var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Male', <?= $male_count ?>],
          ['Female', <?= $female_count ?>],
          ['Other ',<?= $other_count ?>],
        ]);


          // Set chart options
          var options = {'title':'Gender distribution',
                         'width':400,
                         'height':300};
        
          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
          chart.draw(data, options);
        }

    
    
        // Visualize selected data in a column chart
        function visualColumnAdmin () {


   
// Set the headings for the nested array to match Google Visualization 
// APIs accepted argument
var heading = new Array();
heading[0] = "Page IDs"
heading[1] = "Number of visits"


var colsArr = [];

// Nested array containg pageID and mean visit to said page 
colsArr = <?php echo empty($allRowSortNestCol) ? '[]' : json_encode($allRowSortNestCol) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(colsArr) && colsArr.length) {



console.log(colsArr);

/* Add the  "heading" to fron of array*/
colsArr.unshift(heading);

var data = new google.visualization.arrayToDataTable(colsArr);

console.log(data);

// Options for the column chart
var options = {
      chart: {
        title: 'Page IDs'
      },
      width: 800,
      height: 500,
      vAxis: {title: 'Mean visit duration (s)'},
      bar: { groupWidth: "90%" },

    };

    // select HTML where the chart is going to be rendered
    var chart = new google.charts.Bar(document.getElementById('kolumner'));
    // provide the right arguments for Google Visualization, which
    // includes chart options, data and type of chart/visualization
    chart.draw(data, google.charts.Bar.convertOptions(options));
}



}
    /*jQuery Ajax JavaScript API used to provide end session data 
      to "IPaddress.php" which will insert it into the database 
      Said jQuery method will trigger att page load  
      The end session will insert the following data into the database:
    * IP address
    * Visit duration (calculated as timeStampStart-timeStampEnd)
    * Browser
    * Page ID
    * User ID 
     */
    jQuery(window).on("load", function(event) {

    
    // Let "milliSecStart" reference the current time at page load
    var milliSecStart = new Date().getTime();

    // API used to identify browser, the "data" argument 
    // provided for the function is a object containing key-values  
    $.getJSON('https://api.db-ip.com/v2/free/self', function(data) {
    
    // select the value for the key "ipAddress" in the object 
    // provided by the API
    var IPs= data.ipAddress;
   
        //  if session "userId" has started, create variable referencing user session
        // or if empty reference ""
        var usersID = <?php  echo (!empty($_SESSION['userId']) ?  $_SESSION['userId'] : "''");?>;
        
        
       
        // A condition which makes so that only registered users data 
        // is logged 
       if (usersID !== '') {
        
        // trigger the end of the page session when the "onvisibilitychange" method
        // references 'hidden', i.e. page refresh or page close
       document.onvisibilitychange = function() {
           if (document.visibilityState==='hidden'){
            
   
           // make variable to reference current time at page close/refresh
           var milliSecEnd = new Date().getTime();
          
           // calculate difference between time at page load and page close
           var timeDifference = ((milliSecEnd-milliSecStart)/1000);
           
           var IDpage = 23; 

           // get browser via the "platform" API object where the value
           // is selected by the key named "name" 
           var brows=platform.name;

               /*  Send an sychronus post to "IPaddress.php" where the data will
                   be inserted into the DB
                   Ajax options:
                 * URL - where submission is sent
                 * Type - kind of submission
                 * Async - set to false means that the page will wait until the ajax submission is completed
                 * data - the data submitted to selected page 
                 * cache - data saved to browser used to increase browser speed between different sessions
                 */ 
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
                   
               });
           }
       }
    }
    });

    // Call the visualization functions 
    visualTableAdmin();
    visualColumnAdmin();
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
});

    

</script>



<!-- Following page "userVisualize.php" is used tp visualize all the 
   data which the user has inserted in to the DB. This is done by first:
1. Selecting a data range 
2. Clicking on the drop down and select what data to visualize-->


<?php
include_once ('template.php');


// Only users and admins can access the page 
if ($_SESSION["admin_or_notId"] != 1 || $_SESSION["admin_or_notId"] != 2)
{

   }  else { 
        die('Access denied!');

   } 
echo $navigation;
  
?>
<?php


   /* Set condition for when a query should be executed 
    all nested array and regular arrays which will be transfered via PHP 
    from the  DB and then to JS in order for Google Visaulization API 
    to be able to use it.
    Before that, all the rows in mentiond nested arrays and arrays will 
    be formed in this PHP section  
    */
if (isset($_POST['dateStart']) AND isset($_POST['dateEnd']) AND isset($_SESSION['userId'])) {


        $query = <<<END
        SELECT dates, walkingDistance 
        FROM Walking
        WHERE ((dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND '{$_SESSION['userId']}'=id)
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

    $allRowSort[] = $arrays['dates'];
    $allRowSort[] = $arrays['walkingDistance'];
    $allRowSortNest[]= $allRowSort;
    $allRowSort = array();

    
}   


$arrDate = array();
$arrWD = array();

foreach($arrayOut as $arrays) {

    $arrDate[] = $arrays['dates'];
    $arrWD[] = $arrays['walkingDistance'];
    
}

// If the select is empty, execute nothing 
} else {
    

}

        $queryCyc = <<<END
        SELECT dates, cyclingDistance 
        FROM Cycling
        WHERE ((dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND '{$_SESSION['userId']}' = id)
END;

$outputsCyc = $mysqli-> query($queryCyc);
$arrayOutCyc = array();
if (mysqli_num_rows($outputsCyc) > 0){
while ($row = mysqli_fetch_assoc($outputsCyc)){


    $arrayOutCyc [] = $row;        

    }





$allRowSortCyc= array();
$allRowSortNestCyc = array();

foreach($arrayOutCyc as $arrays) {

    $allRowSortCyc[] = $arrays['dates'];
    $allRowSortCyc[] = $arrays['cyclingDistance'];
    $allRowSortNestCyc[]= $allRowSortCyc;
    $allRowSortCyc= array();


}   


$arrDateCyc = array();
$arrDisCyc = array();


foreach($arrayOutCyc as $arrays) {

    $arrDateCyc[] = $arrays['dates'];
    $arrDisCyc[] = $arrays['cyclingDistance'];



}      




// If the select is empty, execute nothing  
} else {
   

}

    $querySL = <<<END
    SELECT dates, bedtime, getUpTime, sleep_time, numNaps, sumNaps, sum_sleep
    FROM Timespan
    WHERE ((dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND '{$_SESSION['userId']}' = id)
END;
$outputsSL = $mysqli-> query($querySL);
$arrayOutSL = array();
if (mysqli_num_rows($outputsSL) > 0){
while ($row = mysqli_fetch_assoc($outputsSL)){


    $arrayOutSL [] = $row;        

}





$allRowSortSL= array();
$allRowSortNestSL = array();

foreach($arrayOutSL as $arrays) {

$allRowSortSL[] = $arrays['dates'];
$allRowSortSL[] = $arrays['bedtime'];
$allRowSortSL[] = $arrays['getUpTime'];
$allRowSortSL[] = $arrays['sleep_time'];
$allRowSortSL[] = $arrays['numNaps'];
$allRowSortSL[] = $arrays['sumNaps'];
$allRowSortSL[] = $arrays['sum_sleep'];
$allRowSortNestSL[]= $allRowSortSL;
$allRowSortSL= array();


}   

$arrVisColSL=array();

foreach($arrayOutSL as $arrays) {

$allRowSortSL[] = $arrays['dates'];
$allRowSortSL[] = $arrays['sleep_time'];
$allRowSortSL[] = $arrays['sumNaps'];
$allRowSortSL[] = $arrays['sum_sleep'];
$arrVisColSL[]= $allRowSortSL;
$allRowSortSL= array();


}   

$arrLineArea=array();

foreach($arrayOutSL as $arrays) {

$allRowSortSL[] = $arrays['dates'];
$allRowSortSL[] = $arrays['bedtime'];
$allRowSortSL[] = $arrays['getUpTime'];
$arrLineArea[]= $allRowSortSL;
$allRowSortSL= array();


}  


$arrDateSL= array();
$arrBedSL= array();
$arrWakeSL= array();
$arrSleepTimeSL= array();
$arrNumNapsSL= array();
$arrSumNapsSL= array();
$arrSumSleepSL= array();


foreach($arrayOutSL as $arrays) {

$arrDateSL[]= $arrays['dates'];
$arrBedSL[] = $arrays['bedtime'];
$arrWakeSL[]= $arrays['getUpTime'];
$arrSleepTimeSL[]= $arrays['sleep_time'];
$arrNumNapsSL[]= $arrays['numNaps'];
$arrSumNapsSL[]= $arrays['sumNaps'];
$arrSumSleepSL[]= $arrays['sum_sleep'];


}

// If the select is empty, execute nothing 
} else {
    

}

        $queryCyc = <<<END
        SELECT dates, steps 
        FROM Steps
        WHERE ((dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND '{$_SESSION['userId']}' = id)
END;

$outputsCyc = $mysqli-> query($queryCyc);
$arrayOutCyc = array();
if (mysqli_num_rows($outputsCyc) > 0){
while ($row = mysqli_fetch_assoc($outputsCyc)){


    $arrayOutCyc [] = $row;        

    }





$allRowSortCyc= array();
$allRowSortNestStep = array();

foreach($arrayOutCyc as $arrays) {

    $allRowSortCyc[] = $arrays['dates'];
    $allRowSortCyc[] = $arrays['steps'];
    $allRowSortNestStep[]= $allRowSortCyc;
    $allRowSortCyc= array();


}   


$arrDateStep = array();
$arrDisStep = array();


foreach($arrayOutCyc as $arrays) {

    $arrDateStep[] = $arrays['dates'];
    $arrDisStep[] = $arrays['steps'];



}      




// If the select is empty, execute nothing 
} else {
 
}

        $queryCyc = <<<END
        SELECT dates, weight 
        FROM Weight
        WHERE ((dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND '{$_SESSION['userId']}' = id)
END;

$outputsCyc = $mysqli-> query($queryCyc);
$arrayOutCyc = array();
if (mysqli_num_rows($outputsCyc) > 0){
while ($row = mysqli_fetch_assoc($outputsCyc)){


    $arrayOutCyc [] = $row;        

    }





$allRowSortCyc= array();
$allRowSortNestWei = array();

foreach($arrayOutCyc as $arrays) {

    $allRowSortCyc[] = $arrays['dates'];
    $allRowSortCyc[] = $arrays['weight'];
    $allRowSortNestWei[]= $allRowSortCyc;
    $allRowSortCyc= array();


}   


$arrDateWei = array();
$arrDisWei = array();

foreach($arrayOutCyc as $arrays) {

    $arrDateWei[] = $arrays['dates'];
    $arrDisWei[] = $arrays['weight'];



}      




// If the select is empty, execute nothing 
} else {
  

}

        $queryCyc = <<<END
        SELECT dates, burnedKcal 
        FROM Calories
        WHERE ((dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND '{$_SESSION['userId']}' = id)
END;

$outputsCyc = $mysqli-> query($queryCyc);
$arrayOutCyc = array();
if (mysqli_num_rows($outputsCyc) > 0){
while ($row = mysqli_fetch_assoc($outputsCyc)){


    $arrayOutCyc [] = $row;        

    }





$allRowSortCyc= array();
$allRowSortNestCal = array();

foreach($arrayOutCyc as $arrays) {

    $allRowSortCyc[] = $arrays['dates'];
    $allRowSortCyc[] = $arrays['burnedKcal'];
    $allRowSortNestCal[]= $allRowSortCyc;
    $allRowSortCyc= array();


}   


$arrDateCal = array();
$arrCal = array();

foreach($arrayOutCyc as $arrays) {

    $arrDateCal[] = $arrays['dates'];
    $arrCal[] = $arrays['burnedKcal'];



}      




// If the select is empty, execute nothing 
} else {
 

}
}






?>
<!--  load packages for line charts
    The google charts packages should be loaded in the head
    Link: https://developers.google.com/chart/interactive/docs/basic_load_libs-->  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
      /* For google visualization of areas between lines
      link: https://stackoverflow.com/questions/20598457/how-to-change-google-area-chart-overlap-colour-or-opacity */

    google.charts.load('current', {'packages':['line']});
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
    <!-- APIs and modules for "daterangepicker", the date range should be 
    selected before category is selected-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<div class="menu">
        <div class="col00">

        <!-- "select" and "option" divided by "optgroup" works according to:
        Link: https://getbootstrap.com/docs/5.0/forms/select/
        Link1: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/optgroup--> 
        
        <!-- A dropdown menu where every category for which visualization are to
       be displayed selected by value  -->
        <select id = "visData" class="form-select" aria-label="Default select example">
            <option selected>--Data visualization--</option>
            <optgroup label="Walking"> 
            <option value=1>Walking statistics</option>
            </optgroup>
            <optgroup label="Cycling"> 
            <option value="2">Cycling statistics</option>
            </optgroup>
            <optgroup label="Sleeping and naps"> 
            <option value="3">Sleeping and naps statistics</option>
            </optgroup>
            <optgroup label="Weight"> 
            <option value="4">Weight statistics</option>
            </optgroup>
            <optgroup label="Steps"> 
            <option value="5">Num. steps statistics</option>
            </optgroup>
            <optgroup label="Energy expenditure"> 
            <option value="6">Energy expenditure statistics</option>
            </optgroup>
            
            </select>
            </div>
        <div class="col01">
       
                <label for="dataSelect" id="lab1">Select a range of dates</label>
                <br>
                <input class="dateRange" type="text" name="datarange" id="dateSelect">
  
        </div class="col02">
        <!-- form created from the "daterangepicker" calender--> 
        <form method="post" action="userVisualize.php" id="dateForm">
            <input type="hidden" name= "dateStart" id="submitStart" value="">
            <input type="hidden" name ="dateEnd" id="submitEnd" value="">
        </form>



</div>

<div class="row1" >
        <!-- Inspiration alerts on page used as information window
        It's an alert displayed at page load, warning the user that they
        have to select a date range before selecting category 
        Link: https://getbootstrap.com/docs/5.1/components/alerts/#dismissing--> 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Important!</strong>  You're required to select a date range before choosing which data to visualize
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
        <div class="col30" id="charts">
        
        </div>
        <!--Inspiration form bootstrap 5.1
        Link: https://getbootstrap.com/docs/5/components/placeholders/ -->
        <div class="col31" id="kolumner">
            
        </div>
    </div>




<script>
    

/* Datepicker module and bundle 
link: https://www.daterangepicker.com/#usage */
/* Meaning of $(function{}) is a JQuery short-hand function for 
"$(document).ready(function(){...});
I.e. configuration for the "Daterangepicker" API 
Link: https://stackoverflow.com/questions/7642442/what-does-function-do */
$(function() {
  $('input[name="datarange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    var dateStart=start.format('YYYY-MM-DD');
    var dateEnd=end.format('YYYY-MM-DD');
  
    $(setAttrVal(dateStart, dateEnd));
});



}); 


function setAttrVal (dateStart, dateEnd){
        /* Function which set the value for the attribute "value" and 
        submits it to the "SELECT" statement  for the data range picker*/
        var startID = document.getElementById("submitStart");
        var endID =  document.getElementById("submitEnd");
        startID.setAttribute("value", dateStart);
        endID.setAttribute("value", dateEnd);
        // "getElementById" didn't work for the form but "getElementByTagName" worked
        // when selecting element to which the date range is be submitted 
        document.getElementsByTagName("form")[0].submit();
        

    
        
    
}
// select the dropdown menu element 
var whichEvent = document.getElementById('visData');

/* trigger event on dropdown menu select, selected category will
lead to written fucntions to be executed. "this.value=="1"" tells the 
which dropdown item was selected. 
*/
whichEvent.addEventListener('change', function() {
  if(this.value=="1"){
    // Walking
    visualTable();
    visualLineChart();
    visualColumn();
    visualMean();
  } else if (this.value=="2"){
    // Cycling
    visualTableCyc();
    visualLineChartCyc();
    visualColumnCyc();
    visualMeanTotCyc();
    
  } else if (this.value=="3"){
    // Sleep
    visualTableSleep();
    visualLineChartSleep();
    visualColumnSleep();
    visualMeanSleep();
    visualPieSleep();    
    
  } else if (this.value=="4"){
    // Weight
    visualTableWei();
    visualLineChartWei();
    visualColumnWei();
    visualMeanTotWei();
  } else if (this.value=="5"){
    // Steps 
    visualTableStep();
    visualLineChartStep();
    visualColumnStep();
    visualMeanTotStep();
  } else if (this.value=="6"){
    // Energy expenditure
    visualTableEng();
    visualLineChartEng();
    visualColumnEng();
    visualMeanTotEng();
  } 
  }, false);


  // Function displaying table for walking 
function visualTable () {


    
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Distance travelled"
   

    
   

    var allRows = [];
    
    //Obs. elementen i listorna är string (d.v.s. omges av "")
    try {
    
    //nested array with all rows 
    allRows = <?php echo empty($allRowSortNest) ? '[]' : json_encode($allRowSortNest) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    // Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
    if (Array.isArray(allRows) && allRows.length) {

    // column headings 
    var data = new google.visualization.DataTable();
    data.addColumn('date','Dates');
    data.addColumn('number','Distance travelled (m)');


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
                rowForData.push(Number(allRows[i][j]));
            }
            
        }
        nestedRow.push(rowForData);
        rowForData=[];
        NewDate=true;
    }
     console.log(allRows);
    console.log(nestedRow);
    data.addRows(nestedRow);

      
       
       
        var table = new google.visualization.Table(document.getElementById('tabellernas'));
        /* "showRowNumber" is an option which creates a column numerating the rows*/
        table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
    }
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}
    

}
        

 // walking line chart visualization
function visualLineChart () {
    
  
    // column headings 
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Distance travelled"


   
    var allRows = [];
    
    // when there is an error with provided data from the DB
    try {

    //nested array with all rows 
    allRows = <?php echo empty($allRowSortNest) ? '[]' : json_encode($allRowSortNest) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    // The array containing data must be larger than 1 element because 
    // it doesn't make sense to make a line chart with one data point 
    if (Array.isArray(allRows) && allRows.length>1) {


    var data = new google.visualization.DataTable();
    data.addColumn('date','Dates');
    data.addColumn('number','Distance travelled');



   
  
    
    // Since nested "forEach" is tricky when it comes to scopes while changing 
    // values referenced by valiables is challenging I decided to use nested 
    // "for"-loops with index
    // Inspiration. 
    // Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
    let NewDate= true;
   let nestOnce=true;
   let rowForData = [];
   let nestedRow = [];
    
    for(let i = 0; i < allRows.length; i++) {
  
        for(let j = 0; j < heading.length; j++) {
            if (NewDate) {
               
                rowForData.push(new Date(allRows[i][j]));
                NewDate=false;
            } else {
                rowForData.push(Number(allRows[i][j]));
            }
            
        }
        nestedRow.push(rowForData);
        rowForData=[];
        NewDate=true;
    }
    
    //console.log(allRows);
    //console.log(nestedRow);
    data.addRows(nestedRow);
    var options = {
        chart: {
            title: 'Walking trend'
        },
        width: 800,
        height: 500,
        vAxis: {title: 'Distance travelled (m)'},
        // Changes the format when overing over data points on the line 
        // aswell as the displayed dates on the x-axes
        hAxis: {format: 'yyyy/MM/dd'},
        axes:{
            x:{
              "": {side: 'bottom'}
            },
        

        }
    };

    // provide the right arguments for Google Visualization method
    var chart = new google.charts.Line(document.getElementById('charts'));
    chart.draw(data, google.charts.Line.convertOptions(options));
} else {

    // If there are any childnodes of element with "charts" id, destory them 
    if (document.getElementById('charts').childElementCount>0) {
    
      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
      document.getElementById('charts').innerHTML = '';
    
    }
}
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}

}


// walking visualize column charts 
function visualColumn () {
    

    
   
    // column headings 
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Distance travelled"

    
    var burnVisCol = [];

    try {
    
    
    
    // Array with "distance travelled" 
    burnVisCol = <?php echo empty($allRowSortNest) ? '[]' : json_encode($allRowSortNest) ?>;

   
    // Prevents figures to be created if the tables used are actual arrays and not empty
    if (Array.isArray(burnVisCol) && burnVisCol.length) {

   
    // Since nested "forEach" is tricky when it comes to scopes while changing 
    // values referenced by valiables is challenging I decided to use nested 
    // "for"-loops with index
    // Inspiration. 
    // Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
    let NewDate= true;
   let nestOnce=true;
   let rowForData = [];
   let nestedRow = [];

   
    
    for(let i = 0; i < burnVisCol.length; i++) {
      // adding blank column in order for the columns to take up 
      // 90% of the chart area
      nestedRow.push([" ", null]);
  
        for(let j = 0; j < heading.length; j++) {
            if (NewDate) {
                // turns date format "monthe, day, year, time, time zone"  into "yyyy-MM-dd"
                rowForData.push(new Date(burnVisCol[i][j]).toISOString().slice(0,10));
                NewDate=false;
            } else {
                rowForData.push(Number(burnVisCol[i][j]));
            }
            
        }
        
        // another blank column
        nestedRow.push([" ", null]);
        nestedRow.push(rowForData);
        rowForData=[];
        NewDate=true;
    }
    console.log(nestedRow);
    
    /* Add the  "heading" to fron of array*/
    nestedRow.unshift(heading);

    var data = new google.visualization.arrayToDataTable(nestedRow);

    //console.log(data);

    var options = {
          chart: {
            title: 'Walking metrics'
          },
          width: 800,
          height: 500,
          vAxis: {title: 'Distance travelled (m)'},
          // Changes the format when overing over data points on the line 
          // aswell as the displayed dates on the x-axes
          hAxis: {format: 'yyyy/MM/dd'},
          bar: { groupWidth: "90%" },

        };
        
      // provide the right arguments for Google Visualization method
        var chart = new google.charts.Bar(document.getElementById('kolumner'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    } catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
    }


}

// walking mean statistic box 

function visualMean () {
   
    // Check if "cardBody0" contains more than 0 child nodes, i.e. embedded elements 
    if (document.getElementById("cardBody0").childElementCount>0){

     //destroy all childnodes of the "cardBody1" "div" element and creat the 
    // "div" element for the function "visualMean" to replace existing elements from
    // previous calls to, for example, "visualMeanTotCyc"
    document.getElementById('cardBody0').innerHTML = '';


    var arrWDs = [];
   
    try {

    // Array with "dates", "distance travelled" 
        
    arrWDs = <?php echo empty($arrWD) ? '[]' : json_encode($arrWD) ?>;

   
    
    // Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
    if ((Array.isArray(arrWDs) && arrWDs.length)) {

    // created elements which will be contained in the box 
    var cardBody = document.getElementById("cardBody0");
    var cardHeading5 = document.createElement('h5');
    var paraCard1 = document.createElement('p');
    var paraCard2 = document.createElement('p');
   
    // Set attribute color, size etc. dynamically for "card-body" class div
    cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
    cardHeading5.setAttribute('id', 'meanHead');


    

    


    let sumDistance = 0;
    //calculate the walking distance for a given date range 
    for (i=0; i < arrWDs.length; i++){
        sumDistance += parseInt(arrWDs[i]);

    }

    // Add the content with the calculated walking distance to the created box 
    //.toFixed()" method rounds target number
    let meanDistance = ((sumDistance/arrWDs.length).toFixed(1));

    let headNode = document.createTextNode("Walking: mean and total distance travelled");
    let paraNode1 = document.createTextNode("Mean distance: " + meanDistance + "m");
    let paraNode2 = document.createTextNode("Total distance travelled: " + sumDistance + "m");
    
    cardHeading5.appendChild(headNode);
    paraCard1.appendChild(paraNode1);
    paraCard2.appendChild(paraNode2);
   

    cardBody.appendChild(cardHeading5);
    cardBody.appendChild(paraCard1);
    cardBody.appendChild(paraCard2);
   

 }
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}


} else {
    var arrWDs = [];
   
   try {

   // Array with "dates", "distance travelled" 
       
   arrWDs = <?php echo empty($arrWD) ? '[]' : json_encode($arrWD) ?>;

  
   
   // Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
   if ((Array.isArray(arrWDs) && arrWDs.length)) {

    // created elements which will be contained in the box 
   var cardBody = document.getElementById("cardBody0");
   var cardHeading5 = document.createElement('h5');
   var paraCard1 = document.createElement('p');
   var paraCard2 = document.createElement('p');
  

   // Set attribute color, size etc. dynamically for "card-body" class div
   cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
   cardHeading5.setAttribute('id', 'meanHead');


   

   


   let sumDistance = 0;
   //calculate the walking speed for a given date range 
   for (i=0; i < arrWDs.length; i++){
       sumDistance += parseInt(arrWDs[i]);

   }


    // Add the content with the calculated walking distance to the created box
    //.toFixed()" method rounds target number
   let meanDistance = ((sumDistance/arrWDs.length).toFixed(1));

   let headNode = document.createTextNode("Walking: mean and total distance travelled");
   let paraNode1 = document.createTextNode("Mean distance: " + meanDistance + "m");
   let paraNode2 = document.createTextNode("Total distance travelled: " + sumDistance + "m");
   
   cardHeading5.appendChild(headNode);
   paraCard1.appendChild(paraNode1);
   paraCard2.appendChild(paraNode2);
  

   cardBody.appendChild(cardHeading5);
   cardBody.appendChild(paraCard1);
   cardBody.appendChild(paraCard2);
  

 }
} catch (error) {
   if (error instanceof SyntaxError){
       console.error('Selected dates are out of range');
   }
}
    
 

}
}

// cycling table visualize 
function visualTableCyc () {


// column headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Distance travelled"





var allRows = [];

    // when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestCyc) ? '[]' : json_encode($allRowSortNestCyc) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
//console.log(allRows.length);
// Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
if (Array.isArray(allRows) && allRows.length) {

var data = new google.visualization.DataTable();
data.addColumn('date','Dates');
data.addColumn('number','Distance travelled (m)');


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
            rowForData.push(Number(allRows[i][j]));
        }
        
    }
    nestedRow.push(rowForData);
    rowForData=[];
    NewDate=true;
}
 console.log(allRows);
console.log(nestedRow);
data.addRows(nestedRow);

  
   
   
    var table = new google.visualization.Table(document.getElementById('tabellernas'));
    /* "showRowNumber" is an option which creates a column numerating the rows*/
    table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}


}
    



// cycling line chart 
function visualLineChartCyc () {

   

    
    
    // column headings 
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Distance travelled (m)"



   
    var allRows = [];
    
    
    try {

    //nested array with all rows 
    allRows = <?php echo empty($allRowSortNestCyc) ? '[]' : json_encode($allRowSortNestCyc) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    // The array containing data must be larger than 1 element because 
    // it doesn't make sense to make a line chart with one data point 
    if (Array.isArray(allRows) && allRows.length>1) {


    var data = new google.visualization.DataTable();
    data.addColumn('date','Date(s)');
    data.addColumn('number','Distance travlled (m)');



   
  
    
    // Since nested "forEach" is tricky when it comes to scopes while changing 
    // values referenced by valiables is challenging I decided to use nested 
    // "for"-loops with index
    // Inspiration. 
    // Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
    let NewDate= true;
   let nestOnce=true;
   let rowForData = [];
   let nestedRow = [];
    
    for(let i = 0; i < allRows.length; i++) {
  
        for(let j = 0; j < heading.length; j++) {
            if (NewDate) {
               
                rowForData.push(new Date(allRows[i][j]));
                NewDate=false;
            } else {
                rowForData.push(Number(allRows[i][j]));
            }
            
        }
        nestedRow.push(rowForData);
        rowForData=[];
        NewDate=true;
    }
   
    
    data.addRows(nestedRow);
    var options = {
        chart: {
            title: 'Cycling trend'
        },
        
        width: 800,
        height: 500,
        vAxis: {title: 'Distance travelled (m)'},
        // Changes the format when overing over data points on the line 
        // aswell as the displayed dates on the x-axes
        hAxis: {format: 'yyyy/MM/dd'},
        axes:{
            x:{
              "": {side: 'bottom'}
            }
        }
    };

    var chart = new google.charts.Line(document.getElementById('charts'));

    chart.draw(data, google.charts.Line.convertOptions(options));
} else {

    // If there are any childnodes of element with "charts" id, destory them 
    if (document.getElementById('charts').childElementCount>0) {
    
      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
      document.getElementById('charts').innerHTML = '';
    
    }
}
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}

}

// cycling column visualize
function visualColumnCyc () {



// column headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Distance travelled"


var burnVisCol = [];

try {


   // Array with "dates", "cyclingDistance"
   burnVisCol = <?php echo empty($allRowSortNestCyc) ? '[]' : json_encode($allRowSortNestCyc) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(burnVisCol) && burnVisCol.length) {


// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];

for(let i = 0; i < burnVisCol.length; i++) {
  // adding blank column in order for the columns to take up 
  // 90% of the chart area
  nestedRow.push([" ", null]);

    for(let j = 0; j < heading.length; j++) {
        if (NewDate) {
           
            rowForData.push(new Date(burnVisCol[i][j]).toISOString().slice(0,10));
            NewDate=false;
        } else {
            rowForData.push(Number(burnVisCol[i][j]));
        }
        
    }
    // another blank column
    nestedRow.push([" ", null]);
    nestedRow.push(rowForData);
    rowForData=[];
    NewDate=true;
}


/* Add the  "heading" to fron of array*/
nestedRow.unshift(heading);

var data = new google.visualization.arrayToDataTable(nestedRow);

var options = {
      chart: {
        title: 'Cycling metrics'
      },
      width: 800,
      height: 500,
      vAxis: {title: 'Distance travelled (m)'},
      // Changes the format when overing over data points on the line 
      // aswell as the displayed dates on the x-axes
      hAxis: {format: 'yyyy/MM/dd'},
      bar: { groupWidth: "90%" },

    };

    var chart = new google.charts.Bar(document.getElementById('kolumner'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}


}

// cycling mean box visualization 
function visualMeanTotCyc () {
// If there are any childnodes of element with "charts" id, destory them 
if (document.getElementById("cardBody0").childElementCount>0){


       //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
    document.getElementById('cardBody0').innerHTML = '';



var arrCycDs = [];




    // when there is an error with provided data from the DB
try {



arrCycDs = <?php echo empty($arrDisCyc) ? '[]' : json_encode($arrDisCyc) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrCycDs) && arrCycDs.length)) {

    // created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumDistance = 0;

//calculate the cycling distance for a given date range 
for (i=0; i < arrCycDs.length; i++){
    sumDistance += parseInt(arrCycDs[i]);

    
}

// Calculated mean speed and total cycling distance will be added to the box
// element   

//.toFixed()" method rounds target number
let meanDistCyc = (sumDistance/arrCycDs.length).toFixed();


let headNode = document.createTextNode("Cycling: mean and total distance travelled");
let paraNode1 = document.createTextNode("Mean cycling distance: " + meanDistCyc + "m");
let paraNode2 = document.createTextNode("Total cycling distance: " + sumDistance + "m");


cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);



cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);



}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}

} else {
  


var arrCycDs = [];

    // when there is an error with provided data from the DB
try {



arrCycDs = <?php echo empty($arrDisCyc) ? '[]' : json_encode($arrDisCyc) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrCycDs) && arrCycDs.length)) {

  // created elements which will be contained in the box 

var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');


// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumDistance = 0;

//calculate the total cycling distance  
for (i=0; i < arrCycDs.length; i++){
    sumDistance += parseInt(arrCycDs[i]);

    
}


// Calculated mean speed and total cycling distance will be added to the box
// element   
//.toFixed()" method rounds target number
let meanDistCyc = (sumDistance/arrCycDs.length).toFixed();


let headNode = document.createTextNode("Cycling: mean and total distance travelled");
let paraNode1 = document.createTextNode("Mean cycling distance: " + meanDistCyc + "m");
let paraNode2 = document.createTextNode("Total cycling distance: " + sumDistance + "m");


cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);



cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);


}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}

 
}


}



// sleep table visualize
function visualTableSleep () {


  
// column headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Bed time"
heading[2] = "Wake up time"
heading[3] = "Time slept"
heading[4] = "Number of naps"
heading[5] = "Time slept naps"
heading[6] = "Total time slept"




var allRows = [];

    // when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestSL) ? '[]' : json_encode($allRowSortNestSL); ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
//console.log(allRows.length);
// Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
if (Array.isArray(allRows) && allRows.length) {


/* Find elements with colons. Split them to date compatible "timeofday" 
array (hh:mm:ss) by their colons, add them to an array and then added to the prepared array */

let rowForData = [];
let nestedNoColon = [];

// Add the title first to "nestedRow"



for(let i = 0; i < allRows.length; i++) {

  for(let j = 0; j < heading.length; j++) {
    //test if string contains ":". If true split the string by its divider ":"
    // and add it to an array   
    if (j==1 || j==2) {
        rowForData.push(((allRows[i][j]).split(/\:/)).map(Number));
        
      } else {
        // split by ":" (which creates an array, e.g. "23:00:00"-> ["23","00","00"])
        // ".map(Number)" method will turn the arrays elements into number type (int)
        rowForData.push(allRows[i][j]); 
          
      }

      }
      nestedNoColon.push(rowForData);
      rowForData=[];
  }
  


//console.log(nestedNoColon);

/* Different options for "addcolumn" for dates and time 
Link: https://developers.google.com/chart/interactive/docs/customizing_axes#discrete-vs-continuous */
var data = new google.visualization.DataTable();
data.addColumn('date','Dates');
data.addColumn('timeofday','Bed time');
data.addColumn('timeofday','Wake up time');
data.addColumn('string','Time slept');
data.addColumn('number','Number of naps');
data.addColumn('string', 'Time slept naps');
data.addColumn('string', 'Total time slept');

let NewDate= true;

//let rowForData = [];
let nestedRow = [];
// Add the to arrays in the right order to make it compatible 
// with Google Visualization "addColumn" method 
for(let i = 0; i < nestedNoColon.length; i++) {

  for(let j = 0; j < heading.length; j++) {
          if (NewDate) {
               
               rowForData.push(new Date(nestedNoColon[i][j]));
               NewDate=false;
           } else if (j==1 || j==2){
            rowForData.push(nestedNoColon[i][j]);
           } else if (j==4){
            rowForData.push(Number(nestedNoColon[i][j])); 
           } else {
            rowForData.push(String(nestedNoColon[i][j]));
           }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;

}

data.addRows(nestedRow);
//console.log(allRows);
//console.log(nestedRow);


 
 
  var table = new google.visualization.Table(document.getElementById('tabellernas'));
  /* "showRowNumber" is an option which creates a column numerating the rows*/
  table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}
  



// sleeping line chart 
function visualLineChartSleep () {




/* Inspiration for "visualLineChartSleep"
Link: https://stackoverflow.com/questions/20598457/how-to-change-google-area-chart-overlap-colour-or-opacity */


// line headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Bedtime"
heading[2] = "Wake up time"


var datetimeSL = [];
var bedtimeSL = [];
var getUpTimeSL = [];



    // when there is an error with provided data from the DB
try {

//3 different arrays, one with bedtime, one with wake up time and one with
// date time 
bedtimeSL = <?php echo empty($arrBedSL) ? '[]' : json_encode($arrBedSL) ?>;
getUpTimeSL = <?php echo empty($arrWakeSL) ? '[]' : json_encode($arrWakeSL) ?>;
datetimeSL  = <?php echo empty($arrDateSL) ? '[]' : json_encode($arrDateSL) ?>;
// Prevents figures to be created if the tables used are actual arrays and not empty
// The array containing data must be larger than 1 element because 
// it doesn't make sense to make a line chart with one data point 
if (Array.isArray(bedtimeSL) && bedtimeSL.length>1) {


let rowForData = [];
let nestedNoColon = [];

for(let i = 0; i < getUpTimeSL.length; i++) {

  
    //test if string contains ":". If true split the string by its divider ":"
    // and add it to an array   
    
    rowForData.push(new Date(datetimeSL[i])); 
    
    // split by ":" (which creates an array, e.g. "23:00:00"-> ["23","00","00"])
    // ".map(Number)" method will turn the arrays elements into number type (int)
    rowForData.push(((bedtimeSL[i]).split(/\:/)).map(Number));
    rowForData.push(((getUpTimeSL[i]).split(/\:/)).map(Number));
    console.log(bedtimeSL[i]);
    nestedNoColon.push(rowForData);
    rowForData=[];
      
}
  


//console.log(nestedNoColon);


var data = new google.visualization.DataTable();
    data.addColumn('date', 'Time of Day');
    data.addColumn('timeofday', 'Bedtime');
    data.addColumn('timeofday', 'Wake up');
    data.addRows(nestedNoColon);

    // options for for line chart 
    /* Max and min values makes it so that 
    the line chart is configured in the range for a 24h clock */
    var options = {
      title: 'Bedtime and wake up time',
      width: 900,
      height: 500,
      hAxis: {
        format: 'yyyy/MM/dd',
        gridlines: {count: 15}
        
      },
      vAxis: {
        format: 'HH:mm',
        title: 'Time of day',
        gridlines: {color: 'none'},
        maxValue: 24,
        minValue: 0
      }
    };
    var chart = new google.visualization.LineChart(document.getElementById('charts'));
    chart.draw(data, options);
} else {

    // If there are any childnodes of element with "charts" id, destory them 
    if (document.getElementById('charts').childElementCount>0) {
    
      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
      document.getElementById('charts').innerHTML = '';
    
    }
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

}



// sleep columns visualization
function visualColumnSleep () {



// column headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Time slept"
heading[2] = "Time slept naps"
heading[3] = "Total time slept"


var burnVisCol = [];

try {



// Array with "dates", "num.step", "distance travelled" and "burned calories"
burnVisCol = <?php echo empty($arrVisColSL) ? '[]' : json_encode($arrVisColSL) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(burnVisCol) && burnVisCol.length) {


// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];

for(let i = 0; i < burnVisCol.length; i++) {
  // adding blank column in order for the columns to take up 
  // 90% of the chart area
  nestedRow.push([" ", null]);
  for(let j = 0; j < burnVisCol[0].length; j++) {
      if (NewDate) {
         
          rowForData.push(new Date(burnVisCol[i][j]));
          NewDate=false;
      } else {
          var tryings = Date.Parse(burnVisCol[i][j]);

          console.log(burnVisCol[i][j]);
          console.log(typeof(burnVisCol[i][j]));
          rowForData.push(burnVisCol[i][j].toISOString());
      }
      
  }
  // another blank column
  nestedRow.push([" ", null]);
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}


/* Add the  "heading" to fron of array*/
nestedRow.unshift(heading);

console.log(nestedRow);

var data = new google.visualization.arrayToDataTable(nestedRow);

var options = {
    chart: {
      title: 'Sleeping metrics'
    },
    width: 800,
    height: 500,
    vAxis: {title: 'Naps and sleep'},
    // Changes the format when overing over data points on the line 
    // aswell as the displayed dates on the x-axes
    hAxis: {format: 'yyyy/MM/dd'},
    bar: { groupWidth: "90%" }

  };

  var chart = new google.charts.Bar(document.getElementById('kolumner'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}

// sleep box mean and total 
function visualMeanSleep () {

if (document.getElementById("cardBody0").childElementCount>0){


//destroy all childnodes of the "cardBody1" "div" element and creat the 
// "div" element for the function "visualMean" to replace existing elements from
// previous calls to, for example, "visualMeanTotCyc"
document.getElementById('cardBody0').innerHTML = '';

var timeSlept = [];
var totalSlept = [];
var numNaps = [];
var napsTimeSlept = [];
try {

  // Array with "dates", "getUpTime", "bedtime", "numNaps"
  timeSlept = <?php echo empty($arrSleepTimeSL) ? '[]' : json_encode($arrSleepTimeSL) ?>;

totalSlept = <?php echo empty($arrSumSleepSL) ? '[]' : json_encode($arrSumSleepSL) ?>;

numNaps = <?php echo empty($arrNumNapsSL) ? '[]' : json_encode($arrNumNapsSL) ?>;

napsTimeSlept = <?php echo empty($arrSumNapsSL) ? '[]' : json_encode($arrSumNapsSL) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(timeSlept) && timeSlept.length) || (Array.isArray(totalSlept) && totalSlept.length) || (Array.isArray(numNaps) && numNaps.length) || (Array.isArray(napsTimeSlept) && napsTimeSlept.length)) {

  // created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
var paraCard4 = document.createElement('p');


// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let totTimeSlept = 0;
let sumNaps = 0; 
let sumSlept = 0;
let napsTime = 0; 

//calculate the the sum sleep time, sum number of naps, sum naps time 
// total sleep time 
for (i=0; i < napsTimeSlept.length; i++){
  totTimeSlept += parseInt(totalSlept[i]);
  sumNaps += parseInt(numNaps[i]);
  sumSlept += parseInt(timeSlept[i]);
  napsTime += parseInt(napsTimeSlept[i]);
}

// Calculated mean and total for sleep and naps data  
//.toFixed()" method rounds target number
let totMeanSleep = (totTimeSlept/napsTimeSlept.length).toFixed(1);
let meanNapsSleep = (sumNaps/napsTimeSlept.length).toFixed(1);
let meanTimeSlept = (sumSlept/napsTimeSlept.length).toFixed(1);
let meanNaps = (napsTime/napsTimeSlept.length).toFixed();

let headNode = document.createTextNode("Mean total time slept, num. naps, naps sleept and time sleep per instance");
let paraNode1 = document.createTextNode("Mean tot. sleep: " + totMeanSleep + "h");
let paraNode2 = document.createTextNode("Mean num. naps: " + meanNapsSleep);
let paraNode3 = document.createTextNode("Mean time slept naps: " + meanNaps + "h");
let paraNode4 = document.createTextNode("Mean time slept: " + meanTimeSlept + "h");

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);
paraCard4.appendChild(paraNode4);

cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);
cardBody.appendChild(paraCard4);

}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}
} else {

var timeSlept = [];
var totalSlept = [];
var numNaps = [];
var napsTimeSlept = [];
try {

  
  // Array with "dates", "getUpTime", "bedtime", "numNaps"
  timeSlept = <?php echo empty($arrSleepTimeSL) ? '[]' : json_encode($arrSleepTimeSL) ?>;

totalSlept = <?php echo empty($arrSumSleepSL) ? '[]' : json_encode($arrSumSleepSL) ?>;

numNaps = <?php echo empty($arrNumNapsSL) ? '[]' : json_encode($arrNumNapsSL) ?>;

napsTimeSlept = <?php echo empty($arrSumNapsSL) ? '[]' : json_encode($arrSumNapsSL) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(timeSlept) && timeSlept.length) || (Array.isArray(totalSlept) && totalSlept.length) || (Array.isArray(numNaps) && numNaps.length) || (Array.isArray(napsTimeSlept) && napsTimeSlept.length)) {
 
  // created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
var paraCard4 = document.createElement('p');


// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let totTimeSlept = 0;
let sumNaps = 0; 
let sumSlept = 0;
let napsTime = 0; 

//calculate the the sum sleep time, sum number of naps, sum naps time 
// total sleep time 
for (i=0; i < napsTimeSlept.length; i++){
  totTimeSlept += parseInt(totalSlept[i]);
  sumNaps += parseInt(numNaps[i]);
  sumSlept += parseInt(timeSlept[i]);
  napsTime += parseInt(napsTimeSlept[i]);
}


// Calculated mean and total for sleep and naps data 
//.toFixed()" method rounds target number
let totMeanSleep = (totTimeSlept/napsTimeSlept.length).toFixed(1);
let meanNapsSleep = (sumNaps/napsTimeSlept.length).toFixed(1);
let meanTimeSlept = (sumSlept/napsTimeSlept.length).toFixed(1);
let meanNaps = (napsTime/napsTimeSlept.length).toFixed();

let headNode = document.createTextNode("Mean total time slept, num. naps, naps sleept and time sleep per instance");
let paraNode1 = document.createTextNode("Mean tot. sleep: " + totMeanSleep + "h");
let paraNode2 = document.createTextNode("Mean num. naps: " + meanNapsSleep);
let paraNode3 = document.createTextNode("Mean time slept naps: " + meanNaps + "h");
let paraNode4 = document.createTextNode("Mean time slept: " + meanTimeSlept + "h");

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);
paraCard4.appendChild(paraNode4);

cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);
cardBody.appendChild(paraCard4);


}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}
}
}

// sleep pie chart, giving the ratio between sum naps and sum sleep time
function visualPieSleep () {

let timeSlept = [];
let numNaps = [];



// when there is an error with provided data from the DB
try {

// arrays with naps and sleep time
timeSlept = <?php echo empty($arrSleepTimeSL) ? '[]' : json_encode($arrSleepTimeSL) ?>;

numNaps = <?php echo empty($arrSumNapsSL) ? '[]' : json_encode($arrSumNapsSL) ?>;

if ((Array.isArray(numNaps) && numNaps.length) || (Array.isArray(timeSlept) && timeSlept.length)) {

// accumulators 
let sumNaps=0;
let sumSleep=0;

//arrays for prepare 
let arrSumNaps = [];
let arrSumSleep = [];


// split by ":" (which creates an array, e.g. "23:00:00"-> ["23","00","00"])
// ".map(Number)" method will turn the arrays elements into number type (int)
for(let i = 0; i < timeSlept.length; i++) {
    arrSumSleep.push((timeSlept[i].split(/\:/)).map(Number));
    arrSumNaps.push((numNaps[i].split(/\:/)).map(Number));
}


//nested loop to sum the times 
for(let i = 0; i < arrSumNaps.length; i++) {

    for(let j = 0; j < arrSumNaps[0].length; j++) {
      
      if (j==1){

        // calculated according to 1/60, which is the ratio of 1 minut to the hour 
        sumNaps += arrSumNaps[i][j]*0,01666;
        sumSleep += arrSumSleep[i][j]*0,01666;    
      } else {
          
        sumNaps += arrSumNaps[i][j];
        sumSleep += arrSumSleep[i][j];

      }
      

    }
    

}


// Prepare array for the arrayToDataTable 
const arrTitle = ['Sleep activity', 'Time per day']
const dataSleep= ['Sleep time'];
const dataNaps = ['Nap time'];
dataSleep.push(sumSleep);
dataNaps.push(sumNaps);

const arrData = [];

arrData.push(arrTitle);
arrData.push(dataSleep);
arrData.push(dataNaps);


var data = google.visualization.arrayToDataTable(arrData);

    var options = {
      title: 'Total sleep activities',
      width:800,
      height:500,
      pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('kolumner'));
    chart.draw(data, options);
}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}

}


// weight table 
function visualTableWei () {

// column headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Weight (kg)"





var allRows = [];

    // when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestWei) ? '[]' : json_encode($allRowSortNestWei) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
//console.log(allRows.length);
// Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
if (Array.isArray(allRows) && allRows.length) {

var data = new google.visualization.DataTable();
data.addColumn('date','Dates');
data.addColumn('number','Weight (kg)');


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
          rowForData.push(Number(allRows[i][j]));
      }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}
//console.log(allRows);
//console.log(nestedRow);
data.addRows(nestedRow);


 
 
  var table = new google.visualization.Table(document.getElementById('tabellernas'));
  /* "showRowNumber" is an option which creates a column numerating the rows*/
  table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}
  




// weight line chart 
function visualLineChartWei () {






// line names 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Weight (kg)"



var allRows = [];


try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestWei) ? '[]' : json_encode($allRowSortNestWei) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
// The array containing data must be larger than 1 element because 
// it doesn't make sense to make a line chart with one data point 
if (Array.isArray(allRows) && allRows.length>1) {


var data = new google.visualization.DataTable();
data.addColumn('date','Date(s)');
data.addColumn('number','Weight (kg)');






// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];

for(let i = 0; i < allRows.length; i++) {

  for(let j = 0; j < heading.length; j++) {
      if (NewDate) {
         
          rowForData.push(new Date(allRows[i][j]));
          NewDate=false;
      } else {
          rowForData.push(Number(allRows[i][j]));
      }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}

//console.log(allRows);
//console.log(nestedRow);
data.addRows(nestedRow);
var options = {
  chart: {
      title: 'Weight trend'
  },
  width: 800,
  height: 500,
  vAxis: 
  {title: 'Weight (kg)'},
  // Changes the format when overing over data points on the line 
  // aswell as the displayed dates on the x-axes
  hAxis: {format: 'yyyy/MM/dd'},
   
  axes:{
      x:{
        "": {side: 'bottom'}
      }
  }
};

var chart = new google.charts.Line(document.getElementById('charts'));

chart.draw(data, google.charts.Line.convertOptions(options));
} else {

    // If there are any childnodes of element with "charts" id, destory them 
    if (document.getElementById('charts').childElementCount>0) {
    
      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
      document.getElementById('charts').innerHTML = '';
    
    }
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

}

// weight column chart
function visualColumnWei () {



// headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Weight (kg)"


var burnVisCol = [];

// when there is an error with provided data from the DB
try {



// Array with "dates", "weight"
burnVisCol = <?php echo empty($allRowSortNestWei) ? '[]' : json_encode($allRowSortNestWei) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(burnVisCol) && burnVisCol.length) {


// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];






for(let i = 0; i < burnVisCol.length; i++) {
  // adding blank column in order for the columns to take up 
  // 90% of the chart area
  nestedRow.push([" ", null]);
  for(let j = 0; j < heading.length; j++) {
   
      if (NewDate) {
         // turns date format "monthe, day, year, time, time zone"  into "yyyy-MM-dd"
         // is needed when adding blank columns and to get the correct data
         // when forming options for the chart 
          rowForData.push(new Date(burnVisCol[i][j]).toISOString().slice(0,10));
          NewDate=false;
      } else {
          rowForData.push(Number(burnVisCol[i][j]));
      }
      
  }
  // another blank column
  nestedRow.push([" ", null]);
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}


/* Add the  "heading" to fron of array*/
nestedRow.unshift(heading);
console.log(nestedRow);


var data = new google.visualization.arrayToDataTable(nestedRow);

var options = {
    chart: {
      title: 'Weight metrics'
    },
    width: 800,
    height: 500,
    bar: { groupWidth: "90%" },
    vAxis: 
    {title: 'Weight (kg)'},
    hAxis: {format: 'yyyy/MM/dd'},
   
  };

  var chart = new google.charts.Bar(document.getElementById('kolumner'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}

// weight mean weight visaulization
function visualMeanTotWei () {


  // If there are any childnodes of element with "charts" id, destory them 
if (document.getElementById("cardBody0").childElementCount>0){


      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
document.getElementById('cardBody0').innerHTML = '';



var arrWei = [];

   // when there is an error with provided data from the DB
try {


// array with weight and dates 
arrWei = <?php echo empty($arrDisWei) ? '[]' : json_encode($arrDisWei) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrWei) && arrWei.length)) {

  // created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumWei = 0;

//calculate the total weight 
for (i=0; i < arrWei.length; i++){
  sumWei += parseInt(arrWei[i]);


}

// Calculate mean wight 
//.toFixed()" method rounds target number
let meanWei = (sumWei/arrWei.length).toFixed(1);


let headNode = document.createTextNode("Weight: mean weight for selected date range");
let paraNode1 = document.createTextNode("Mean weight: " + meanWei + "kg");



cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);




cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);



}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}

} else {



var arrWei = [];

    // when there is an error with provided data from the DB
try {


// array with dates and weight 
arrWei = <?php echo empty($arrDisWei) ? '[]' : json_encode($arrDisWei) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrWei) && arrWei.length)) {



    // created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');



// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumWei = 0;

//calculate the total weight 
for (i=0; i < arrWei.length; i++){
  sumWei += parseInt(arrWei[i]);


}

// Calculate mean weight  
//.toFixed()" method rounds target number
let meanWei = (sumWei/arrWei.length).toFixed(1);


let headNode = document.createTextNode("Weight: mean weight for selected date range");
let paraNode1 = document.createTextNode("Mean weight: " + meanWei + "kg");



cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);




cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);


}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}


}

}

// steps table visualize
function visualTableStep () {


var heading = new Array();
heading[0] = "Dates"
heading[1] = "Num. steps"





var allRows = [];

    // when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestStep) ? '[]' : json_encode($allRowSortNestStep) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
//console.log(allRows.length);
// Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
if (Array.isArray(allRows) && allRows.length) {

var data = new google.visualization.DataTable();
data.addColumn('date','Dates');
data.addColumn('number','Num. steps');


let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];

for(let i = 0; i < allRows.length; i++) {

  for(let j = 0; j < heading.length; j++) {
      if (NewDate) {
         
          rowForData.push(new Date(allRows[i][j]));
          NewDate=false;
      } else {
          rowForData.push(Number(allRows[i][j]));
      }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}
console.log(allRows);
console.log(nestedRow);
data.addRows(nestedRow);


 
 
  var table = new google.visualization.Table(document.getElementById('tabellernas'));
  /* "showRowNumber" is an option which creates a column numerating the rows*/
  table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}
  




// steps line chart 
function visualLineChartStep () {






var heading = new Array();
heading[0] = "Dates"
heading[1] = "Num. steps"



var allRows = [];

// when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestStep) ? '[]' : json_encode($allRowSortNestStep) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
// The array containing data must be larger than 1 element because 
// it doesn't make sense to make a line chart with one data point 
if (Array.isArray(allRows) && allRows.length>1) {


var data = new google.visualization.DataTable();
data.addColumn('date','Date(s)');
data.addColumn('number','Num. steps');






// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];

for(let i = 0; i < allRows.length; i++) {

  for(let j = 0; j < heading.length; j++) {
      if (NewDate) {
         
          rowForData.push(new Date(allRows[i][j]));
          NewDate=false;
      } else {
          rowForData.push(Number(allRows[i][j]));
      }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}

//console.log(allRows);
//console.log(nestedRow);
data.addRows(nestedRow);
var options = {
  chart: {
      title: 'Num. steps trend'
  },
  width: 800,
  height: 500,
  vAxis: 
    {title: 'Num. steps'},
    // Changes the format when overing over data points on the line 
    // aswell as the displayed dates on the x-axes
    hAxis: {format: 'yyyy/MM/dd'},
  axes:{
      x:{
        "": {side: 'bottom'}
      }
  }
};

var chart = new google.charts.Line(document.getElementById('charts'));

chart.draw(data, google.charts.Line.convertOptions(options));
} else {

    // If there are any childnodes of element with "charts" id, destory them 
    if (document.getElementById('charts').childElementCount>0) {
    
      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
      document.getElementById('charts').innerHTML = '';
    
    }
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

}

// steps column chart 
function visualColumnStep () {





var heading = new Array();
heading[0] = "Dates"
heading[1] = "Num. steps"


var burnVisCol = [];

// when there is an error with provided data from the DB
try {



// Array with "dates", "numSteps"
burnVisCol = <?php echo empty($allRowSortNestStep) ? '[]' : json_encode($allRowSortNestStep) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(burnVisCol) && burnVisCol.length) {


// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];

for(let i = 0; i < burnVisCol.length; i++) {
  // adding blank column in order for the columns to take up 
  // 90% of the chart area
  nestedRow.push([" ", null]);

  for(let j = 0; j < heading.length; j++) {
      if (NewDate) {
         
          rowForData.push(new Date(burnVisCol[i][j]).toISOString().slice(0,10));
          NewDate=false;
      } else {
          rowForData.push(Number(burnVisCol[i][j]));
      }
      
  }
   // another blank column
   nestedRow.push([" ", null]);
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}


/* Add the  "heading" to fron of array*/
nestedRow.unshift(heading);

var data = new google.visualization.arrayToDataTable(nestedRow);

var options = {
    chart: {
      title: 'Steps metrics'
    },
    width: 800,
    height: 500,
    bar: { groupWidth: "90%" },
    vAxis: 
    {title: 'Num. steps'},
    // Changes the format when overing over data points on the line 
    // aswell as the displayed dates on the x-axes
    hAxis: {format: 'yyyy/MM/dd'}

  };

  var chart = new google.charts.Bar(document.getElementById('kolumner'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}


// steps mean and total box visualization 
function visualMeanTotStep () {
 
    // If there are any childnodes of element with "charts" id, destory them 
if (document.getElementById("cardBody0").childElementCount>0){


      //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
document.getElementById('cardBody0').innerHTML = '';



var arrSteps = [];


    // when there is an error with provided data from the DB
try {



arrSteps = <?php echo empty($arrDisStep) ? '[]' : json_encode($arrDisStep) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrSteps) && arrSteps.length)) {

// created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');


// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumSteps = 0;

//calculate the walking speed for a given date range 
for (i=0; i < arrSteps.length; i++){
  sumSteps += parseInt(arrSteps[i]);


}

// Calculate mean and total number of steps for a given date range  
//.toFixed()" method rounds target number
let meanSteps = (sumSteps/arrSteps.length).toFixed();


let headNode = document.createTextNode("Steps: mean and total num. steps taken");
let paraNode1 = document.createTextNode("Mean num. steps: " + meanSteps);
let paraNode2 = document.createTextNode("Total num. steps: " + sumSteps);


cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);



cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);



}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}

} else {



var arrSteps = [];

 // when there is an error with provided data from the DB
try {



arrSteps = <?php echo empty($arrDisStep) ? '[]' : json_encode($arrDisStep) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrSteps) && arrSteps.length)) {

    // created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');


// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumSteps = 0;

//calculate the walking speed for a given date range 
for (i=0; i < arrSteps.length; i++){
  sumSteps += parseInt(arrSteps[i]);


}


// Calculate mean and total number of steps for a given date range  
//.toFixed()" method rounds target number
let meanSteps = (sumSteps/arrSteps.length).toFixed();


let headNode = document.createTextNode("Steps: mean and total num. steps taken");
let paraNode1 = document.createTextNode("Mean num. steps: " + meanSteps);
let paraNode2 = document.createTextNode("Total num. steps: " + sumSteps);


cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);



cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);


}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}


}

}


// engergy expenediture table 
function visualTableEng () {

var heading = new Array();
heading[0] = "Dates"
heading[1] = "Energy expenditure"





var allRows = [];

    // when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestCal) ? '[]' : json_encode($allRowSortNestCal) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
//console.log(allRows.length);
// Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
if (Array.isArray(allRows) && allRows.length) {

var data = new google.visualization.DataTable();
data.addColumn('date','Dates');
data.addColumn('number','Energy expenditure');


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
          rowForData.push(Number(allRows[i][j]));
      }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}
console.log(allRows);
console.log(nestedRow);
data.addRows(nestedRow);


 
 
  var table = new google.visualization.Table(document.getElementById('tabellernas'));
  /* "showRowNumber" is an option which creates a column numerating the rows*/
  table.draw(data, {showRowNumber: true, pageSize: 10, width: '100%', height: '40%'});
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}
  



// energy expenditure line chart 
function visualLineChartEng () {






// line headings
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Energy expenditure"



var allRows = [];


    // when there is an error with provided data from the DB
try {

//nested array with all rows 
allRows = <?php echo empty($allRowSortNestCal) ? '[]' : json_encode($allRowSortNestCal) ?>;

// Prevents figures to be created if the tables used are actual arrays and not empty
// The array containing data must be larger than 1 element because 
// it doesn't make sense to make a line chart with one data point 
if (Array.isArray(allRows) && allRows.length>1) {


var data = new google.visualization.DataTable();
data.addColumn('date','Date(s)');
data.addColumn('number','Energy expenditure');






// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
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
          rowForData.push(Number(allRows[i][j]));
      }
      
  }
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}

//console.log(allRows);
//console.log(nestedRow);
data.addRows(nestedRow);
var options = {
  chart: {
      title: 'Energy expenditure trend'
  },
  width: 800,
  height: 500,
  vAxis: 
    {title: 'Energy expenditure'},
    // Changes the format when overing over data points on the line 
    // aswell as the displayed dates on the x-axes
    hAxis: {format: 'yyyy/MM/dd'},
  axes:{
      x:{
        "": {side: 'bottom'}
      }
  }
};

var chart = new google.charts.Line(document.getElementById('charts'));

chart.draw(data, google.charts.Line.convertOptions(options));
} else {

  // If there are any childnodes of element with "charts" id, destory them 
  if (document.getElementById('charts').childElementCount>0) {

    //destroy all childnodes of the "charts" "div" element from 
    // previous calls to, for example, "visualLineChartEng" when 
    // date range populates an array which is 1 or fewer elements 
    document.getElementById('charts').innerHTML = '';

  }
}


} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

}


// engergy expenditure columns 
function visualColumnEng () {



// headings 
var heading = new Array();
heading[0] = "Dates"
heading[1] = "Energy expenditure"


var burnVisCol = [];

    // when there is an error with provided data from the DB
try {



// Array with "dates", "burned calories"
burnVisCol = <?php echo empty($allRowSortNestCal) ? '[]' : json_encode($allRowSortNestCal) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(burnVisCol) && burnVisCol.length) {


// Since nested "forEach" is tricky when it comes to scopes while changing 
// values referenced by valiables is challenging I decided to use nested 
// "for"-loops with index
// Inspiration. 
// Link: https://www.codegrepper.com/code-examples/javascript/nested+array+loop+foreach+javascript
let NewDate= true;
let nestOnce=true;
let rowForData = [];
let nestedRow = [];


/* A loop nested "for"-loop used to order the list so 
    as the right data is in the right column and the right data type */
for(let i = 0; i < burnVisCol.length; i++) {
  // adding blank column in order for the columns to take up 
  // 90% of the chart area
  nestedRow.push([" ", null]);

  for(let j = 0; j < heading.length; j++) {
      if (NewDate) {
         
          rowForData.push(new Date(burnVisCol[i][j]).toISOString().slice(0,10));
          NewDate=false;
      } else {
          rowForData.push(Number(burnVisCol[i][j]));
      }
      
  }
   // another blank column
   nestedRow.push([" ", null]);
  nestedRow.push(rowForData);
  rowForData=[];
  NewDate=true;
}


/* Add the  "heading" to fron of array*/
nestedRow.unshift(heading);

var data = new google.visualization.arrayToDataTable(nestedRow);

var options = {
    chart: {
      title: 'Energy expenditure metrics'
    },
    width: 800,
    height: 500,
    bar: { groupWidth: "90%" },
    vAxis: 
    {title: 'Energy expenditure'},
    // Changes the format when overing over data points on the line 
    // aswell as the displayed dates on the x-axes
    hAxis: {format: 'yyyy/MM/dd'}
  };

  var chart = new google.charts.Bar(document.getElementById('kolumner'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}


// energy expenditure box visualization
function visualMeanTotEng () {

  // If there are any childnodes of element with "charts" id, destory them 
if (document.getElementById("cardBody0").childElementCount>0){

 //destroy all childnodes of the "charts" "div" element from 
      // previous calls to, for example, "visualLineChartEng" when 
      // date range populates an array which is 1 or fewer elements 
document.getElementById('cardBody0').innerHTML = '';



var arrCals = [];

// when there is an error with provided data from the DB
try {



  arrCals = <?php echo empty($arrCal) ? '[]' : json_encode($arrCal) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrCals) && arrCals.length)) {


// created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');


// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumCal = 0;

//calculate the total calories burned
for (i=0; i < arrCals.length; i++){
  sumCal += parseInt(arrCals[i]);


}

// Calculate mean and total calories burned  
//.toFixed()" method rounds target number
let meanCal = (sumCal/arrCals.length).toFixed();


let headNode = document.createTextNode("Calories: mean and total calories burned");
let paraNode1 = document.createTextNode("Mean calories burned: " + meanCal);
let paraNode2 = document.createTextNode("Total calories burned: " + sumCal);


cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);



cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);



}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}

} else {


var arrCals = [];

// when there is an error with provided data from the DB
try {



  arrCals = <?php echo empty($arrCal) ? '[]' : json_encode($arrCal) ?>;




// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(arrCals) && arrCals.length)) {

// created elements which will be contained in the box 
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');

//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumCal = 0;

//calculate the total calories burned
for (i=0; i < arrCals.length; i++){
  sumCal += parseInt(arrCals[i]);


}

// Calculate mean and total calories burned  
//.toFixed()" method rounds target number
let meanCal = (sumCal/arrCals.length).toFixed();


let headNode = document.createTextNode("Calories: mean and total calories burned");
let paraNode1 = document.createTextNode("Mean calories burned: " + meanCal);
let paraNode2 = document.createTextNode("Total calories burned: " + sumCal);


cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);



cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);



}
} catch (error) {
if (error instanceof SyntaxError){
console.error('Selected dates are out of range');
}
}


}

}

// Resets "cardBody1"'s content when call all the other functions for the 
// combined compares
function visualTotReset() {
    var cardBody = document.getElementById("cardBody1");
    cardBody.removeAttribute('style');
    cardBody.innerHTML = '';

}
const divTitlar = document.getElementById("tabellernas");


/* Options on which mutations to observe */
const obsMutConfig = {childList: true};



// Callback function used to adjust size of the table visualizations 
const callback = function (observer){

    //Optional way to make a callback function with the second "MutationObserver"
    //Create a mutation observer for the "tbody" element 
    // Link: https://developer.mozilla.org/en-US/docs/Web/API/MutationObserver/observe

    
    const tbodyEle = document.getElementsByTagName("tbody")[0];
    

    const obsMutConfigTbody = {childList: true};

    const callback = function (tbodyObserver){
            let numb = tbodyEle.childElementCount;
            //console.log(numb);
        if (10>numb){
            /* About average size for each row (table height is set to 40% at load and 
            there are 10 rows per page, "numb" is the number of "childNodes" for "tbody", i.e. rows
            of the table)  */
            let tableSize = 40/(10/numb);
            /* since the "getElementsByClassName" will result in a "HTMLCollection" 
            output (i.e. an object) where in our case the "0" index is the "div" element
            Link: https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByClassName
            Link1: https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection */
            var tableClass = document.getElementsByClassName('google-visualization-table')[0];
            
            tableClass.style.height = tableSize + "%";

           
        }       

    }

    const tbodyObserver = new MutationObserver(callback);
    
    // The above script to adjust table size only works for 
    // Google table figures 
    if (typeof tbodyEle == 'object') {
        tbodyObserver.observe(tbodyEle,obsMutConfigTbody);
    }
    
}
/* Observer instance for the "callback" function */
const observer = new MutationObserver(callback);

/* start observing "divTitlar" for mutations */
observer.observe(divTitlar,obsMutConfig);



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
       
       var IDpage = 18; 

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
});

</script>

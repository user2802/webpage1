<!-- Following code shows how to select rows from a MySQL table and 
pass them into an array 
Link: https://www.youtube.com/watch?v=gnkI7hIC2RU&ab_channel=DaniKrossing-->



<?php
include_once ('template.php');
echo $navigation; 
?>
<?php
if (isset($_POST['dateStart']) AND isset($_POST['dateEnd']) AND isset($_SESSION['userId'])) {


//echo $_POST['dateStart'];
//echo $_POST['dateEnd'];

// "$mysqli" is the variable from "template.php" used as an argument for "mysqli_query"   
// https://www.youtube.com/watch?v=gnkI7hIC2RU&ab_channel=DaniKrossing
        $query = <<<END
        SELECT w.dates, w.numSteps, w.walkingDistance, w.timeWalk, b.burned_kcal 
        FROM Walking w, BurnedKcal b
        WHERE ((w.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND (b.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND w.dates=b.dates
        AND '{$_SESSION['userId']}'=w.id AND '{$_SESSION['userId']}' = b.id)
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
    $allRowSort[] = $arrays['numSteps'];
    $allRowSort[] = $arrays['walkingDistance'];
    $allRowSort[] = $arrays['timeWalk'];
    $allRowSort[] = $arrays['burned_kcal'];
    $allRowSortNest[]= $allRowSort;
    $allRowSort = array();

    
}   

/* Array for "visualColumn" function */

$arrVisCol=array();

foreach($arrayOut as $arrays) {

    $allRowSort[] = $arrays['dates'];
    $allRowSort[] = $arrays['numSteps'];
    $allRowSort[] = $arrays['walkingDistance'];
    $allRowSort[] = $arrays['burned_kcal'];
    $arrVisCol[]= $allRowSort;
    $allRowSort = array();

    
}   

$arrDate = array();
$arrNumStep = array();
$arrWD = array();
$arrTime = array();
$arrBurn = array();
// For line charts, contains dates, num. steps and walking distance in 3 
// separate rows 
foreach($arrayOut as $arrays) {

    $arrDate[] = $arrays['dates'];
    $arrNumStep[] = $arrays['numSteps'];
    $arrWD[] = $arrays['walkingDistance'];
    $arrTime[] = $arrays['timeWalk'];
    $arrBurn[] = $arrays['burned_kcal'];

    
}

} else {
    //echo "Select table is empty";

}

        $queryCyc = <<<END
        SELECT c.dates, c.cyclingDistance, c.timeCyc, bc.burned_kcal 
        FROM Cycling c, BurnedKcalCyc bc
        WHERE ((c.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND (bc.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND c.dates=bc.dates
        AND '{$_SESSION['userId']}' = c.id AND '{$_SESSION['userId']}'=bc.id)
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
    $allRowSortCyc[] = $arrays['timeCyc'];
    $allRowSortCyc[] = $arrays['burned_kcal'];
    $allRowSortNestCyc[]= $allRowSortCyc;
    $allRowSortCyc= array();


}   

/* Array for "visualColumn" function */

$arrVisColCyc=array();

foreach($arrayOutCyc as $arrays) {

    $allRowSortCyc[] = $arrays['dates'];
    $allRowSortCyc[] = $arrays['cyclingDistance'];
    $allRowSortCyc[] = $arrays['burned_kcal'];
    $arrVisColCyc[]= $allRowSortCyc;
    $allRowSortCyc= array();


}   

$arrDateCyc = array();
$arrDisCyc = array();
$arrTimeCyc= array();
$arrBurnCyc = array();
// For line charts, contains dates, num. steps and walking distance in 3 
// separate rows 
foreach($arrayOutCyc as $arrays) {

    $arrDateCyc[] = $arrays['dates'];
    $arrDisCyc[] = $arrays['cyclingDistance'];
    $arrTimeCyc[] = $arrays['timeCyc'];
    $arrBurnCyc[] = $arrays['burned_kcal'];


}      




} else {
    //echo "Select table is empty";

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

/* Array for "visualColumn" function */

$arrVisColSL=array();

foreach($arrayOutSL as $arrays) {

    $allRowSortSL[] = $arrays['dates'];
    $allRowSortSL[] = $arrays['sleep_time'];
    $allRowSortSL[] = $arrays['sumNaps'];
    $allRowSortSL[] = $arrays['sum_sleep'];
    $arrVisColSL[]= $allRowSortSL;
    $allRowSortSL= array();

    
}   

// To create an array used to visualize area between 2 lines
$arrLineArea=array();

foreach($arrayOutSL as $arrays) {

    $allRowSortSL[] = $arrays['dates'];
    $allRowSortSL[] = $arrays['bedtime'];
    $allRowSortSL[] = $arrays['getUpTime'];
    $arrLineArea[]= $allRowSortSL;
    $allRowSortSL= array();

    
}  

/* Array for "visualPieSleep" function
The "sleep_time" and "sumNaps" will be iterated and summed
with "var dates_as_int = dates.map(Date.parse);" 
Link: https://stackoverflow.com/questions/38701847/how-can-i-convert-a-date-into-an-integer*/


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

} else {
    //echo "Select table is empty";

}
        //query to get the max values from walking and cycling together with their views
        // about burned calories
        $queryMax = <<<END
        SELECT MAX(c.cyclingDistance) AS maxCyc, MAX(c.timeCyc) AS maxTimeCyc, MAX(bc.burned_kcal) AS maxCycBurn, MAX(w.walkingDistance) AS maxWalkDist, MAX(w.timeWalk) AS maxTimeWalk, MAX(b.burned_kcal) AS maxWalkBurn
        FROM Cycling c, BurnedKcalCyc bc, Walking w, BurnedKcal b 
        WHERE ((c.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND (bc.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND c.dates=bc.dates AND (w.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') 
        AND (b.dates BETWEEN '{$_POST['dateStart']}' AND '{$_POST['dateEnd']}') AND w.dates=b.dates
        AND '{$_SESSION['userId']}'=c.id AND '{$_SESSION['userId']}'=bc.id AND '{$_SESSION['userId']}'=w.id AND '{$_SESSION['userId']}'=b.id)
END;

$outputsMax = $mysqli-> query($queryMax);
$arrayOutMax = array();
if (mysqli_num_rows($outputsMax) > 0){
    while ($row = mysqli_fetch_assoc($outputsMax)){
        
        
        $arrayOutMax [] = $row;        

    }





$arrWalkMaxDist= array();
$arrCycMaxDist= array();
$arrWalkMaxTime= array();
$arrCycMaxTime= array();
$arrWalkMaxBurn= array();
$arrCycMaxBurn= array();

foreach($arrayOutMax as $arrays) {

    $arrWalkMaxDist[]= $arrays['maxWalkDist'];
    $arrCycMaxDist[] = $arrays['maxCyc'];
    $arrWalkMaxTime[]= $arrays['maxTimeWalk'];
    $arrCycMaxTime[]= $arrays['maxTimeCyc'];
    $arrWalkMaxBurn[]= $arrays['maxWalkBurn'];
    $arrCycMaxBurn[]= $arrays['maxCycBurn'];
   

    
}
} else {
    //echo "Select table is empty";

}
}









/*
$allRow[] = $arrDate;
$allRow[] = $arrNumStep;
$allRow[] = $arrWD;

$headings= array();
$headings[0] = "Dates"
$headings[1] = "Num. steps"
$headings[2] = "Distance travelled"

$allRowSort = array();
$allRowSortNest = array();

for (i=0; headings.length -1 > i; i++){
    $allRowSort [] = $arrDate[i];
    $allRowSort [] = $arrNumStep[i];
    $allRowSort [] = $arrWD[i];
    $allRowSortNest [] = $allRowSort
}
*/

//print_r($allRow);

/*
echo $arrDate;
echo $arrNumStep;
echo $arrWD;*/

?>
<!--  load packages for line charts
    The google charts packages should be loaded in the head
    Link: https://developers.google.com/chart/interactive/docs/basic_load_libs-->  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
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

    /* For google visualization of areas between lines
    link: https://stackoverflow.com/questions/20598457/how-to-change-google-area-chart-overlap-colour-or-opacity */
    //google.load("visualization", "1", {packages:["corechart"]});
    </script>
    <!-- APIs and modules for "daterangepicker" -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<div class="menu">
        <div class="col00">

        <!-- "select" and "option" divided by "optgroup" works according to:
        Link: https://getbootstrap.com/docs/5.0/forms/select/
        Link1: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/optgroup--> 
        <select id = "visData" class="form-select" aria-label="Default select example">
            <option selected>--Data visualization--</option>
            <optgroup label="Walking"> 
            <option value=1>Walking statistics</option>
            </optgroup>
            <optgroup label="Cycling"> 
            <option value="2">Cycling statistics</option>
            </optgroup>
            <optgroup label="Sleeping"> 
            <option value="3">Sleeping and naps statistics</option>
            </optgroup>
            <optgroup label="Combined statistics"> 
            <option value="4">All activities</option>
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
        Link: https://getbootstrap.com/docs/5.1/components/alerts/#dismissing--> 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Important!</strong>  You're required to select a date range before choosing which data to visualize
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        <div class="col11">
        </div>

</div>
  <!-- Inspiration
    Link: https://react-bootstrap.github.io/components/dropdowns/#single-button-dropdowns
    Configuration of "react-bootstrap"
    Link1: https://react-bootstrap.github.io/getting-started/introduction/-->

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
Link: https://stackoverflow.com/questions/7642442/what-does-function-do */
$(function() {
  $('input[name="datarange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    var dateStart=start.format('YYYY-MM-DD');
    var dateEnd=end.format('YYYY-MM-DD');
    //Create a javascript array
    //var dateArray = [];
    //dateArray.push(dateEnd);
    //dateArray.push(dateStart);
    //console.log(dateArray);
    //var dateArrayJSON = JSON.stringify(dateArray);
    // add attribute "value" with list "jarray" 
    //$('#dateSubmit').attr("value",dateArrayJSON);
    //$('#submitStart').attr("value",dateStart);
    //$('#submitEnd').attr("value",dateEnd);
    // submit form
    //$(".submitEnd").val(end.format('YYYY-MM-DD'));
    //$(".submitStart").val(start.format('YYYY-MM-DD'));
    //$(".submitStart").attr("value",start.format('YYYY-MM-DD'));
    //$(".submitEnd").attr("value",end.format('YYYY-MM-DD'));
    $(setAttrVal(dateStart, dateEnd));
});



}); 


function setAttrVal (dateStart, dateEnd){
        /* Function which set the value for the attribute "value" and 
        submits it to the "SELECT" statement  */
        var startID = document.getElementById("submitStart");
        var endID =  document.getElementById("submitEnd");
        console.log(startID);
        console.log(dateStart);
        startID.setAttribute("value", dateStart);
        endID.setAttribute("value", dateEnd);
        // "getElementById" didn't work for the form but "getElementByTagName" worked
        document.getElementsByTagName("form")[0].submit();
        

    
        
    
}

var whichEvent = document.getElementById('visData');
whichEvent.addEventListener('change', function() {
  if(this.value=="1"){
    visualTable();
    visualLineChart();
    visualColumn();
    visualMean();
    visualTotal();
  } else if (this.value=="2"){
    visualTableCyc();
    visualLineChartCyc();
    visualColumnCyc();
    visualMeanCyc();
    visualTotalCyc();
    
  } else if (this.value=="3"){
    visualTableSleep();
    visualLineChartSleep();
    visualColumnSleep();
    visualMeanSleep();
    visualTotalSleep(); 
    visualPieSleep();    
    
    
  } else if (this.value=="4"){
      visualPieComp();
      visualPieTimeComp();
      visualColumnSessionComp();
      visualTotCompare();
      visualTotReset();
    
  }
  }, false);

//adding all functions inside one might require that you expand the scope 
/*function walkingVisual () {
    visualTable();
    visualLineChart();
    visualColumn();
    visualMean();
    visualTotal();
    
}*/
function visualTable () {


    
      //Link: http://jsfiddle.net/4pEJB/
    // How it should work 
    /*
    var myLineDiv = document.getElementById("titlar")
    var lineChart = document.createElement('lineChart')
    var lineBody = document.createElement('lBody')
    lineChart.setAttribute('id', 'timelines');
    */
    
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Num. steps"
    heading[2] = "Distance travelled"
    heading[3] = "Time (min)"
    heading[4] = "Burned calories"

    
   

    var allRows = [];
    
    //Obs. elementen i listorna är string (d.v.s. omges av "")
    try {
    
    //nested array with all rows 
    allRows = <?php echo empty($allRowSortNest) ? '[]' : json_encode($allRowSortNest) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    //console.log(allRows.length);
    // Link: https://stackoverflow.com/questions/11743392/check-if-an-array-is-empty-or-exists
    if (Array.isArray(allRows) && allRows.length) {

    var data = new google.visualization.DataTable();
    data.addColumn('date','Dates');
    data.addColumn('number','Num. steps');
    data.addColumn('number','Distance travelled');
    data.addColumn('number','Time (min)');
    data.addColumn('number','Burned calories');

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
        

  
// this funktion is linked to an event trigger where if the "input" with name 
// "timelines" is clicked the 
// Link: https://developers.google.com/chart/interactive/docs/gallery/linechart
// link1: https://developers.google.com/chart/interactive/docs/gallery/linechart#top-x-charts
     
/*window.addEventListener("load", () => {
    document.querySelector("#chartDiv").addEventListener("click", visualLineChart); 

});*/



function visualLineChart () {
    
 
      //Link: http://jsfiddle.net/4pEJB/
    // How it should work 
    /*
    var myLineDiv = document.getElementById("titlar")
    var lineChart = document.createElement('lineChart')
    var lineBody = document.createElement('lBody')
    lineChart.setAttribute('id', 'timelines');
    */

   

    
    
    
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Num. steps"
    heading[2] = "Distance travelled"


   
    var allRows = [];
    
    
    try {

    //nested array with all rows 
    allRows = <?php echo empty($allRowSortNest) ? '[]' : json_encode($allRowSortNest) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    if (Array.isArray(allRows) && allRows.length) {


    var data = new google.visualization.DataTable();
    data.addColumn('date','Date(s)');
    data.addColumn('number','Num. steps');
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
    /*
    NewDate= true;
    const rowForData = [];
    const nestedRow = [];
    for (const rowNum of allRows){
        for (const row of allRows) {
            if (NewDate) {
                rowForData.push(new Date(ele));
                NewDate=false;
                
            }
            const rowForData = [];
        }
        nestedRow.push(rowForData);
        const rowForData = [];
        NewDate= true;
    }
    */
    console.log(allRows);
    console.log(nestedRow);
    data.addRows(nestedRow);
    var options = {
        chart: {
            title: 'Walking trend',
         subtitle: 'num. steps and distance travelled'
        },
        width: 800,
        height: 500,
        axes:{
            x:{
              "": {side: 'bottom'}
            }
        }
    };

    var chart = new google.charts.Line(document.getElementById('charts'));

    chart.draw(data, google.charts.Line.convertOptions(options));
}
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}

}


function visualColumn () {
    /* Column charts which will be used 
    Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

      //Link: http://jsfiddle.net/4pEJB/
    // How it should work 
    /*
    var myLineDiv = document.getElementById("titlar")
    var lineChart = document.createElement('lineChart')
    var lineBody = document.createElement('lBody')
    lineChart.setAttribute('id', 'timelines');
    */

    
   

    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Num. steps"
    heading[2] = "Distance travelled"
    heading[3] = "Burned calories"

    
    var burnVisCol = [];

    try {
    
    
    
    // Array with "dates", "num.step", "distance travelled" and "burned calories"
    burnVisCol = <?php echo empty($arrVisCol) ? '[]' : json_encode($arrVisCol) ?>;

   
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
  
        for(let j = 0; j < heading.length; j++) {
            if (NewDate) {
               
                rowForData.push(new Date(burnVisCol[i][j]));
                NewDate=false;
            } else {
                rowForData.push(Number(burnVisCol[i][j]));
            }
            
        }
        nestedRow.push(rowForData);
        rowForData=[];
        NewDate=true;
    }

    
    /* Add the  "heading" to fron of array*/
    nestedRow.unshift(heading);

    var data = new google.visualization.arrayToDataTable(nestedRow);

    var options = {
          chart: {
            title: 'Walking metrics',
            subtitle: 'Distance, num. steps and burned calories',
          },
          width: 800,
          height: 500,
          bar: { groupWidth: "75%" }

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


function visualMean () {
    /* Column charts which will be used 
    Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

    if (document.getElementById("cardBody0").childElementCount>0){

     //destroy all childnodes of the "cardBody1" "div" element and creat the 
    // "div" element for the function "visualMean" to replace existing elements from
    // previous calls to, for example, "visualMeanCyc"
    document.getElementById('cardBody0').innerHTML = '';

    var burnVisCol = [];
    var arrWDs = [];
    var arrTime = [];
    var arrNumSteps = [];
    try {

        // Array with "dates", "num.step", "distance travelled" and "burned calories"
        burnVisCol = <?php echo empty($arrBurn) ? '[]' : json_encode($arrBurn) ?>;
    
    arrWDs = <?php echo empty($arrWD) ? '[]' : json_encode($arrWD) ?>;

    arrTime = <?php echo empty($arrTime) ? '[]' : json_encode($arrTime) ?>;

    arrNumSteps = <?php echo empty($arrNumStep) ? '[]' : json_encode($arrNumStep) ?>;

    
    // Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
    if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length) || (Array.isArray(arrNumSteps) && arrNumSteps.length)) {

    //Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
    // element och sedan lägga till diagramet till det skapade elementet
    var cardBody = document.getElementById("cardBody0");
    var cardHeading5 = document.createElement('h5');
    var paraCard1 = document.createElement('p');
    var paraCard2 = document.createElement('p');
    var paraCard3 = document.createElement('p');
    var paraCard4 = document.createElement('p');
    //cardHeading5.setAttribute('id', 'cardHeading');
    //paraCard1.setAttribute('id', 'cardText0');
    //paraCard2.setAttribute('id', 'cardText1');

    // Set attribute color, size etc. dynamically for "card-body" class div
    cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
    cardHeading5.setAttribute('id', 'meanHead');


    

    


    let sumDistance = 0;
    let sumTime = 0; 
    let sumKcal = 0;
    let sumSteps = 0; 
    //calculate the walking speed for a given date range 
    for (i=0; i < arrNumSteps.length; i++){
        sumDistance += parseInt(arrWDs[i]);
        sumTime += parseInt(arrTime[i]);
        sumKcal += parseInt(burnVisCol[i]);
        sumSteps += parseInt(arrNumSteps[i]);
    }

    // Calculate mean speed and mean time spent walking for a given date range 
    //.toFixed()" method rounds target number
    let meanSpeed = (((sumDistance/1000)/(sumTime/60))/arrNumSteps.length).toFixed(1);
    let meanTime = ((sumTime)/arrNumSteps.length).toFixed();
    let meanBurn = (sumKcal/arrNumSteps.length).toFixed();
    let meanSteps = (sumSteps/arrNumSteps.length).toFixed();

    let headNode = document.createTextNode("Mean speed, time walking and burned calories");
    let paraNode1 = document.createTextNode("Mean speed: " + meanSpeed + "km/h");
    let paraNode2 = document.createTextNode("Mean num. steps: " + meanSteps);
    let paraNode3 = document.createTextNode("Mean walking time: " + meanTime + "min.");
    let paraNode4 = document.createTextNode("Mean burned calories: " + meanBurn + "kcal");

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


    //set the content of the "p" elements in the bootstrap card
    //document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
    //document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
    }
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}


} else {
      //Link: http://jsfiddle.net/4pEJB/
    // How it should work 
    /*
    var myLineDiv = document.getElementById("titlar")
    var lineChart = document.createElement('lineChart')
    var lineBody = document.createElement('lBody')
    lineChart.setAttribute('id', 'timelines');
    */


    var burnVisCol = [];
    var arrWDs = [];
    var arrTime = [];
    var arrNumSteps = [];
    try {

        // Array with "dates", "num.step", "distance travelled" and "burned calories"
        burnVisCol = <?php echo empty($arrBurn) ? '[]' : json_encode($arrBurn) ?>;
    
    arrWDs = <?php echo empty($arrWD) ? '[]' : json_encode($arrWD) ?>;

    arrTime = <?php echo empty($arrTime) ? '[]' : json_encode($arrTime) ?>;

    arrNumSteps = <?php echo empty($arrNumStep) ? '[]' : json_encode($arrNumStep) ?>;

    
    // Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
    if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length) || (Array.isArray(arrNumSteps) && arrNumSteps.length)) {

    //Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
    // element och sedan lägga till diagramet till det skapade elementet
    var cardBody = document.getElementById("cardBody0");
    var cardHeading5 = document.createElement('h5');
    var paraCard1 = document.createElement('p');
    var paraCard2 = document.createElement('p');
    var paraCard3 = document.createElement('p');
    var paraCard4 = document.createElement('p');
    //cardHeading5.setAttribute('id', 'cardHeading');
    //paraCard1.setAttribute('id', 'cardText0');
    //paraCard2.setAttribute('id', 'cardText1');

    // Set attribute color, size etc. dynamically for "card-body" class div
    cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
    cardHeading5.setAttribute('id', 'meanHead');


    

    


    let sumDistance = 0;
    let sumTime = 0; 
    let sumKcal = 0;
    let sumSteps = 0; 
    //calculate the walking speed for a given date range 
    for (i=0; i < arrNumSteps.length; i++){
        sumDistance += parseInt(arrWDs[i]);
        sumTime += parseInt(arrTime[i]);
        sumKcal += parseInt(burnVisCol[i]);
        sumSteps += parseInt(arrNumSteps[i]);
    }

    // Calculate mean speed and mean time spent walking for a given date range 
    //.toFixed()" method rounds target number
    let meanSpeed = (((sumDistance/1000)/(sumTime/60))/arrNumSteps.length).toFixed(1);
    let meanTime = ((sumTime)/arrNumSteps.length).toFixed();
    let meanBurn = (sumKcal/arrNumSteps.length).toFixed();
    let meanSteps = (sumSteps/arrNumSteps.length).toFixed();

    let headNode = document.createTextNode("Mean speed, time walking and burned calories");
    let paraNode1 = document.createTextNode("Mean speed: " + meanSpeed + "km/h");
    let paraNode2 = document.createTextNode("Mean num. steps: " + meanSteps);
    let paraNode3 = document.createTextNode("Mean walking time: " + meanTime + "min.");
    let paraNode4 = document.createTextNode("Mean burned calories: " + meanBurn + "kcal");

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


    //set the content of the "p" elements in the bootstrap card
    //document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
    //document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
    }
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}
    
 

}
}
/* Shows a windows which, for example, displays the totala amount of burned
calories, distance travelled etc.  */
function visualTotal () {
    /* Column charts which will be used 
    Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

    if (document.getElementById("cardBody1").childElementCount>0){

    //destroy all childnodes of the "cardBody1" "div" element and creat the 
    // "div" element for the function "visualTotal" to replace existing elements from
    // previous calls 
    document.getElementById('cardBody1').innerHTML = '';


    var burnVisCol = [];
    var arrWDs = [];
    var arrTime = [];
    var arrNumSteps = [];
    try {

    
    // Array with "dates", "num.step", "distance travelled" and "burned calories"
    burnVisCol = <?php echo empty($arrBurn) ? '[]' : json_encode($arrBurn) ?>;
    
    arrWDs = <?php echo empty($arrWD) ? '[]' : json_encode($arrWD) ?>;

    arrTime = <?php echo empty($arrTime) ? '[]' : json_encode($arrTime) ?>;

    arrNumSteps = <?php echo empty($arrNumStep) ? '[]' : json_encode($arrNumStep) ?>;

    
    // Prevents figures to be created if the tables used are undefined or null
    if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length) || (Array.isArray(arrNumSteps) && arrNumSteps.length)) {

    //Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
    // element och sedan lägga till diagramet till det skapade elementet
    var cardBody = document.getElementById("cardBody1");
    var cardHeading5 = document.createElement('h5');
    var paraCard1 = document.createElement('p');
    var paraCard2 = document.createElement('p');
    var paraCard3 = document.createElement('p');
    var paraCard4 = document.createElement('p');
    //cardHeading5.setAttribute('id', 'cardHeading');
    //paraCard1.setAttribute('id', 'cardText0');
    //paraCard2.setAttribute('id', 'cardText1');

    // Set attribute color, size etc. dynamically for "card-body" class div
    cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
    cardHeading5.setAttribute('id', 'sumHead');

    


    let sumSteps = 0;
    let sumDistance = 0;
    let sumTime = 0; 
    let sumKcal = 0;
    //calculate the walking speed for a given date range 
    for (i=0; i < arrNumSteps.length; i++){
        sumSteps +=parseInt(arrNumSteps[i]);
        sumDistance += parseInt(arrWDs[i]);
        sumTime += parseInt(arrTime[i]);
        sumKcal += parseInt(burnVisCol[i]);
    }

    // convert minutes to hours with division and through modulus of the hour to
    // get the decimals    
    let timeHour = (sumTime/60)-((sumTime/60)%1);

    //get the number of minutes through modulus
    let timeMin = sumTime%60;
    
    if (timeMin<10){
        timeMinString = '0'+String(timeMin);
    } else {
        timeMinString = timeMin;
    }

    let headNode = document.createTextNode("Mean speed, time walking and burned calories");
    let paraNode1 = document.createTextNode("Total number of steps: " + sumSteps);
    let paraNode2 = document.createTextNode("Total distance travelled: " + sumDistance + "m");
    let paraNode3 = document.createTextNode("Total number of burned calories: " + sumKcal + "kcal");
    let paraNode4 = document.createTextNode("Total time spent on workout: " + timeHour +":" + timeMinString + "h");

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


    //set the content of the "p" elements in the bootstrap card
    //document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
    //document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
    }
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}

} else {
      //Link: http://jsfiddle.net/4pEJB/
    // How it should work 
    /*
    var myLineDiv = document.getElementById("titlar")
    var lineChart = document.createElement('lineChart')
    var lineBody = document.createElement('lBody')
    lineChart.setAttribute('id', 'timelines');
    */


    var burnVisCol = [];
    var arrWDs = [];
    var arrTime = [];
    var arrNumSteps = [];
    try {

    
    // Array with "dates", "num.step", "distance travelled" and "burned calories"
    burnVisCol = <?php echo empty($arrBurn) ? '[]' : json_encode($arrBurn) ?>;
    
    arrWDs = <?php echo empty($arrWD) ? '[]' : json_encode($arrWD) ?>;

    arrTime = <?php echo empty($arrTime) ? '[]' : json_encode($arrTime) ?>;

    arrNumSteps = <?php echo empty($arrNumStep) ? '[]' : json_encode($arrNumStep) ?>;

    
    // Prevents figures to be created if the tables used are undefined or null
    if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length) || (Array.isArray(arrNumSteps) && arrNumSteps.length)) {

    //Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
    // element och sedan lägga till diagramet till det skapade elementet
    var cardBody = document.getElementById("cardBody1");
    var cardHeading5 = document.createElement('h5');
    var paraCard1 = document.createElement('p');
    var paraCard2 = document.createElement('p');
    var paraCard3 = document.createElement('p');
    var paraCard4 = document.createElement('p');
    //cardHeading5.setAttribute('id', 'cardHeading');
    //paraCard1.setAttribute('id', 'cardText0');
    //paraCard2.setAttribute('id', 'cardText1');

    // Set attribute color, size etc. dynamically for "card-body" class div
    cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
    cardHeading5.setAttribute('id', 'sumHead');

    


    let sumSteps = 0;
    let sumDistance = 0;
    let sumTime = 0; 
    let sumKcal = 0;
    //calculate the walking speed for a given date range 
    for (i=0; i < arrNumSteps.length; i++){
        sumSteps +=parseInt(arrNumSteps[i]);
        sumDistance += parseInt(arrWDs[i]);
        sumTime += parseInt(arrTime[i]);
        sumKcal += parseInt(burnVisCol[i]);
    }

    // convert minutes to hours with division and through modulus of the hour to
    // get the decimals    
    let timeHour = (sumTime/60)-((sumTime/60)%1);

    //get the number of minutes through modulus
    let timeMin = sumTime%60;
    
    if (timeMin<10){
        timeMinString = '0'+String(timeMin);
    } else {
        timeMinString = timeMin;
    }

    let headNode = document.createTextNode("Mean speed, time walking and burned calories");
    let paraNode1 = document.createTextNode("Total number of steps: " + sumSteps);
    let paraNode2 = document.createTextNode("Total distance travelled: " + sumDistance + "m");
    let paraNode3 = document.createTextNode("Total number of burned calories: " + sumKcal + "kcal");
    let paraNode4 = document.createTextNode("Total time spent on workout: " + timeHour +":" + timeMinString + "h");

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


    //set the content of the "p" elements in the bootstrap card
    //document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
    //document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
    }
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}


}
 

}

function visualTableCyc () {


  //Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/

var heading = new Array();
heading[0] = "Dates"
heading[1] = "Distance travelled"
heading[2] = "Time (min)"
heading[3] = "Burned calories"




var allRows = [];

//Obs. elementen i listorna är string (d.v.s. omges av "")
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
data.addColumn('number','Time (min)');
data.addColumn('number','Burned calories');

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
    


// this funktion is linked to an event trigger where if the "input" with name 
// "timelines" is clicked the 
// Link: https://developers.google.com/chart/interactive/docs/gallery/linechart
// link1: https://developers.google.com/chart/interactive/docs/gallery/linechart#top-x-charts
 
/*window.addEventListener("load", () => {
document.querySelector("#chartDiv").addEventListener("click", visualLineChart); 

});*/



function visualLineChartCyc () {


      //Link: http://jsfiddle.net/4pEJB/
    // How it should work 
    /*
    var myLineDiv = document.getElementById("titlar")
    var lineChart = document.createElement('lineChart')
    var lineBody = document.createElement('lBody')
    lineChart.setAttribute('id', 'timelines');
    */

   

    
    
    
    var heading = new Array();
    heading[0] = "Dates"
    heading[1] = "Distance travelled (m)"
    heading[2] = "Time (min)"
    heading[3] = "Burned calories"



   
    var allRows = [];
    
    
    try {

    //nested array with all rows 
    allRows = <?php echo empty($allRowSortNestCyc) ? '[]' : json_encode($allRowSortNestCyc) ?>;
    
    // Prevents figures to be created if the tables used are actual arrays and not empty
    if (Array.isArray(allRows) && allRows.length) {


    var data = new google.visualization.DataTable();
    data.addColumn('date','Date(s)');
    data.addColumn('number','Distance travlled (m)');
    data.addColumn('number','Time (min)');
    data.addColumn('number','Burned calories');



   
  
    
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
    /*
    NewDate= true;
    const rowForData = [];
    const nestedRow = [];
    for (const rowNum of allRows){
        for (const row of allRows) {
            if (NewDate) {
                rowForData.push(new Date(ele));
                NewDate=false;
                
            }
            const rowForData = [];
        }
        nestedRow.push(rowForData);
        const rowForData = [];
        NewDate= true;
    }
    */
    console.log(allRows);
    console.log(nestedRow);
    data.addRows(nestedRow);
    var options = {
        chart: {
            title: 'Cycling trend',
            subtitle: 'distance, time and burned calories'
        },
        width: 800,
        height: 500,
        axes:{
            x:{
              "": {side: 'bottom'}
            }
        }
    };

    var chart = new google.charts.Line(document.getElementById('charts'));

    chart.draw(data, google.charts.Line.convertOptions(options));
}
} catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
}

}


function visualColumnCyc () {
/* Column charts which will be used 
Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

  //Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/




var heading = new Array();
heading[0] = "Dates"
heading[1] = "Distance travelled"
heading[2] = "Burned calories"


var burnVisCol = [];

try {


   // Array with "dates", "num.step", "distance travelled" and "burned calories"
   burnVisCol = <?php echo empty($arrVisColCyc) ? '[]' : json_encode($arrVisColCyc) ?>;


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

    for(let j = 0; j < heading.length; j++) {
        if (NewDate) {
           
            rowForData.push(new Date(burnVisCol[i][j]));
            NewDate=false;
        } else {
            rowForData.push(Number(burnVisCol[i][j]));
        }
        
    }
    nestedRow.push(rowForData);
    rowForData=[];
    NewDate=true;
}


/* Add the  "heading" to fron of array*/
nestedRow.unshift(heading);

var data = new google.visualization.arrayToDataTable(nestedRow);

var options = {
      chart: {
        title: 'Cycling metrics',
        subtitle: 'Distance and burned calories',
      },
      width: 800,
      height: 500,
      bar: { groupWidth: "75%" }

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


function visualMeanCyc () {
/* Column charts which will be used 
Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

if (document.getElementById("cardBody0").childElementCount>0){


    document.getElementById('cardBody0').innerHTML = '';


var burnVisCol = [];
var arrWDs = [];
var arrTime = [];

try {

    // Array with "dates", "num.step", "distance travelled" and "burned calories"
    burnVisCol = <?php echo empty($arrBurnCyc) ? '[]' : json_encode($arrBurnCyc) ?>;

arrWDs = <?php echo empty($arrDisCyc) ? '[]' : json_encode($arrDisCyc) ?>;

arrTime = <?php echo empty($arrTimeCyc) ? '[]' : json_encode($arrTimeCyc) ?>;



// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length)) {

//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumDistance = 0;
let sumTime = 0; 
let sumKcal = 0;

//calculate the walking speed for a given date range 
for (i=0; i < burnVisCol.length; i++){
    sumDistance += parseInt(arrWDs[i]);
    sumTime += parseInt(arrTime[i]);
    sumKcal += parseInt(burnVisCol[i]);
    
}

// Calculate mean speed and mean time spent walking for a given date range 
//.toFixed()" method rounds target number
let meanSpeed = (((sumDistance/1000)/(sumTime/60))/burnVisCol.length).toFixed(1);
let meanTime = ((sumTime)/burnVisCol.length).toFixed();
let meanBurn = (sumKcal/burnVisCol.length).toFixed();


let headNode = document.createTextNode("Mean speed, time cycling and burned calories");
let paraNode1 = document.createTextNode("Mean speed: " + meanSpeed + "km/h");
let paraNode2 = document.createTextNode("Mean cycling time: " + meanTime + "min.");
let paraNode3 = document.createTextNode("Mean burned calories: " + meanBurn + "kcal");

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);


cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);



//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}

} else {
  //Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/


var burnVisCol = [];
var arrWDs = [];
var arrTime = [];

try {

    // Array with "dates", "num.step", "distance travelled" and "burned calories"
    burnVisCol = <?php echo empty($arrBurnCyc) ? '[]' : json_encode($arrBurnCyc) ?>;

arrWDs = <?php echo empty($arrDisCyc) ? '[]' : json_encode($arrDisCyc) ?>;

arrTime = <?php echo empty($arrTimeCyc) ? '[]' : json_encode($arrTimeCyc) ?>;



// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length)) {

//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let sumDistance = 0;
let sumTime = 0; 
let sumKcal = 0;

//calculate the walking speed for a given date range 
for (i=0; i < burnVisCol.length; i++){
    sumDistance += parseInt(arrWDs[i]);
    sumTime += parseInt(arrTime[i]);
    sumKcal += parseInt(burnVisCol[i]);
    
}

// Calculate mean speed and mean time spent walking for a given date range 
//.toFixed()" method rounds target number
let meanSpeed = (((sumDistance/1000)/(sumTime/60))/burnVisCol.length).toFixed(1);
let meanTime = ((sumTime)/burnVisCol.length).toFixed();
let meanBurn = (sumKcal/burnVisCol.length).toFixed();


let headNode = document.createTextNode("Mean speed, time cycling and burned calories");
let paraNode1 = document.createTextNode("Mean speed: " + meanSpeed + "km/h");
let paraNode2 = document.createTextNode("Mean cycling time: " + meanTime + "min.");
let paraNode3 = document.createTextNode("Mean burned calories: " + meanBurn + "kcal");

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);


cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);



//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}

 
}


}
/* Shows a windows which, for example, displays the totala amount of burned
calories, distance travelled etc.  */
function visualTotalCyc () {
/* Column charts which will be used 
Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

if (document.getElementById("cardBody1").childElementCount>0){

    //Remove conent before creating new 
    document.getElementById('cardBody1').innerHTML = '';


var burnVisCol = [];
var arrWDs = [];
var arrTime = [];

try {


// Array with "dates", "num.step", "distance travelled" and "burned calories"
burnVisCol = <?php echo empty($arrBurnCyc) ? '[]' : json_encode($arrBurnCyc) ?>;

arrWDs = <?php echo empty($arrDisCyc) ? '[]' : json_encode($arrDisCyc) ?>;

arrTime = <?php echo empty($arrTimeCyc) ? '[]' : json_encode($arrTimeCyc) ?>;




// Prevents figures to be created if the tables used are undefined or null
if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length)) {

//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody1");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');

//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'sumHead');





let sumDistance = 0;
let sumTime = 0; 
let sumKcal = 0;
//calculate the walking speed for a given date range 
for (i=0; i < burnVisCol.length; i++){
    sumDistance += parseInt(arrWDs[i]);
    sumTime += parseInt(arrTime[i]);
    sumKcal += parseInt(burnVisCol[i]);
}

console.log(sumDistance);



// convert minutes to hours with division and through modulus of the hour to
// get the decimals    
let timeHour = (sumTime/60)-((sumTime/60)%1);

//get the number of minutes through modulus
let timeMin = sumTime%60;

    if (timeMin<10){
        timeMinString = '0'+String(timeMin);
    } else {
        timeMinString = timeMin;
    }
let headNode = document.createTextNode("Total distance travelled, time spent and bruned calories");
let paraNode1 = document.createTextNode("Total distance travelled: " + sumDistance + "m");
let paraNode2 = document.createTextNode("Total number of burned calories: " + sumKcal + "kcal");
let paraNode3 = document.createTextNode("Total time spent on workout: " + timeHour +":" + timeMinString + "h");

console.log(sumDistance);

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);


cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);



//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}

} else {
  //Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/


var burnVisCol = [];
var arrWDs = [];
var arrTime = [];

try {


// Array with "dates", "num.step", "distance travelled" and "burned calories"
burnVisCol = <?php echo empty($arrBurnCyc) ? '[]' : json_encode($arrBurnCyc) ?>;

arrWDs = <?php echo empty($arrDisCyc) ? '[]' : json_encode($arrDisCyc) ?>;

arrTime = <?php echo empty($arrTimeCyc) ? '[]' : json_encode($arrTimeCyc) ?>;




// Prevents figures to be created if the tables used are undefined or null
if ((Array.isArray(burnVisCol) && burnVisCol.length) || (Array.isArray(arrWDs) && arrWDs.length) || (Array.isArray(arrTime) && arrTime.length)) {

//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody1");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');

//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'sumHead');





let sumDistance = 0;
let sumTime = 0; 
let sumKcal = 0;
//calculate the walking speed for a given date range 
for (i=0; i < burnVisCol.length; i++){
    sumDistance += parseInt(arrWDs[i]);
    sumTime += parseInt(arrTime[i]);
    sumKcal += parseInt(burnVisCol[i]);
}

console.log(sumDistance);



// convert minutes to hours with division and through modulus of the hour to
// get the decimals    
let timeHour = (sumTime/60)-((sumTime/60)%1);

//get the number of minutes through modulus
let timeMin = sumTime%60;

    if (timeMin<10){
        timeMinString = '0'+String(timeMin);
    } else {
        timeMinString = timeMin;
    }
let headNode = document.createTextNode("Total distance travelled, time spent and bruned calories");
let paraNode1 = document.createTextNode("Total distance travelled: " + sumDistance + "m");
let paraNode2 = document.createTextNode("Total number of burned calories: " + sumKcal + "kcal");
let paraNode3 = document.createTextNode("Total time spent on workout: " + timeHour +":" + timeMinString + "h");

console.log(sumDistance);

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);


cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);



//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + meanSpeed;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanTime;
}
} catch (error) {
if (error instanceof SyntaxError){
    console.error('Selected dates are out of range');
}
}


}


}



function visualTableSleep () {


    
//Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/

var heading = new Array();
heading[0] = "Dates"
heading[1] = "Bed time"
heading[2] = "Wake up time"
heading[3] = "Time slept"
heading[4] = "Number of naps"
heading[5] = "Time slept naps"
heading[6] = "Total time slept"




var allRows = [];

//Obs. elementen i listorna är string (d.v.s. omges av "")
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
  


console.log(nestedNoColon);

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
//data.addRows(nestedRow);

 
 
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
  


// this funktion is linked to an event trigger where if the "input" with name 
// "timelines" is clicked the 
// Link: https://developers.google.com/chart/interactive/docs/gallery/linechart
// link1: https://developers.google.com/chart/interactive/docs/gallery/linechart#top-x-charts

/*window.addEventListener("load", () => {
document.querySelector("#chartDiv").addEventListener("click", visualLineChart); 

});*/



function visualLineChartSleep () {


//Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/




/* Inspiration for "visualLineChartSleep"
Link: https://stackoverflow.com/questions/20598457/how-to-change-google-area-chart-overlap-colour-or-opacity */

var heading = new Array();
heading[0] = "Dates"
heading[1] = "Bedtime"
heading[2] = "Wake up time"


var datetimeSL = [];
var bedtimeSL = [];
var getUpTimeSL = [];


try {

//nested array with all rows 
bedtimeSL = <?php echo empty($arrBedSL) ? '[]' : json_encode($arrBedSL) ?>;
getUpTimeSL = <?php echo empty($arrWakeSL) ? '[]' : json_encode($arrWakeSL) ?>;
datetimeSL  = <?php echo empty($arrDateSL) ? '[]' : json_encode($arrDateSL) ?>;
// Prevents figures to be created if the tables used are actual arrays and not empty
if (Array.isArray(bedtimeSL) && bedtimeSL.length) {


let rowForData = [];
let nestedNoColon = [];

// Add the title first to "nestedRow"

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
  


console.log(nestedNoColon);


var data = new google.visualization.DataTable();
    data.addColumn('date', 'Time of Day');
    data.addColumn('timeofday', 'Bedtime');
    data.addColumn('timeofday', 'Wake up');
    data.addRows(nestedNoColon);
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
        gridlines: {color: 'none'},
        maxValue: 24,
        minValue: 0
      }
    };
    var chart = new google.visualization.LineChart(document.getElementById('charts'));
    chart.draw(data, options);
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

}


function visualColumnSleep () {
/* Column charts which will be used 
Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

//Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/




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
      title: 'Walking metrics',
      subtitle: 'Distance, num. steps and burned calories',
    },
    width: 800,
    height: 500,
    bar: { groupWidth: "75%" }

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


function visualMeanSleep () {
/* Column charts which will be used 
Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

if (document.getElementById("cardBody0").childElementCount>0){


//destroy all childnodes of the "cardBody1" "div" element and creat the 
// "div" element for the function "visualMean" to replace existing elements from
// previous calls to, for example, "visualMeanCyc"
document.getElementById('cardBody0').innerHTML = '';

var timeSlept = [];
var totalSlept = [];
var numNaps = [];
var napsTimeSlept = [];
try {

  // Array with "dates", "num.step", "distance travelled" and "burned calories"
  timeSlept = <?php echo empty($arrSleepTimeSL) ? '[]' : json_encode($arrSleepTimeSL) ?>;

totalSlept = <?php echo empty($arrSumSleepSL) ? '[]' : json_encode($arrSumSleepSL) ?>;

numNaps = <?php echo empty($arrNumNapsSL) ? '[]' : json_encode($arrNumNapsSL) ?>;

napsTimeSlept = <?php echo empty($arrSumNapsSL) ? '[]' : json_encode($arrSumNapsSL) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(timeSlept) && timeSlept.length) || (Array.isArray(totalSlept) && totalSlept.length) || (Array.isArray(numNaps) && numNaps.length) || (Array.isArray(napsTimeSlept) && napsTimeSlept.length)) {

//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
var paraCard4 = document.createElement('p');
//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let totTimeSlept = 0;
let sumNaps = 0; 
let sumSlept = 0;
let napsTime = 0; 
//calculate the walking speed for a given date range 
for (i=0; i < napsTimeSlept.length; i++){
  totTimeSlept += parseInt(totalSlept[i]);
  sumNaps += parseInt(numNaps[i]);
  sumSlept += parseInt(timeSlept[i]);
  napsTime += parseInt(napsTimeSlept[i]);
}

// Calculate mean speed and mean time spent walking for a given date range 
//.toFixed()" method rounds target number
let totMeanSleep = (totTimeSlept/napsTimeSlept.length).toFixed(1);
let meanNapsSleep = (sumNaps/napsTimeSlept.length).toFixed();
let meanTimeSlept = (sumSlept/napsTimeSlept.length).toFixed();
let meanNaps = (napsTime/napsTimeSlept.length).toFixed(1);

let headNode = document.createTextNode("Mean total time slept, num. naps, naps sleept and time sleep per instance");
let paraNode1 = document.createTextNode("Mean tot. sleep: " + totMeanSleep + "h");
let paraNode2 = document.createTextNode("Mean num. naps: " + meanNaps);
let paraNode3 = document.createTextNode("Mean time slept naps: " + meanNapsSleep + "h");
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


//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + totMeanSleep;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanNapsSleep;
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}



} else {
//Link: http://jsfiddle.net/4pEJB/
// How it should work 
/*
var myLineDiv = document.getElementById("titlar")
var lineChart = document.createElement('lineChart')
var lineBody = document.createElement('lBody')
lineChart.setAttribute('id', 'timelines');
*/


var timeSlept = [];
var totalSlept = [];
var numNaps = [];
var napsTimeSlept = [];
try {

  // Array with "dates", "num.step", "distance travelled" and "burned calories"
  timeSlept = <?php echo empty($arrSleepTimeSL) ? '[]' : json_encode($arrSleepTimeSL) ?>;

totalSlept = <?php echo empty($arrSumSleepSL) ? '[]' : json_encode($arrSumSleepSL) ?>;

numNaps = <?php echo empty($arrNumNapsSL) ? '[]' : json_encode($arrNumNapsSL) ?>;

napsTimeSlept = <?php echo empty($arrSumNapsSL) ? '[]' : json_encode($arrSumNapsSL) ?>;


// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(timeSlept) && timeSlept.length) || (Array.isArray(totalSlept) && totalSlept.length) || (Array.isArray(numNaps) && numNaps.length) || (Array.isArray(napsTimeSlept) && napsTimeSlept.length)) {

//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
var paraCard4 = document.createElement('p');
//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');







let totTimeSlept = 0;
let sumNaps = 0; 
let sumSlept = 0;
let napsTime = 0; 
//calculate the walking speed for a given date range 
for (i=0; i < napsTimeSlept.length; i++){
  totTimeSlept += parseInt(totalSlept[i]);
  sumNaps += parseInt(numNaps[i]);
  sumSlept += parseInt(timeSlept[i]);
  napsTime += parseInt(napsTimeSlept[i]);
}

// Calculate mean speed and mean time spent walking for a given date range 
//.toFixed()" method rounds target number
let totMeanSleep = (totTimeSlept/napsTimeSlept.length).toFixed(1);
let meanNapsSleep = (sumNaps/napsTimeSlept.length).toFixed();
let meanTimeSlept = (sumSlept/napsTimeSlept.length).toFixed();
let meanNaps = (napsTime/napsTimeSlept.length).toFixed(1);

let headNode = document.createTextNode("Mean total time slept, num. naps, naps sleept and time sleep per instance");
let paraNode1 = document.createTextNode("Mean tot. sleep: " + totMeanSleep + "h");
let paraNode2 = document.createTextNode("Mean num. naps: " + meanNaps);
let paraNode3 = document.createTextNode("Mean time slept naps: " + meanNapsSleep + "h");
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


//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + totMeanSleep;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanNapsSleep;
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}
}
}

function visualTotalSleep() {

    // Remove the style attribute from "cardBody1" and remove conent before creating new
    // said element  
    var cardBody = document.getElementById("cardBody1");
    cardBody.removeAttribute('style');
    document.getElementById('cardBody1').innerHTML = '';

}
/* Inspiration 
Link: https://developers.google.com/chart/interactive/docs/gallery/piechart#making-a-donut-chart */
function visualPieSleep () {

    let timeSlept = [];
    let numNaps = [];

    try {
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

    

    // Loop used to 
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

// pie chart for burned calories comparison between cycling and walking 
function visualPieComp() {

    let burnKcalWalk = [];
    let burnKcalCyc = []; 

    try {

    burnKcalWalk = <?php echo empty($arrBurn) ? '[]' : json_encode($arrBurn) ?>;
    
    burnKcalCyc = <?php echo empty($arrBurnCyc) ? '[]' : json_encode($arrBurnCyc) ?>;

    if ((Array.isArray(burnKcalWalk) && burnKcalWalk.length) || (Array.isArray(burnKcalCyc) && burnKcalCyc.length)) {
    // accumulators 
    let sumKcalWalk=0;
    let sumKcalCyc=0;

    //arrays used for data for the activities
    let arrSumWalk = ['Walking'];
    let arrSumCyc = ['Cycling'];
    let arrForData = [];
    
    console.log(burnKcalWalk);
    console.log(burnKcalCyc);
    // sum the burn calories for walking and cycling for the given period 
    for(let i = 0; i < burnKcalWalk.length; i++) {
        sumKcalWalk+=Number(burnKcalWalk[i]);
        
    }

    for(let i = 0; i < burnKcalCyc.length; i++) {
        sumKcalCyc+=Number(burnKcalCyc[i]);
        
    }

    

    arrSumWalk.push(sumKcalWalk);
    arrSumCyc.push(sumKcalCyc);
    arrForData.push(arrSumWalk);
    arrForData.push(arrSumCyc);

    console.log(arrForData);
    
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Activities');
    data.addColumn('number', 'Burned calories');

    data.addRows(arrForData);

        var options = {
          title:    'Burned calories',
          subtitle: 'Comparing burned calories between walking and cycling activities',
          width:    800,
          height:   500
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('tabellernas'));
        chart.draw(data, options);
    }
    } catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

}

// pie chart used to compare/illustrate the ratio between time spent walking and cycling
// for the selected period 
function visualPieTimeComp() {

    let timeWalk = [];
    let timeCyc = [];

    try {
timeWalk = <?php echo empty($arrTime) ? '[]' : json_encode($arrTime) ?>;

timeCyc = <?php echo empty($arrTimeCyc) ? '[]' : json_encode($arrTimeCyc) ?>;


if ((Array.isArray(timeWalk) && timeWalk.length) || (Array.isArray(timeCyc) && timeCyc.length)) {
// accumulators 
let sumTimeWalk=0;
let sumTimeCyc=0;

//arrays used for data for the activities
let arrSumWalk = ['Walking'];
let arrSumCyc = ['Cycling'];
let arrForData = [];


// sum the burn calories for walking and cycling for the given period 
for(let i = 0; i < timeWalk.length; i++) {
    sumTimeWalk+=Number(timeWalk[i]);
    
}

for(let i = 0; i < timeCyc.length; i++) {
    sumTimeCyc+=Number(timeCyc[i]);
    
}



arrSumWalk.push(sumTimeWalk);
arrSumCyc.push(sumTimeCyc);
arrForData.push(arrSumWalk);
arrForData.push(arrSumCyc);

console.log(arrForData);

var data = new google.visualization.DataTable();

data.addColumn('string', 'Activities');
data.addColumn('number', 'Time spent');

data.addRows(arrForData);

    var options = {
      title:    'Time spent',
      subtitle: 'Illustrating the ratio between time spent on walking and cycling activities',
      width:    800,
      height:   500
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('charts'));
    chart.draw(data, options);
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}


}

// shows as a column chart comparing the number of workout session for walking and
// cycling 

function visualColumnSessionComp () {

    
    var datesWalke = [];
    var datesCyc = [];

    try {
    
    
    
    // Array with "dates" for walking and cycling. These will be used to count the number of 
    // instances (i.e. workout sessions) done for a specific date range 
    datesWalk = <?php echo empty($arrDate) ? '[]' : json_encode($arrDate) ?>;
    datesCyc = <?php echo empty($arrDateCyc) ? '[]' : json_encode($arrDateCyc) ?>;

   
    // Prevents figures to be created if the tables used are actual arrays and not empty
    if ((Array.isArray(datesWalk) && datesWalk.length) && (Array.isArray(datesCyc) && datesCyc.length)) {

   
    // Accumulators to count number of sessions
    let numWalkSess = 0;
    let numCycSess = 0;
   
    let arrWalkSess = ['Walking sessions'];
    let arrCycSess = ['Cycling sessions'];
    
    for(let i = 0; i < datesWalk.length; i++) {
        numWalkSess+=1;
        
    }

    for(let i = 0; i < datesCyc.length; i++) {
        numCycSess+=1;
        
    }

    arrWalkSess.push(numWalkSess);
    arrCycSess.push(numCycSess);

    console.log(arrWalkSess);

    // adding matching color to the "cycling" column
    // Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart#labeling-columns
    


    // Enabling styling options and titles
    let titleArrForData = ['Activities', 'Number of sessions', { role: "style" }]

    let arrForData = [];

    arrForData.push(titleArrForData);

    arrWalkSess.push("#0d6efd");
    arrCycSess.push("#dc3545");

    arrForData.push(arrWalkSess);
    arrForData.push(arrCycSess);

    console.log(arrForData);

    var data = google.visualization.arrayToDataTable(arrForData);

    var options = {
          chart: {
            title: 'Number of sessions',
            subtitle: 'Comparing number of cycling- and walking sessions for a given date range',
          },
          width: 800,
          height: 500,
          bar: { groupWidth: "75%",
         },
         // removes decleration name after top column index 1 and larger (in our case 
         // "Number of sessions") with a default assigned colour. If setting is "none"
         // then there be no legend
         legend: { position: "none" },


          // Colors doesn't work the same way as shown in the documentation 
                        
        };
        

        var chart = new google.visualization.ColumnChart(document.getElementById('kolumner'));

        chart.draw(data, options);
    }
    } catch (error) {
    if (error instanceof SyntaxError){
        console.error('Selected dates are out of range');
    }
    }

}

// information window comparing single most calories burned, longest workout
// furthest distance travelled  

function visualTotCompare() {

    /* Column charts which will be used 
Link: https://developers.google.com/chart/interactive/docs/gallery/columnchart */

if (document.getElementById("cardBody0").childElementCount>0){


//destroy all childnodes of the "cardBody1" "div" element and creat the 
// "div" element for the function "visualMean" to replace existing elements from
// previous calls to, for example, "visualMeanCyc"
document.getElementById('cardBody0').innerHTML = '';

var walkTime = [];
var cycTime = [];
var walkBurn = [];
var cycBurn = [];
var walkDist= [];
var cycDist = [];
try {

  // Array with "dates", "num.step", "distance travelled" and "burned calories"
  walkTime = <?php echo empty($arrWalkMaxTime) ? '[]' : json_encode($arrWalkMaxTime) ?>;

  cycTime = <?php echo empty($arrCycMaxTime) ? '[]' : json_encode($arrCycMaxTime) ?>;

  walkBurn = <?php echo empty($arrWalkMaxBurn) ? '[]' : json_encode($arrWalkMaxBurn) ?>;

  cycBurn = <?php echo empty($arrCycMaxBurn) ? '[]' : json_encode($arrCycMaxBurn) ?>;

  walkDist = <?php echo empty($arrWalkMaxDist) ? '[]' : json_encode($arrWalkMaxDist) ?>;

  cycDist = <?php echo empty($arrCycMaxDist) ? '[]' : json_encode($arrCycMaxDist) ?>;
  
  
// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(walkBurn) && walkBurn.length) && (Array.isArray(cycTime) && cycTime.length) && (Array.isArray(cycBurn) && cycBurn.length) && (Array.isArray(walkDist) && walkDist.length) && (Array.isArray(cycDist) && cycDist.length)) {
    
    
      
    
//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
var paraCard4 = document.createElement('p');
var paraCard5 = document.createElement('p');
var paraCard6 = document.createElement('p');
//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');



let walkT = (Number(walkTime[0])).toFixed(1);
let cycT = (Number(cycTime[0])).toFixed(1);
let walkB =  (Number(walkBurn[0])).toFixed(1);
let cycB = (Number(cycBurn[0])).toFixed(1);
let walkD = (Number(walkDist[0])).toFixed(1);
let cycD = (Number(cycDist[0])).toFixed(1);

let headNode = document.createTextNode("Maximum bruned calories, distanced travelled and time session for walking anc cycling");
let paraNode1 = document.createTextNode("Max time walking session: " + walkT + 'min');
let paraNode2 = document.createTextNode("Max time cycling session: " + cycT + 'min');
let paraNode3 = document.createTextNode("Max burned calories walking: " +  walkB);
let paraNode4 = document.createTextNode("Mean burned calories cycling: " + cycB);
let paraNode5 = document.createTextNode("Max walk distance travelled: " + walkD + 'm');
let paraNode6 = document.createTextNode("Max cycling distance travelled: " + cycD + 'm');

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);
paraCard4.appendChild(paraNode4);
paraCard5.appendChild(paraNode5);
paraCard6.appendChild(paraNode6);

cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);
cardBody.appendChild(paraCard4);
cardBody.appendChild(paraCard5);
cardBody.appendChild(paraCard6);


//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + totMeanSleep;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanNapsSleep;
}
} catch (error) {
if (error instanceof SyntaxError){
  console.error('Selected dates are out of range');
}
}

} else {

var walkTime = [];
var cycTime = [];
var walkBurn = [];
var cycBurn = [];
var walkDist= [];
var cycDist = [];
try {

  // Array with "dates", "num.step", "distance travelled" and "burned calories"
  walkTime = <?php echo empty($arrWalkMaxTime) ? '[]' : json_encode($arrWalkMaxTime) ?>;

  cycTime = <?php echo empty($arrCycMaxTime) ? '[]' : json_encode($arrCycMaxTime) ?>;

  walkBurn = <?php echo empty($arrWalkMaxBurn) ? '[]' : json_encode($arrWalkMaxBurn) ?>;

  cycBurn = <?php echo empty($arrCycMaxBurn) ? '[]' : json_encode($arrCycMaxBurn) ?>;

  walkDist = <?php echo empty($arrWalkMaxDist) ? '[]' : json_encode($arrWalkMaxDist) ?>;

  cycDist = <?php echo empty($arrCycMaxDist) ? '[]' : json_encode($arrCycMaxDist) ?>;

  console.log(walkBurn);  

  // Check if arrays don't contains nulls 
  walkNull = walkTime.every(element => element !== null)
  cycNull = cycTime.every(element => element !== null)
  wBrunNull = walkBurn.every(element => element !== null)
  cBurnNull = cycBurn.every(element => element !== null)
  wDistNull = walkDist.every(element => element !== null)
  cDistNull = cycDist.every(element => element !== null)

// Prevents figures to be created if the tables used are actual arrays and not empty                                                                                    
if ((Array.isArray(walkBurn) && walkBurn.length) && (Array.isArray(cycTime) && cycTime.length) && 
(Array.isArray(cycBurn) && cycBurn.length) && (Array.isArray(walkDist) 
&& walkDist.length) && (Array.isArray(cycDist) && cycDist.length) && (walkNull) 
&& (cycNull) && (wBurnNull) && (cBurnNull) && (wDistNull) && (cDistNull)) {
    
//|| (Array.isArray(cycTime) && cycTime.length) || (Array.isArray(cycBurn) && cycBurn.length) || (Array.isArray(walkDist) && walkDist.length) ||(Array.isArray(cycDist) && cycDist.length)
    
//Dynamiska elementen fungerar inte som de ska; man kan inte ska ett 
// element och sedan lägga till diagramet till det skapade elementet
var cardBody = document.getElementById("cardBody0");
var cardHeading5 = document.createElement('h5');
var paraCard1 = document.createElement('p');
var paraCard2 = document.createElement('p');
var paraCard3 = document.createElement('p');
var paraCard4 = document.createElement('p');
var paraCard5 = document.createElement('p');
var paraCard6 = document.createElement('p');
//cardHeading5.setAttribute('id', 'cardHeading');
//paraCard1.setAttribute('id', 'cardText0');
//paraCard2.setAttribute('id', 'cardText1');

// Set attribute color, size etc. dynamically for "card-body" class div
cardBody.setAttribute('style', "max-width: 350px; border-width: 3px; border-style: solid; border-color: #0d6efd;");
cardHeading5.setAttribute('id', 'meanHead');

console.log(walkBurn[0]);  

let walkT = (Number(walkTime[0])).toFixed(1);
let cycT = (Number(cycTime[0])).toFixed(1);
let walkB =  (Number(walkBurn[0])).toFixed(1);
let cycB = (Number(cycBurn[0])).toFixed(1);
let walkD = (Number(walkDist[0])).toFixed(1);
let cycD = (Number(cycDist[0])).toFixed(1);

let headNode = document.createTextNode("Maximum bruned calories, distanced travelled and time session for walking anc cycling");
let paraNode1 = document.createTextNode("Max time walking session: " + walkT + 'min');
let paraNode2 = document.createTextNode("Max time cycling session: " + cycT + 'min');
let paraNode3 = document.createTextNode("Max burned calories walking: " +  walkB);
let paraNode4 = document.createTextNode("Mean burned calories cycling: " + cycB);
let paraNode5 = document.createTextNode("Max walk distance travelled: " + walkD + 'm');
let paraNode6 = document.createTextNode("Max cycling distance travelled: " + cycD + 'm');

cardHeading5.appendChild(headNode);
paraCard1.appendChild(paraNode1);
paraCard2.appendChild(paraNode2);
paraCard3.appendChild(paraNode3);
paraCard4.appendChild(paraNode4);
paraCard5.appendChild(paraNode5);
paraCard6.appendChild(paraNode6);

cardBody.appendChild(cardHeading5);
cardBody.appendChild(paraCard1);
cardBody.appendChild(paraCard2);
cardBody.appendChild(paraCard3);
cardBody.appendChild(paraCard4);
cardBody.appendChild(paraCard5);
cardBody.appendChild(paraCard6);


//set the content of the "p" elements in the bootstrap card
//document.getElementById("cardText0").innerHTML="Average speed" + totMeanSleep;
//document.getElementById("cardText1").innerHTML="Average walk speed" + meanNapsSleep;
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




const callback = function (observer){

    //Optional way to make a callback function with the second "MutationObserver"
    //Create a mutation observer for the "tbody" element 
    // Link: https://developer.mozilla.org/en-US/docs/Web/API/MutationObserver/observe
    /*
    const tbodyEle = document.getElementsByTagName("tbody")[0];

    const tbodyObserver = new MutationObserver( function () {
        let numb = tbodyEle.childElementCount;
            console.log(numb);
        if (10>numb){
            let tableSize = 40/(10/numb);
           var tableClass = document.getElementsByClassName('google-visualization-table')[0];
            console.log(tableClass);
            console.log(tableSize);
            tableClass.style.height = tableSize + "%";
        }
    });

    tbodyObserver.observe(tbodyEle, {childList: true}); */

    
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
            //console.log(tableClass);
            //console.log(tableSize);
            tableClass.style.height = tableSize + "%";

            /*Stop observing for changes in "tbody" element when done otherwise there
            will be multiple observations open*/
            //tbodyObserver.disconnect();
            //observer.disconnect();
        }       

    }

    const tbodyObserver = new MutationObserver(callback);
    
    tbodyObserver.observe(tbodyEle,obsMutConfigTbody);

    
}
/* Observer instance for the "callback" function */
const observer = new MutationObserver(callback);

/* start observing "divTitlar" for mutations */
observer.observe(divTitlar,obsMutConfig);

</script>

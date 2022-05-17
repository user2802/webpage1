<?php
include_once ('template.php');

    /* Following data is sen via POST submission provided via jQuery Ajax API
     * userID - User id 
     * userIP - Users IP address
     * visitDuration - time spent on page between page load and page close/refresh 
     * browser - kind of browser user uses 
     * pageID - Page number, which page is the end session data coming from
     */
    $userID=$_POST['ids'];
	$userIP=$_POST['IPaddresses'];
    $visitDuration=$_POST['vDur'];
    $browser=$_POST['browsers'];
    $pageID=$_POST['pageIDs'];

/*
   Insert transfered data
*/

    $query = <<<END
    INSERT INTO p_logs(id, IPaddress, visitDuration, pageID, browser) 
    VALUES('{$userID}','{$userIP}', '{$visitDuration}', '{$pageID}', '{$browser}')
END;
	
/* Note: "echo json_encode(array("statusCode"=>xxx)) can be used 
to make different repsons for alerts using the status code as condition 
*/ 
if ($mysqli->query($query) !== TRUE) {
    die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
    header('Location:index.php');
    //echo json_encode(array("statusCode"=>201));

} else {
    $mysqli->query($query);
    //echo json_encode(array("statusCode"=>200));
   
}

?>


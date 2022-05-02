<?php
include_once ('template.php');

    // Check if "id" and corresponding "browser" exists by counting number of 
    // number of rows selected
	$userIP=$_POST['IPaddresses'];
    $visitDuration=$_POST['vDur'];
    $browser=$_POST['brows'];
    $pageID=$_POST['IDpage'];

/*
// If there are no "id":s with corresponding "browsers" then the number of selected 
// rows is zero, and thus make a new instance 
*/

    $query = <<<END
    INSERT INTO p_logs(IPaddress, visitDuration, pageID, browser) 
    VALUES('{$userIP}', '{$visitDuration}', '{$pageID}', '{$browser}')
END;
	
if ($mysqli->query($query) !== TRUE) {
    die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
    header('Location:index.php');
    //echo json_encode(array("statusCode"=>201));

} else {
    $mysqli->query($query);
    //echo json_encode(array("statusCode"=>200));
    echo 'Current browser added to the database!';
}

?>


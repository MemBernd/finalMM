
<?php
require_once 'connection.php';
$clientRecord = (isset($_POST['clientRecord'])) ? $_POST['clientRecord'] : 1;
$eventType = (isset($_POST['eventType'])) ? $_POST['eventType'] : null;
$eventStartDateTime = (isset($_POST['eventStartDateTime'])) ? $_POST['eventStartDateTime'] : null;
$decorations = (isset($_POST['decorations'])) ? $_POST['decorations'] : null;
$eventEndDateTime = (isset($_POST['eventEndDateTime'])) ? $_POST['eventEndDateTime'] : null;
$attendees = (isset($_POST['attendees'])) ? $_POST['attendees'] : 0;
$parties = (isset($_POST['parties'])) ? $_POST['parties'] : null;
$photos = (isset($_POST['photos'])) ? $_POST['photos'] : null;
$breakfast = (isset($_POST['breakfast'])) ? $_POST['breakfast'] : null;
$drinks = (isset($_POST['drinks'])) ? $_POST['drinks'] : null;
$budget = (isset($_POST['budget'])) ? $_POST['budget'] : 0;
$idEventRequestStatus = 1;

//execute
$sql = "INSERT INTO eventrequest (eventType, eventStartDateTime, eventEndDateTime, attendees, budget, clientRecord, idEventRequestStatus) ".
"VALUES ('".$eventType."', '".$eventStartDateTime."', '".$eventEndDateTime."', ".$attendees.", ".$budget.", ".$clientRecord.", ".$idEventRequestStatus.");";
$result = modify($sql);

if ($result == -1) {
    $array = ["result" => "success"];
    echo json_encode($array);
} else {
    $array = ["result" => "failure"];
    echo json_encode($array);
}
/*
if ($result == -1) {
    echo "failure";
} else {
    $sql = "INSERT INTO eventrequestpreferences (eventRecord, preference)
            VALUES (".$result.", '".$decorations."');";
    $result = modify($sql);
    $sql = "INSERT INTO eventrequestpreferences (eventRecord, preference)
            VALUES (".$result.", '".$parties."');";
    $result = modify($sql);
    $sql = "INSERT INTO eventrequestpreferences (eventRecord, preference)
            VALUES (".$result.", '".$photos."');";
    $result = modify($sql);
    $sql = "INSERT INTO eventrequestpreferences (eventRecord, preference)
            VALUES (".$result.", '".$breakfast."');";
    $result = modify($sql);
    $sql = "INSERT INTO eventrequestpreferences (eventRecord, preference)
            VALUES (".$result.", '".$drinks."');";
    $result = modify($sql);


    echo "success";
}*/
?>

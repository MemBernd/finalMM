
<?php
require_once 'connection.php';
$clientRecord = (isset($_POST['clientRecord'])) ? $_POST['clientRecord'] : 0;
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
$username = (isset($_POST['username'])) ? $_POST['username'] : "sarah";

//execute
$sql = "INSERT INTO eventrequest (eventType, eventStartDateTime, eventEndDateTime, attendees, budget, clientRecord, idEventRequestStatus) ".
"VALUES ('".$eventType."', '".$eventStartDateTime."', '".$eventEndDateTime."', ".$attendees.", ".$budget.", ".$clientRecord.", ".$idEventRequestStatus.");";
$result = modify($sql);

if ($result == -1) {
    $array = ["result" => "failure"];
    close();
    echo json_encode($array);
} else {
    $array = ["result" => "success"];
    $sql ="INSERT INTO `task` (`subject`, `description`, `priority`, `status`, `eventRecord`, `creator`, `assignee`)"
        . " VALUES ('Initial Request decision', 'Accept or reject the event request by clientRecord ".$clientRecord."', 'high', 'created', ".$result.", '".$username."', 'janet');";
    $result2 = modify($sql);
    close();
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

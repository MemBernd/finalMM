<?php

require_once 'connection.php';
$username = (isset($_POST['username'])) ? $_POST['username'] : 'janet';

$sql = "SELECT task.idTask, task.subject, task.description, task.priority, eventrequest.idEventRequestStatus as status,"
    ." task.eventRecord, task.creator, task.assignee"
    ." From task join eventrequest on task.eventRecord = eventrequest.eventRecord"
    ." WHERE task.assignee = '".$username."' AND NOT eventrequest.idEventRequestStatus = 10;";
$result = select($sql);
close();
$rows = array();
$rowsAlt = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
    $rowsAlt['object_name'][] = $r;
}
echo json_encode($rows);
//print json_encode($rowsAlt);

?>

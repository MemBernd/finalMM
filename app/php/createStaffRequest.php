<?php

require_once 'connection.php';
$username = (isset($_POST['username'])) ? $_POST['username'] : 'jack';
$jobTitle = (isset($_POST['jobTitle'])) ? $_POST['jobTitle'] : 'test job title';
$jobDescription = (isset($_POST['jobDescription'])) ? $_POST['jobDescription'] : 'test job description';
$experience = (isset($_POST['experience'])) ? $_POST['experience'] : 'test experience';
$idTask = (isset($_POST['idTask'])) ? $_POST['idTask'] : 2;

//$eventRecord = (isset($_POST['eventRecord'])) ? $_POST['eventRecord'] : 1;
//$sql ="INSERT INTO `task` (`subject`, `description`, `priority`, `statusId`, `eventRecord`, `creator`, `assignee`)"
//    . " VALUES ('Staff request', 'More details by clicking.', 'high', 11, ".$eventRecord.", '".$username."', 'simon');";
$sql = "UPDATE `task` SET `subject` = 'Staff request needed.', `priority` = 'high', description = 'Details in the request.',"
    ." `creator` = '".$username."', `assignee` = 'simon', `statusId` = '11' WHERE `task`.`idTask` = ".$idTask.";";
$result = modify($sql);
if ($result == -1) {
    $array = ["result" => "failure"];
} else {
    /*  this update isn't really neded the way the status is handled right now; leaving it here in case it is needed.
    $sql = "UPDATE `eventrequest` SET `idEventRequestStatus` = '11' WHERE `eventrequest`.`eventRecord` = ".$eventRecord.";";
    modify($sql); */
    reseting();
    $sql = "INSERT INTO `staffrequest` (`experience`, `jobTitle`, `jobDescription`, `idTask`) "
        ."VALUES ('".$experience."', '".$jobTitle."', '".$jobDescription."', '".$idTask."');";
    modify($sql);
    $array = ["result" => "success"];
}
close();
echo json_encode($array);
?>

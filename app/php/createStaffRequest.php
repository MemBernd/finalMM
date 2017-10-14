<?php

require_once 'connection.php';
$username = (isset($_POST['username'])) ? $_POST['username'] : 'jack';
$jobTitle = (isset($_POST['jobTitle'])) ? $_POST['jobTitle'] : null;
$jobDescription = (isset($_POST['jobDescription'])) ? $_POST['jobDescription'] : null;
$experience = (isset($_POST['experience'])) ? $_POST['experience'] : null;
$eventRecord = (isset($_POST['eventRecord'])) ? $_POST['eventRecord'] : 0;


$sql ="INSERT INTO `task` (`subject`, `description`, `priority`, `status`, `eventRecord`, `creator`, `assignee`)"
    . " VALUES ('Staff request', 'More details by clicking.', 'high', 'created', ".$eventRecord.", '".$username."', 'simon');";
$result = modify($sql);
if ($result == -1) {
    $array = ["result" => "failure"];
} else {
    $sql = "INSERT INTO `staffrequest` (`experience`, `jobTitle`, `jobDescription`, `idTask`) "
        ."VALUES ('".$experience."', '".$jobTitle."', '".$jobDescription."', '".$result."');";
    modify($sql);
    $array = ["result" => "success"];
}
close();
echo json_encode($array);
?>

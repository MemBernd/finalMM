<?php

require_once 'connection.php';
$idTask = (isset($_POST['idTask'])) ? $_Post['idTask'] : 0;
$amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;

$sql = "SELECT eventRecord from task where idTask = ".$idTask.";";
$result = select($sql);
$array = array();
if($result == -1) {
    $array = ['result' => 'failure'];
} else {
    $eventRecord = $result[];
    $sql = "UPDATE eventRequest SET budget = ".$amount." WHERE eventRecord = ".$eventRecord.";";
    $array = ['result' => 'failure'];
}
close();
echo json_encode($array);
?>

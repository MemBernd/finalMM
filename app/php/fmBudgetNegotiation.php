<?php
$idTask = (isset($_POST['idTask'])) ? $_Post['idTask'] : 0;
$amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;

$sql = "SELECT eventRecord from task where idTask = ".$idTask.";";
$result = modify($sql);
$array = array();
if($result == -1) {
    $array = ['result' => 'failure'];
} else {
    $sql = "UPDATE eventRequest SET budget = ".$amount." WHERE eventRecord = ".$eventRecord.";"
}

?>

<?php
require_once 'connection.php';
$idTask = (isset($_POST['idTask'])) ? $_POST['idTask'] : 10;

echo json_encode(finishTask($idTask));

function finishTask($idTask) {
    $return = 'failure';
    $sql = "UPDATE task SET statusId = 10 where idTask = ".$idTask.";";
    if(modify($sql) != -1) {
        $return = 'success';
    }
    $array = ['result' => $return];
    return $array;
}
?>

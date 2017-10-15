<?php

require_once 'connection.php';
$idTask = (isset($_POST['idTask'])) ? $_Post['idTask'] : 0;
$amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;

echo json_encode(fmBudgetNegotiation($idTask, $amount));

function fmBudgetNegotiation($idTask, $amount) {
    $return = 'failure';
    $sql = "SELECT eventRecord, assignee, creator from task where idTask = ".$idTask.";";
    $result = select($sql);
    $array = array();
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $eventRecord = $row['eventRecord'];
        $newAssignee = $row['creator'];
        $newCreator = $row['assignee'];
        if ($eventRecord > 0) {
            $sql = "UPDATE eventRequest SET budget = ".$amount." WHERE eventRecord = ".$eventRecord.";";
            $result = modify($sql);
            echo $sql;
            if ($result != -1) {
                $sql = "UPDATE `task` SET `subject` = 'Budget negotiation finished. ', description = 'Final amount is ".$amount."', `priority` = 'high', "
                    ." `creator` = '".$newCreator."', `assignee` = '".$newAssignee."', `statusId` = '14' WHERE `task`.`idTask` = ".$idTask.";";
                $result = modify($sql);
                echo $sql;
                if($result != -1) {
                    $return = 'success';
                }
            }
        }
    }
    $array = ['result' => $return];
    close();
    return $array;
}
?>

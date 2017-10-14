<?php

require_once 'connection.php';
$username = (isset($_POST['username'])) ? $_POST['username'] : 'jack';
$idTask = (isset($_POST['idTask'])) ? $_POST['idTask'] : 3;
$reason = (isset($_POST['reason'])) ? $_POST['reason'] : 'No reason provided.';
$amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;

$sql = "UPDATE `task` SET `subject` = 'Budget negotiation initialized.', `priority` = 'high', description = 'Details in the request.',"
    ." `creator` = '".$username."', `assignee` = 'alice', `statusId` = '9' WHERE `task`.`idTask` = ".$idTask.";";
$result = modify($sql);
if ($result == -1) {
    $array = ["result" => "failure"];
} else {
    reseting();
    $sql = "INSERT INTO `financialrequest` (`amount`, `reason`, "
    ."`agreedBudget`, `status`, `idTask`) VALUES (".$amount.", '".$reason."', NULL, NULL, ".$idTask.");";
    modify($sql);
    //echo $sql;
    $array = ["result" => "success"];
}
close();
echo json_encode($array);
?>

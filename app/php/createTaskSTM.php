<?php
require_once 'connection.php';

$idTask = (isset($_POST['idTask'])) ? $_POST['idTask'] : 0;
$description = (isset($_POST['description'])) ? $_POST['description'] : "No description provided";
$assignee = (isset($_POST['assignee'])) ? $_POST['assignee'] : 'no name given';
$priority = (isset($_POST['priority'])) ? $_POST['priority'] : 'medium';

echo json_encode(createTask($idTask, $description, $assignee, $priority));

function createTask($idTask, $description, $assignee, $priority) {
    $return = 'failure';
    $statusId = 15;
    $sql = "select assignee, eventRecord from task where idTask = ".$idTask.";";
    $result = select($sql);
    $subject = 'Create a plan.';

    if ($r = mysqli_fetch_assoc($result)) {

        $sql = "Insert into task (subject, description, priority, eventRecord, creator, assignee, statusId) "
        ." Values ('".$subject."', '".$description."', '".$priority."', ".$r['eventRecord'].", '".$r['assignee']."', "
        ." '".$assignee."', ".$statusId.");";
        echo $sql;
        $result = modify($sql);
        if($result != -1) {
            $return = 'success';
        }
    }

    $array = ['result' => $return];
    return $array;
}
?>

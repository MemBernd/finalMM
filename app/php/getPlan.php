<?php
require_once 'connection.php';

$idTask= (isset($_POST['idTask'])) ? $_POST['idTask'] : 21;

echo json_encode(getPlan($idTask));

function getPlan($idTask) {
    $return = null;
    $array = null;

    $sql = "Select description from plan where idTask = ".$idTask.";";
    $result = select($sql);

    if($r = mysqli_fetch_assoc($result)) {
        $array = $r;
    }
    return $array;
}
?>

<?php
require_once 'connection.php';

//input is id of task
$idTask= (isset($_POST['idTask'])) ? $_POST['idTask'] : 0;
$sql = "call getEventDetailsFromTask(".$idTask.");";
$result = select($sql); //function is called from connection.php
close();
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
?>

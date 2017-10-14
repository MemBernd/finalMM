<?php
require_once 'connection.php';

$sql = "SELECT DISTINCT assignee as username FROM task WHERE task.statusId BETWEEN 7 and 12;";

$result = select($sql);
close();
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
?>

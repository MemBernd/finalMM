<?php
require_once 'connection.php';


$idTask= (isset($_POST['idTask'])) ? $_POST['idTask'] : 2;

$sql = "select * from staffrequest "
    ."WHERE idTask = ".$idTask.";";

$result = select($sql); //function is called from connection.php
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $array = ['experience' => $row['experience'], 'jobTitle' => $row['jobTitle'], 'jobDescription' => $row['jobDescription']];
} else {
    $array = ['experience' => null, 'jobTitle' => null, 'jobDescription' => null];
}
close();
echo json_encode($array);
?>


<?php
require_once 'connection.php';
$idTask = (isset($_POST['idTask'])) ? $_POST['idTask'] : 0 ;
$description = (isset($_POST['description'])) ? $_POST['description'] : 'none';
$result = 0;
    $sql = "call fmProcessed(".$idTask.", '".$description."');";
    $result = execute($sql);
if ($result == 1) {
    $array = ["result" => "success"];
} else {
    $array = ["result" => "failure"];
}
close();
echo json_encode($array);
?>

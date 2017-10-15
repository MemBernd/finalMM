<?php
require_once 'connection.php';


$idTask= (isset($_POST['idTask'])) ? $_POST['idTask'] : 3;
echo json_encode(getFinancialRequest($idTask));

function getFinancialRequest ($idTask) {
    $sql = "select amount, reason from financialrequest "
        ."WHERE idTask = ".$idTask.";";

    $row = null;
    $result = select($sql); //function is called from connection.php
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
    close();
}

?>

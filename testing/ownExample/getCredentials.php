
<?php
include 'connection.php';
$name = (isset($_POST['userName'])) ? $_POST['userName'] : 'no name';
$sql="SELECT * FROM employee WHERE username = '".$name."'";
$result = select($sql); //function is called from connection.php
$row = mysqli_fetch_assoc($result);
$array = ['password' => $row['password'], 'role' => $row['role']];
echo json_encode($array);
?>

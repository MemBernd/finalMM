<?php
$name = (isset($_POST['username'])) ? $_POST['username'] : 'no name';
$con = mysqli_connect('localhost','root','','sep');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"sep");
$sql="SELECT * FROM employee WHERE username = '".$name."'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$array = ['password' => $row['password'], 'role' => $row['role'], 'username' => $row['username']];
echo json_encode($array);
?>
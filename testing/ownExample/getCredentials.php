
<?php
$name = (isset($_POST['userName'])) ? $_POST['userName'] : 'no name';
$con = mysqli_connect('localhost','root','','sep');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"sep");
$sql="SELECT * FROM employee WHERE username = '".$name."'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$array = ['password' => $row['password'], 'role' => $row['role']];
echo json_encode($array);
?>

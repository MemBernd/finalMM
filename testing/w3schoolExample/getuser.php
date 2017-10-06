<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = $_GET['q'];

$con = mysqli_connect('localhost','root','','sep');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"sep");
$sql="SELECT * FROM employee WHERE username = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>password</th>
<th>role</th>
";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['role'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>

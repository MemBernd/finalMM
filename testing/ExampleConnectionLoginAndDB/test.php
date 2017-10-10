

<?php
include 'connection.php';
$name = (isset($_POST['userName'])) ? $_POST['userName'] : 'no name';
return $name;
?>

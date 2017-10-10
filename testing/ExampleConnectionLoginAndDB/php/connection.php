<?php

$con = mysqli_connect('localhost','root','','sep'); //connection details: serverAddress, username, password, database)
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));   //needs to be changed to throw error instead
}
//mysqli_select_db($con,"sep");

//function to execute when selecting something
function select($query) {
    global $con;

    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

//function to execute when inserting or updating
function modify($query) {
    global $con;
    if (mysqli_query($con,$query)) {
        mysqli_close($con);
        return mysql_insert_id($con);
    } else {
        mysqli_close($con);
        return -1;
    }
}

//function to execute when deleting
function delete($query) {
    global $con;
    if(msqli_query($con,$query)) {
        mysqli_close($con);
        return true;
    } else {
        mysqli_close($con);
        return false;
    }
}
?>

<?php

function getTaskList($username) {

        $_POST['username'] = $username;
        //get output
        $testingFile = 'getTaskList.php';
        ob_start(); // Start output buffering
        include dirname(__FILE__).'/../app/php/'.$testingFile.'';
        $list = ob_get_contents(); // Store buffer in variable
        ob_end_clean(); // End buffering and clean up
        $obj = json_decode($list, true);
        return $obj;
}
?>

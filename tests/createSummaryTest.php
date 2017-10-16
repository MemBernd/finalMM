<?php
use PHPUnit\Framework\TestCase;

include 'taskListWrapper.php';

class createSummaryTest extends TestCase
{
    public function testGetTaskList() {
        $username = 'janet';
        $statusId = 4;
        $obj = getTaskList($username);
        $size = sizeof($obj);
        for ($i = 0; $i <$size; $i++) {
            if($obj[$i]['status'] == $statusId) {
                $this -> assertTrue(true);
                return $obj[$i]['idTask'];
            }
        }
        $this -> assertTrue(false, "No task which could be decided upon.");
    }

    /**
    *@depends testGetTaskList
    */
    public function testCreateSummary($idTask) {

        $_POST['idTask']= $idTask;

        //get output
        $testingFile = 'createSummary.php';
        ob_start(); // Start output buffering
        include dirname(__FILE__).'/../app/php/'.$testingFile.'';
        $list = ob_get_contents(); // Store buffer in variable
        ob_end_clean(); // End buffering and clean up
        $obj = json_decode($list, true);
        $size = sizeof($obj);

        $this -> assertEquals("success", $obj['result']);
        return;

    }

    /**
    * @depends testCreateSummary
    */
    public function testCreateSummaryInvalidId() {

        $_POST['idTask'] = -1;

        //get output
        $testingFile = 'createSummary.php';
        ob_start(); // Start output buffering
        include dirname(__FILE__).'/../app/php/'.$testingFile.'';
        $list = ob_get_contents(); // Store buffer in variable
        ob_end_clean(); // End buffering and clean up
        $obj = json_decode($list, true);
        $size = sizeof($obj);

        $this -> assertEquals("failure", $obj['result']);

    }


}

?>

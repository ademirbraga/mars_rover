<?php
require_once('simpletest/autorun.php');

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All tests for SimpleTest ' . SimpleTest::getVersion());
        $this->addFile('/direcao_test.php');
        $this->addFile('/rover_test.php');
        $this->addFile('/plataforma_test.php');
    }
}
?>
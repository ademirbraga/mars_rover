<?php
    require_once('simpletest/autorun.php');
    require_once('../classes/Plataforma.class.php');


class TestOfPlataforma extends UnitTestCase{

    private $plataforma;

    function setUp(){
        $this->plataforma = new Plataforma();
    }
}
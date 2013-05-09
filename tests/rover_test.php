<?php
require_once('simpletest/autorun.php');
require_once('../classes/Rover.class.php');


class TestOfRover extends UnitTestCase{

    private $rover;

    function setUp(){
        $this->rover = new Rover();
    }

    function testProcessa_comando(){
        $this->rover->set_plataforma(5,5);
        $this->rover->set_posicao_rover(1,2, NORTH);
        $this->assertTrue($this->rover->processa_comando('LMRLRM'));
    }

    function testAndar(){
        $this->rover->set_plataforma(5,5);
        $this->rover->set_posicao_rover(1,2, NORTH);
        $this->assertTrue($this->rover->andar());
    }

    function testVerifica_proximo_movimento(){
        $this->rover->set_plataforma(5,5);
        $this->rover->set_posicao_rover(1,2, NORTH);
        $this->assertTrue($this->rover->verifica_proximo_movimento());
    }
}
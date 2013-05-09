<?php
    require_once('simpletest/autorun.php');
    require_once('../classes/Plataforma.class.php');
    require_once('../classes/Direcao.class.php');


class TestOfPlataforma extends UnitTestCase{

    private $plataforma;
    private $direcao;

    function setUp(){
        $this->plataforma = new Plataforma();
        $this->direcao = new Direcao();
    }

    function testExcede_limite_vertical(){
        $this->plataforma->set_tamanho_plataforma(5,5);
        $this->direcao->set_direcao_inicial($x=10,$y=10,$direcao=NORTH);
        $this->assertTrue($this->plataforma->excede_limite_vertical($this->direcao));
    }

    function testExcede_limite_horizontal(){
        $this->plataforma->set_tamanho_plataforma(5,5);
        $this->direcao->set_direcao_inicial($x=6,$y=1,$direcao=EAST);
        $this->assertTrue($this->plataforma->excede_limite_horizontal($this->direcao));
    }

    function testSet_tamanho_plataforma(){
        $this->assertTrue($this->plataforma->set_tamanho_plataforma(3,3));
    }
}
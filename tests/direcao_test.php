<?php
require_once('simpletest/autorun.php');
require_once('../classes/Direcao.class.php');


class TestOfDirecao extends UnitTestCase{
    private $direcao;

    function setUp(){
        $this->direcao = new Direcao();
    }

    function testAtualizar_coordenadas(){
        $this->assertTrue($this->direcao->atualizar_coordenadas(NORTH));
    }

    function testSet_posicao(){
        $this->assertTrue($this->direcao->set_posicao('x',1));
    }

    function testGet_x(){
        $this->assertNotNull($this->direcao->get_x());
    }

    function testGet_y(){
        $direcao = new Direcao();
        $this->assertNotNull($this->direcao->get_y());
    }

    function testVirar_esquerda(){
        $this->direcao->set_direcao(NORTH);
        $this->direcao->virar_esquerda();
        $this->assertNotNull($this->direcao->get_direcao());
    }

    function testVirar_direita(){
        $this->direcao->set_direcao(SOUTH);
        $this->direcao->virar_direita();
        $this->assertNotNull($this->direcao->get_direcao());
    }

    function testGet_esquerda(){
        $this->assertNotNull($this->direcao->get_esquerda(WEST));
    }
    function testGet_direita(){
        $this->assertNotNull($this->direcao->get_direita(EAST));
    }

    function testSet_direcao(){
        $this->assertTrue($this->direcao->set_direcao(WEST));
    }
}
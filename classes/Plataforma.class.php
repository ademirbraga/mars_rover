<?php
require_once('Rover.class.php');

class Plataforma{
    private $x;
    private $y;

    function set_x($x){
        $this->x = $x;
    }
    function set_y($y){
        $this->y = $y;
    }
    function get_x(){
        return $this->x;
    }
    function get_y(){
        return $this->y;
    }

    /**
     * @name set_tamanho_plataforma
     * @param $x
     * @param $y
     * @return bool
     * @throws InvalidArgumentException
     * @desc Seta as dimensoes da plataforma (horizontal e vertical)
     */
    function set_tamanho_plataforma($x,$y){
        $this->set_x($x);
        $this->set_y($y);
    }

    /**
     * @name excede_limite_vertical
     * @param object $objDirecao
     * @return bool
     * @desc Verifica se o movimento do robo vai exceder a plataforma no sentido vertical
     */
    function excede_limite_vertical($objDirecao){
       return ((($objDirecao->get_direcao() == NORTH) && (($objDirecao->get_y()+1) > $this->get_y())) || (($objDirecao->get_direcao() == SOUTH) && (($objDirecao->get_y()-1) < 0)));
    }
    /**
     * @name excede_limite_horizontal
     * @param object $objDirecao
     * @return bool
     * @desc Verifica se o movimento do robo vai exceder a plataforma no sentido horizontal
     */
    function excede_limite_horizontal($objDirecao){
        return ((($objDirecao->get_direcao() == EAST) && (($objDirecao->get_x()+1) > $this->get_x())) ||(($objDirecao->get_direcao() == WEST) && (($objDirecao->get_x()-1) < 0)));
    }
}
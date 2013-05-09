<?php
require_once('Rover.class.php');

class Plataforma{
    private $x;
    private $y;

    function set_tamanho_plataforma($x,$y){
        if(!is_numeric($x) || !is_numeric($y)){
            throw new InvalidArgumentException("Parametros #1 e #2 para o tamanho da plataforma devem ser numeros inteiros. Parametros recebidos #1:'{$x}' e #2:'{$y}' ");
            return false;
        }
        $this->set_x($x);
        $this->set_y($y);
        return true;
    }
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


    function excede_limite_horizontal($objDirecao){
        return $this->excede_limites_plataforma($objDirecao,$d1=EAST,$d2=WEST,$d3='x');
    }
    function excede_limite_vertical($objDirecao){
        return $this->excede_limites_plataforma($objDirecao,$d1=NORTH,$d2=SOUTH,$d3='y');
    }


//    function excede_limite_vertical($objDirecao){
//        if((($objDirecao->get_direcao() == NORTH) && (($objDirecao->get_y()+1) > $this->get_y())) ||(($objDirecao->get_direcao() == SOUTH) && (($objDirecao->get_y()-1) < 0))){
//            throw new ErrorException('Com este movimento a Rover vai sair da plataforma!');
//            return true;
//        }
//        return false;
//    }
//    function excede_limite_horizontal($objDirecao){
//        if((($objDirecao->get_direcao() == EAST) && (($objDirecao->get_x()+1) > $this->get_x())) ||(($objDirecao->get_direcao() == WEST) && (($objDirecao->get_x()-1) < 0))){
//            throw new ErrorException('Com este movimento a Rover vai sair da plataforma!');
//            return true;
//        }
//        return false;
//    }

    function excede_limites_plataforma($objDirecao,$d1=EAST,$d2=WEST,$d3='x'){
        $f = 'get_'.$d3;
        if((($objDirecao->get_direcao() == $d1) && (($objDirecao->$f()+1) > $this->$f())) ||(($objDirecao->get_direcao() == $d2) && (($objDirecao->$f()-1) < 0))){
            throw new ErrorException('Com este movimento a Rover vai sair da plataforma!');
            return true;
        }
        return false;
    }
}
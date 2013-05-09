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

    function rover_esta_na_plataforma(Rover $rover){
        if($rover->objDirecao->get_x() > $this->get_x() || $rover->objDirecao->get_y() > $this->get_y()){
            throw new ErrorException('Rover esta fora da plataforma!');
            return false;
        }
        return true;
    }
}
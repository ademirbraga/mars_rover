<?php

defined('NORTH') or define('NORTH','N');
defined('EAST')  or define('EAST','E');
defined('SOUTH')  or define('SOUTH','S');
defined('WEST')  or define('WEST','W');

class Direcao{
    private $x = null;
    private $y = null;
    private $direcao = null;
    private $esquerda = array(NORTH=>WEST,SOUTH=>EAST,EAST=>NORTH,WEST=>SOUTH);
    private $direita = array(NORTH=>EAST,SOUTH=>WEST,EAST=>SOUTH,WEST=>NORTH);
    private $cardinais = array(NORTH,EAST,SOUTH,WEST);

    function set_direcao_inicial($x=null,$y=null,$direcao=null){
        $this->x = !is_null($x) ? $x : 0;
        $this->y = !is_null($y) ? $y : 0;
        $this->direcao = !is_null($direcao) ? $direcao : NORTH;
    }

    function get_x(){
        return $this->x;
    }
    function get_y(){
        return $this->y;
    }
    function get_direcao(){
        return $this->direcao;
    }

    /**
     * @name atualizar_coordenadas
     * @param string $direcao
     * @return bool
     * @throws InvalidArgumentException
     * @desc Atualiza as coordenadas x ou x de acordo com a direcao dada
     */
    function atualizar_coordenadas($direcao=NORTH){
        if(!in_array($direcao,$this->cardinais)){
            throw new InvalidArgumentException('Parametro deve ser um dos seguintes: N,S,W,E');
            return false;
        }else{
            switch($direcao){
                case NORTH: $this->set_posicao('y',1);break;
                case SOUTH: $this->set_posicao('y',-1); break;
                case EAST:  $this->set_posicao('x',1); break;
                case WEST:  $this->set_posicao('x',-1); break;
            }
            return true;
        }
    }

    function set_posicao($posicao='x',$valor=0){
        if(in_array($posicao,array('x','y')) && is_numeric($valor)){
            $this->$posicao += $valor;
            return true;
        }else{
            throw new InvalidArgumentException('Parametro #1 deve ser:"x" ou "y"  e Parametro #2 deve ser um inteiro. Paramtro #1:'.$posicao.": Parametro #2: $valor") ;
            return false;
        }
    }

    function set_direcao($direcao=NORTH){
        if(!in_array($direcao,$this->cardinais)){
            throw new InvalidArgumentException('Parametro deve ser um dos seguintes: N,S,W,E. Parametro recebido='.$direcao);
            return false;
        }else{
            $this->direcao = $direcao;
            return true;
        }
    }

    function get_esquerda($atual=NORTH){
        if(!in_array($atual,$this->cardinais)){
            throw new InvalidArgumentException('Parametro deve ser um dos seguintes: N,S,W,E. Parametro recebido='.$atual);
            return false;
        }else{
            return $this->esquerda[$atual];
        }
    }
    function get_direita($atual=NORTH){
        if(!in_array($atual,$this->cardinais)){
            throw new InvalidArgumentException('Parametro deve ser um dos seguintes: N,S,W,E. Parametro recebido='.$atual);
            return false;
        }else{
            return $this->direita[$atual];
        }
    }
    function virar_direita(){
        $this->set_direcao($this->get_direita($this->get_direcao()));
    }
    function virar_esquerda(){
        $this->set_direcao($this->get_esquerda($this->get_direcao()));
    }

}


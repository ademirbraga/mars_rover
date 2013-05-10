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
    private $cardinais = array(NORTH,SOUTH,EAST,WEST);

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
    function get_cardeais(){
        return $this->cardinais;
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
                case NORTH: $this->set_posicao('y',1,$direcao);break;
                case SOUTH: $this->set_posicao('y',-1,$direcao); break;
                case EAST:  $this->set_posicao('x',1,$direcao); break;
                case WEST:  $this->set_posicao('x',-1,$direcao); break;
            }
            return true;
        }
    }

    function set_posicao($posicao='x',$valor=0,$direcao){
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

    /**
     * @name get_esquerda
     * @param string $atual
     * @return bool
     * @throws InvalidArgumentException
     * @desc Captura a direcao à esquerda da direcao atual: ex: se estiver na direcao NORTH, a direcao a esquerda sera WEST
     */
    function get_esquerda($atual=NORTH){
        if(!in_array($atual,$this->cardinais)){
            throw new InvalidArgumentException('Parametro deve ser um dos seguintes: N,S,W,E. Parametro recebido='.$atual);
            return false;
        }else{
            return $this->esquerda[$atual];
        }
    }

    /**
     * @name get_direita
     * @param string $atual
     * @return bool
     * @throws InvalidArgumentException
     * @desc Captura a direcao à direita da direcao atual: ex: se estiver na direcao NORTH, a direcao a direita sera EAST
     */
    function get_direita($atual=NORTH){
        if(!in_array($atual,$this->cardinais)){
            throw new InvalidArgumentException('Parametro deve ser um dos seguintes: N,S,W,E. Parametro recebido='.$atual);
            return false;
        }else{
            return $this->direita[$atual];
        }
    }

    /**
     * @name virar_direita
     * @desc Metodo para mudar a direcao da rover para a direita da direcao atual
     */
    function virar_direita(){
        $this->set_direcao($this->get_direita($this->get_direcao()));
    }

    /**
     * @name virar_esquerda
     * @desc Metodo para mudar a direcao da rover para a esquerda da direcao atual
     */
    function virar_esquerda(){
        $this->set_direcao($this->get_esquerda($this->get_direcao()));
    }

}


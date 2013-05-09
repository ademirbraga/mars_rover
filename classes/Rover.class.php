<?php
/**
 * Um esquadrão de robôs robóticos estão a desembarcar pela NASA em um platô em Mars.This planalto, que é
 * curiosamente rectangular, deve ser navegado por therovers para que as câmeras on-board pode obter uma
 * visão completa do terreno circundante para enviar de volta para Terra.

    A localização e posição da sonda é representado por uma combinação de x e y de coordenadas e uma letra que representa
    um dos quatro pontos cardeais cardinais. O patamar é dividido em uma grade para simplificar a navegação.
    Uma posição de exemplo pode ser 0, 0, N, o que significa que o rover está no fundo
    canto esquerdo e virado para Norte.
 *
  A fim de controlar um rover, a NASA envia uma simples seqüência de letras. As letras possíveis são:
 * ===============================================================================================================================================
 * -------------->>>'L' e 'R' faz o spin rover 90 graus para a esquerda ou direita, respectivamente, sem sair de seu local atual.
 * -------------->>>'M':: Significa avançar um ponto de grade, e manter a mesma posição.
 * ===============================================================================================================================================
 *
    Suponha que a praça directamente do Norte a partir de (x, y) é (x, y +1).
 *
 * ENTRADA:
    A primeira linha da entrada é as coordenadas superior direito do planalto, as coordenadas inferior esquerdo estão
 * a ser assumida 0,0.

    O resto da entrada é a informação referente às sondas que foram implantados. Cada robô tem duas linhas de entrada.
 * A primeira linha dá a posição do rover, ea segunda linha é uma série de instruções dizendo o rover como explorar o planalto.

    A posição é composta de dois inteiros e uma carta separados por espaços, correspondentes à x e um co-ordenadas e
 * orientação do robô.

    Cada rover será concluída em seqüência, o que significa que o segundo rover não vai começar a se mover até que a
 * primeira terminou em movimento.


    SAÍDA
        A saída para cada rover deve ser o seu último coordenadas e título.
 *
 *
 * **************************************************************************************
 * INPUT AND OUTPUT

        Test Input:

        5 5
        1 2 N
        LMLMLMLMM
 *
        3 3 E
        MMRMMRMRRM

        Expected Output:

        1 3 N
        5 1 E
 **************************************************************************************/
require_once('Direcao.class.php');
require_once('Plataforma.class.php');


class Rover{
    public $objDirecao;
    public $objPlataforma;

    function __construct(){
        $this->objDirecao = new Direcao();
        $this->objPlataforma = new Plataforma();
    }

    function set_posicao_rover($x=0,$y=0,$direcao=NORTH){
        if(!is_numeric($x) || !is_numeric($y) || !in_array($direcao,array(NORTH,SOUTH,EAST,WEST)) || $x < 0 || $y < 0){
            throw new InvalidArgumentException("Parametros #1 e #2 devem ser numeros inteiros positivos. Parametro #3 deve ser um dos seguintes: N,S,W,E");
            return false;
        }
        $this->objDirecao->set_direcao_inicial($x,$y,$direcao);
        return true;
    }

    function set_plataforma($x,$y){
        $this->objPlataforma->set_tamanho_plataforma($x,$y);
    }

    /**
     * @name processa_comando
     * @param string $comandos
     * @throws InvalidArgumentException
     * @desc Metodo para processar o comando enviado ao robo, virar a direita , esquerda e movimentar-se
     */
    function processa_comando($comandos='LMLMLMLMM'){
        if(!empty($comandos)){
            $comandos = str_split($comandos,1);
            foreach($comandos as $comando){
                if($comando == 'M'){
                    $this->andar();
                }elseif($comando == 'L'){
                    $this->objDirecao->virar_esquerda();
                }elseif($comando == 'R'){
                    $this->objDirecao->virar_direita();
                }else{
                    throw new InvalidArgumentException("Comando nao reconhecido, tente: L, R ou M. Parametro Recebido='".implode('',$comandos)."'");
                    return false;
                }
            }
            return true;
        }else{
            throw new InvalidArgumentException("Comando nao reconhecido, tente: L, R ou M. Parametro Recebido='".$comandos."'");
            return false;
        }
    }

    /**
     * @name andar
     * @desc: Metodo para realizar o movimento do robo
     */
    function andar(){
        if($this->verifica_proximo_movimento()){
            $direcao = $this->objDirecao->get_direcao();
            $this->objDirecao->atualizar_coordenadas($direcao);
            return true;
        }
        return false;
    }

    /**
     * @name verifica_proximo_movimento
     * @return bool
     * @throws ErrorException
     * @desc Verifica se o proximo movimento da rover eh permitido, ou seja, o movimento nao pode ultrapassar as
     * dimensoes da plataforma impostas pelo usuario
     */
    function verifica_proximo_movimento(){
        if(
            (($this->objDirecao->get_direcao() == NORTH) && (($this->objDirecao->get_y()+1) > $this->objPlataforma->get_y())) ||
            (($this->objDirecao->get_direcao() == SOUTH) && (($this->objDirecao->get_y()-1) < 0))||

            (($this->objDirecao->get_direcao() == EAST) && (($this->objDirecao->get_x()+1) > $this->objPlataforma->get_x())) ||
            (($this->objDirecao->get_direcao() == WEST) && (($this->objDirecao->get_x()-1) < 0))

            ){
            throw new ErrorException('Com este movimento a Rover vai sair da plataforma!');
            return false;
        }
        return true;
    }

    /**
     * @name print_posicao
     * @return string
     * @desc Metodo para pegar a posicao atual do robo
     */
    function print_posicao(){
        return "{$this->objDirecao->get_x()} {$this->objDirecao->get_y()} {$this->objDirecao->get_direcao()}\n";
    }
}

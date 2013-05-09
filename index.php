<?php

require_once('classes/Rover.class.php');

if(!empty($_POST)){
//echo'<pre>';print_r($_POST);echo'</pre>';
    foreach($_POST['x'] as $k=>$v){
        //plataforma: 5 5
        //rover #1
        //ENTRADA: 1 2 N
        //COMANDO: LMLMLMLMM
        //SAIDA:   1 3 N
        $rover = new Rover();
        $rover->set_plataforma($_POST['d1'],$_POST['d2']);
        $rover->set_posicao_rover($_POST['x'][$k], $_POST['y'][$k], $_POST['d'][$k]);
        $rover->processa_comando($_POST['c'][$k]);
        $resultado[$k] = $rover->print_posicao();
    }
}
?>
<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="./public/js/jquery-1.8.0.min.js"></script>
    </head>
    <body>
    <form action="#" method="POST" id="frm" name="frm">
        <fieldset>
            <legend>Dimensões da Plataforma</legend>
            <div>
                <div>
                    X<input type="text" name="d1" id="d1" value="<?php echo @$_POST['d1']?>"/>
                    Y<input type="text" name="d2" id="d2" value="<?php echo @$_POST['d2']?>"/>
                </div>
        </fieldset>
        <fieldset>
            <legend>Mars Rover</legend>
            </div>
                <div>
                    <table>
                        <tr>
                            <th>X</th>
                            <th>Y</th>
                            <th>Direção</th>
                            <th>Comando</th>
                            <th>Resultado</th>
                        </tr>
                        <tbody id="tbDados">
                            <?php
                                if(!empty($_POST)){
                                    foreach($_POST['x'] as $k=>$v){
                                        $remove = ($k > 0) ? "<td><a href='javascript:void(0);' onclick='remover({$k})'>Remover</a></td>":'';
                                        echo"<tr id='tr_{$k}'>
                                                <td><input type='text' name='x[{$k}]' id='x_{$k}' value='{$_POST['x'][$k]}'></td>
                                                <td><input type='text' name='y[{$k}]' id='y_{$k}' value='{$_POST['y'][$k]}'></td>
                                                <td><input type='text' name='d[{$k}]' id='d_{$k}' value='{$_POST['d'][$k]}'></td>
                                                <td><input type='text' name='c[{$k}]' id='c_{$k}' value='{$_POST['c'][$k]}'></td>
                                                <td><input type='text' name='r[{$k}]' id='r_{$k}' value='{$resultado[$k]}' disabled='disabled'></td>
                                                {$remove}
                                            </tr>";
                                    }
                                }else{
                                    echo ' <tr id="tr_0">
                                                <td><input type="text" name="x[0]" id="x_0" value=""></td>
                                                <td><input type="text" name="y[0]" id="y_0" value=""></td>
                                                <td><input type="text" name="d[0]" id="d_0" value=""></td>
                                                <td><input type="text" name="c[0]" id="c_0" value=""></td>
                                                <td><input type="text" name="r[0]" id="r_0" value="" disabled="disabled"></td>
                                                <td></td>
                                            </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <input type="button" name="add" id="add" value="Adicionar">
                </div>


        </fieldset>
        <div>
            <input type="submit" name="enviar" id="enviar" value="Enviar">
        </div>
    </form>
    </body>
    <script type="text/javascript">
        var id = <?php if (!@empty($_POST['x'])) echo @count($_POST['x']);else echo  1; ?>;
        $("#add").click(function(){
            var tr = '<tr id="tr_'+id+'">' +
                    '<td><input type="text" name="x['+id+']" id="x_'+id+'" value=""/></td>' +
                    '<td><input type="text" name="y['+id+']" id="y_'+id+'" value=""/></td>' +
                    '<td><input type="text" name="d['+id+']" id="d_'+id+'" value=""/></td>' +
                    '<td><input type="text" name="c['+id+']" id="c_'+id+'" value=""/></td>' +
                    '<td><input type="text" name="r['+id+']" id="r_'+id+'" value="" disabled="disabled"/></td>' +
                    '<td><a href="javascript:void(0);" onclick="remover('+id+')">Remover</a></td>' +
                    '</tr>';
            $("#tbDados").append(tr);
            id++;
        });

        function remover(id){
            $("#tr_"+id).remove();
        }
    </script>
</html>

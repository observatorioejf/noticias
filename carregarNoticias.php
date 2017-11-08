<?php
include_once './validacao.php';
include_once './autoload.php';
include '../conn.php';

use Classes\ControleNoticia;

$funcoes = new ControleNoticia($conn);

$resultado = $funcoes->buscarTodos();

while ($obj = $resultado->fetch_assoc()) :
    $date = date("d/m/Y H:i:s", strtotime($obj['data']));
    $noticias['data'] = $date;
    $noticias['id'] = $obj['id'];
    $noticias['titulo'] = $obj['titulo'];
    if($obj['endereco'] == "Notícia Interna"){
        $classEditar = "editar-interna";
    } else {
        $classEditar = "editar-externa";
    }
    $noticias['endereco'] = $obj['endereco'];
    $noticias['ativada'] = ($obj['ativada'] !== 0) ? "Sim" : "Não";
    $noticias['exibir_historico'] = ($obj['exibir_historico'] !== 0) ? "Sim" : "Não";
    $noticias['operacoes'] = '<button title="Ver" id="'.$obj['id'].'" type ="button" class="btn btn-primary btn-xs detalhes"><i class="fa fa-search-plus"></i></button>&nbsp;' .
            '<button title="Editar" id="'.$obj['id'].'" type ="button" class="btn btn-primary btn-xs '.$classEditar.'"><i class="fa fa-pencil"></i></button>&nbsp;' .
            '<button title="Excluir" id="'.$obj['id'].'" type ="button" class="btn btn-primary btn-xs excluir"><i class="fa fa-times"></i></button>';
    $rows["data"][] = $noticias;
endwhile;

echo json_encode($rows);
<?php
include_once './validacao.php';
include_once '../conn.php';
include_once './autoload.php';

use Classes\ControleNoticia;

$funcoes = new ControleNoticia($conn);


//$controleNoticia->alterar('Rede InoGov fará última reunião do ano no dia 15/12s', 'img/inova_tcusd.jpg', false, '', 37);
$resultado = $funcoes->buscarPorId(41);


//while ($obj = $resultado->fetch_assoc()) {
//    var_dump($obj['usuario']);
//    $usuario = substr((explode('@', $obj['usuario']))[1] , 0,3);
//    $fonte = ($usuario == 'cjf') ? strtoupper($usuario) : strtoupper(substr((explode('@', $obj['usuario']))[1] , 0,4));
//    $obj['fonte'] = $fonte;
//    var_dump($obj);
//
//    $a[] = $obj;
//}

//var_dump($resultado->fetch_assoc());

$result = $resultado->fetch_assoc();
$usuario = substr((explode('@', $result['usuario']))[1] , 0,3);
$fonte = ($usuario == 'cjf') ? strtoupper($usuario) : strtoupper(substr((explode('@', $result['usuario']))[1] , 0,4));
$result['fonte'] = $fonte;

var_dump($result);
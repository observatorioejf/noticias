<?php

if (!isset($_POST['titulo']) || !isset($_POST['endereco']) || !isset($_POST['img'])) {
    header("Location: index.php");
    die();
}

include '../conn.php';
mysqli_select_db($conn, "noticias") or die(mysqli_error($conn));

if (!isset($_SESSION)) {
    session_start();
}

$endereco = $_POST ["endereco"];

$queryInsercao = "INSERT INTO tb_noticias (endereco, titulo, nome_imagem, ativada) VALUES ('$endereco', '$titulo','$name',true)";



$resultadoDaInsercao = mysqli_query($conn, $queryInsercao) or die(mysqli_error($conn));

if ($resultadoDaInsercao) {
    rename('croped/' . $name, 'Imagens/' . $name);
    unset($_SESSION['imagemTemp']);
    $_SESSION['message'] = "cadastroSucesso";
    echo "<script>window.location='index.php'</script>";
} else {
    $_SESSION['message'] = "cadastroErro";
    echo "<script>window.location='index.php'</script>";
}

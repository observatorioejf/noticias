<?php

if (!isset($_POST['titulo']) || !isset($_POST['endereco']) || !isset($_POST['id'])) {
    header("Location: index.php");
    die();
}

include '../conn.php';
mysqli_select_db($conn, "noticias") or die(mysqli_error($conn));

if(!isset($_SESSION)){
    session_start();
}

$id = filter_input(INPUT_POST, $id);
$titulo = $_POST['titulo'];
$endereco = $_POST['endereco'];
$atvd = $_POST['ativada'];

if($atvd==0){
    $ativada = false;
} else{
    $ativada = true;
}

$queryUpdate = ("UPDATE tb_noticias SET titulo='$titulo', endereco='$endereco' , ativada='$atvd' WHERE id='$id'");

$result = mysqli_query($conn, $queryUpdate) or die(mysqli_error($conn));

if ($result == true) {
    $_SESSION['message']="updateSucesso";
    echo "<script>window.location='index.php'</script>"; 
} else {
    $_SESSION['message']="updateErro";
    echo "<script>window.location='index.php'</script>";
}

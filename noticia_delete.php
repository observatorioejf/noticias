<meta charset="utf-8"/>
<?php

if (!isset($_POST['id'])) {
    header("Location: index.php");
    die();
}

include '../conn.php';
mysqli_select_db($conn, "noticias") or die(mysqli_error($conn));

if(!isset($_SESSION)){
    session_start();
}

$id = $_POST['id'];

$pesquisa = mysqli_query($conn, "select * from tb_noticias where id=$id");
$obj = mysqli_fetch_object($pesquisa);
$nome_imagem = $obj->nome_imagem;

$queryDelete = ("DELETE FROM tb_noticias WHERE id=$id");  


$result = mysqli_query($conn, $queryDelete);

if ($result == true) {
    unlink('Imagens/' . $nome_imagem);
    $_SESSION['message']="deleteSucesso";
    echo "<script>window.location='index.php'</script>"; 
} else {
    $_SESSION['message']="deleteErro";
    echo "<script>window.location='index.php'</script>"; 
}

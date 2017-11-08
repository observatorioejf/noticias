<?php

include '../conn.php';
mysqli_select_db($conn, "noticias") or die(mysqli_error($conn));

$id = $_GET['id'];

// Executa a query, trazendo os dados do banco
$query = "SELECT * FROM tb_noticias where id = $id";
$result = mysqli_query($conn, $query);


while ($obj = mysqli_fetch_object($result)) {
    $id = $obj->id;
    $foto = $obj->imagem;
    $tipo = $obj->tipo_imagem;
    header("Content-type: $tipo");
    print $foto;
}

<?php

/**
 * Description of NoticiaDAO
 *
 * @author Danilo
 */

namespace Classes\DAO;

use Classes\Model\Noticia;

class NoticiaDAO {

    private $conn;
    private $noticia;
    private $noticias;

    public function __construct($conn) {
        $this->conn = $conn;
        mysqli_select_db($this->conn, "noticias");
        $this->noticia = new Noticia();
        $this->carregarTodasNoticias();
    }

    function carregarTodasNoticias() {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM tb_noticias");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($obj = $result->fetch_object()) {
            $this->noticias[] = new Noticia($obj->id, $obj->endereco, $obj->titulo, $obj->nome_imagem, $obj->texto);
        }
    }

    function adicionar($titulo, $endereco, $nome_imagem, $texto = "") {
        $stmt = mysqli_prepare($this->conn, "INSERT INTO tb_noticias (titulo, endereco, nome_imagem, texto, ativada) VALUES(?,?,?,?,1)");
        $stmt->bind_param("ssss", $titulo, $endereco, $nome_imagem, $texto);
        $resultado = $stmt->execute();
        $this->carregarTodasNoticias();
        return $resultado;
    }

    function remover($id) {
        $stmt = mysqli_prepare($this->conn, "DELETE FROM tb_noticias where id=?");
        $stmt->bind_param("i", $id);
        $resultado = $stmt->execute();
        $this->carregarTodasNoticias();
        return $resultado;
    }

    function editar($id, $titulo, $endereco, $ativada, $texto) {
        $stmt = mysqli_prepare($this->conn, "UPDATE tb_noticias set titulo=?, endereco=?, ativada=?, texto=? WHERE id=?");
        $stmt->bind_param("ssisi", $titulo, $endereco, $ativada, $texto, $id);
        $resultado = $stmt->execute();
        $this->carregarTodasNoticias();
        return $resultado;
    }

    function getNoticia() {
        return $this->noticia;
    }

    function getNoticias() {
        return $this->noticias;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

    function setNoticia($noticia) {
        $this->noticia = $noticia;
    }

    function setNoticias($noticias) {
        $this->noticias = $noticias;
    }

}

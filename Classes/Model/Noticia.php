<?php

/**
 * Description of Noticia
 *
 * @author Danilo
 */
namespace Classes\Model;

class Noticia {

    private $id;
    private $endereco;
    private $titulo;
    private $nome_imagem;
    private $texto;

    public function __construct($id=null, $endereco=null, $titulo=null, $nome_imagem=null, $texto=null) {
        $this->id = $id;
        $this->endereco = $endereco;
        $this->titulo = $titulo;
        $this->nome_imagem = $nome_imagem;
        $this->texto = $texto;
    }

    function getId() {
        return $this->id;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getNome_imagem() {
        return $this->nome_imagem;
    }

    function getTexto() {
        return $this->texto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setNome_imagem($nome_imagem) {
        $this->nome_imagem = $nome_imagem;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

}

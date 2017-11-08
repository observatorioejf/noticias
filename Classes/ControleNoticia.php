<?php
namespace Classes;
/**
 * Description of ControleNoticia
 *
 * @author Danilo
 */
class ControleNoticia {
    private $conn;
	private $mensagem;
	
    public function __construct($conn) {
        $this->conn = $conn;
        mysqli_select_db($this->conn, "noticias");
    }

    function buscarTodos() {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM tb_noticias");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function buscarPorId($id) {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM tb_noticias WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function alterar($titulo, $endereco, $texto, $ativada, $exibir_historico, $id) {
        $stmt = mysqli_prepare($this->conn, "UPDATE tb_noticias SET titulo=?, endereco=? , texto=?, ativada=?, exibir_historico=? WHERE id=?");
        $stmt->bind_param("sssiii", $titulo, $endereco, $texto, $ativada, $exibir_historico, $id);
		
		$querySelect = ("select * from tb_noticias where id=$id");
		$select = mysqli_query($this->conn, $querySelect);
		$obj = mysqli_fetch_object($select);
				
		//$obj = buscarPorId($id);
		//$obj = buscarPorId($id)->fetch_assoc();
		$titulo_antigo = $obj->titulo;
		$endereco_antigo = $obj->endereco;
		$ativada_antigo = $obj->ativada;
		$texto_antigo = $obj->texto;
		$historico_antigo = $obj->exibir_historico;

		
		$this->mensagem = "Alterações ID = $id ";

		if ($titulo != $titulo_antigo)
			$this->mensagem .= "<br> titulo = $titulo_antigo, para titulo = $titulo";
		
		if ($endereco != $endereco_antigo)
			$this->mensagem .= "<br> endereco = $endereco_antigo, para endereco = $endereco";

		if ($ativada != $ativada_antigo)
			$this->mensagem .= "<br> ativada = $ativada_antigo, para ativada = $ativada";
	
		if ($texto != $texto_antigo)
			$this->mensagem .= "<br> texto = $texto_antigo, para texto = $texto";
        if ($exibir_historico != $historico_antigo)
			$this->mensagem .= "<br> exibir_historico = $historico_antigo, para exibir_historico = $exibir_historico";

		$this->mensagem .= ".";
		$this->mensagem = mysqli_real_escape_string($this->conn, $this->mensagem);
		
		
		$result = $stmt->execute(); 
		
		if($result)
			ControleNoticia::log_noticia();
		
        return $result;
    }
    
    function alterarImagem($tamanho, $espacos, $id) {
        $stmt = mysqli_prepare($this->conn, "UPDATE tb_noticias SET tamanho_imagem=?, espacos=? WHERE id=?");
        $stmt->bind_param("ssi", $tamanho, $espacos, $id);
        return $stmt->execute();
    }

    function inserirExterna($endereco, $titulo, $nome_imagem, $tamanho_imagem, $espacos, $usuario) {
        $hora = date('Y-m-d H:i:s');
        $stmt = mysqli_prepare($this->conn, "INSERT INTO tb_noticias (endereco, titulo, nome_imagem, tamanho_imagem, ativada, espacos, data, usuario) VALUES (?,?,?,?,true,?,?,?)");
        $stmt->bind_param("sssssss", $endereco, $titulo, $nome_imagem, $tamanho_imagem, $espacos, $hora, $usuario);
        $result = $stmt->execute();
		
		$this->mensagem .= "Inserção <br> titulo = $titulo, nome_imagem = $nome_imagem, tamanho_imagem = $tamanho_imagem, espacos = $espacos.";
		$this->mensagem = mysqli_real_escape_string($this->conn, $this->mensagem);
		
		if($result)
			ControleNoticia::log_noticia();
		
		return $result;
    }
    
    function inserirInterna($titulo, $nome_imagem, $tamanho_imagem, $texto, $espacos, $usuario) {
        $hora = date('Y-m-d H:i:s');
        $stmt = mysqli_prepare($this->conn, "INSERT INTO tb_noticias (endereco, titulo, nome_imagem, tamanho_imagem, texto, ativada, espacos, data, usuario) VALUES ('Notícia Interna',?,?,?,?,true,?,?,?)");
        $stmt->bind_param("sssssss", $titulo, $nome_imagem, $tamanho_imagem, $texto, $espacos, $hora, $usuario);
        $result = $stmt->execute();
        
		$this->mensagem .= "Inserção  <br> titulo = $titulo, nome_imagem = $nome_imagem, tamanho_imagem = $tamanho_imagem, texto = $texto, espacos = $espacos..";
		$this->mensagem = mysqli_real_escape_string($this->conn, $this->mensagem);
		
		if($result)
			ControleNoticia::log_noticia();
		
		return $result;
    }

    function remover($id) {
        $stmt = mysqli_prepare($this->conn, "DELETE FROM tb_noticias WHERE id=?");
        $stmt->bind_param("i", $id);
		
		
		$querySelect = ("select * from tb_noticias where id=$id");
		$select = mysqli_query($this->conn, $querySelect);
		$obj = mysqli_fetch_object($select);
				
		$titulo = $obj->titulo;
		$endereco = $obj->endereco;
		$ativada = $obj->ativada;
		$texto= $obj->texto;

		$this->mensagem .= "Remoção ID = $id <br> titulo = $titulo, endereco = $endereco, texto = $texto.";
		$this->mensagem = mysqli_real_escape_string($this->conn, $this->mensagem);
		
		$result = $stmt->execute();
		
		if($result)
			ControleNoticia::log_noticia();
		
		return $result;
    }
	
	function log_noticia(){
		//Dados do Sistema:
		$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
		$hora = date('Y-m-d H:i:s');
		$usuario = $_SESSION['UsuarioID'];
		$tabela = "noticias.tb_noticias";
		$sistema = "Noticias";
		
		mysqli_select_db($this->conn, "adm");
		$sql = "INSERT INTO logs VALUES (NULL, '" . $hora . "', '" . $ip . "', '" . $this->mensagem . "', '" . $tabela . "', '" . $usuario . "', '" . $sistema . "')";
		mysqli_query($this->conn, $sql);
	}



}

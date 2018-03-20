<?php
namespace Juliana\Model;
use Juliana\DB\Sql;
use Juliana\Helper\ValidaCPFCNPJ;//lib de terceiros
class Cliente
{	//atributos da classe Cliente
	public $id;
	public $nome;
	public $cpf;
	public $endereco;
	public $email;
	public $senha;
	public $municipio;
	public $estado;
	public $telefone;
	//método construtor da classe Cliente
	public function __construct($id = "", $nome = "", $cpf = "", $endereco = "", $email = "", $senha = "", $municipio = "", $estado = "", $telefone = "")
	{
		$this->id 			= $id;
		$this->nome 		= $nome;
		$this->cpf 			= $cpf;
		$this->endereco 	= $endereco;
		$this->email 		= $email;
		$this->senha 		= $senha;
		$this->municipio 	= $municipio;
		$this->estado 		= $estado;
		$this->telefone 	= $telefone;
	}
	// getters e setters ---------------------- inicio---------------------------//
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	public function getNome()
	{
		return $this->nome;
	}
	public function setNome($nome)
	{
		$this->nome = $nome;
		return $this;
	}
	public function getCpf()
	{
		return $this->cpf;
	}
	public function setCpf($cpf)
	{
		$this->cpf = $cpf;
		return $this;
	}
	public function getEndereco()
	{
		return $this->endereco;
	}
	public function setEndereco($endereco)
	{
		$this->endereco = $endereco;
		return $this;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}
	public function getSenha()
	{
		return $this->senha;
	}
	public function setSenha($senha)
	{
		$this->senha = $senha;
		return $this;
	}
	public function getMunicipio()
	{
		return $this->municipio;
	}
	public function setMunicipio($municipio)
	{
		$this->municipio = $municipio;
		return $this;
	}
	public function getEstado()
	{
		return $this->estado;
	}
	public function setEstado($estado)
	{
		$this->estado = $estado;
		return $this;
	}
	public function getTelefone()
	{
		return $this->telefone;
	}
	public function setTelefone($telefone)
	{
		$this->telefone = $telefone;
		return $this;
	}
    // getters e setters ---------------------- fim ---------------------------//
    //método que retorna o cliente pelo ID
	public function loadById($id){
		$sql = new Sql;
		$result = $sql->select("SELECT * FROM clientes WHERE id = :ID", array(
			":ID" => $id
			));
		if(count($result) > 0){
			return $this->setData($result[0]);
		}
	}
	//seta os dados do cliente
	private function setData($result){
		$c = new Cliente;
		$c->setId($result['id']);
		$c->setNome($result['nome']);
		$c->setSenha($result['senha']);
		$c->setEmail($result['email']);
		$c->setCpf($result['cpf']);
		$c->setMunicipio($result['municipio']);
		$c->setEstado($result['estado']);
		$c->setTelefone($result['telefone']);
		$c->setEndereco($result['endereco']);
		return $c;
	}
	//método que retorna uma lista de clientes
	public static function getList(){
		//este método pode ser estático pois não usa $this-> ou seja, nenhum método da classe
		$sql = new Sql;
		return $sql->select("SELECT * FROM clientes ORDER BY id");
	}
	//método para inserir o cliente no banco de dados
	public function save($nome, $senha, $email, $cpf, $municipio, $estado, $telefone, $endereco){
		$valida = $this->validarCPF($cpf);
		if($valida){
			$cpf = $valida;
			$sql = new Sql;
			$checaEmail = $sql->select("SELECT * FROM clientes WHERE email = :EMAIL", array(
				':EMAIL' => $email
				));
			if(count($checaEmail) > 0){
				return false;
				exit;
			}else{
				$result = $sql->query(
					"INSERT INTO clientes
					(nome, senha, email, cpf, municipio, estado, telefone, endereco) 
					VALUES
					(:NOME, :SENHA, :EMAIL, :CPF, :MUNICIPIO, :ESTADO, :TELEFONE, :ENDERECO)", array(
						':NOME' 		=> $nome,
						':SENHA' 		=> sha1($senha),
						':EMAIL' 		=> $email,
						':CPF'			=> $cpf,
						':MUNICIPIO'	=> $municipio,
						':ESTADO'		=> $estado,
						':TELEFONE'		=> $telefone,
						':ENDERECO'		=> $endereco
						)
					);
				return true;
			}
		}else{
			return false;
		}

	}
	// método que atualiza um cliente
	public function update($id, $nome, $senha, $email, $cpf, $municipio, $estado, $telefone, $endereco){
		$valida = $this->validarCPF($cpf);
		if($valida){
			$cpf = $valida;
			$sql = new Sql;
			$sql->query("UPDATE clientes SET 
				nome = :NOME, email = :EMAIL, senha = :SENHA, cpf = :CPF, municipio = :MUNICIPIO, estado = :ESTADO, telefone = :TELEFONE, endereco = :ENDERECO 
				WHERE id = :ID", array(
					':ID'			=> $id,
					':NOME' 		=> $nome,
					':SENHA' 		=> sha1($senha),
					':EMAIL' 		=> $email,
					':CPF'			=> $cpf,
					':MUNICIPIO'	=> $municipio,
					':ESTADO'		=> $estado,
					':TELEFONE'		=> $telefone,
					':ENDERECO'		=> $endereco
					));
		}else{
			return false;
		}
	}
	//método que apaga um cliente
	public function delete($id){
		$sql = new Sql;
		$sql->query("DELETE FROM clientes WHERE id = :ID", array(
			':ID' => $id
			));
	}
	//função para validar o cpf e formatar antes de salvar no banco
	private function validarCPF($cpf){
		$v = new ValidaCPFCNPJ($cpf);
		$formatado = $v->formata();
		if ( $formatado ) {
			return $formatado; 
		} else {
			return false;
		}
		return false;
	}
}
?>
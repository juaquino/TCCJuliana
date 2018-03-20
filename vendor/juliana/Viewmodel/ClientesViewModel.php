<?php 
namespace Juliana\Viewmodel;
use Juliana\Model\Cliente;
class ClientesViewModel
{
	public static function salvar(){
		$cliente = new Cliente;
		$nome= $_POST['nome'];
		$email= $_POST['email'];
		$senha= $_POST['senha'];
		$estado= $_POST['estado'];
		$municipio= $_POST['municipio'];
		$cpf= $_POST['cpf'];
		$telefone= $_POST['telefone'];
		$endereco= $_POST['endereco'];
		if($cliente->save($nome, $senha, $email, $cpf, $municipio, $estado, $telefone, $endereco)){
			return true;
		}else{
			return false;
		}
	}
	//prepara o usuario para atualizar
	public static function editar(){
		$cliente = new Cliente;
		$id = $_POST['id'];
		$nome= $_POST['nome'];
		$email= $_POST['email'];
		$senha= $_POST['senha'];
		$estado= $_POST['estado'];
		$municipio= $_POST['municipio'];
		$cpf= $_POST['cpf'];
		$telefone= $_POST['telefone'];
		$endereco= $_POST['endereco'];
		if($cliente->update($id, $nome, $senha, $email, $cpf, $municipio, $estado, $telefone, $endereco)){
			return true;
		}else{
			return false;
		}
	}
	//gera as variaveis para editar o usuario na tela e auto preencher os campos
	public static function geraVariaveis($id){
		$cliente = new Cliente;
		$dados_do_cliente = $cliente->loadById($id);
		$dados = array(
			'id' => $dados_do_cliente->id,
			'nome'=> $dados_do_cliente->nome,
			'email'=> $dados_do_cliente->email,
			'senha'=> $dados_do_cliente->senha,
			'estado'=> $dados_do_cliente->estado,
			'municipio'=> $dados_do_cliente->municipio,
			'cpf'=> $dados_do_cliente->cpf,
			'telefone'=> $dados_do_cliente->telefone,
			'endereco'=> $dados_do_cliente->endereco
			);
		return $dados;
	}
}
?>
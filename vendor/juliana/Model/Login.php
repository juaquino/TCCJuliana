<?php
namespace Juliana\Model;
use Juliana\DB\Sql;
class Login
{	//método que tenta o login
	public function check($email, $senha)
	{
		$senha = sha1($senha);
		$sql = new Sql;
		$s = $sql->select("SELECT * FROM clientes WHERE email = :email AND senha = :senha", array(
			':email'=>$email,
			':senha'=>$senha
			));
		if (count($s) > 0 ){
			
			$this->access($email, $s[0]['id']);
			return true;

		}else{
			return false;
		}
	}
	public function access($email, $id_user)
	{
		session_start();
		$_SESSION['id_user'] =  $id_user ;
		$_SESSION['user'] = $email;
	}
}
?>
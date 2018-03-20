<?php 
namespace Juliana\Viewmodel;
use Juliana\Model\Login;
class LoginViewModel
{
	private $email;
	private $senha;
	public function login()
	{
		$this->email = $_POST['email'];
		$this->senha = $_POST['senha'];
		$l = new Login;
		if($l->check($this->email, $this->senha)){
			return true;
		}else{
			return false;
		}
	}
}
?>
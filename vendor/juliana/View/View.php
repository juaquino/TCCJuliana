<?php 
namespace Juliana\View;
class View
{
	/**
	 * Class Constructor - carrega o header da página
	 */
	public function __construct()
	{
		require_once('views/comum/Header.php');
	}
	//carrega a view pelo método
	public function loadView($view, $vars = array())
	{
		//pega um array e cria as variaveis com o nome da key
		if($vars){
			extract($vars, EXTR_SKIP , 'var');
		}
		//inclui a rota desejada
		require_once('views/'. $view . '.php' );
	}
	/**
	 * Class Destructor - carrega o footer da página
	 */
	public function __destruct()
	{
		require_once('views/comum/Footer.php');
	}
}
?>
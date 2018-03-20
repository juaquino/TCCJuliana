<?php 

//carrega as classe na pasta vendor
require_once("vendor/autoload.php");
session_start();

//inclui as classes necessárias
use \Slim\Slim;
use \Juliana\View\View;
use \Juliana\Viewmodel\LoginViewModel;
use \Juliana\Model\Cliente;
use \Juliana\DB\Sql;
use \Juliana\Viewmodel\ClientesViewModel;

$app = new Slim();//este é o framework pra ajudar nas rotas


//cada função a seguir indica uma rota

$app->get('/',function(){
	$view = new View();
	$view->loadView('login');

});
$app->get('/login',function(){
	$view = new View();
	$view->loadView('login');

});

$app->get('/lista',function(){

	$clientes = Cliente::getList();//pega a lista de clientes cadastrados

	$view = new View();
	$view->loadView('lista', array('lista' => $clientes));


});

$app->get('/cadastrar',function(){

	$clientes = new Cliente;

	$view = new View();
	$view->loadView('cadastrar');


});

$app->get('/delete/:id',function($id) use ($app){
	
	$cliente = new Cliente;
	$cliente->delete($id);
	$app->redirect('../login');

});

$app->get('/edit/:id',function($id) use ($app){
	
	$vars = ClientesViewModel::geraVariaveis($id);//gera as variaveis para editar o usuario
	$view = new View();

	$view->loadView('cadastrar', $vars);

});

$app->post('/salvaredicao', function() use ($app){

	if($_POST['id'] == ""){

		$checkemail = ClientesViewModel::salvar();//salva usuario novo no banco
		
		if($checkemail == false){
			$app->redirect('erro');
		}else{

			$app->redirect('login');
		}

		
	}else{
		ClientesViewModel::editar();//atualiza o usuario
		/*** volta pa tela anterior **/
		echo "<script>";
		echo "window.history.back()";
		echo "</script>";
	}

	
	

});

//rota de erro caso o email já esteja em uso ou ocpf for inválido
$app->get('/erro', function(){
	$view = new View();
	$view->loadView('login', array('msg' => 'Email já cadastrado ou CPF Inválido!'));
});


//rota que cria o login

$app->post('/dologin', function() use ($app){

	$lvm = new LoginViewModel;
	$login = $lvm->login();
	//die(json_encode($_SESSION));
	if(@$_SESSION['user']){
		
		$app->redirect('edit/' . $_SESSION['id_user']);
	}else{
		
		$app->redirect('login');
	}

});



$app->get('/logout', function() use ($app){
	session_destroy();
	$app->redirect('login');
});

$app->run();

?>
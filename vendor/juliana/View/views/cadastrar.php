<?php
if($vars['id'] == ""){ // correção de rota para criar e atualizar
	echo '<form method="post" action="salvaredicao">';
	echo '<div>Preencha os seus dados pessoais</div>';
}else{
	echo '<form method="post" action="../salvaredicao">';
}
//campos para o formulário
?>
<div>
	<input required type="hidden" name="id" value="<?=$vars['id']?>">
</div>
<div>
	<label for="nome">Nome:</label>
	<input required type="text" name="nome" value="<?=$vars['nome'] ?>">
</div>
<div>
	<label for="cpf">CPF:</label>
	<input id="cpf" required type="text" name="cpf" value="<?=$vars['cpf'] ?>">
	<div id="msgCPF"></div>
</div>
<div>
	<label for="endereco">Endereço:</label>
	<input required type="text" name="endereco" value="<?=$vars['endereco'] ?>">
</div>
<div>
	<label for="email">Email:</label>
	<input required type="email" name="email" value="<?=$vars['email'] ?>">
</div>
<div>
	<label for="senha">Senha:</label>
	<input required type="password" name="senha" value="">
</div>
<div>
	<label for="municipio">Municipio:</label>
	<input required type="text" name="municipio" value="<?=$vars['municipio'] ?>">
</div>
<div>
	<label for="estado">Estado:</label>
	<input required type="text" name="estado" value="<?=$vars['estado'] ?>">
</div>
<div>
	<label for="telefone">Telefone:</label>
	<input required type="text" name="telefone" value="<?=$vars['telefone'] ?>">
</div>

<div>
	<input class="btn" type="submit" name="" value="Salvar">
</div>
</form>
//botão para exclusão
<?php  
if($vars['id'] != ""){ ?>
<a href="../delete/<?=$vars['id']?>" onclick="return confirm('Tem certeza que deseja excluir sua conta?');">
	<button class="btn red">Excluir Conta</button>
</a>
<?php 
}
?>


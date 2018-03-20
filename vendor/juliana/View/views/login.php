<!--formulário para o login do cliente-->
<h3>
	Olá! Para continuar, digite seu e-mail e senha.
</h3>
<form action="dologin" method="post">
	<div class="form-group">
		<label for="email">E-mail:</label>
		<input type="email" name="email" class="form-control" id="email">
	</div>
	<div class="form-group">
		<label for="pwd">Senha:</label>
		<input type="password" name="senha" class="form-control" id="pwd">
	</div>
	<div class="center">
		<button type="submit" class="btn btn-lg btn-default">
			Continuar
		</button>
	</div>
</div>
</form>
<div class="center" style="margin-top: 5px">
	<a href="cadastrar">
		<button class="btn btn-lg btn-default">
			Criar Conta
		</button>
	</a>
	<?php 
	if($vars['msg']){?>
	<div class="card-panel lighten-2 orange"><?=$vars['msg']?></div>
	<?php
}
?>
</div>


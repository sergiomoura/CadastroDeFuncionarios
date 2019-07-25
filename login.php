<?php 
	// Incluindo funções
	include('./inc/functions.php');

	// Ferificando se o post está vindo
	if($_POST){

		// Guardando o resultado do login (true/false)
		$loginOk = login($_POST['email'],$_POST['senha']);

		// Redirecionando se login estiver OK
		if($loginOk){
			header('location: index.php');
		}

	} else {

		// Garantindo que $loginOk esteja definida com valor padrão igual a true
		$loginOk = true;

	}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cadastro de Funcionários</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
</head>
<body>
	
	<main class="container">
	<div class="row">
		<form class="col-sm-12 col-md-6 offset-3"  action="login.php" method="post">
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="email" class="form-control <?= (!$loginOk?'is-invalid':'')?>" id="email" name="email" placeholder="Digite o seu e-mail">
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" class="form-control <?= (!$loginOk?'is-invalid':'')?>" id="senha" name="senha" placeholder="Digite sua senha">
				<?php if(!$loginOk): ?><div class="invalid-feedback">Informações de login inválidas</div><?php endif; ?>
			</div>
			<button class="btn btn-primary" type="submit">Entrar</button>
		</form>
	</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html
<?php 

	// Definindo uma constante para o nome do arquivo
	define('ARQUIVO','funcionarios.json');
	
	// Definindo constante para guardar caminho das fotos
	define('PASTA_FOTOS','fotos/');

	// Função para validar dados do post
	function errosNoPost(){
		$erros =[];
		if(!isset($_POST['nome']) || $_POST['nome']==''){
			$erros[] = 'errNome';
		}

		if(!isset($_POST['email']) || $_POST['email']==''){
			$erros[] = 'errEmail';
		}

		if(!isset($_POST['senha']) || $_POST['senha']==''){
			$erros[] = 'errSenha';
		}

		if($_POST['conf'] != $_POST['senha']){
			$erros[] = 'errConf';
		}

		return $erros;
	}

	// Carregando o conteúdo do arquivo (string json) para uma variável
	function getFuncionarios(){
		$json = file_get_contents(ARQUIVO);
		$funcionarios = json_decode($json,true);
		return $funcionarios;
	}
	
	// Função que adiciona funcionario ao json
	function addFuncionario($nome,$email,$senha,$foto){

		// Carregando os funcionarios
		$funcionarios = getFuncionarios();

		// Adicionando um novo funcionario ao array de funcionarios
		$funcionarios[] = [
			'nome' => $nome,
			'email' => $email,
			'senha' => password_hash($senha, PASSWORD_DEFAULT),
			'foto' => $foto
		];
		
		// Transformando o array funcionarios numa string json
		$json = json_encode($funcionarios);

		// Salvar a string json no arquivo
		file_put_contents(ARQUIVO,$json); 
	}

	// Função que faz o login do usuário
	function login($email,$senha){

		// Carregando vetor de funcionários
		$funcionarios = getFuncionarios();

		// Buscando o funcionário com o email passado
		$achou = false;
		foreach ($funcionarios as $f) {
			if($f['email'] == $email){
				$achou = true;
				break;
			}
		}


		if($achou){
			// Validando a senha
			if(password_verify($senha,$f['senha'])){
				$loginOk = true;
			} else {
				$loginOk = false;
			}
		} else {
			$loginOk = false;
		}

		return $loginOk;

	}

	// Função que salva a foto do usuário
	function salvaFoto($tmpNome,$nome){
		move_uploaded_file($tmpNome,PASTA_FOTOS.$nome);
	}

	// Função que carrega dados do funcionário a partir do e-mail
	function getFuncionario($email){

		// Carregando vetor de funcionários
		$funcionarios = getFuncionarios();

		// Buscando o funcionário com o email passado
		foreach ($funcionarios as $f) {

			if($f['email'] == $email){

				// Removendo o campo de senha do funcionário
				unset($f['senha']);

				// retornando o funcionário e finalizando a função
				return $f;
			}

		}

		return false;

	}

	// Função que imprime a foto do funcionário ou foto padrão.
	function exibeFoto($funcionario,$class=''){

		// Verificando se foto existe ou se vai por a foto padrao
		if(isset($funcionario['foto']) && file_exists(PASTA_FOTOS.$funcionario['foto'])){
			$foto = PASTA_FOTOS.$funcionario['foto'];
		} else {
			$foto = PASTA_FOTOS.'foto_padrao.jpg';
		}

		// Atribuindo ou nao uma classe
		if($class == ''){
			echo("<img src='$foto' alt='$funcionario[nome]'>");
		} else {
			echo("<img class='$class' src='$foto' alt='$funcionario[nome]'>");
		}
	}
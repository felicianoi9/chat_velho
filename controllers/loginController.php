<?php

class loginController extends Controller  {

	public function index(){		

		$data = array();

		$this->loadView('login',$data);	

	}

	public function signin(){
		$data = array(
			'msg' => '');

		if(!empty($_GET['erro'])){
			if($_GET['erro']== 1){
				$data['msg'] = "Usuário ou Senha inválidos!";
			}
			
		}

		if(!empty($_POST['username'])){
			$username = strtolower($_POST['username']);
			$pass = $_POST['pass'];
			

			$users= new Users();

			if($users->validateUsername($username, $pass)){

				header("Location: ".BASE_URL);
				exit;
				
			}else{
				header("Location: ".BASE_URL."login?erro=1");
				exit;
				
			}
		}else{
			header("Location: ".BASE_URL."login");
			exit;
		}

		$this->loadView('signin',$data);	

	}
	public function signup(){
		$data = array(
			'msg' => '');

		if(!empty($_POST['username'])){
			$username = strtolower($_POST['username']);
			$pass = $_POST['pass'];

			$users= new Users();

			if($users->validateUser($username)){

				if (!$users->userExists($username)){
					$users->registerUser($username, $pass);
					header("Location: ".BASE_URL."login");
				}else{
					$data['msg'] = "Usuário já exite em nosso banco de dados. ";

				}

			}else{
				$data['msg'] = "Usuário não válido! (Digite apenas letras e números)";
			}
		}
		$this->loadView('signup',$data);	
		
	}
}
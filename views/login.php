<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>CHAT - Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/login.css" />
	
</head>
<body>

	<div class="container">
		<h4>Login</h4>
		<?php if(!empty($msg)):?>
			<div class="warning"><?php echo $msg;?></div>
		<?php endif;?>
		<form method="POST" action="<?php echo BASE_URL;?>login/signin">
			Usuário:</br>
			<input type="text" name="username" /></br></br>
			Senha:</br>
			<input type="password" name="pass" /></br></br>

			<input type="submit" value="Entrar" /></br></br>
		</form>
		</br></br>

		<a href="<?php echo BASE_URL;?>login/signup">Faça seu cadastro!</a>

	</div>
	
	
</body>
</html>
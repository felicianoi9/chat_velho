<?php 

class Users extends Model{

	private  $uid;

	public function verifyLogin(){
		if(!empty($_SESSION['chathastlogin'])){
			$s = $_SESSION['chathastlogin'];

			$sql = "SELECT * FROM users WHERE login_hash=:hash";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":hash", $s);
			$sql->execute();

			if($sql->rowCount()>0){
				$data = $sql->fetch();
				$this->uid = $data['id'];
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function getUid(){
		return $this->uid;
	}

	public function validateUser($u){

		if(preg_match('/^[a-z0-9]+$/',$u)){
			return true;
		}else{
			return false;
		}

	}

	public function validateUsername($username, $pass){

		$sql = "SELECT * FROM users WHERE username=:u";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":u",$username);
		$sql->execute();

		if($sql->rowCount()>0){
			$info = $sql->fetch();


			if(password_verify($pass, $info['pass'])){
				$loginhash = md5(rand(0,99999).time().$info['id'].$info['username']);

				$this->setLoginhash($info['id'], $loginhash);

				$_SESSION['chathastlogin'] = $loginhash;


				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}


	}

	private function setLoginhash($uid, $hash){

		$sql = "UPDATE users SET login_hash=:hash WHERE id=:id ";
		$sql = $this->db->prepare($sql); 
		$sql->bindValue(":hash", $hash);
		$sql->bindValue(":id", $uid);
		$sql->execute();




	}

	public function userExists($u){

		$sql = "SELECT * FROM users WHERE username=:$u";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":$u",$u);
		$sql->execute();

		if ($sql->rowCount()>0){
			return true;
		}else{
			return false;
		}

	}

	public function registerUser($username, $pass){

		$newpass = password_hash($pass, PASSWORD_DEFAULT );

		$sql = "INSERT INTO users (username, pass) VALUES (:u, :p) ";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":u",$username );
		$sql->bindValue(":p",$newpass );
		$sql->execute();

	}

	
}
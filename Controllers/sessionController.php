<?php namespace Controllers;

use Models\Session as Session;
	
class sessionController{
	
	private $url = URL;
	private $session;

	public function __construct(){
		$this->session = new Session();
	}

	public function index(){
		header('Location: '. URL . "session/sign_in");
	}

	public function sign_in(){
		if($_POST){
			$username = $_POST['username'];
			$this->session->set("email", $_POST['username']);
			$this->session->set("password", md5($_POST['password']));
			$result = $this->session->auth();
			if ($result == False) {
				header('Location: '. URL . "session/sign_in");
			}else{
				session_start();
				$_SESSION['usuario'] = $username;
				header('Location: '. URL . "estudiantes/index");
			}
		}
	}
	
	public function logout(){
		session_destroy();
 		header("location:".$this->url.'session/sign_in');
	}

	public function register(){
		if($_POST){
			if ($_POST['password'] == $_POST['rpassword']) {
				$this->session->set("email", $_POST['username']);
				$this->session->set("password", md5($_POST['password']));
				$this->session->add();
				header('Location: '. URL . "session/sign_in");
			}
		}
	}
	
	public function delete_user(){}
	public function edit_user(){}
	public function profile(){}
}

?>
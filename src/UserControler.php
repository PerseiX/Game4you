<?php
require 'User.php';
require 'Database.php';
require 'Validation.php';
require '../vendor/autoload.php';
class UserController
{
	public function twigEnvironment(){
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem('../templates/views');
		$twig = new Twig_Environment($loader, array(
			'cache' => null  ));
		return $twig;
	}

	public function showFormAction(){
		$twig = $this->twigEnvironment();
		echo $twig->render("registry.html.twig",array('logged'=> $_SESSION['logged'],
			                                          'login' =>$_SESSION['login']
													 ));

	}
    public function validationAction($post)
    {
	
		$database = new Database();
        $validation = new validation();
		$validEmail = $validation->validEmail($post['email'], $database->queryDatabase('SELECT email FROM users'));
		$validLogin = $validation->validLogin($post['login'], $database->queryDatabase('SELECT login FROM users'));
		$validPassword = $validation->validPassword($post['password'], $post['passwordRepeat']);
		$resultValidation = array(
							'validEmail' => $validEmail,
							'validLogin' => $validLogin,
							'validPassword' => $validPassword,
		);
		
		if($_GET['action'] == "validation"){
			echo json_encode($resultValidation);
		}
	  return $resultValidation;	   
    }
	
	public function registryAction($post){

		$validationResult = $this->validationAction($_POST);
		$result = in_array(false, $validationResult);
        $createUser = false;

		if($result == false){
			$user = new User();			
			$createUser = $user->registry($database = new Database(),$post);

			if($createUser == true){
				//echo "Pomyslnie dodano uzytkownika";
			}		
		}
		else{
			//echo "zwaliduj plik";
		}
		
		$status = array('registryStatus' => $createUser);
		echo json_encode($status);
	}
	
	public function loginAction($post){
		$validation = new Validation();
		$database = new Database();
		$loginUser = false;
		$validationLogin = $validation->loginValidation($post, $database->queryDatabase('SELECT login FROM users'));
		$validationPassword = $validation->passwordValidation($post, $database->queryDatabase('SELECT password FROM users'));
		
		
		if($validationLogin == true && $validationPassword == true){			
			$user = new User();
			$loginUser = $user->login($database->queryDatabase('SELECT * FROM users'), $_POST);
			
			if($loginUser == true){
			//	echo "pomyslnie zalogowano";
			}
			else{
			//	echo "blad logowania. przepraszamy";
			}
		}
		else{
			//echo "bledny login lub haslo";
		}

        $status = array('loginStatus' => $loginUser, 'login' => $_SESSION['login']);
		echo json_encode($status);

	}
	
	public function logOutAction(){

		$twig = $this->twigEnvironment();
		$user = new User();
		$logOutResult = $user->logOut();

		echo $twig->render('index.html.twig', array('successLogOut' => $logOutResult));
	}
}

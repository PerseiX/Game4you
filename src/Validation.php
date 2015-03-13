<?php
class Validation
{	//registryAction and validationAction

    public function validEmail($email, $databaseEmail)
    {
        $validation = true;
        foreach ($databaseEmail as $row) {
            if($row['email'] == $email){
				$validation = false;
            }
        }

        $rulesEmail = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
        if(($validation == true) && (preg_match($rulesEmail, $email))) {
            $validation = true;
        }
        else{
            $validation = false;
        }

        return $validation;
    }
	
    public function validLogin($login, $databaseLogin)
    {
		$validation = true;
        foreach ($databaseLogin as $row) {
            if ($row['login'] == $login) {
                $validation = false;
            }

        }
        if(($validation == true) && ($login != "")) {
            $validation = true;
        }
        else{
            $validation = false;
        }


		return $validation;
    }

    public function validPassword($password, $passwordRepeat)
    {
        if ($password != '' && $passwordRepeat != ''){
            if ($password == $passwordRepeat) {
                return true;
            }
         }
        return false;
    }
	//loginAction
	public function loginValidation($login, $databaseLogin){
		foreach ($databaseLogin as $row) {
            if ($row['login'] == $login) {
                return false;
            }
        }
        return true;
	}
	
	public function passwordValidation($password, $databasePassword){
		foreach ($databasePassword as $row) {
            if ($row['password'] == $password) {
                return false;
            }
        }
        return true;
	}
}

<?php
class User{
   public function registry($databaseConnection, $inputData){
       $registryStatus = false;

       $stmt = $databaseConnection->pdo->prepare('INSERT INTO `users` (`email`,`login`,`password`,`passwordRepeat`,`type`)	VALUES(
				:email,
				:login,
				:password,
				:passwordRepeat,
				:type)');

       $stmt->bindValue(':email', $inputData['email'], PDO::PARAM_STR);
       $stmt->bindValue(':login', $inputData['login'], PDO::PARAM_STR);
       $stmt->bindValue(':password', $inputData['password'], PDO::PARAM_STR);
       $stmt->bindValue(':passwordRepeat', $inputData['passwordRepeat'], PDO::PARAM_STR);
       $stmt->bindValue(':type', "standard", PDO::PARAM_STR);
       $result = $stmt->execute();

       if($result>0){
           $registryStatus = true;
       }
       return $registryStatus;
   }

    public function login($databaseResult, $inputData){
	    $loginStatus = false;
		
        foreach($databaseResult as $row){
            if($row['login'] == $inputData['login'] && $row['password'] == $inputData['password']){
                $_SESSION['logged'] = true;
                $_SESSION['login'] = $row['login'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $loginStatus = true;
            }
        }
        return $loginStatus;
    }

    public function logOut(){
	    $logOutStatus = false;
		$loginDate = array(
					$_SESSION['logged'] = false,
					$_SESSION['login'] = null,
					$_SESSION['id'] = null,
					$_SESSION['email'] = null,
		);
		
		if(in_array(true,$loginDate) == false){
			$logOutStatus = true;
		}
		else{
			$logOutStatus = false;
		}
		return $logOutStatus;
    }

}

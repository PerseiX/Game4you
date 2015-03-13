<?php
class Database{
    public $pdo;
    public function __construct(){
        try {
            $dataObj = json_decode(file_get_contents('databaseConnection.json'));
            $password =  $dataObj->databaseLogin->password;
            $login = $dataObj->databaseLogin->login;

            $db = new PDO('mysql:host=localhost; dbname=g4u', $login, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch
        (PDOException $error) {
            print "Błąd połączenia z bazą!: " . $error->getMessage() . "<br/>";
            die();
        }
        $this->pdo = $db;
    }

    public function queryDatabase($query)
    {
        return $this->pdo->query($query);
    }
}


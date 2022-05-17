<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/model/Usuario.php";

/**
 * Description of TarefaMapper
 * @author felipe
 */
class UsuarioMapper {

    public $dbuser = "root";
    public $dbpass = "";
    public $pdo;

    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=tarefas", $this->dbuser, $this->dbpass);
    }

    public function autenticacao($usuario) {
        $sql = "select * from usuario where login='" .
                $usuario->get_login() . "' and senha="
                . $usuario->get_senha() . "'";
		#print($sql);		
				
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($results)>0){
            return $results[0];
        }else{
             throw new Exception("Usuario ou senha invalidos");
        }      
    }
    
    
     public function buscar() {
        $sql = "select * from usuario;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return  $results;
    }
    

}

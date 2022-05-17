<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/model/Tarefa.php";
/**
 * Description of TarefaMapper
 * @author felipe
 */
class TarefaMapper {
    
    public $dbuser = "root";
    public $dbpass = "";
    public $pdo;
    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=tarefas", $this->dbuser, $this->dbpass);
    }
    public function salvar(Tarefa $tarefa) {
        $sql = "INSERT INTO tarefa (descricao, data_fim, status, user_id) VALUES ('"
                . $tarefa->get_descricao()
                . "','" . date("Y-m-d", strtotime($tarefa->get_data_fim())) . "'"
                . ",1"
                . "," . $_SESSION['user_id']. ");";
		print($sql);
        if ($error = $this->pdo->query($sql) == TRUE) {
            echo "Criado com sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $error;
            throw new Exception("Erro ao criar tarefa" . $error);
        }
    }
    
     public function atualizar(Tarefa $tarefa) {
        $sql = "UPDATE tarefa SET descricao='". $tarefa->get_descricao()  ."'"
                . " WHERE id=" . $tarefa->get_id(). ";";
        //echo $sql;
        if($error = $this->pdo->query($sql) == TRUE) {
            echo "Atualizado com sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $error;
            throw new Exception("Erro ao atualizar tarefa" . $error);
        }
    }
    
    
    public function buscar($user_id) {
        $sql = "select * from tarefa where tarefa.user_id=". $user_id;//recuperando o id por meio da sessao no servidor.
       // $sql = "select * from tarefa";//recuperando o id por meio da sessao no servidor.
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return  $results;
    }
    
    public function remover($id) {
        $sql = "DELETE FROM tarefa WHERE id=" . $id;
        $statement = $this->pdo->prepare($sql );
        if($statement->execute()== false){
            throw new Exception("Não foi possivel remover a tarefa");
        }
    }
}
